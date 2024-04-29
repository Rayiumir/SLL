<div>
<div class="row">
    <div class="col-md-6">
        <button type="button" class="btn btn-primary mb-3 rounded-5" data-bs-toggle="modal" data-bs-target="#Modal"><i class="fa-duotone fa-user-plus"></i> افزودن کاربر جدید </button>
        <button type="button" class="btn btn-danger mb-3 rounded-5 ms-2"><i class="fa-duotone fa-trash"></i> سطل زباله 0 </button>
        <livewire:admin.users.create></livewire:admin.users.create>
    </div>
    <div class="col-md-6">
        <from>
            <input class="form-control form-control rounded-5" type="text" placeholder="جستجوی کاربران ... " aria-label="" wire:model.live="search">
        </from>
    </div>
</div>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">شناسه</th>
        <th scope="col">عکس</th>
        <th scope="col">نام</th>
        <th scope="col">ایمیل</th>
        <th scope="col">شماره موبایل</th>
        <th scope="col">دسترسی</th>
        <th scope="col">وضعیت</th>
        <th scope="col">تاریخ</th>
        <th scope="col">عملیات</th>
    </tr>
    </thead>
    <tbody>
        @foreach($users as $row)
            <tr wire:ignore>
                <th scope="row">{{$loop->index+1}}</th>
                <td>
                    <figure>
                        <img src="{{asset('images/users/small/' .$row->image)}}" class="rounded-4" width="52px">
                    </figure>
                </td>
                <td>{{$row->name}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->mobile}}</td>
                <td>تست</td>
                <td>تست</td>
                <td>{{$row->created_at}}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-secondary mb-3 rounded-5 btn-sm"><i class="fa-duotone fa-edit"></i></button>
                    <button type="button" class="btn btn-danger mb-3 rounded-5 btn-sm" wire:click="deleteUser({{$row->id}})"><i class="fa-duotone fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
