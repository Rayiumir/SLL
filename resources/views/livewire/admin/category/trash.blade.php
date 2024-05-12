<div>
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-5">
                        <button type="button" class="btn btn-danger rounded-5"><i class="fa-duotone fa-trash"></i> سطل زباله {{\App\Models\Category::onlyTrashed()->count()}} </button>
                        <a href="{{ route('categories.index') }}" type="button" class="btn btn-light rounded-5"><i class="fa-duotone fa-arrow-rotate-left"></i> برگشت به دسته بندی </a>
                    </div>
                    <div class="col-md-7">
                        <from>
                            <input class="form-control form-control rounded-5" type="text" placeholder="جستجوی دسته بندی ... " aria-label="" wire:model.live="search">
                        </from>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">عکس</th>
                    <th scope="col">عنوان</th>
                    <th scope="col">عنوان انگلیسی</th>
                    <th scope="col">اسلاگ</th>
                    <th scope="col">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $row)
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>
                            <figure class="text-center">
                                <img src="{{asset('images/categories/small/' .$row->image)}}" class="rounded-4" width="32px">
                            </figure>
                        </td>
                        <td>{{$row->title}}</td>
                        <td>{{$row->en_title}}</td>
                        <td>{{$row->slug}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning btn-sm mb-3 rounded-5" wire:click="recoveryCategories({{$row->id}})" title="بازیابی دسته بندی"><i class="fa-duotone fa-arrow-rotate-left"></i></button>
                            <button type="button" class="btn btn-danger btn-sm mb-3 rounded-5" wire:click="deleteCategories({{$row->id}})" title="حذف نهایی"><i class="fa-duotone fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
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
                            <input type="text" disabled wire:model="title" name="title" class="form-control rounded-5 @error('title') is-invalid @enderror" id="input1">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="input2" class="form-label">نام انگلیسی</label>
                            <input type="text" disabled wire:model.blur="en_title" name="en_title" class="form-control rounded-5 @error('en_title') is-invalid @enderror" id="input2">
                            @error('en_title')
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="input3" class="form-label">انتخاب دسته والد</label>
                            <select class="form-select rounded-5 @error('parent_id') is-invalid @enderror" disabled name="parent_id" wire:model="parent_id" id="input3" aria-label="Default select example">
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
                            <input type="file" disabled wire:model="image" name="image" class="form-control rounded-5 @error('image') is-invalid @enderror" id="input8">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </form>
                    <button type="button" disabled class="btn btn-primary rounded-5 mt-4"><i class="fa-duotone fa-user-plus"></i> ایجاد دسته بندی </button>
                </div>
            </div>
        </div>
    </div>
</div>
