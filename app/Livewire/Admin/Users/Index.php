<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;


class Index extends Component
{
    public $users;
    public $search = '';
    protected $listeners = ['userCreated' => 'refreshData'];
    public function mount(): void
    {
        $this->users = User::all();
    }
    public function refreshData(): void
    {
        $this->users = User::all();
    }

    public function updatedSearch(): void
    {
        $this->users = User::where('name', 'like', '%' . $this->search . '%')->get();
    }
    public function deleteUser($id): void
    {
        User::destroy($id);
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.users.index');
    }
}
