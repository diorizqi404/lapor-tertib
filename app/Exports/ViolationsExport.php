<?php

namespace App\Exports;

use App\Models\Violation;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class ViolationsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Violation::where('violations.school_id', Auth::user()->school_id)
            ->with('teacher', 'student', 'violationCategory')
            ->join('students', 'violations.student_id', '=', 'students.id')
            ->select('students.name as student_name', 'violation_category_name', 'point', 'description', 'datetime', 'teacher_name')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name Siswa',
            'Nama Pelanggaran',
            'Point',
            'Deskripsi',
            'Tanggal & Waktu',
            'Nama Pelapor'
        ];
    }
}
