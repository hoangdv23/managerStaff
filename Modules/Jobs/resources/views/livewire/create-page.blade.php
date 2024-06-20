<div class="card card-bordered">
    <div class="card-inner">    
        <form action="" wire:submit.prevent="createJobs()">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="name">Tên jobs</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="name"> --}}
                            <input type="text" id="name" class="form-control @error('name') error @enderror" wire:model.lazy="name" placeholder="{{ __('Tên Jobs') }}">
                                    @error('name') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="code">Khách hàng</label>
                        <div class="form-control-wrap">
                            <select id="code" class="form-select js-select2 @error('code') error @enderror" wire:model.lazy="code" placeholder="{{ __('Mã khách hàng') }}">
                                <option value="">Chọn bộ phận</option>
                                @foreach ( $listCustomer as $item )
                                    <option value="{{ $item['id'] }}">{{ $item['code'] }} - {{ $item['name'] }}</option>
                                @endforeach
                                
                            </select>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="type">Loại dịch vụ</label>
                        <div class="form-control-wrap" wire:ignore>
                            <select class="form-select js-select2" id="selectType" wire:model="type" multiple="multiple" data-placeholder="Chọn giá trị">
                                <option disabled>Vui lòng chọn giá trị</option> 
                                @foreach ($listType_service as $typeService)
                                    <option value="{{$typeService['id']}}">{{$typeService['name']}}</option> 
                                @endforeach

                            </select>
                            {{-- @json($type) --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="amount">Số lượng ảnh</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="email"> --}}
                            <input type="text" id="amount" class="form-control @error('amount') error @enderror" wire:model.lazy="amount" placeholder="{{ __('Số lượng ảnh') }}">
                                    @error('amount') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="status">Trạng thái</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="status"> --}}
                            <select name="" class="form-select js-select2" id="status" wire:model.lazy="status">
                                <option value="999" >Vui lòng chọn</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="startday">Ngày bắt đầu</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-right">
                                <em class="icon ni ni-calendar"></em>
                            </div>
                            <input type="text" id="startday" autocomplete="off" class="form-control date-picker @error('startday') error @enderror" wire:model.lazy="startday" placeholder="{{ __('Start Day') }}" data-date-format="yyyy-mm-dd">
                            @error('startday') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="stopday">Ngày kết thúc</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-right">
                                <em class="icon ni ni-calendar"></em>
                            </div>
                            <input type="text" id="stopday" autocomplete="off" class="form-control date-picker @error('stopday') error @enderror" wire:model.lazy="stopday" placeholder="{{ __('Stop Day') }}" data-date-format="yyyy-mm-dd">
                            @error('stopday') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="note">Ghi chú</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="note"> --}}
                            <textarea name="" class="form-control" id="note" cols="30" rows="10" wire:model.lazy="note" placeholder="Ghi chú"></textarea>
                            @error('name') <span class="invalid">{{ $message }}</span> @enderror
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


<script>
    $(document).ready(function() {
    //Permission
    window.initselectTypeDrop=()=>{
        $('#selectType').select2({
            // allowClear: true
        });
    }
    initselectTypeDrop();
    $('#selectType').on('change', function (e) {
        var dataRole = $('#selectType').select2("val");
        @this.set('type', dataRole);
    });

    window.livewire.on('selectType',()=>{
        initselectTypeDrop();
    });
    })
    $(document).ready(function (){
    //Start At
        $('#startday').on('change', function (e) {
            @this.set('startday', e.target.value);
        });
    })

    $(document).ready(function (){
    //Start At
        $('#stopday').on('change', function (e) {
            @this.set('stopday', e.target.value);
        });
    })
</script>
