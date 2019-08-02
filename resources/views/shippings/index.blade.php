@extends('layouts.app')

@section('title', 'Address Book')

@section('content')
    <header>
        <div  class="flex justify-between items-center">

            <h2 class="mb-0">My Address Book</h2>

            @withProfile($user)
                <a href="{{ route('users.shippings.create', $user) }}"
                class="bg-blue-300 hover:bg-blue-400 px-2 py-1 text-white text-base rounded-sm pull-right no-underline">
                    <i class="fa fa-plus fa-lg mr-1" aria-hidden="true"></i> Add Address
                </a>
            @endwithProfile
        </div>
        <hr>
    </header>

    @withProfile($user)
        <section id="addressBook">
            @foreach ($user->getAddressBook()->chunk(3) as $chunk)
                <div class="row mb-4">
                    @foreach ($chunk as $address)
                        <div class="col-md-4">
                            @include('shippings.partials.html._show_address', [
                                'customer' => $address,
                            ])
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p>Your address book is empty at present.</p>
        </section>
    @endwithProfile
@endsection

@section('scripts')
    <script>

        var deleteShippingButton = $('#deleteShippingButton');
        var redirectAfterDeleteShipping = "{{ route('users.shippings.index', $user) }}";

        deleteShippingButton.on('click', function() {

            var shippingId = $(this).val();
            var deleteShippingUrl = '/shippings/'+shippingId;

            swalConfirmDelete(deleteShippingUrl, redirectAfterDeleteShipping);
        });

    </script>
@endsection
