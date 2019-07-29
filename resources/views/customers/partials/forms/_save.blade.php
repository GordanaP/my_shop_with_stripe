<form action="{{ $route }}" method="POST">

    @csrf

    @if (Route::currentRouteName() == 'customers.edit')
        @method('PUT')
    @endif

    <!-- First Name -->
    <div class="form-group row">

        <label for="first_name" class="col-sm-3 col-form-label">
            <div class="pull-right">
                <span class="text-red-500 text-lg">*</span> First Name:
            </div>
        </label>

        <div class="col-sm-9">
            <input type="text" name="first_name" id="first_name"
            placeholder="Enter first name"
            value="{{ $first_name }}"
            class="form-control @error('first_name') is-invalid @enderror" />

            @info(['field' => 'first_name'])
                Max. 50 characters. Only letters, numbers, hyphens, and spaces.
            @endinfo

            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Last Name -->
    <div class="form-group row">
        <label for="last_name" class="col-sm-3 col-form-label">
            <div class="pull-right">
                <span class="text-red-500 text-lg">*</span> Last Name:
            </div>
        </label>
        <div class="col-sm-9">
            <input type="text" name="last_name" id="last_name"
            placeholder="Enter last name"
            value="{{ $last_name }}"
            class="form-control @error('last_name') is-invalid @enderror" />

            @info(['field' => 'last_name'])
                Max. 50 characters. Only letters, numbers, hyphens, and spaces.
            @endinfo

            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Street Address -->
    <div class="form-group row">
        <label for="street_address" class="col-sm-3 col-form-label">
            <div class="pull-right">
                <span class="text-red-500 text-lg">*</span> Street Address:
            </div>
        </label>
        <div class="col-sm-9">
            <input type="text" name="street_address" id="street_address"
            placeholder="Enter street address"
            value="{{ $street_address }}"
            class="form-control @error('street_address') is-invalid @enderror" />

            @info(['field' => 'street_address'])
                Max. 150 characters. Only letters, numbers, hyphens, and spaces.
            @endinfo

            @error('street_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Postal Code -->
    <div class="form-group row">
        <label for="postal_code" class="col-sm-3 col-form-label">
            <div class="pull-right">
                <span class="text-red-500 text-lg">*</span> Postal Code:
            </div>
        </label>
        <div class="col-sm-9">
            <input type="text" name="postal_code" id="postal_code"
            placeholder="Enter postal code"
            value="{{ $postal_code }}"
            class="form-control @error('postal_code') is-invalid @enderror" />

            @info(['field' => 'postal_code'])
                Max. 16 characters. Only letters, numbers, hyphens, and spaces.
            @endinfo

            @error('postal_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- City -->
    <div class="form-group row">
        <label for="city" class="col-sm-3 col-form-label">
            <div class="pull-right">
                <span class="text-red-500 text-lg">*</span> City:
            </div>
        </label>
        <div class="col-sm-9">
            <input type="text" name="city" id="city"
            placeholder="Enter city"
            value="{{ $city }}"
            class="form-control @error('city') is-invalid @enderror" />

            @info(['field' => 'city'])
                Max. 50 characters. Only letters, numbers, hyphens, and spaces.
            @endinfo

            @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Country -->
    <div class="form-group row">
        <label for="country" class="col-sm-3 col-form-label">
            <div class="pull-right">
                <span class="text-red-500 text-lg">*</span> Country:
            </div>
        </label>
        <div class="col-sm-9">

            <select name="country" id="country"
            class="form-control @error('country') is-invalid @enderror">
                <option value="">Select a country</option>

                @foreach (Country::all() as $country => $code)
                    <option value="{{ $code }}"
                    {{ getSelected($code, $country_code) }}
                    >
                        {{ $country }}
                    </option>
                @endforeach
            </select>

            @info(['field' => 'country'])
                Valid country.
            @endinfo

            @error('country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Phone -->
    <div class="form-group row">
        <label for="phone" class="col-sm-3 col-form-label">
            <div class="pull-right">
                <span class="text-red-500 text-lg">*</span> Phone Number:
            </div>
        </label>
        <div class="col-sm-9">
            <input type="text" name="phone" id="phone"
            placeholder="Enter phone number"
            value="{{ $phone }}"
            class="form-control @error('phone') is-invalid @enderror" />

            @info(['field' => 'phone'])
                Valid phone number.
            @endinfo

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group pull-right">
        <button type="submit" class="btn btn-primary">
            {{ $button_name }}
        </button>
    </div>

</form>