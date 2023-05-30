@if(! $errors->any() )
    {{ $slot ?? '' }}
    
@else
    @error($name)
    <div class="p-1 text-danger small">{{ $message }}</div>
    @enderror

@endif
