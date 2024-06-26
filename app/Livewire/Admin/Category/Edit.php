<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    #[Validate('required|min:3')]
    public $title;
    #[Validate('required|min:3')]
    public $en_title;
    public $slug;
    public $category_id;
    public $image;
    public $categories;
    public $selected_category;

    public function updated($name): void
    {
        $this->validateOnly($name);
    }
    public function editCategories($category_id): void
    {
        $this->selected_category = Category::query()->find($category_id);
    }
    public function updateCategories(): void
    {
        $this->validate();
        Category::query()->create([
            'title' => $this->title,
            'en_title' => $this->en_title,
            'slug' => Str::slug($this->en_title),
            'parent_id' => $this->parent_id,
            'image' => self::saveImage($this->image)
        ]);

        $this->dispatch('categoriesList');
        $this->alert('success', 'دسته بندی جدید اضافه شد.');
    }

    public function saveImage($image)
    {
        if ($image){
            $name = $image->hashName();

            $smallImage = ImageManager::imagick()->read($image->getRealPath());
            $bigImage = ImageManager::imagick()->read($image->getRealPath());
            $smallImage->resize(256, 256, function ($constraint){
                $constraint->aspectRatio();
            });

            Storage::disk('local')->put('categories/small/'.$name, (string) $smallImage->encodeByMediaType('image/jpeg', 90));
            Storage::disk('local')->put('categories/big/'.$name, (string) $bigImage->encodeByMediaType('image/jpeg', 90));

            return $name;

        }else{
            return "";
        }
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.category.edit');
    }
}
