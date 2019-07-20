@extends('layouts.app')

@section('title', 'Edit Account')

@section('content')
    <div class="card w-4/5 mx-auto">
        <div class="border-b border-b-gray-500 p-3 text-xl uppercase">
            Edit account
        </div>

        <div class="px-3 pt-3 text-sm font-light">
                All fields marked with * are required.
        </div>

        <div class="card-body mx-auto w-3/4">
            @include('users.forms._edit')
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        clearServerSideErrorOnNewInput()

    </script>
@endsection