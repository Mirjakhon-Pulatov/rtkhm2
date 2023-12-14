@foreach($photos as $photo)
    <img width="150px" height="auto"
         onclick="setImage('{{$photo->id}}', '{{ asset("uploads/gallery/thumbnails/" . $photo->file) }}')"
         src="{{ asset("uploads/gallery/thumbnails/" . $photo->file) }}">
@endforeach
