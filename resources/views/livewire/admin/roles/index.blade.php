<div>
    <div class="row">
        <div class="col-md-6">
            <button type="button" class="btn btn-primary mb-3 rounded-5" data-bs-toggle="modal" data-bs-target="#RoleModal"><i class="fa-duotone fa-user-plus"></i> افزودن نقش جدید </button>
            <livewire:admin.roles.create></livewire:admin.roles.create>
        </div>
        <div class="col-md-6">
            <from>
                <input class="form-control form-control rounded-5" type="text" placeholder="جستجوی نقش ها ... " aria-label="" wire:model.live="search">
            </from>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">شناسه</th>
            <th scope="col">عنوان نقش</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $row)
            <tr>
                <th scope="row" style="width: 50px;">{{$loop->index+1}}</th>
                <td>{{$row->name}}</td>
                <td class="text-center" style="width: 100px;">
                    <button type="button" class="btn btn-danger mb-3 rounded-5 btn-sm" wire:click="deleteRoles({{$row->id}})" title="حذف نهایی"><i class="fa-duotone fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
