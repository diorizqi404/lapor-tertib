<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{School, Department, Grade, Classes, User, Student, ViolationCategory, Violation};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run()
    // {
    //     // Buat dua sekolah
    //     $smp = School::factory()->create(['name' => 'SMP Negeri 1']);
    //     $smk = School::factory()->create(['name' => 'SMK Negeri 1']);

    //     // Buat admin untuk masing-masing sekolah
    //     User::factory()->create([
    //         'school_id' => $smp->id,
    //         'role' => 'admin',
    //         'name' => 'Admin SMP',
    //         'email' => 'admin_smp@example.com',
    //     ]);

    //     User::factory()->create([
    //         'school_id' => $smk->id,
    //         'role' => 'admin',
    //         'name' => 'Admin SMK',
    //         'email' => 'admin_smk@example.com',
    //     ]);

    //     // Buat guru (teacher) untuk masing-masing sekolah
    //     User::factory(5)->create([
    //         'school_id' => $smp->id,
    //         'role' => 'teacher',
    //     ]);

    //     User::factory(5)->create([
    //         'school_id' => $smk->id,
    //         'role' => 'teacher',
    //     ]);

    //     // Buat grade untuk masing-masing sekolah
    //     $smpGrades = Grade::factory(3)->create(['school_id' => $smp->id]);
    //     $smkGrades = Grade::factory(3)->create(['school_id' => $smk->id]);

    //     // Buat department khusus untuk SMK
    //     $smkDepartments = Department::factory(3)->create(['school_id' => $smk->id]);

    //     // Buat kelas untuk SMP
    //     foreach ($smpGrades as $grade) {
    //         Classes::factory(3)->create(['school_id' => $smp->id, 'grade_id' => $grade->id]);
    //     }

    //     // Buat kelas untuk SMK dengan department
    //     foreach ($smkGrades as $grade) {
    //         foreach ($smkDepartments as $department) {
    //             Classes::factory(3)->create(['school_id' => $smk->id, 'grade_id' => $grade->id, 'department_id' => $department->id]);
    //         }
    //     }

    //     // Buat siswa untuk masing-masing sekolah
    //     foreach ($smpGrades as $grade) {
    //         foreach ($grade->classes as $class) {
    //             Student::factory(10)->create(['school_id' => $smp->id, 'class_id' => $class->id]);
    //         }
    //     }
    //     foreach ($smkGrades as $grade) {
    //         foreach ($grade->classes as $class) {
    //             Student::factory(10)->create(['school_id' => $smk->id, 'class_id' => $class->id]);
    //         }
    //     }

    //     // Buat kategori pelanggaran
    //     $smpViolationCategories = ViolationCategory::factory(5)->create(['school_id' => $smp->id]);
    //     $smkViolationCategories = ViolationCategory::factory(5)->create(['school_id' => $smk->id]);



    //     // Buat pelanggaran untuk siswa
    //     foreach (Student::all() as $student) {
    //         $violation_category_id = $student->school_id == $smp->id
    //             ? $smpViolationCategories->random()->id
    //             : $smkViolationCategories->random()->id;

    //         Violation::factory(2)->create([
    //             'school_id' => $student->school_id,
    //             'student_id' => $student->id,
    //             'violation_category_id' => $violation_category_id,
    //             'point' => ViolationCategory::find($violation_category_id)->point,
    //         ]);
    //     }
    // }

    public function run()
    {
        $this->call([
            SuperadminSeeder::class,
            SchoolSeeder::class,
        ]);
    }
}
