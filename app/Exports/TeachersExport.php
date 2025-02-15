<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeachersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 'teacher')
            ->where('school_id', auth()->user()->school_id)
            ->select('name', 'email', 'phone', 'gender')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Gender',
        ];
    }
}


