<div>
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title">{{ __('role.Add Role') }}</h4>
                <div class="nk-block-des">
                    <p>{{ __('role.You can make new role your website.') }}</p>
                </div>
            </div>
        </div>
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="role_form gy-3" wire:submit.prevent="store()">
                    <div class="row g-3 align-center">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="name">{{ __('Name') }} <span class="required">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control @error('name') error @enderror" id="name" wire:model.lazy="name">
                                    @error('name') <span class="invalid">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="g">
                                <div class="custom-control custom-control-sm custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkall" wire:model="selectAll">
                                    <label class="custom-control-label" for="checkall">
                                        <span class="preview-title overline-title">{{ __('Select all') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            @forelse ($permissionArr as $index => $permission)
                            <div class="card card-bordered card-preview mb-4">
                                <table class="table preview-reference">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="overline-title" colspan="2"><strong>{{ $permission->module }}</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (collect($permission->children)->chunk(2) as $chunkedTitleObjects)
                                        <tr>
                                            @foreach ($chunkedTitleObjects as $item)
                                            <td wire:key="{{ $item['id'] }}">
                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                    <input type="checkbox" value="{{ $item['name'] }}" class="custom-control-input" id="check-bl{{ $item['id'] }}" wire:model.lazy="selectedPermissions">
                                                    <label class="custom-control-label" for="check-bl{{ $item['id'] }}">{{ $item['description'] }}</label>
                                                </div>
                                            </td>
                                            @if(sizeof($chunkedTitleObjects) == 1)
                                            <td>&nbsp</td>
                                            @endif
                                            @endforeach
                                            <tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-lg-12 offset-lg-12">
                                    <div class="form-group mt-2 text-center">
                                        <button type="submit" class="btn btn-primary">
                                        <em class="icon ni ni-save"></em>
                                        <span>{{ __('Update') }}</span>
                                        </button>
                                        <a href="{{ route('roles.index') }}" class="btn btn-light">
                                            <em class="icon ni ni-back-arrow-fill"></em>
                                            <span>{{ __('Back') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div><!-- card -->
                    </div><!-- .nk-block -->
                </div>