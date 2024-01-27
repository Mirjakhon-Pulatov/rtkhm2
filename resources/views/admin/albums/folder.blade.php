@foreach ($photos as $photo)
    <img width="150px" height="auto"
        onclick="setImage('{{ $photo->id }}', '{{ asset('public/uploads/gallery/thumbnails/' . $photo->file) }}')"
        src="{{ asset('public/uploads/gallery/thumbnails/' . $photo->file) }}">
@endforeach
