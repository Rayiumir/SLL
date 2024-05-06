<?php

namespace App\Livewire\Admin\Roles;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use LivewireAlert;

    #[Validate('required|min:3')]
    public $name;
    protected $listeners = ['dataCreated' => 'saveUser'];

    public function updated($name): void
    {
        $this->validateOnly($name);
    }

    public function saveRole(): void
    {
        $validate = $this->validate();
        Role::query()->create($validate);
        $this->resetInput();
        $this->dispatch('roleList');
        $this->alert('success', 'با موفقیت نقش جدید اضافه شد.');
    }

    public function resetInput(): void
    {
        $this->resetValidation();
        $this->name = '';
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.roles.create');
    }
}
