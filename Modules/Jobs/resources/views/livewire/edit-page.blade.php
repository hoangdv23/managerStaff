<div>
    <div class="modal fade" wire:ignore.self role="dialog" id="jobs-update" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $titleForm }}</h5>
                    <a href="javascript:void(0);" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit.prevent="editJobs({{ $jobId }})">
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
                                        <select id="code" class="form-select action-select2 @error('code') error @enderror" wire:model.lazy="code" placeholder="{{ __('Mã khách hàng') }}">
                                            <option value="">Chọn bộ phận</option>
                                            @foreach ( $listCustomer as $item )
                                                <option value="{{ $item['id'] }}" >{{ $item['code'] }} - {{ $item['name'] }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- chỉ cần add class name action-select2 vào select rồi gọi js ở dưới -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="type">Loại dịch vụ</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select action-select2"  id="selectType" 
                                            data-search="on" wire:model.lazy="type" multiple>
                                            <option value = "null">Vui lòng chọn giá trị</option> 
                                            @foreach ($listType_service as $key => $row)
                                                <option value="{{$row->id}}" wire:key = "dohfojh{!!$key!!}">{{$row->name}}</option> 
                                            @endforeach
                                        </select>
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
                                        <select name="" class="form-select action-select2" id="status" wire:model.lazy="status">
                                            <option value="" disabled>Vui lòng chọn</option>
                                            <option value="1">PROCESS</option>
                                            <option value="0">REJECT</option>
                                            <option value="2">DONE</option>
                                            <option value="3">APPROVE</option>
                                            <option value="4">SENT</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="stopday">Thời gian kết thúc</label>
                                    <div class="form-control-wrap">
                                        {{-- <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-calendar"></em>
                                        </div> --}}
                                        {{-- @json($stopday) --}}
                                        {{-- <input type="text" id="site-stopday"  class="form-control"  wire:model.lazy="stopday"> --}}
                                        <input type="datetime-local" class="form-control"  wire:model.lazy="stopday">
                                        {{-- <input type="text" id="site-stopday" autocomplete="off" class="form-control date-picker @error('stopday') error @enderror" wire:model.lazy="stopday" placeholder="{{ __('Stop Day') }}" data-date-format="yyyy-mm-dd"> --}}
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
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
    <!-- select region modal -->
    <script>
        // thay the js-select2 bang action-select2 (miễn là khác js-select2)  , dùng hàm này cho mọi option select
    $(document).ready(function() {
        $('.action-select2').select2( // hàm khởi tạo select2
            {
                // allowClear: true,
            }
        );
        $('#site-stopday').on('change', function (e) {
                  @this.set('stopday', e.target.value);
             });
        $('.action-select2').on('change', function (e) { // add dữ liệu vào wire:model khi select2 thay đổi
            let data = $(this).select2("val");
            let nameSelect = $(this).attr('wire:model.lazy');
            if(!(nameSelect == null ||nameSelect == "undefined" ||nameSelect == "")){
                @this.set(nameSelect, data);
            }else{
                nameSelect = $(this).attr('wire:model.defer');
                if(!(nameSelect == null ||nameSelect == "undefined" ||nameSelect == "")){
                    @this.set(nameSelect, data);
                }
            }
        });
        $('#site-stopday').datetimepicker({
                format:'Y-m-d H:i:s',
            dayOfWeekStart : 1,
            lang:'en'
            });
        Livewire.on('refreshSelect2Table', function () {
            jQuery(document).ready(function () {
                $('.action-select2').select2(
                    {
                        // allowClear: true,
                    }
                ); 
                $('#site-stopday').on('change', function (e) {
                  @this.set('stopday', e.target.value);
                });
                $('.action-select2').on('change', function (e) { // add dữ liệu vào wire:model khi select2 thay đổi
                    let data = $(this).select2("val");
                    let nameSelect = $(this).attr('wire:model.lazy');
                    if(!(nameSelect == null ||nameSelect == "undefined" ||nameSelect == "")){
                        @this.set(nameSelect, data);
                    }else{
                        nameSelect = $(this).attr('wire:model.defer');
                        if(!(nameSelect == null ||nameSelect == "undefined" ||nameSelect == "")){
                            @this.set(nameSelect, data);
                        }
                    }
                });
            }); 

        }); 
    }); 
    </script>
</div>