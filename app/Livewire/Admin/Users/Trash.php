<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Trash extends Component
{
    use WithPagination;

    public $users;
    public $search = '';
    protected $listeners = ['userCreated' => 'refreshData'];

    public function refreshData(): void
    {
        $this->users = DB::table('users')->whereNotNull('deleted_at')->latest()->get();
    }

    public function mount(): void
    {
        $this->users = DB::table('users')->whereNotNull('deleted_at')->latest()->get();
    }

    public function updatedSearch(): void
    {
        $this->users = User::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function deleteUser($id): void
    {
        $user = User::withTrashed()->findOrFail($id);

        $big_path = public_path("images/users/big/$user->image");
        if (is_file($big_path)) {
            unlink($big_path);
        }

        $small_path = public_path("images/users/small/$user->image");
        if (is_file($small_path)) {
            unlink($small_path);
        }

        $user->forceDelete();
        $this->dispatch('userCreated');
    }
    public function recoveryUser($id): void
    {
        $user = User::withTrashed()->where('id',$id)->first();
        $user->restore();
        $this->dispatch('userCreated');
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.users.trash');
    }
}