<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Trash extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $categories;
    public $search = '';
    protected $listeners = ['categoriesTrash' => 'refreshData'];

    public function refreshData(): void
    {
        $this->categories = DB::table('categories')->whereNotNull('deleted_at')->latest()->get();
    }

    public function mount(): void
    {
        $this->categories = DB::table('categories')->whereNotNull('deleted_at')->latest()->get();
    }

    public function updatedSearch(): void
    {
        $this->categories = Category::where('title', 'like', '%' . $this->search . '%')->get();
    }

    public function deleteCategories($id): void
    {
        $categories = Category::withTrashed()->findOrFail($id);

        $big_path = public_path("images/categories/big/$$categories->image");
        if (is_file($big_path)) {
            unlink($big_path);
        }

        $small_path = public_path("images/categories/small/$categories->image");
        if (is_file($small_path)) {
            unlink($small_path);
        }

        $categories->forceDelete();
        $this->dispatch('categoriesTrash');
        $this->alert('success', 'برای همیشه حذف شد.');
    }
    public function recoveryCategories($id): void
    {
        $categories = Category::withTrashed()->where('id', $id)->first();
        $categories->restore();
        $this->dispatch('categoriesTrash');
        $this->alert('success', 'با موفقیت بازیابی شد.');
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.category.trash');
    }


}
