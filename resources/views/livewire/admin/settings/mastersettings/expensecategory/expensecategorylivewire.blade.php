<div>
    <x-admin.layouts.admintableindex>

        <x-slot name="title">
            EXPENSE CATEGORY
        </x-slot>

        <x-slot name="action">
            <a wire:navigate class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('adminsettings') }}"
                role="button">Back</a>
            <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                data-bs-toggle="modal" data-bs-target="#createoreditModal">
                Create
            </button>
        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
                'name' => 'S.NO',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UNIQID',
                'type' => 'sortby',
                'sortname' => 'uniqid',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'EXPENSE CATEGORY NAME',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'ACTIVE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW/EDIT',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($this->expensecategory as $index => $eachexpensecategory)
                <tr>
                    <td>{{ $this->expensecategory->firstItem() + $index }}</td>
                    <td>{{ $eachexpensecategory->uniqid }}</td>
                    <td class="text-start">{{ $eachexpensecategory->name }}</td>
                    <td>{!! $eachexpensecategory->active
                        ? '<span class="badge bg-success fs-6">Yes</span>'
                        : '<span class="badge bg-danger fs-6">No</span>' !!}
                    </td>
                    <td>
                        <button wire:click="show({{ $eachexpensecategory->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>

                        <button wire:click="edit({{ $eachexpensecategory->id }})" class="btn btn-sm btn-primary"><i
                                class="bi bi-pencil-fill"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $this->expensecategory->firstItem() }} to {{ $this->expensecategory->lastItem() }} out of
            {{ $this->expensecategory->total() }}
            items
        </x-slot>

        <x-slot name="pagination">
            {{ $this->expensecategory->links() }}
        </x-slot>

    </x-admin.layouts.admintableindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.mastersettings.expensecategory.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.mastersettings.expensecategory.show')

    <!-- Modal Action Helper -->
    @include('livewire.helper.livewiremodalhelper')

</div>
