<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ViolationCategory as ViolationCategoryModel;

class ViolationCategory extends Component
{
    use WithPagination;

    public $school_id;

    public $name = [];
    public $point = [];
    public $description = [];
    public $selected_id = [];
    public $isEditing = false;
    public $isAddFormOpen = false;
    public $isAddFormClicked = false;
    public $isEditFormOpen = false;
    public $editingId = null;

    public function render()
    {
        $this->school_id = Auth::user()->school_id;

        $violation_categories = ViolationCategoryModel::where('school_id', $this->school_id)->paginate(10);

        return view('livewire.admin.violation-menu.category.violation-category', [
            'violation_categories' => $violation_categories
        ]);
    }

    public function resetInputFields($id = null)
    {
        if($id === null) {
            unset($this->name, $this->point, $this->description);
        } else {
            unset($this->name[$id], $this->point[$id], $this->description[$id]);
        }
    }

    public function openAddForm()
    {
        if($this->isAddFormClicked) {
            $this->isAddFormOpen = false;
            $this->isAddFormClicked = false;
            $this->resetInputFields();
        } else {
            $this->isAddFormOpen = true;
            $this->isAddFormClicked = true;

            $this->isEditFormOpen = false;
            $this->editingId = null;
            $this->isEditing = false;
        }
    }

    public function openEditForm($id)
    {
        if($this->editingId === $id) {
            $this->isEditing = false;
            $this->isEditFormOpen = false;
            $this->editingId = null;
            $this->resetInputFields($id);
        } else {
            $this->isEditing = true;
            $this->isEditFormOpen = true;
            $this->editingId = $id;

            $this->isAddFormOpen = false;
            $this->isAddFormClicked = false;
        }
    }

    public function rules($id = null)
    {
        if (!$this->isEditing) {
            return [
                'name' => 'required|string',
                'point' => 'required|numeric',
                'description' => 'required|string'
            ];
        } else {
            return [
                "name.$id" => 'nullable|string',
                "point.$id" => 'nullable|numeric',
                "description.$id" => 'nullable|string'
            ];
        }
    }

    public function store()
    {
        $this->validate();

        DB::transaction(function () {
            ViolationCategoryModel::lockForUpdate()->create([
                'school_id' => $this->school_id,
                'name' => $this->name,
                'point' => $this->point,
                'description' => $this->description
            ]);
        });
        flash()->success('Violation category created successfully');
        $this->resetInputFields();
    }

    public function update($id)
    {
        $this->validate($this->rules($id));

        $category = ViolationCategoryModel::find($id);

        DB::transaction(function () use ($id, $category) {
            ViolationCategoryModel::lockForUpdate()->find($id)->update([
                'name' => $this->name[$id] ?? $category->name,
                'point' => $this->point[$id] ?? $category->point,
                'description' => $this->description[$id] ?? $category->description
            ]);
        });
        flash()->success('Violation category updated successfully');
        $this->resetInputFields($id);
    }

    public function delete()
    {
        DB::transaction(function () {
            ViolationCategoryModel::lockForUpdate()->whereIn('id', $this->selected_id)->delete();
        });
        $this->selected_id = [];
        flash()->success('Violation category deleted successfully');
    }
}
