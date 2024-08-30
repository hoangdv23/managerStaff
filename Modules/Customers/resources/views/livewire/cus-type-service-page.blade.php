<div>
    <div class="modal fade" wire:ignore.self role="dialog" id="cusTypeService" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $titleForm }}</h5>
                    <a href="javascript:void(0);" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form  wire:submit.prevent="editCustype({{$customerId}})" >
                        <div class="row gy-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="type">Chọn Type</label>
                                    <div class="form-control-wrap">
                                        <select name="" class="form-select" id="type" wire:model.lazy="typeService_id">
                                                <option value="999" >Vui lòng chọn</option>
                                            @foreach ($typeService as $item)
                                                <option value="{{$item->id}}" >{{$item->name}}</option>
                                            
                                            @endforeach
                                        </select>
                                        
                                        @error('name') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="price">Giá KH</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('price') error @enderror" id="price" placeholder="Giá" wire:model.lazy="price">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="priceEditor">Giá Editor</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('priceEditor') error @enderror" id="priceEditor" placeholder="Giá" wire:model.lazy="priceEditor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="priceQC">Giá QC</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('priceQC') error @enderror" id="priceQC" placeholder="Giá" wire:model.lazy="priceQC">
                                    </div>
                                </div>
                            </div>
                            @if(session()->has('message'))
                                <div style="color: red; text-align: center;">{{ session('message') }}</div>
                            @endif
                            <div class="col-12">
                                <ul class="text-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-primary">
                                        <em class="icon ni ni-save"></em>
                                        <span>{{ __('Update') }}</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    
</div><!-- .modal-body -->
<div class="modal-body">
@if($listCusType !== null)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Type Service</th>
            <th scope="col">Giá KH trả</th>
            <th scope="col">Giá trả Editor</th>
            <th scope="col">Giá trả QC</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
            <tbody>
                @foreach($listCusType as $type)
                <tr>
                    <th scope="row">{{typeServiceName($type->typeService_id) }}</th>
                    <td>{{ $type->priceCus }}</td>
                    <td>{{ $type->priceEditor }}</td>
                    <td>{{ $type->priceQC }}</td>
                    <td>
                        <li><a href="javascript:void(0);" wire:click="$dispatch('deleteCusType',{ customerId : {{ $customerId}}, typeId : {{ $type->typeService_id }} })" class="text-danger swal-confirm-delete">
                            <em class="icon ni ni-trash text-danger"></em><span>{{ __('Delete') }}</span>
                        </a></li>
                    </td>
                </tr>
            @endforeach
            
            </tbody>
      </table>

@else
    <p>Chưa có bản ghi nào</p>
@endif
</div><!-- .modal-content -->
</div><!-- .modal-content -->
</div><!-- .modal-dialog -->
</div><!-- .modal -->
<!-- select region modal -->    

</div>