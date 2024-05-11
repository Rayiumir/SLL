<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public $categories;
    protected $listeners = ['categoriesList' => 'refreshData'];
    public function mount(): void
    {
        $this->categories = Category::all();
    }
    public function refreshData(): void
    {
        $this->categories = Category::all();
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::query()->pluck('title', 'id');
        return view('livewire.admin.category.index', compact('categories'));
    }
}
