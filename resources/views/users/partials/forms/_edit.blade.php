<form action="{{ route('users.update', $user) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">
            <div class="pull-right">
                <span class="text-red-500 text-lg">*</span> Name:
            </div>
        </label>
        <div class="col-sm-9">
            <input type="text" name="name" id="name"
            placeholder="Enter your name"
            value="{{ old('name') ?: $user->name }}"
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
        <label for="email" class="col-sm-3 col-form-label">
            <div class="pull-right">
                <span class="text-red-500 text-lg">*</span> E-mail address:
            </div>
        </label>
        <div class="col-sm-9">
            <input type="text" name="email" id="email"
            placeholder="email@example.com"
            value="{{ old('email') ?: $user->email }}"
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
        <label for="password" class="col-sm-3 col-form-label">
            <span class="pull-right">Password:</span>
        </label>
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
        <label for="password-confirm" class="col-sm-3 col-form-label">
            <span class="pull-right">Confirm Password:</span>
        </label>
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