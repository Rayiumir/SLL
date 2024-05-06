<div wire:ignore.self class="modal fade" id="RoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">افزودن کاربر جدید</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa-duotone fa-user-plus fa-4x"></i>
                </div>

                <form class="row g-3 mt-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="col-md-12">
                        <label for="input1" class="form-label">عنوان نقش</label>
                        <input type="text" wire:model="name" name="name" class="form-control rounded-5 @error('name') is-invalid @enderror" id="input1">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </form>
                <button type="button" wire:click="saveRole" class="btn btn-primary rounded-5 mt-4"><i class="fa-duotone fa-user-plus"></i> ثبت نقش </button>
                <span wire:loading>در حال ذخیره ... </span>
            </div>
        </div>
    </div>
</div>
