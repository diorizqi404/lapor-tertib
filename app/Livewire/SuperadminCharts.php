<?php
namespace App\Livewire;

use App\Models\Student;
use App\Models\User;
use App\Models\Violation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SuperadminCharts extends Component
{
    public $violationsOverTime  = [];
    public $topSchoolViolations = [];

    public $violationsByCategory      = [];
    public $violationsByMonth         = [];
    public $violationsByClass         = [];
    public $violationsByDepartment    = [];
    public $topViolatingStudents      = [];
    public $topReportingTeachers      = [];
    public $totalViolationsLast30Days = 0;
    public $newestViolations          = [];

    public function mount()
    {
        // 📌 Grafik Tren Pelanggaran Dari Waktu Ke Waktu (hari)
        $this->violationsOverTime = Violation::select(DB::raw("DATE_FORMAT(datetime, '%d %b') as date"), DB::raw('count(*) as total'))
            ->where('datetime', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy(DB::raw("MIN(datetime)"))
            ->get()
            ->pluck('total', 'date')
            ->toArray();

        $school_id = Auth::user()->school_id;

        // 📌 Statistik Pelanggaran Per Bulan (Line Chart)
        // $this->violationsByMonth = Violation::where('school_id', $school_id)
        //     ->select(DB::raw("DATE_FORMAT(datetime, '%Y-%m') as month"), DB::raw('count(*) as total'))
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->get()
        //     ->pluck('total', 'month')
        //     ->toArray();

        // 📌 Sekolah dengan Pelanggaran Tertinggi (Top 5 List)
        $this->topSchoolViolations = Violation::select('schools.name as school_name', DB::raw('count(*) as total'))
            ->join('schools', 'violations.school_id', '=', 'schools.id')
            ->groupBy('schools.id', 'schools.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->pluck('total', 'school_name')
            ->toArray();

        $this->newestViolations = Violation::with('school','student', 'teacher', 'violationCategory')
            ->orderByDesc('datetime')
            ->limit(10)
            ->get()
            ->toArray();

        $this->totalViolationsLast30Days = array_sum($this->violationsOverTime);
    }

    public function render()
    {
        return view('livewire.superadmin-charts');
    }
}
