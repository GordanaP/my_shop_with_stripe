<form action="{{ route('users.update', Auth::user()) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Name:<span class="text-red-500 text-lg">*</span></label>
        <div class="col-sm-9">
            <input type="text" name="name" id="name"
            placeholder="Enter your name"
            value="{{ old('name') ?: Auth::user()->name }}"
            class="form-control @error('name') is-invalid @enderror" />

            @info(['field' => 'name'])
                Only letters & numbers.
            @endinfo

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">E-mail address: <span class="text-red-500 text-lg">*</span></label>
        <div class="col-sm-9">
            <input type="text" name="email" id="email"
            placeholder="email@example.com"
            value="{{ old('email') ?: Auth::user()->email }}"
            class="form-control @error('email') is-invalid @enderror" />

            @info(['field' => 'email'])
                Valid email address.
            @endinfo

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label">Password:</label>
        <div class="col-sm-9">
            <input type="password" name="password" id="password"
            value="{{ old('password') }}"
            placeholder="******"
            class="form-control @error('password') is-invalid @enderror" />

            @info(['field' => 'password'])
                At least 6 characters.
            @endinfo

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-sm-3 col-form-label">Confirm Password:</label>
        <div class="col-sm-9">
            <input type="password" class="form-control"
            id="password-confirm" name="password_confirmation"
            placeholder="Retype password" />
        </div>
    </div>

    <div class="form-group pull-right">
        <button type="submit" class="btn btn-primary">Update Account</button>
    </div>

</form>