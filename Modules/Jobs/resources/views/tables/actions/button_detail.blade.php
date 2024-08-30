<div class="dropdown">
    <a style="padding: 0;margin: 0;" class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0">
        <em class="icon ni ni-more-h"></em>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
        <ul class="link-list-plain no-bdr">
            <li> 
                <a href="javascript:void(0);" wire:click="$dispatch('triggerEditTypes', { typeId: {{$id}} })" 
                   class="text-fourth">
                    <em class="icon ni ni-edit-fill"></em>
                    <span>{{ __('Sửa') }}</span>
                </a>
            </li>
            @can('job-editor')
            <li>
                <a href="javascript:void(0);" wire:click="$dispatch('triggerEditer', { typeId: {{$id}} })" 
                   class="text-fourth">
                    <em class="icon ni ni-edit-fill"></em>
                    <span>{{ __('Editer') }}</span>
                </a>
            </li>
            @endcan
            @can('job-QC')
            <li>
                
                <a href="javascript:void(0);" wire:click="$dispatch('triggerQC', { typeId: {{$id}} })" 
                   class="text-fourth">
                    <em class="icon ni ni-edit-fill"></em>
                    <span>{{ __('QC') }}</span>
                </a>
            </li> 
            @endcan
            
            <li>
                
                <a href="javascript:void(0);" wire:click="$dispatch('triggerSatus', { typeId: {{$id}} })" 
                   class="text-fourth">
                    <em class="icon ni ni-edit-fill"></em>
                    <span>{{ __(' Status') }}</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" 
                   wire:click="$dispatch('triggerDelete', { typeId: {{$id}} })" 
                   class="text-danger swal-confirm-delete">
                    <em class="icon ni ni-trash text-danger"></em>
                    <span>{{ __('Delete') }}</span>
                </a>
            </li>
            
        </ul>
    </div>
</div>

<style>
.table-responsive{
    min-height: 300px;
    min-width: 0px;
}
</style>