<script src="{{ asset('js/form_helpers.js') }}" ></script>

@include('sweetalert::alert')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('scripts')