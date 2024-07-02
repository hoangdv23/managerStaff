<div class="card card-bordered">
    <div class="card-inner">    
        <form action="" wire:submit.prevent="createTypes()">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="name">Nhập tên Loại dịch vụ mới</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="name"> --}}
                            <input type="text" id="name" class="form-control @error('name') error @enderror" wire:model.lazy="name" placeholder="{{ __('customer.Name') }}">
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
    </div>
</div>
</div><!-- .nk-block -->