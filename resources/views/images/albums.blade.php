
@foreach($albums as $album)
    <div class="form-check">
        <label class="form-check-label">
            <input 
                class="form-check-input" 
                name="albums[]" 
                value="{{ $album->id }}" 
                type="checkbox" 
                @if ($album->images->contains('id', $image->id)) checked @endif
            >
            {{ $album->name }}
        </label>
    </div>        
@endforeach
