<div class="card" style="height: 350px">

    <div class="text-lg p-3 border-b">
        <i class="fa fa-{{ $icon }} text-gray-600 mr-1"></i> {{ $title }}
    </div>

    <div class="card-body text-lg">
        {{ $details }}
    </div>

    <div class="flex items-center p-3">
        <a href="{{ $edit_route }}">Edit</a>
        <span class="mx-2">|</span>

        {{ $slot }}
    </div>

</div>