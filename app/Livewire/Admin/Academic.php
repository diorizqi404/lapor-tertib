<?php

    namespace App\Livewire\Admin;

    use App\Models\Classes;
    use App\Models\Department;
    use App\Models\Grade;
    use App\Models\AcademicYear;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class Academic extends Component
    {
        public $school_id;

        // DEPARTMENT
        public $dept_name = [];
        public $dept_initial = [];
        public $deptSelected_id = [];
        public $isEditingDept = false;
        public $isAddFormDeptOpen = false;
        public $isAddDeptClicked = false;
        public $isEditFormDeptOpen = false;
        public $editingDeptId = null;

        // ACADEMIC_YEAR
        public $academic_start_date = [];
        public $academic_end_date = [];
        public $academicSelected_id = [];
        public $isEditingAcademic = false;
        public $isAddFormAcademicOpen = false;
        public $isAddAcademicClicked = false;
        public $isEditFormAcademicOpen = false;
        public $editingAcademicId = null;

        // GRADE
        public $grade_name = [];
        public $gradeSelected_id = [];
        public $isEditingGrade = false;
        public $isAddFormGradeOpen = false;
        public $isAddGradeClicked = false;
        public $isEditFormGradeOpen = false;
        public $editingGradeId = null;

        // CLASS
        public $class_dept_id = [];
        public $class_grade_id = [];
        public $class_name = [];
        public $classSelected_id = [];
        public $isEditingClass = false;
        public $isAddFormClassOpen = false;
        public $isAddClassClicked = false;
        public $isEditFormClassOpen = false;
        public $editingClassId = null;
        public $perPage = 10;


        public function render()
        {
            $this->school_id = Auth::user()->school_id;

            $departments = Department::where('school_id', $this->school_id)
                ->withCount('classes')
                ->get();

            $grades = Grade::where('school_id', $this->school_id)
                ->get();

            $classes = Classes::where('school_id', $this->school_id)
                ->with('department', 'grade')
                ->get();

            $academic_years = AcademicYear::where('school_id', $this->school_id)
                ->get();

            return view('livewire.admin.academic-menu.academic', [
                'departments' => $departments,
                'grades' => $grades,
                'classes' => $classes,
                'academic_years' => $academic_years,
            ]);
        }

        public function resetInputFields($id = null)
        {
            if ($id === null) {
                unset($this->dept_name, $this->dept_initial);
                unset($this->grade_name);
                unset($this->class_dept_id, $this->class_grade_id, $this->class_name);
                unset($this->academic_start_date, $this->academic_end_date);
            } else {
                unset($this->dept_name[$id], $this->dept_initial[$id]);
                unset($this->grade_name[$id]);
                unset($this->class_dept_id[$id], $this->class_grade_id[$id], $this->class_name[$id]);
                unset($this->academic_start_date[$id], $this->academic_end_date[$id]);
            }
            $this->resetValidation();
        }

        // DEPARTMENT
        public function openAddFormDept()
        {
            if ($this->isAddDeptClicked) {
                $this->isAddFormDeptOpen = false;
                $this->isAddDeptClicked = false;
                $this->resetInputFields();
            } else {
                $this->isAddFormDeptOpen = true;
                $this->isAddDeptClicked = true;

                $this->isEditFormDeptOpen = false;
                $this->editingDeptId = null;
                $this->isEditingDept = false;
            }
        }

        public function openEditFormDept($id)
        {
            if ($this->editingDeptId === $id) {
                $this->isEditingDept = false;
                $this->isEditFormDeptOpen = false;
                $this->editingDeptId = null;
                $this->resetInputFields($id);
            } else {
                $this->isEditingDept = true;
                $this->isEditFormDeptOpen = true;
                $this->editingDeptId = $id;
                $this->isAddFormDeptOpen = false;
                $this->isAddDeptClicked = false;
            }
        }

        public function dept_rules($id = null)
        {
            if (!$this->isEditingDept) {
                return [
                    'dept_name' => 'required|string',
                    'dept_initial' => 'required|string',
                ];
            } else {
                return [
                    "dept_name.$id" => 'nullable|string',
                    "dept_initial.$id" => 'nullable|string',
                ];
            }
        }

        public function dept_store()
        {
            $this->validate($this->dept_rules());

            DB::transaction(function () {
                Department::lockForUpdate()->create([
                    'school_id' => $this->school_id,
                    'name' => $this->dept_name,
                    'initial' => $this->dept_initial,
                ]);
            });
            flash()->success('Department created successfully.');
            $this->resetInputFields();
        }

        public function dept_update($id)
        {
            $this->validate($this->dept_rules($id));

            $dept = Department::findOrFail($id);

            DB::transaction(function () use ($id, $dept) {
                Department::lockForUpdate()->where('id', $id)->update([
                    'name' => $this->dept_name[$id] ?? $dept->name,
                    'initial' => $this->dept_initial[$id] ?? $dept->initial,
                ]);
            });
            flash()->success('Department updated successfully.');
            $this->resetInputFields($id);
        }

        public function dept_delete()
        {
            Department::whereIn('id', $this->deptSelected_id)->delete();
            $this->deptSelected_id = [];
            flash()->success("Department deleted successfully.");
        }
        // END DEPARTMENT

        public function openAddFormAcademic()
        {
            if ($this->isAddAcademicClicked) {
                $this->isAddFormAcademicOpen = false;
                $this->isAddAcademicClicked = false;
                $this->resetInputFields();
            } else {
                $this->isAddFormAcademicOpen = true;
                $this->isAddAcademicClicked = true;

                $this->isEditFormAcademicOpen = false;
                $this->editingAcademicId = null;
                $this->isEditingAcademic = false;
            }
        }

        public function openEditFormAcademic($id)
        {
            if ($this->editingAcademicId === $id) {
                $this->isEditingAcademic = false;
                $this->isEditFormAcademicOpen = false;
                $this->editingAcademicId = null;
                $this->resetInputFields();
            } else {
                $this->isEditingAcademic = true;
                $this->isEditFormAcademicOpen = true;
                $this->editingAcademicId = $id;
                $this->isAddFormAcademicOpen = false;
                $this->isAddAcademicClicked = false;
            }
        }

        public function academic_rules($id = null)
        {
            if (!$this->isEditingAcademic) {
                return [
                    'academic_start_date' => 'required|date',
                    'academic_end_date' => 'required|date',
                ];
            } else {
                return [
                    "academic_start_date.$id" => 'nullable|date',
                    "academic_end_date.$id" => 'nullable|date',
                ];
            }
        }

        public function academic_store()
        {
            $this->validate($this->academic_rules());

            DB::transaction(function () {
                AcademicYear::lockForUpdate()->create([
                    'school_id' => $this->school_id,
                    'start_date' => $this->academic_start_date,
                    'end_date' => $this->academic_end_date,
                ]);
            });
            flash()->success('Academic year created successfully.');
            $this->resetInputFields();
        }

        public function academic_update($id)
        {
            $this->validate($this->academic_rules($id));

            $academic = AcademicYear::findOrFail($id);

            DB::transaction(function () use ($id, $academic) {
                AcademicYear::lockForUpdate()->where('id', $id)->update([
                    'start_date' => $this->academic_start_date[$id] ?? $academic->start_date,
                    'end_date' => $this->academic_end_date[$id] ?? $academic->end_date,
                ]);
            });
            flash()->success('Academic year updated successfully.');
            $this->resetInputFields($id);
        }

        public function academic_delete()
        {
            DB::transaction(function () {
                AcademicYear::lockForUpdate()->whereIn('id', $this->academicSelected_id)->delete();
            });
            $this->academicSelected_id = [];
            flash()->success("Academic year deleted successfully.");
        }

        // GRADE
        public function openAddFormGrade()
        {
            if ($this->isAddGradeClicked) {
                $this->isAddFormGradeOpen = false;
                $this->isAddGradeClicked = false;
                $this->resetInputFields();
            } else {
                $this->isAddFormGradeOpen = true;
                $this->isAddGradeClicked = true;

                $this->isEditFormGradeOpen = false;
                $this->editingGradeId = null;
                $this->isEditingGrade = false;
            }
        }

        public function openEditFormGrade($id)
        {
            if ($this->editingGradeId === $id) {
                $this->isEditingGrade = false;
                $this->isEditFormGradeOpen = false;
                $this->editingGradeId = null;
                $this->resetInputFields();
            } else {
                $this->isEditingGrade = true;
                $this->isEditFormGradeOpen = true;
                $this->editingGradeId = $id;
                $this->isAddFormGradeOpen = false;
                $this->isAddGradeClicked = false;
            }
        }

        public function grade_rules($id = null)
        {
            if(!$this->isEditingGrade) {
                return [
                    'grade_name' => 'required|string',
                ];
            } else {
                return [
                    "grade_name.$id" => 'nullable|string',
                ];
            }
        }

        public function grade_store()
        {
            $this->validate($this->grade_rules());

            DB::transaction(function () {
                Grade::lockForUpdate()->create([
                    'school_id' => $this->school_id,
                    'name' => $this->grade_name,
                ]);
            });
            flash()->success('Grade created successfully.');
            $this->resetInputFields();
        }

        public function grade_update($id)
        {
            $this->validate($this->grade_rules($id));

            $grade = Grade::findOrFail($id);

            DB::transaction(function () use ($id, $grade) {
                Grade::lockForUpdate()->where('id', $id)->update([
                    'name' => $this->grade_name[$id] ?? $grade->name,
                ]);
            });
            flash()->success('Grade updated successfully.');
            $this->resetInputFields($id);
        }

        public function grade_delete()
        {
            Grade::whereIn('id', $this->gradeSelected_id)->delete();
            $this->gradeSelected_id = [];
            flash()->success("Grade deleted successfully.");
        }
        // END GRADE

        // CLASS
        public function openAddFormClass()
        {
            if ($this->isAddClassClicked) {
                $this->isAddFormClassOpen = false;
                $this->isAddClassClicked = false;
                $this->resetInputFields();
            } else {
                $this->isAddFormClassOpen = true;
                $this->isAddClassClicked = true;

                $this->isEditFormClassOpen = false;
                $this->editingClassId = null;
                $this->isEditingClass = false;
            }
        }

        public function openEditFormClass($id)
        {
            if ($this->editingClassId === $id) {
                $this->isEditingClass = false;
                $this->isEditFormClassOpen = false;
                $this->editingClassId = null;
                $this->resetInputFields();
            } else {
                $this->isEditingClass = true;
                $this->isEditFormClassOpen = true;
                $this->editingClassId = $id;
                $this->isAddFormClassOpen = false;
                $this->isAddClassClicked = false;
            }
        }

        public function class_rules($id = null)
        {
            if(!$this->isEditingClass) {
                return [
                    'class_dept_id' => 'nullable',
                    'class_grade_id' => 'required|string',
                    'class_name' => 'required|string',
                ];
            }else {
                return [
                    "class_dept_id.$id" => 'nullable|string',
                    "class_grade_id.$id" => 'nullable|string',
                    "class_name.$id" => 'nullable|string',
                ];
            }
        }

        public function class_store()
        {
            $this->validate($this->class_rules());

            if (empty($this->class_dept_id)) {
                $this->class_dept_id = null;
            }

            DB::transaction(function () {
                Classes::lockForUpdate()->create([
                    'school_id' => $this->school_id,
                    'department_id' => $this->class_dept_id,
                    'grade_id' => $this->class_grade_id,
                    'name' => $this->class_name,
                ]);
            });
            flash()->success('Class created successfully.');
            $this->resetInputFields();
        }

        public function class_update($id)
        {
            $this->validate($this->class_rules($id));

            $classes = Classes::findOrFail($id);

            DB::transaction(function () use ($id, $classes) {
                Classes::lockForUpdate()->where('id', $id)->update([
                    'school_id' => $this->school_id,
                    'department_id' => $this->class_dept_id[$id] ?? $classes->department_id,
                    'grade_id' => $this->class_grade_id[$id] ?? $classes->grade_id,
                    'name' => $this->class_name[$id] ?? $classes->name,
                ]);
            });
            flash()->success('Class updated successfully.');
            $this->resetInputFields($id);
        }

        public function class_delete()
        {
            Classes::whereIn('id', $this->classSelected_id)->delete();
            $this->classSelected_id = [];
            flash()->success("Class deleted successfully.");
        }
        // END CLASS
    }
