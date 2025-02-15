<?php

namespace App\Livewire\Admin;

use App\Models\Punishment as ModelsPunishment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Punishment extends Component
{
    use WithPagination;

    public $school_id;

    public $name = [];
    public $min_point = [];
    public $selected_id = [];
    public $isEditing = false;
    public $isAddFormOpen = false;
    public $isAddClicked = false;
    public $isEditFormOpen = false;
    public $editingId = null;

    public $perPage = 10;

    public function render()
    {
        $this->school_id = Auth::user()->school_id;

        $punishments = ModelsPunishment::where('school_id', $this->school_id)
            ->paginate($this->perPage);

        return view('livewire.admin.violation-menu.punishment.punishment', [
            'punishments' => $punishments
        ]);
    }

    public function resetInputFields($id = null)
    {
        if ($id === null) {
            unset($this->name, $this->min_point);
        } else {
            unset($this->name[$id], $this->min_point[$id]);
        }
        $this->resetValidation();
    }

    public function openAddForm()
    {
        if ($this->isAddClicked) {
            $this->isAddFormOpen = false;
            $this->isAddClicked = false;
            $this->resetInputFields();
        } else {
            $this->isAddFormOpen = true;
            $this->isAddClicked = true;

            $this->isEditFormOpen = false;
            $this->editingId = null;
            $this->isEditing = false;
        }
    }

    public function openEditForm($id)
    {
        if ($this->editingId === $id) {
            $this->isEditing = false;
            $this->isEditFormOpen = false;
            $this->editingId = null;
            $this->resetInputFields($id);
        } else {
            $this->isEditing = true;
            $this->isEditFormOpen = true;
            $this->editingId = $id;
            $this->isAddFormOpen = false;
            $this->isAddClicked = false;
        }
    }

    public function rules($id = null)
    {
        if (!$this->isEditing) {
            return [
                'name' => 'required|string',
                'min_point' => 'required|string',
            ];
        } else {
            return [
                "name.$id" => 'nullable|string',
                "min_point.$id" => 'nullable|string',
            ];
        }
    }

    public function store()
    {
        $this->validate($this->rules());

        DB::transaction(function () {
            ModelsPunishment::lockForUpdate()->create([
                'school_id' => $this->school_id,
                'name' => $this->name,
                'min_point' => $this->min_point,
            ]);
        });
        flash()->success('Punishment created successfully.');
        $this->resetInputFields();
    }

    public function update($id)
    {
        $this->validate($this->rules($id));

        $punishment = ModelsPunishment::findOrFail($id);

        DB::transaction(function () use ($id, $punishment) {
            ModelsPunishment::lockForUpdate()->where('id', $id)->update([
                'name' => $this->name[$id] ?? $punishment->name,
                'min_point' => $this->min_point[$id] ?? $punishment->min_point,
            ]);
        });
        flash()->success('Punishment updated successfully.');
        $this->resetInputFields($id);
    }

    public function delete()
    {
        DB::transaction(function () {
            ModelsPunishment::lockForUpdate()->whereIn('id', $this->selected_id)->delete();
        });
        $this->selected_id = [];
        flash()->success('Punishment deleted successfully');
    }
}
