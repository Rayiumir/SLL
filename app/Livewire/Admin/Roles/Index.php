<?php

namespace App\Livewire\Admin\Roles;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use LivewireAlert;
    public $roles;
    public $search = '';
    protected $listeners = ['roleList' => 'refreshData'];

    public function mount(): void
    {
        $this->roles = Role::all();
    }
    public function refreshData(): void
    {
        $this->roles = Role::all();
    }

    public function updatedSearch(): void
    {
        $this->roles = Role::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function deleteRoles($id): void
    {
        $role = Role::findById($id);
        $role->delete();
        $this->dispatch('roleList');
        $this->alert('success', 'برای همیشه حذف شد.');
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.roles.index');
    }
}

