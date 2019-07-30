@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <h2 class="mb-0">
        Hi, {{ optional(Auth::user()->customer)->full_name ?: Auth::user()->name }}
    </h2>

    <hr>

    <div class="row">
        <div class="col-md-4">
            @include('home.partials._show_account')
        </div>

        <div class="col-md-4">
            @withProfile(Auth::user())
                @include('home.partials._show_profile')
            @else
                @include('home.partials._add_profile')
            @endwithProfile
        </div>

        <div class="col-md-4">
            @include('home.partials._view_address_book')
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        var deleteAccountButton = $('#deleteAccountButton');
        var deleteAccountUrl = "{{ route('users.destroy', Auth::user()) }}";
        var redirectAfterDeleteAccount = "{{ route('welcome') }}";

        deleteAccountButton.on('click', function(){
            swalConfirmDelete(deleteAccountUrl, redirectAfterDeleteAccount);
        });

        @withProfile(Auth::user())
            var deleteProfileButton = $('#deleteProfileButton');
            var deleteProfileUrl = "{{ route('customers.destroy', Auth::user()->customer) }}";
            var redirectAfterDeleteProfile = "{{ route('home') }}";

            deleteProfileButton.on('click', function(){
                swalConfirmDelete(deleteProfileUrl, redirectAfterDeleteProfile);
            });
        @endwithProfile

    </script>
@endsection