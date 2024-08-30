<div class="card card-bordered">
    <div class="card-inner">    
        <form action="" wire:submit.prevent="create()">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <div class="form-control-wrap">
                            <input type="text" id="name" class="form-control @error('name') error @enderror" wire:model.lazy="name" placeholder="{{ __('customer.Name') }}">
                                    @error('name') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="code">Mã khách hàng</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="code"> --}}
                            <input type="text" id="code" class="form-control @error('code') error @enderror" wire:model.lazy="code" placeholder="{{ __('Mã khách hàng') }}">
                                    @error('code') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="email"> --}}
                            <input type="text" id="email" class="form-control @error('email') error @enderror" wire:model.lazy="email" placeholder="{{ __('Email khách hàng') }}">
                                    @error('email') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="phone"> --}}
                            <input type="text" id="phone" class="form-control @error('phone') error @enderror" wire:model.lazy="phone" placeholder="{{ __('Số điện thoại') }}">
                                    @error('phone') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="paypal">Paypal</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="type"> --}}
                            <input type="paypal" id="country" class="form-control @error('paypal') error @enderror" wire:model.lazy="paypal" placeholder="{{ __(' không cần thiết phải điền') }}">
                                    @error('paypal') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="timezone">Chọn múi giờ</label>
                        <div class="form-control-wrap">
                            <select name="" class="form-select js-select2" id="timezone" wire:model.lazy="timezone">
                                <option value="999" >Vui lòng chọn</option>
                                @foreach($timezones as $timezone)
                                    <option value="{{ $timezone }}">{{ $timezone }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="country">Quốc gia</label>
                        <div class="form-control-wrap">
                            {{-- <input type="text" class="form-control" id="type"> --}}
                            <input type="text" id="country" class="form-control @error('type') error @enderror" wire:model.lazy="country" placeholder="{{ __(' không cần thiết phải điền') }}">
                                    @error('country') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="type">Loại khách hàng</label>
                        <div class="form-control-wrap">
                            <input type="text" id="type" class="form-control @error('type') error @enderror" wire:model.lazy="type" placeholder="{{ __('Loại khách hàng/ không cần thiết phải điền') }}">
                                    @error('type') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-6">
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
<script type="text/javascript">

    $(document).ready(function() {
        //Permission
        window.initSelectTimeZoneDrop=()=>{
            $('#timezone').select2({
                allowClear: true
            });
        }
        initSelectTimeZoneDrop();
        $('#timezone').on('change', function (e) {
            var dataZone = $('#timezone').select2("val");
            @this.set('timezone', dataZone);
        });

        window.livewire.on('selectRole',()=>{
            initSelectTimeZoneDrop();
        });


    });
</script>
</div><!-- .nk-block -->