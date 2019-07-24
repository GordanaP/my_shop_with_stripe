@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>Welcome to My Shop With Stripe</h1>

    <form>
        <input type="text" name="getName" id="getName">
        <button type="button" id="submitButton">Submit</button>
    </form>
@endsection

@section('scripts')
    <script>

        var testStoreUrl = "{{ route('tests.store') }}"
        var submitButton = document.querySelector('#submitButton');

        submitButton.addEventListener('click', function(){
            var getName = document.querySelector('#getName').value

            $.ajax({
                url: testStoreUrl,
                type: 'POST',
                data: {
                    name: getName
                },
            })
            .done(function(response) {
                console.log(response);
            })
        });

    </script>
@endsection