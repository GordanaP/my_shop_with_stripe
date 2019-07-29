@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <header>
        <h2 class="mb-0">
            Hi, {{ optional(Auth::user()->customer)->full_name ?: Auth::user()->name }}
        </h2>
        <hr>
    </header>

    <main>
        <div class="row">
            <div class="col-md-4">
                @include('home.partials._show_account')
            </div>

            <div class="col-md-4">
                @registered
                    @include('home.partials._show_profile')
                @else
                    @include('home.partials._add_profile')
                @endregistered
            </div>

            <div class="col-md-4">
                @include('home.partials._view_address_book')
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>

        var deleteAccountButton = $('#deleteAccountButton');
        var deleteAccountUrl = "{{ route('users.destroy', Auth::user()) }}";
        var redirectAfterDeleteAccount = "{{ route('welcome') }}";

        deleteAccountButton.on('click', function(){
            swalConfirmDelete(deleteAccountUrl, redirectAfterDeleteAccount);
        });

        @registered
            var deleteProfileButton = $('#deleteProfileButton');
            var deleteProfileUrl = "{{ route('customers.destroy', Auth::user()->customer) }}";
            var redirectAfterDeleteProfile = "{{ route('home') }}";

            deleteProfileButton.on('click', function(){
                swalConfirmDelete(deleteProfileUrl, redirectAfterDeleteProfile);
            });
        @endregistered

    </script>
@endsection