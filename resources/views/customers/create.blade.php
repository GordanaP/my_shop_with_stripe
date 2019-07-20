@extends('layouts.app')

@section('title', 'Create Profile')

@section('content')

    <div class="card w-4/5 mx-auto">
        <div class="border-b border-b-gray-500 p-3 text-xl uppercase">
            Create profile
        </div>

        <div class="px-3 pt-3 text-sm font-light">
            All fields marked with * are required.
        </div>

        <div class="card-body mx-auto w-3/4">
            <form action="{{ route('users.customers.store') }}" method="POST">

                @csrf

                <!-- First Name -->
                <div class="form-group row">
                    <label for="first_name" class="col-sm-3 col-form-label">
                        <div class="pull-right">
                            <span class="text-red-500 text-lg">*</span> First Name:
                        </div>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="first_name" id="first_name"
                        placeholder="Enter your first name"
                        value="{{ old('first_name') }}"
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
                        placeholder="Enter your last name"
                        value="{{ old('last_name') }}"
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
                        placeholder="Enter your street address"
                        value="{{ old('street_address') }}"
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
                        placeholder="Enter your postal code"
                        value="{{ old('postal_code') }}"
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
                        placeholder="Enter your city"
                        value="{{ old('city') }}"
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
                                {{ getSelected($code , old('country')) }}
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
                        placeholder="Enter your phone number"
                        value="{{ old('phone') }}"
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
                        Create Profile
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        clearServerSideErrorOnNewInput()

    </script>
@endsection