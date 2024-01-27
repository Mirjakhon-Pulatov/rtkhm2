@foreach ($ExtraImagesList as $imageItem)
    @php
        $image = \App\Models\gallerys::select('file')
            ->where('id', $imageItem->image_id)
            ->first();
    @endphp
    <div class="col-md-12 extra_image mb-4" is_num="{{ $imageItem->s_num }}">
        <div is_num="{{ $imageItem->s_num }}" class="count_div" type="button">{{ $imageItem->s_num }}</div>
        <img height="auto" src="{{ asset('public/uploads/gallery/thumbnails/' . $image->file) }}" width="100%">
        <button
            onclick="DeleteExtraImage('{{ $imageItem->dt }}', '{{ $imageItem->code }}', {{ $imageItem->image_id }}, {{ $imageItem->s_num }})"
            class="btn btn-sm btn-danger delete_extra_image" type="button"><i class="bx bx-trash"></i></button>
        <button
            onclick="ChangeExtraInfo('{{ $imageItem->dt }}', '{{ $imageItem->code }}', {{ $imageItem->image_id }}, {{ $imageItem->s_num }})"
            class="btn btn-sm btn-primary edit_extra_image" type="button"><i class="bx bx-edit"></i></button>
    </div>
@endforeach
