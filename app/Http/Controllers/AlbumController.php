<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\gallerys;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Featured_images;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = album::orderBy('id', 'desc')->get();
        return view('admin.albums.albums', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    public function ShowAlbum($id)
    {

        if (!is_numeric($id)) {
            return view('admin.error.404');
        }

        $CurrentAlbum = album::where('id', $id)->first();
        $AlbumPhotos = gallerys::where('album_id', $id)->get();

        if (!$CurrentAlbum) {
            return view('admin.error.404');
        }

        $directory = public_path('uploads/gallery/photos');
        $directoryThumb = public_path('uploads/gallery/thumbnails');

        // Проверяем, существует ли директория
        if (!File::exists($directory)) {
            // Если нет, создаем ее
            File::makeDirectory($directory, 0755, true);
        }

        // Проверяем, существует ли директория
        if (!File::exists($directoryThumb)) {
            // Если нет, создаем ее
            File::makeDirectory($directoryThumb, 0755, true);
        }

        return view('admin.albums.add-photo', compact('CurrentAlbum', 'AlbumPhotos'));
    }

    public function addPhoto(Request $request)
    {

        $image = $request->file('file');

        $imageName = Carbon::now()->format('H-i-s_-_d-m-Y') . "_" . uniqid() . "." . $image->getClientOriginalExtension();

        gallerys::create([
            'album_id' => $request->input('album_id'),
            'file' => $imageName,
            'type' => $image->getClientOriginalExtension(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        $image->move(public_path('uploads/gallery/photos'), $imageName);

        $OriginalPohoto = public_path('uploads/gallery/photos/' . $imageName);

        function makeThumb($src, $desired_width, $imageName)
        {
            $array = explode(".", $src);
            $ext = $array[count($array) - 1];
            $ext = strtolower($ext);

            $dest = public_path() . '/uploads/gallery/thumbnails/' . $imageName;

            if ($ext == "jpg" || $ext == "jpeg")
                $source_image = imagecreatefromjpeg($src);
            elseif ($ext == "png")
                $source_image = imagecreatefrompng($src);

            $width = imagesx($source_image);
            $height = imagesy($source_image);

            $desired_height = floor($height * ($desired_width / $width));

            $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

            if ($ext == "jpg" || $ext == "jpeg")
                imagejpeg($virtual_image, $dest);
            elseif ($ext == "png")
                imagepng($virtual_image, $dest);
        }

        makeThumb($OriginalPohoto, '640', $imageName);


        return response()->json(['success' => $imageName]);
    }

    public function deletePhoto(Request $request)
    {
        $LinktoFile = $request->input('delete_id');

        $LinktoFile = Str::after($LinktoFile, 'thumbnails/');


        $file_path_o = public_path('uploads\gallery\photos\\' . $LinktoFile);
        $file_path_t = public_path('uploads\gallery\thumbnails\\' . $LinktoFile);

        gallerys::where('file', 'like', '%' . $LinktoFile . '%')->delete();

        if ((File::exists($file_path_o)) && (File::exists($file_path_t))) {

            unlink($file_path_o);
            unlink($file_path_t);
        } else {
            echo 'Файл не существует.';
        }


        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        album::create([
            'title' => $request->input('title'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return redirect()->back();
    }


    public function storePhotos(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album = album::find($id);
        $album->update([
            'title' => $request->input('name')
        ]);

        return redirect()->back()->with('success', 'Имя изменен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, album $album, gallerys $gallery)
    {
        $album = Album::find($request->album_id);

        if ($album) {
            // Находим все фотографии связанные с альбомом
            $photos = gallerys::where('album_id', $request->album_id)->get();

            // Проходим по всем фотографиям и удаляем их
            foreach ($photos as $photo) {
                $photoFilePath = public_path('uploads/gallery/photos/') . $photo->file;
                $thumbnailPath = public_path('uploads/gallery/thumbnails/') . $photo->file;

                if (file_exists($photoFilePath)) {
                    unlink($photoFilePath);
                }

                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath);
                }

                $photo->delete();
            }

            // Удаляем альбом
            $album->delete();

            return redirect()->route('albums')->with('success', 'Альбом и все фотографии удалены');
        } else {
            return redirect()->route('albums')->with('error', 'Альбом не найден');
        }
    }

    public function OpenFolder(Request $request)
    {
        $galleryId = $request->input('gallery_id');

        $photos = gallerys::where('album_id', $galleryId)->orderBy('id', 'desc')->get();

        return view('admin.albums.folder', compact('photos'));
    }


    public function setImage(Request $request)
    {
        $id = $request->input('id');
        $dt = $request->input('dt');
        $article = $request->input('article');

        $ImageUpdate = Featured_images::where('article', $article)->get()->count();

        if ($ImageUpdate > 0) {
            Featured_images::where('article', $article)->update(['image_id' => $id, 'updated_at' => Carbon::now()]);
        } else {
            Featured_images::create([
                'dt' => $dt,
                'article' => $article,
                'image_id' => $id
            ]);
        }
        return response()->json(['success' => "Изменено !"]);
    }


    public function DeleteImageContent(Request $request)
    {
        Featured_images::where('article', $request->article)->delete();
        return response()->json(['success' => "Удалено !"]);
    }

}
