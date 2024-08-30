<div>
    <div class="modal fade" wire:ignore.self role="dialog" id="user-update-Cus" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $titleForm }}</h5>
                    <a href="javascript:void(0);" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form  wire:submit.prevent="EditCustomers({{$customerId}})" >
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Tên khách hàng</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('name') error @enderror" id="name" placeholder="Nhập tên khách hàng" wire:model.lazy="name">
                                        @error('name') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="code">Mã khách hàng</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('code') error @enderror" id="code" placeholder="Nhập mã khách hàng" wire:model.lazy="code">
                                        @error('code') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="phone">Số điện thoại</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('phone') error @enderror" id="phone" placeholder="Nhập số điện thoại" wire:model.lazy="phone">
                                        @error('phone') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('email') error @enderror" id="email" placeholder="Nhập số điện thoại" wire:model.lazy="email">
                                        @error('email') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="status">Status</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2 @error('status') error @enderror" id="status"  wire:model.lazy="status">
                                            <option value="999" >Vui lòng chọn</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @error('status') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="type">Loại khách hàng</label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="type" class="form-control @error('type') error @enderror" wire:model.lazy="type" placeholder="{{ __('Loại khách hàng') }}">
                                    @error('type') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div> --}}
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
                                        <select name="timezone" class="form-select js-select2" id="timezone" wire:model.lazy="timezone">
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="note">Ghi chú</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control @error('note') error @enderror" id="note" cols="64" rows="4" placeholder="Nhập ghi chú" wire:model.lazy="note"></textarea>
                                        {{-- <input type="text" class="form-control @error('phone') error @enderror" id="phone" placeholder="Nhập số điện thoại" wire:model.lazy="phone"> --}}
                                        @error('note') <span class="invalid">{{ $message }}</span> @enderror
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
                </div>