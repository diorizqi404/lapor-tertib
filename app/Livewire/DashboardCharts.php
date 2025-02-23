<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Violation;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardCharts extends Component
{
    public $violationsByCategory = [];
    public $violationsByMonth = [];
    public $violationsByClass = [];
    public $violationsByDepartment = [];
    public $topViolatingStudents = [];
    public $topReportingTeachers = [];
    public $violationsOverTime = [];
    public $totalViolationsLast30Days = 0;
    public $newestViolations = [];

    public function mount()
    {
        $school_id = Auth::user()->school_id;

        // 📌 Statistik Pelanggaran Per Kategori (Pie Chart)
        $this->violationsByCategory = Violation::where('school_id', $school_id)
            ->select('violation_category_id', DB::raw('count(*) as total'))
            ->groupBy('violation_category_id')
            ->with('violationCategory:id,name')
            ->get()
            ->map(fn($item) => [
                'name' => $item->violationCategory->name ?? 'Unknown',
                'total' => $item->total,
            ])
            ->toArray();

        // 📌 Statistik Pelanggaran Per Bulan (Line Chart)
        // $this->violationsByMonth = Violation::where('school_id', $school_id)
        //     ->select(DB::raw("DATE_FORMAT(datetime, '%Y-%m') as month"), DB::raw('count(*) as total'))
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->get()
        //     ->pluck('total', 'month')
        //     ->toArray();

        // 📌 Statistik Pelanggaran Per Kelas (Bar Chart)
        // $this->violationsByClass = Student::where('students.school_id', $school_id)
        //     ->join('violations', 'students.id', '=', 'violations.student_id')
        //     ->join('classes', 'students.class_id', '=', 'classes.id')
        //     ->select(DB::raw('CONCAT(grades.name, " ", COALESCE(departments.name, ""), " ", classes.name) as class_name'), DB::raw('count(violations.id) as total'))
        //     ->join('grades', 'classes.grade_id', '=', 'grades.id')
        //     ->leftJoin('departments', 'classes.department_id', '=', 'departments.id')
        //     ->groupBy('class_name')
        //     ->orderByDesc('total')
        //     ->limit(5)
        //     ->get()
        //     ->pluck('total', 'class_name')
        //     ->toArray();

        // 📌 Statistik Pelanggaran Per Jurusan (Bar Chart) - Department opsional
        // $this->violationsByDepartment = Student::where('students.school_id', $school_id)
        //     ->join('violations', 'students.id', '=', 'violations.student_id')
        //     ->leftJoin('classes', 'students.class_id', '=', 'classes.id')
        //     ->leftJoin('departments', 'classes.department_id', '=', 'departments.id')
        //     ->select(DB::raw('COALESCE(departments.name, "Tanpa Jurusan") as department_name'), DB::raw('count(violations.id) as total'))
        //     ->groupBy('department_name')
        //     ->orderByDesc('total')
        //     ->get()
        //     ->pluck('total', 'department_name')
        //     ->toArray();


        // 📌 Siswa Dengan Pelanggaran Tertinggi (Top 5 List)
        $this->topViolatingStudents = Student::where('students.school_id', $school_id)
            ->join('violations', 'students.id', '=', 'violations.student_id')
            ->select('students.name', 'students.photo', 'students.gender', DB::raw('count(violations.id) as total'))
            ->groupBy('students.id', 'students.name', 'students.photo', 'students.gender')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->toArray();

        // 📌 Guru Dengan Laporan Pelanggaran Terbanyak (Top 5 List)
        $this->topReportingTeachers = User::where('role', 'teacher')
            ->where('users.school_id', $school_id)
            ->join('violations', 'users.id', '=', 'violations.teacher_id')
            ->select('users.name', 'users.photo', 'users.gender', DB::raw('count(violations.id) as total'))
            ->groupBy('users.id', 'users.name', 'users.photo', 'users.gender')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->toArray();

        $this->newestViolations = Violation::where('school_id', $school_id)
            ->with('student', 'teacher', 'violationCategory')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->toArray();



        // 📌 Grafik Tren Pelanggaran Dari Waktu Ke Waktu (hari)
        $this->violationsOverTime = Violation::where('school_id', $school_id)
            ->select(DB::raw("DATE_FORMAT(datetime, '%d %b') as date"), DB::raw('count(*) as total'))
            ->where('datetime', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy(DB::raw("MIN(datetime)"))
            ->get()
            ->pluck('total', 'date')
            ->toArray();

        $this->totalViolationsLast30Days = array_sum($this->violationsOverTime);
    }

    public function render()
    {
        return view('livewire.dashboard-charts');
    }
}
