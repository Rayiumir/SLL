<div>
    <div class="card rounded-4">
        <div class="card-body">
            <div class="text-center">
                <i class="fa-duotone fa-list-tree fa-4x"></i>
            </div>

            <form class="row g-3 mt-4" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="col-md-12">
                    <label for="input1" class="form-label">عنوان دسته</label>
                    <input type="text" wire:model="title" name="title" class="form-control rounded-5 @error('title') is-invalid @enderror" id="input1">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="input2" class="form-label">نام انگلیسی</label>
                    <input type="text" wire:model.blur="en_title" name="en_title" class="form-control rounded-5 @error('en_title') is-invalid @enderror" id="input2">
                    @error('en_title')
                    <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="input3" class="form-label">انتخاب دسته والد</label>
                    <select class="form-select rounded-5 @error('parent_id') is-invalid @enderror" name="parent_id" wire:model="parent_id" id="input3" aria-label="Default select example">
                        <option selected value="0">انتخاب کنید ...</option>
                        @foreach($categories as $row)
                            <option value="{{$row->id}}">{{$row->title}}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="input8" class="form-label">آیکون دسته بندی</label>
                    <input type="file" wire:model="image" name="image" class="form-control rounded-5 @error('image') is-invalid @enderror" id="input8">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>

            </form>
            <button type="button" wire:click="saveCategories()" class="btn btn-primary rounded-5 mt-4"><i class="fa-duotone fa-user-plus"></i> ایجاد دسته بندی </button>
            <span wire:loading>در حال ذخیره ... </span>
        </div>
    </div>
</div>
