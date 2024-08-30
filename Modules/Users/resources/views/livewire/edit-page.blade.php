<div>
    <div class="modal fade" wire:ignore.self role="dialog" id="user-update" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $titleForm }}</h5>
                    <a href="javascript:void(0);" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form  wire:submit.prevent="editUsers({{ $userId }})" >
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Tên <span class="required">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('name') error @enderror" id="name" placeholder="Nhập tên " wire:model.lazy="name">
                                        @error('name') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Username <span class="required">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('username') error @enderror" id="name" placeholder="Nhập username" wire:model.lazy="username">
                                        @error('username') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="phone">Điện thoại</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('phone') error @enderror" id="phone" placeholder="Nhập điện thoại của bộ phận" wire:model.lazy="phone">
                                        @error('phone') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('email') error @enderror" id="email" placeholder="Nhập email của bộ phận" wire:model.lazy="email">
                                        @error('email') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="roles">Chức vụ</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" id="selectRole" wire:model.lazy="roles"
                                        data-placeholder="{{ __('role.Select Roles') }}">
                                            <option value="">Vui lòng chọn</option>
                                        @foreach ($listRole as $k => $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                        @error('roles') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="status">Trạng thái</label>
                                    <div class="form-control-wrap">
                                        <select name="status" id="status" class="form-control @error('status') error @enderror" wire:model.lazy="status">
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                        @error('status') <span class="invalid">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-12">
                                <ul class="text-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit"  class="btn btn-primary">
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
            window.initSelectRoleDrop = () => {
                $('#selectRole').select2({
                    allowClear: true
                });
            }
            initSelectRoleDrop();
            $('#selectRole').on('change', function(e) {
                var dataRole = $('#selectRole').select2("val");
                @this.set('roles', dataRole);
            });
            window.livewire.on('selectRole', () => {
                initSelectRoleDrop();
            });




        });
    </script>

</div>