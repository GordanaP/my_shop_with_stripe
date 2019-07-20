@extends('layouts.app')

@section('title', 'Edit Account')

@section('content')
    <header>
        <h1>Edit account</h1>
        <hr class="mb-4">
    </header>

    <main>
        <div class="card card-body w-2/3 mx-auto px-5">

            @include('users.forms._edit')

        </div>
    </main>
@endsection

@section('scripts')
    <script>

        clearServerSideErrorOnNewInput()

    </script>
@endsection