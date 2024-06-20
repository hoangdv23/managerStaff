<div class="row g-gs">
    <div class="col-lg-6">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Tạo tài khoản mới</h5>
                </div>
                <form wire:submit.prevent="createUser()">
                    <div class="form-group">
                        <label class="form-label" for="name">Tên người dùng</label>
                        <div class="form-control-wrap">
                            <input type="text" id="name" class="form-control @error('name') error @enderror" wire:model.lazy="name" placeholder="{{ __('Name') }}">
                                    @error('name') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="form-control-wrap">
                            <input type="text" id="username" class="form-control @error('username') error @enderror" wire:model.lazy="username" placeholder="{{ __('username') }}">
                                    @error('username') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone</label>
                        <div class="form-control-wrap">
                            <input type="text" id="phone" class="form-control @error('phone') error @enderror" wire:model.lazy="phone" placeholder="{{ __('setting.Phone Number') }}">
                                    @error('phone') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email-address">Email address</label>
                        <div class="form-control-wrap">
                            <input type="text" id="email" class="form-control @error('email') error @enderror" wire:model.lazy="email" placeholder="{{ __('setting.Email') }}">
                                    @error('email') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="form-control-wrap">
                            <a href="javascript:void(0);" class="form-icon form-icon-right passcode-switch" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control @error('password') error @enderror" id="password" placeholder="{{ __('setting.Password') }}" wire:model.lazy="password">
                                    @error('password') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Roles</label>
                        <div class="form-control-wrap">
                            <select class="form-select js-select2" id="selectRole" wire:model.lazy="roles" data-placeholder="{{ __('role.Select Roles') }}">
                                <option>Chọn quyền</option>
                                @foreach($listRole as $k => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('roles') <span class="invalid">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div><!-- .nk-block -->