<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;

class TeachersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 'teacher')
            ->where('school_id', Auth::user()->school_id)
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


