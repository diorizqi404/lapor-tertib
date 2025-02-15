<?php

    namespace App\Imports;

    use App\Models\User;
    use Illuminate\Support\Collection;
    use Maatwebsite\Excel\Concerns\ToCollection;

    class TeachersImport implements ToCollection
    {
        /**
         * @param array $row
         *
         * @return \Illuminate\Database\Eloquent\Model|null
         */
        public function collection(Collection $rows)
        {
            $barisKe = 1;

            foreach ($rows as $row) {
                if ($barisKe == 1) {
                    $barisKe++;
                    continue;
                }

                User::create([
                    'school_id' => auth()->user()->school_id,
                    'role' => 'teacher',
                    'name' => !empty($row[0]) ? $row[0] : '',
                    'email' => !empty($row[1]) ? $row[1] : '',
                    'phone' => !empty($row[2]) ? $row[2] : '',
                    'gender' => !empty($row[3]) ? $row[3] : '',
                    'password' => !empty($row[4]) ? bcrypt($row[4]) : bcrypt('password'),
                ]);
            }
        }
    }
