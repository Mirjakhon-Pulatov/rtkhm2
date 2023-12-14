<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class FilesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = Files::all();
        return view('admin.files', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->hasFile('filename')) {
            $file = $request->file('filename');
            $name = $file->getClientOriginalName();
            $extension = $file->guessClientExtension();
            $size = $file->getSize();
            $size = $size / 1024;

            if ($size < 1024) {
                $size = floor($size);
                $size = $size . " кб";
            } else {
                $size = $size / 1024;
                $megabytes = floor($size);
                $kilobytes = round(($size - $megabytes) * 1024);
                $kilobytes = substr($kilobytes, 0, -1);
                $size = $megabytes . "." . $kilobytes . ' мб ';
            }


            if ($request->has('original_name')) {
                $filename = $name;
            } else {
                $filename = Carbon::now()->format('H-i-s_-_d-m-Y') . "_" . uniqid() . "." . $extension;
            }

            $request->filename->move(public_path('uploads/files'), $filename);
            Files::create([
                'filename' => $filename,
                'type' => $extension,
                'size' => $size
            ]);
        }


        return redirect()->back()->with('success', 'Файл успешно загружено');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
//                dd($request->all());
        $files = Files::findOrFail($request->file_id);
        $file_name = $files->filename;
        $file_path = public_path('uploads/files/' . $file_name);
        if (file_exists($file_path)) {
            unlink($file_path);
            $files->delete();
            return redirect()->route('files.index')->with('success', 'Файл успешно удален');
        } else {
            $files->delete();
            return redirect()->route('files.index')->with('success', 'Файл успешно удален');
        }

    }
}
