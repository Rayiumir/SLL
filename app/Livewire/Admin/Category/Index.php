<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Index extends Component
{
    use LivewireAlert;

    public $categories;
    public $search = '';
    protected $listeners = ['categoriesList' => 'refreshData'];
    public function mount(): void
    {
        $this->categories = Category::all();
    }
    public function refreshData(): void
    {
        $this->categories = Category::all();
    }
    public function updatedSearch(): void
    {
        $this->categories = Category::where('title', 'like', '%' . $this->search . '%')->get();
    }
    public function deleteCategories($id): void
    {
        $categories = Category::query()->find($id);
        $categories->delete();
        $this->dispatch('categoriesList');
        $this->alert('success', 'به سطل زباله منتقل شد.');
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::with('parent')->paginate();
        //$categoriesp = Category::where('category_id', null)->get();
        return view('livewire.admin.category.index', compact('categories'));
    }
}
