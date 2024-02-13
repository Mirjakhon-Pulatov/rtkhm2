<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Featured_imagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
    public function destroy(string $id)
    {
        //
    }

     public function getImage($table, $code)
    {
        $getImageId = DB::select("SELECT image_id FROM `featured_images` where dt = '$table' and article = '$code' ");
        if ($getImageId) {
            $getImageId = $getImageId[0]->image_id;
            $getImage = DB::select("Select file from gallerys where id = '$getImageId' ");
            return $getImage[0]->file ?? null;
        } else {
            return '';
        }
    }

}
