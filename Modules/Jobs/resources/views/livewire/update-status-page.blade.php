<div>
    <div class="modal fade" wire:ignore.self role="dialog"  id="jobs-status" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $titleForm }}</h5>
                    <a href="javascript:void(0);" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateStatus({{ $typeId }})">
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="status">Đổi trạng thái công việc</label>
                                    <div class="form-control-wrap">
                                        {{-- <input type="text" class="form-control @error('status') error @enderror" id="status" placeholder="Nhập người nhận việc" wire:model.lazy="status" > --}}
                                        <select name="" id="status" wire:model.lazy="status" class="form-control @error('status') error @enderror">
                                                <option value="" unselect>Vui lòng chọn</option>
                                                <option value="1">PROCESS</option>
                                                <option value="0">REJECT</option>
                                                <option value="2">DONE</option>
                                                <option value="3">APPROVE</option>
                                                <option value="4">SENT</option>
                                        </select>
                                        @error('status') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            
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
                    </div><!-- .modal-content --> 
                    </div><!-- .modal-dialog -->
                    </div><!-- .modal -->
                    <!-- select region modal -->
                </div>