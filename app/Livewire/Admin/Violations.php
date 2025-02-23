<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Violation;
use App\Models\AcademicYear;
use App\Models\Punishment;
use App\Models\Setting;
use App\Models\ViolationCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ViolationsExport;

class Violations extends Component
{
    use WithPagination, WithFileUploads;

    public $school_id, $teacher_id, $student_id, $violation_category_id, $datetime, $description, $point, $photo;
    public $isModalOpen = false;
    public $isEdit = false;
    public $existingPhoto;
    public $selected_id = [];
    public $keyword;
    public $perPage = 10;
    public $selectedStudent = null;

    public $searchCategory = '';
    public $selectedCategory = null;

    public $dateType = 'date';
    public $value = '';

    protected $listeners = ['student-selected' => 'onStudentSelected', 'filterUpdated'];

    public function filterUpdated($dateType, $value)
    {
        $this->dateType = $dateType;
        $this->value = $value;
    }

    public function onStudentSelected($student)
    {
        $this->selectedStudent = $student;
    }

    public function render()
    {
        $this->school_id = Auth::user()->school_id;

        $query = Violation::where('school_id', $this->school_id)
            ->with('teacher', 'student', 'violationCategory')
            ->where(function ($q) {
                $q->whereHas('student', function ($q) {
                    $q->where('name', 'like', '%' . $this->keyword . '%');
                })->orWhereHas('teacher', function ($q) {
                    $q->where('name', 'like', '%' . $this->keyword . '%');
                })->orWhereHas('violationCategory', function ($q) {
                    $q->where('name', 'like', '%' . $this->keyword . '%');
                });
            });

        if ($this->value) {
            if ($this->dateType === 'date') {
                $query->whereDate('datetime', $this->value);
            } elseif ($this->dateType === 'week') {
                $query->whereBetween('datetime', [
                    Carbon::parse($this->value)->startOfWeek(),
                    Carbon::parse($this->value)->endOfWeek(),
                ]);
            } elseif ($this->dateType === 'month') {
                $query->whereMonth('datetime', Carbon::parse($this->value)->month)
                    ->whereYear('datetime', Carbon::parse($this->value)->year);
            }
        }

        $violations = $query->orderBy('datetime', 'desc')->paginate($this->perPage);

        $categories = ViolationCategory::where('school_id', $this->school_id)
            ->where('name', 'like', '%' . $this->searchCategory . '%')
            ->get();

        return view('livewire.admin.violation-menu.violation.violations', [
            'violations' => $violations,
            'selectedStudent' => $this->selectedStudent,
            'categories' => $categories
        ]);
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = ViolationCategory::where('school_id', $this->school_id)
            ->findOrFail($categoryId);


        // Reset pencarian setelah memilih
        $this->searchCategory = '';
    }


    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = false;
    }

    public function resetInputFields()
    {
        $this->teacher_id = '';
        $this->student_id = '';
        $this->violation_category_id = '';
        $this->datetime = '';
        $this->description = '';
        $this->point = '';
        $this->photo = '';
        $this->existingPhoto = '';
        $this->resetValidation();
    }

    public function rules()
    {
        return [
            'selectedStudent.id' => 'required',
            'violation_category_id' => 'required',
            'datetime' => 'required',
            'description' => 'required',
            'photo' => 'required|image|max:4096'
        ];
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEdit = false;
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $teacher = Auth::user();

        $category = ViolationCategory::where('id', $this->violation_category_id)->first();

        $photoPath = $this->photo ? $this->photo->store('violation_photos', 'public') : null;

        $violation = DB::transaction(function () use ($teacher, $category, $photoPath) {
            Violation::lockForUpdate()->create([
                'school_id' => $this->school_id,
                'teacher_id' => $teacher->id,
                'student_id' => $this->selectedStudent["id"],
                'violation_category_id' => $this->violation_category_id,
                'datetime' => $this->datetime,
                'description' => $this->description,
                'point' => $category->point,
                'photo' => $photoPath
            ]);
        });

        $totalPoint = DB::table('violations')
            ->where('student_id', $this->selectedStudent["id"])
            ->sum('point');

        $min_point = Punishment::where('school_id', $this->school_id)
            ->where('min_point', '<=', $totalPoint)
            ->orderBy('min_point', 'desc')
            ->first();

        $punishment = $min_point ? $min_point->name : 'Tidak mendapat hukuman';

        $setting = Setting::where('school_id', $this->school_id)->first();
        $selected_fields = $setting->message_template;

        $pesan =  "Laporan Pelanggaran!\n";

        if (in_array('student_name', $selected_fields)) {
            $pesan .= "Nama Siswa: {$this->selectedStudent['name']}\n";
        }
        if (in_array('violation_name', $selected_fields)) {
            $pesan .= "Pelanggaran: {$category->name}\n";
        }
        if (in_array('teacher_name', $selected_fields)) {
            $pesan .= "Guru Pelapor: {$teacher->name}\n";
        }
        if (in_array('description', $selected_fields)) {
            $pesan .= "Deskripsi: {$this->description}\n";
        }
        if (in_array('punishment', $selected_fields)) {
            $pesan .= "Hukuman: {$punishment}\n";
        }

        // $template = Setting::where('school_id', $this->school_id)->value('message_template');

        // if (empty($template)) {
        //     $template = env('DEFAULT_MESSAGE_TEMPLATE');
        // }

        // $data = [
        //     '{student_name}' => $this->selectedStudent["name"],
        //     '{violation_name}' => $category->name,
        //     '{teacher_name}' => $teacher->name,
        //     '{description}' => $this->description,
        //     '{punishment}' => $punishment
        // ];

        // foreach ($data as $key => $value) {
        //     if (strpos($template, $key) !== false) {
        //         $template = str_replace($key, $value, $template);
        //     }
        // }

        // $message = $template;

        $notelp = $this->selectedStudent["parent_phone"];

        $this->sendWa($notelp, $pesan);

        $this->dispatch('pelanggaran-created');
        flash()->success('Violation saved successfully');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function sendWa($notelp, $message)
    {
        $api = env('WA_API_URL') . "sendText";

        $notelp = str_replace("0", "62", $notelp);

        $response = Http::post($api, [
            "chatId" => $notelp . "@c.us",
            "reply_to" => null,
            "text" => $message,
            "linkPreview" => true,
            "session" => "default"
        ]);

        if ($response->successful()) {
            flash()->success('WhatsApp message sent successfully');
        } else {
            flash()->error('Failed to send WhatsApp message: ' . $response->body());
        }
    }

    public function delete()
    {
        if (count($this->selected_id) == 0) {
            flash()->error('Please select at least one violation');
            return;
        }

        DB::transaction(function () {
            Violation::where('school_id', $this->school_id)
                ->whereIn('id', $this->selected_id)
                ->lockForUpdate()
                ->delete();
        });

        flash()->success('Violation deleted successfully');
        $this->selected_id = [];
    }

    public function resetPoint()
    {
        $start_date = AcademicYear::where('school_id', $this->school_id)
            ->where('status', 'active')
            ->first()->start_date;

        DB::transaction(function () use ($start_date) {
            Violation::where('school_id', $this->school_id)
                ->where('datetime', '<', $start_date)
                ->lockForUpdate()
                ->update([
                    'point' => 0,
                ]);
        });

        flash()->success('Point resetted successfully');
    }

    public function exportExcel()
    {
        return Excel::download(new ViolationsExport(), 'Violations.xlsx');
    }
}
