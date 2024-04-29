<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('required|min:3')]
    public $name;
    #[Validate('required|email|unique:users,email')]
    public $email;
    #[Validate('required|unique:users,mobile')]
    public $mobile;
    #[Validate('required|min:8')]
    public $password;
    public $image;
    public $users;
    protected $listeners = ['dataCreated' => 'saveUser'];

    public function updated($name): void
    {
        $this->validateOnly($name);
    }

    public function saveUser(): void
    {
        $validate = $this->validate();
        $user = User::query()->create($validate);
        if ($this->image) {
            $user->update([
                'image' => self::saveImage($this->image)
            ]);
        }
        $this->resetInput();
        $this->dispatch('userCreated');
    }

    public function saveImage($file)
    {
        if ($file){
            $name = $file->hashName();

            $smallImage = ImageManager::imagick()->read($file->getRealPath());
            $bigImage = ImageManager::imagick()->read($file->getRealPath());
            $smallImage->resize(256, 256, function ($constraint){
                $constraint->aspectRatio();
            });

            Storage::disk('local')->put('users/small/'.$name, (string) $smallImage->encodeByMediaType('image/jpeg', 90));
            Storage::disk('local')->put('users/big/'.$name, (string) $bigImage->encodeByMediaType('image/jpeg', 90));

            return $name;

        }else{
            return "";
        }
    }

    public function resetInput(): void
    {
        $this->resetValidation();
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->password = '';
        $this->image = '';
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.users.create');
    }

}
