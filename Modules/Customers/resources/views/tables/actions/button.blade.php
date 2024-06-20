
<div class="dropdown">
    <a style="padding: 0;margin: 0;" class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"
        data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
        <ul class="link-list-plain no-bdr">
            @can('customer-update')
                <li><a href="javascript:void(0);" wire:click="$dispatch('triggerEditCus', { customerId : {{ $row->id }} })" class="text-primary"><em
                    class="icon ni ni-edit-fill"></em><span>{{ __('Edit') }}</span>
                </a></li>
            @endcan
            @can('customer-delete')
                <li><a href="javascript:void(0);" wire:click="$dispatch('deleteItem',{ customerId : {{ $row->id }} })" class="text-danger swal-confirm-delete">
                    <em class="icon ni ni-trash text-danger"></em><span>{{ __('Delete') }}</span>
                </a></li>
            @endcan
                

        </ul>
    </div>
</div>

<style>
.table-responsive{
	min-height: 300px;
}
</style>