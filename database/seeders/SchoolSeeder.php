<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolId = DB::table('schools')->insertGetId([
            'name' => 'SMKN 2 Surabaya',
            'email' => 'official@smkn2sby.sch',
            'address' => 'JL Tentara Genie Pelajara',
            'phone' => '0315343708',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'school_id' => $schoolId,
            'role' => 'admin',
            'name' => 'Rizqi',
            'email' => 'rizqiii.dio@gmail.com',
            'phone' => '0812345678',
            'gender' => 'L',
            'password' => Hash::make('zxcv0000'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $teachers = [
            [
                'name' => 'Agus Winardi',
                'email' => 'agus@gmail.com',
                'phone' => '0812345671',
                'gender' => 'L',
            ],
            [
                'name' => 'Eny Haryati',
                'email' => 'eny@example.com',
                'phone' => '0812345672',
                'gender' => 'P',
            ],
            [
                'name' => 'Yudho Pramono',
                'email' => 'yudho@example.com',
                'phone' => '0812345673',
                'gender' => 'L',
            ],
            [
                'name' => 'Lestari Putri',
                'email' => 'lestari@example.com',
                'phone' => '0812345674',
                'gender' => 'P',
            ],
            [
                'name' => 'Hendro Purwoko',
                'email' => 'hendro@example.com',
                'phone' => '0812345675',
                'gender' => 'L',
            ],
        ];

        foreach ($teachers as $teacher) {
            DB::table('users')->insert([
                'school_id' => $schoolId,
                'role' => 'teacher',
                'name' => $teacher['name'],
                'email' => $teacher['email'],
                'phone' => $teacher['phone'],
                'gender' => $teacher['gender'],
                'password' => Hash::make('zxcv0000'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $academicYearId = DB::table('academic_years')->insertGetId([
            'school_id' => $schoolId,
            'start_date' => '2019-07-15',
            'end_date' => '2020-06-19'
        ]);

        $departments = [
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'initial' => 'RPL',
            ],
            [
                'name' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                'initial' => 'TJKT',
            ],
            [
                'name' => 'Teknik Elektronika Industri',
                'initial' => 'TEI',
            ],
            [
                'name' => 'Teknik Instalasi Tenaga Listrik',
                'initial' => 'TITL',
            ],
            [
                'name' => 'Teknik Pemesinan',
                'initial' => 'TPM',
            ],
        ];

        $departmentIds = [];
        foreach ($departments as $department) {
            $departmentIds[$department['initial']] = DB::table('departments')->insertGetId([
                'school_id' => $schoolId,
                'name' => $department['name'],
                'initial' => $department['initial'],
            ]);
        }

        $grades = ['10', '11', '12'];

        $gradeIds = [];
        foreach ($grades as $grade) {
            $gradeIds[$grade] = DB::table('grades')->insertGetId([
                'school_id' => $schoolId,
                'name' => $grade,
            ]);
        }

        for ($i = 1; $i <= 3; $i++) { // 3 kelas per grade per jurusan
            foreach ($grades as $grade) {
                foreach ($departmentIds as $departmentInitial => $departmentId) {
                    DB::table('classes')->insert([
                        'school_id' => $schoolId,
                        'department_id' => $departmentId,
                        'grade_id' => $gradeIds[$grade],
                        'name' => $i, // Hanya angka
                    ]);
                }
            }
        }

        $classes = DB::table('classes')->pluck('id')->toArray();

        // Data siswa dummy
        $students = [
            ['nis' => '220001', 'name' => 'Ahmad Fauzan', 'gender' => 'L'],
            ['nis' => '220002', 'name' => 'Budi Santoso', 'gender' => 'L'],
            ['nis' => '220003', 'name' => 'Citra Lestari', 'gender' => 'P'],
            ['nis' => '220004', 'name' => 'Dian Pratama', 'gender' => 'L'],
            ['nis' => '220005', 'name' => 'Eka Susanti', 'gender' => 'P'],
            ['nis' => '220006', 'name' => 'Fajar Ramadhan', 'gender' => 'L'],
            ['nis' => '220007', 'name' => 'Gita Permata', 'gender' => 'P'],
            ['nis' => '220008', 'name' => 'Hadi Saputra', 'gender' => 'L'],
            ['nis' => '220009', 'name' => 'Indah Kusuma', 'gender' => 'P'],
            ['nis' => '220010', 'name' => 'Joko Wijaya', 'gender' => 'L'],
        ];

        // Insert data siswa dengan kelas secara acak
        foreach ($students as $student) {
            DB::table('students')->insert([
                'school_id' => $schoolId,
                'class_id' => $classes[array_rand($classes)], // Random class_id dari daftar kelas
                'academic_year_id' => $academicYearId,
                'nis' => $student['nis'],
                'name' => $student['name'],
                'gender' => $student['gender'],
                'parent_phone' => '085198362542',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $violationCategories = [
            [
                'name' => 'Terlambat',
                'point' => 10,
                'description' => 'Terlambat masuk sekolah',
            ],
            [
                'name' => 'Atribut Tidak Lengkap',
                'point' => 5,
                'description' => 'Tidak menggunakan seragam lengkap',
            ],
            [
                'name' => 'Meninggalkan Kelas saat Jam Pelajaran',
                'point' => 7,
                'description' => 'Meninggalkan kelas tanpa izin saat jam pelajaran',
            ],
            [
                'name' => 'Rambut Panjang',
                'point' => 4,
                'description' => 'Rambut panjang melebihi telinga (bagi laki-laki)',
            ],
            [
                'name' => 'Berjudi',
                'point' => 50,
                'description' => 'Berjudi di lingkungan sekolah',
            ],
            [
                'name' => 'Merokok',
                'point' => 40,
                'description' => 'Merokok di lingkungan sekolah',
            ],
            [
                'name' => 'Membawa Senjata Tajam',
                'point' => 75,
                'description' => 'Membawa senjata tajam ke sekolah',
            ],
            [
                'name' => 'Menggunakan Narkoba',
                'point' => 200,
                'description' => 'Menggunakan narkoba di lingkungan sekolah',
            ],
        ];

        foreach ($violationCategories as $category) {
            DB::table('violation_categories')->insert([
                'school_id' => $schoolId,
                'name' => $category['name'],
                'point' => $category['point'],
                'description' => $category['description'],
            ]);
        }

        $punishments = [
            [
                'name' => 'Surat Peringatan 1',
                'min_point' => 20,
            ],
            [
                'name' => 'Surat Peringatan 2',
                'min_point' => 40,
            ],
            [
                'name' => 'Skorsing 3 Hari',
                'min_point' => 60,
            ],
            [
                'name' => 'Skorsing 7 Hari',
                'min_point' => 75,
            ],
            [
                'name' => 'Skorsing 14 Hari',
                'min_point' => 100,
            ],
        ];

        foreach ($punishments as $punishment) {
            DB::table('punishments')->insert([
                'school_id' => $schoolId,
                'name' => $punishment['name'],
                'min_point' => $punishment['min_point'],
            ]);
        }
    }
}
