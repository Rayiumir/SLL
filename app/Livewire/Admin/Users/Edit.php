<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    #[Rule('required', 'min:3')]
    public $name;
    #[Rule('required', 'email', 'unique:users,email')]
    public $email;
    #[Rule('required', 'unique:users,mobile')]
    public $mobile;
    #[Rule('required', 'min:8')]
    public $password;
    #[Rule('nullable', 'image', 'max:2024')]
    public $image;
    public $user_id;
    public User $user;
    protected $listeners = ['userUpdated' => 'updateUser'];

    public function mount($id): void
    {
        $user = User::find($id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        $this->image = $user->image;
        $this->password = $user->password;

        $this->user = $user;
    }

    public function updated($name): void
    {
        $this->validateOnly($name);
    }

    public function updateUser(): void
    {
        $this->validate();
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->mobile = $this->mobile;

        if($this->password) {
            $this->user->password = Hash::make($this->password);
        }

        if ($this->image) {
            $this->user->update([
                'image' => self::saveImage($this->image)
            ]);
        }

        $this->user->save();
        $this->dispatch('userUpdated ');
        $this->alert('success', 'با موفقیت به ویرایش شد.');
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
        $user = $this->user;
        return view('livewire.admin.users.edit', compact('user'));
    }
}
