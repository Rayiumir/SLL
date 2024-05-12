<div>
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('categories.trash') }}" type="button" class="btn btn-danger rounded-5"><i class="fa-duotone fa-trash"></i> سطل زباله {{\App\Models\Category::onlyTrashed()->count()}} </a>
                    </div>
                    <div class="col-md-8">
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
                    <th scope="col">دسته والد</th>
                    <th scope="col">اسلاگ</th>
                    <th scope="col">تاریخ ایجاد</th>
                    <th scope="col">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $row)
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>
                            <figure>
                                <img src="{{asset('images/categories/small/' .$row->image)}}" class="rounded-4" width="52px">
                            </figure>
                        </td>
                        <td>{{$row->title}}</td>
                        <td>{{$row->en_title}}</td>
                        <td>{{$row->getParentName()}}</td>
                        <td>{{$row->slug}}</td>
                        <td>{{$row->getCreateAtShamsi()}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-secondary btn-sm mb-3 rounded-5" wire:click="editCategories({{$row->id}})" data-bs-toggle="modal" data-bs-target="#ModalEdit"><i class="fa-duotone fa-edit"></i></button>
                            <livewire:admin.category.edit></livewire:admin.category.edit>
                            <button type="button" class="btn btn-danger btn-sm mb-3 rounded-5" wire:click="deleteCategories({{$row->id}})"><i class="fa-duotone fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <livewire:admin.category.create></livewire:admin.category.create>
        </div>
    </div>
</div>
