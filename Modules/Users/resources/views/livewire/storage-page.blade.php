<div>
    <div class="modal fade" wire:ignore.self role="dialog" id="user-password" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $titleForm }}</h5>
                    <a href="javascript:void(0);" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row g-1 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="username">{{ __('Username') }}</label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                        <h5>{{$username}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="gy-3" wire:submit.prevent="store({{ $userId }})">
                        <div class="row g-1 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="name">{{ __('New Password') }}</label>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" id="phone"
                                            class="form-control @error('newPassword') error @enderror"
                                            wire:model="newPassword" placeholder="New Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-1 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="confirmPassword">Confirm Password <span
                                            class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" id="phone"
                                            class="form-control @error('newPassword') error @enderror"
                                            wire:model="confirmPassword" placeholder="Confirm Password">
                                        @error('confirmPassword')
                                            <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="row g-3">
                            <div class="col-lg-7 offset-lg-5">
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        <em class="icon ni ni-save"></em>
                                        <span>{{ __('Update') }}</span>
                                    </button>
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