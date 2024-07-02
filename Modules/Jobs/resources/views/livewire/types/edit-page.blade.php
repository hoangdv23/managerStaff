<div>
    <div class="modal fade" wire:ignore.self role="dialog" id="types-update" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $titleForm }}</h5>
                    <a href="javascript:void(0);" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit.prevent="editTypesService({{ $typeId }})">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Tên loại dịch vụ</label>
                                    <div class="form-control-wrap">
                                        {{-- <input type="text" class="form-control" id="name"> --}}
                                        <input type="text" id="name" class="form-control @error('name') error @enderror" wire:model.lazy="name" placeholder="{{ __('Tên loại dịch vụ') }}">
                                                @error('name') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Chọn màu:</label>
                                    <div class="form-control-wrap">
                                        {{-- <input type="text" class="form-control" id="name"> --}}
                                    <input type="color" class="form-control @error('color') error @enderror" id="color" wire:model.lazy="color">
                                    @error('color') <span class="invalid">{{ $message }}</span> @enderror
                                        Màu đã chọn: @json($color)
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Lưu thông tin</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
    <!-- select region modal -->
</div>