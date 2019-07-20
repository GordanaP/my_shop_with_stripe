<form action="{{ route('users.update', Auth::user()) }}" method="POST">

    <div class="form-group row text-sm font-light">
        All fields marked with * are required.
    </div>

    @csrf
    @method('PUT')

    <div class="form-group row">
        <label for="name">Name:<span class="text-red-500 text-lg">*</span></label>
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

    <div class="form-group row">
        <label for="email">E-mail address: <span class="text-red-500 text-lg">*</span></label>
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

    <div class="form-group row">
        <label for="password">Password:</label>
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

    <div class="form-group row">
        <label for="password-confirm">Confirm Password:</label>

        <input type="password" class="form-control"
         id="password-confirm" name="password_confirmation"
         placeholder="Retype password" />
    </div>

    <div class="form-group row">
        <button type="submit" class="btn btn-primary">Update Account</button>
    </div>

</form>