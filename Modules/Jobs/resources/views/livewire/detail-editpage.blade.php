<div>
    <div class="modal fade" wire:ignore.self role="dialog" id="jobs-detai-update" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $titleForm }}</h5>
                    <a href="javascript:void(0);" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit.prevent="editTypeJobs({{ $typeId }})">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Tên jobs</label>
                                    <div class="form-control-wrap">
                                        <select id="name" class="form-select action-select2 @error('name') error @enderror" wire:model.lazy="name" placeholder="{{ __('Mã khách hàng') }}">
                                            <option value="">Chọn jobs</option>
                                            @foreach ( $listJobs as $item )
                                                <option value="{{ $item['id'] }}" > {{ $item['name'] }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="type_service">Loại jobs</label>
                                    <div class="form-control-wrap">
                                        <select id="type_service" class="form-select action-select2 @error('type_service') error @enderror" wire:model.lazy="type_service" placeholder="{{ __('Mã khách hàng') }}">
                                            <option value="">Chọn Loại </option>
                                            @foreach ( $listType_service as $item )
                                                <option value="{{ $item['id'] }}" > {{ $item['name'] }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="amount">Số lượng ảnh</label>
                                    <div class="form-control-wrap">
                                        {{-- <input type="text" class="form-control" id="email"> --}}
                                        <input type="text" id="amount" class="form-control @error('amount') error @enderror" wire:model.lazy="amount" placeholder="{{ __('Số lượng ảnh') }}">
                                                @error('amount') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
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
                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="price">Đơn giá khách hàng trả</label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="price"  class="form-control"  wire:model.lazy="price">
                                        @error('price') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="editor_price">Đơn giá Editor</label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="editor_price"  class="form-control"  wire:model.lazy="editor_price">
                                        @error('editor_price') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="qc_price">Đơn giá QC</label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="qc_price"  class="form-control"  wire:model.lazy="qc_price">
                                        @error('qc_price') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="deadline">Thời gian kết thúc</label>
                                    <div class="form-control-wrap">
                                        <input type="datetime-local" class="form-control"  wire:model.lazy="deadline">
                                        @error('deadline') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="note">Link ảnh gốc</label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="fixed_link" class="form-control @error('fixed_link') error @enderror" wire:model.lazy="fixed_link" placeholder="{{ __('Link ảnh jobs') }}">
                                        {{-- <textarea name="" class="form-control" id="note" cols="30" rows="10" wire:model.lazy="note" placeholder="Ghi chú"></textarea> --}}
                                        @error('name') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="note">Link ảnh đã up</label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="edited_link" class="form-control @error('edited_link') error @enderror" wire:model.lazy="edited_link" placeholder="{{ __('Link ảnh jobs') }}">
                                        {{-- <textarea name="" class="form-control" id="note" cols="30" rows="10" wire:model.lazy="note" placeholder="Ghi chú"></textarea> --}}
                                        @error('name') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="note">Link ảnh đã check</label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="checked_link" class="form-control @error('checked_link') error @enderror" wire:model.lazy="checked_link" placeholder="{{ __('Link ảnh jobs') }}">
                                        {{-- <textarea name="" class="form-control" id="note" cols="30" rows="10" wire:model.lazy="note" placeholder="Ghi chú"></textarea> --}}
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
    }); 
    </script>
</div>