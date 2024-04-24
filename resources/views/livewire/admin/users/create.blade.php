<div wire:ignore.self class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">افزودن کاربر جدید</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa-duotone fa-user-plus fa-4x"></i>
                </div>

                <form class="row g-3 mt-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="col-md-12">
                        <label for="input1" class="form-label">نام و نام خانواگی</label>
                        <input type="text" wire:model="name" name="name" class="form-control rounded-5 @error('name') is-invalid @enderror" id="input1">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="input2" class="form-label">ایمیل</label>
                        <input type="email" wire:model.blur="email" name="email" class="form-control rounded-5 @error('email') is-invalid @enderror" id="input2">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="input3" class="form-label">موبایل</label>
                        <input type="text" wire:model="mobile" name="mobile" class="form-control rounded-5 @error('mobile') is-invalid @enderror" id="input3">
                        @error('mobile')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="input4" class="form-label">رمز عبور</label>
                        <input name="password" wire:model="password" type="password" class="form-control rounded-5 @error('password') is-invalid @enderror" id="input4">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="input8" class="form-label">عکس کاربر</label>
                        <input type="file" wire:model="image" name="image" class="form-control rounded-5 @error('image') is-invalid @enderror" id="input8">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </form>
                <button type="button" wire:click="saveUser" class="btn btn-primary rounded-5 mt-4"><i class="fa-duotone fa-user-plus"></i> ثبت کاربر </button>
                <span wire:loading>در حال ذخیره ... </span>
            </div>
        </div>
    </div>
</div>
