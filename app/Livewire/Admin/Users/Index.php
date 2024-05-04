<?php

namespace App\Livewire\Admin\Users;

use App\Enums\UserStatus;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;


class Index extends Component
{
    public $users;
    public $search = '';
    protected $listeners = ['userList' => 'refreshData'];
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

    public function changeStatusUser($id): void
    {
        $users = User::query()->find($id);
        if ($users->status == UserStatus::Active->value){
            $users->update([
                'status' => UserStatus::Inactive->value
            ]);
        }elseif ($users->status == UserStatus::Inactive->value){
            $users->update([
                'status' => UserStatus::Banned->value
            ]);
        }elseif ($users->status == UserStatus::Banned->value){
            $users->update([
                'status' => UserStatus::Active->value
            ]);
        }
        $this->dispatch('userList');
    }

    public function deleteUser($id): void
    {
        $user = User::find($id);
        $user->delete();
        $this->dispatch('userList');

    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.users.index');
    }
}
