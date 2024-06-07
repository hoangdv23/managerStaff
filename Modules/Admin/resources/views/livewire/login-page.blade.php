<div>
    
    <form wire:submit.prevent="loginPage()">
        @if ($message = Session::get('error'))
    
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
        @endif
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="default-01"> Username</label>
        </div>
        <div class="form-control-wrap">
            <input type="text" name="email" wire:model="email" required autofocus autocomplete="username" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address or username">
            @error('email') <span>{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password"  required autocomplete="current-password">Password</label>
            @error('password') <span>{{ $message }}</span> @enderror
            {{-- <a class="link link-primary link-sm" href="html/pages/auths/auth-reset-v2.html">Forgot Password?</a> --}}
        </div>
        <div class="form-control-wrap">
            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input type="password" class="form-control form-control-lg" id="password" wire:model="password" placeholder="Enter your passcode">
        </div>
    </div> 
    @if(session()->has('message'))
            <div style="color: red; text-align: center;">{{ session('message') }}</div>
        @endif
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
    </div>
    </form>
    </div>