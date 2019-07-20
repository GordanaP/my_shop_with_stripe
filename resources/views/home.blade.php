@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="height: 350px">
                <div class="text-lg p-3 border-b">
                    <i class="fa fa-lock text-gray-600 mr-1"></i> My account
                </div>

                <div class="card-body text-lg">
                    <p class="mb-1">{{ Auth::user()->name }}</p>
                    <p>{{ Auth::user()->email }}</p>
                </div>

                <div class="flex items-center p-3">
                    <a href="{{ route('users.edit', Auth::user()) }}">Edit</a>
                    <span class="mx-2">|</span>

                    @include('users.forms._delete')
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <a href="nav-brand" class="font-bold nav-item" style="color: inherit; text-decoration: none">
                <div class="card" style="height: 350px">
                    <div class="my-auto text-2xl">
                        <p class="text-center mb-1"><i class="fa fa-plus text-gray-500"></i></p>
                        <p class="text-center">Add Profile</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        var deleteAccountButton = $('#deleteAccountButton');
        var deleteAccountUrl = "{{ route('users.destroy', Auth::user()) }}";
        var redirectToUrl = "{{ route('welcome') }}";

        deleteAccountButton.on('click', function(){

            swalConfirmDelete(deleteAccountUrl, redirectToUrl);

        });

    </script>
@endsection