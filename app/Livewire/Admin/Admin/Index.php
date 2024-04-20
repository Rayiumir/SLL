<?php

namespace App\Livewire\Admin\Admin;

use Livewire\Component;

class Index extends Component
{

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.admin.index')->layout('layouts.AdminLayout');
    }
}
