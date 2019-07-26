@if (! $errors->has($field))
    <div class="flex {{ $field }} items-center gabriela">
        <span class="font-bold text-blue-500 mr-2 italic text-lg">i</span>
        <span class="text-xs text-gray-500">{{ $slot }}</span>
    </div>
@endif