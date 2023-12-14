<?php

namespace App\Http\Controllers;

use App\Models\extra_images;
use App\Models\Featured_images;
use App\Models\gallerys;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExtraImagesController extends Controller
{
    public function OpenFolder(Request $request)
    {
        $galleryId = $request->input('gallery_id');

        $photos = gallerys::where('album_id', $galleryId)->orderBy('id', 'desc')->get();

        return view('admin.albums.folder_extra', compact('photos'));
    }


    public function SetImageExtra(Request $request)
    {
        $id = $request->input('id');
        $dt = $request->input('dt');
        $article = $request->input('article');
        $s_num = $request->input('s_num');
//        $result = extra_images::where('code', $article)->orderBy('s_num', 'desc')->first();
//        if ($result){
//            $sNum = $result->s_num;
//            $sNum = $sNum + 1;
//        }else{
//            $sNum = 1;
//        }
        extra_images::create([
            'dt' => $dt,
            'code' => $article,
            'image_id' => $id,
            's_num' => $s_num
        ]);

        return response()->json(['success' => "Добавлено !"]);
    }


    public function DeleteExtraImage(Request $request)
    {
        $dt = $request->input('dt');
        $code = $request->input('code');
        $image_id = $request->input('image_id');
        $s_num = $request->input('s_num');

        extra_images::where('dt', $dt)->where('code', $code)->where('image_id', $image_id)->where('s_num', $s_num)->delete();

        return response()->json(['success' => "Добавлено !"]);
    }

    public function GetDataExtra(Request $request)
    {
        $dt = $request->input('dt');
        $code = $request->input('code');
        $image_id = $request->input('image_id');
        $s_num = $request->input('s_num');

        $data = extra_images::where('dt', $dt)->where('code', $code)->where('image_id', $image_id)->where('s_num', $s_num)->first();

        return response()->json(['data' => $data]);
    }


    function ExtraImagesDataUpdate(Request $request)
    {

        $dt = $request->input('dtValue');
        $code = $request->input('codeValue');
        $image_id = $request->input('imageIdValue');
        $s_num = $request->input('SerialNumber');
        $OldSerialNumber = $request->input('OldSerialNumber');
        $info = $request->input('DescInfo');

        $updatedRows = extra_images::where('dt', $dt)
            ->where('code', $code)
            ->where('image_id', $image_id)
            ->where('s_num', $OldSerialNumber)
            ->update([
                's_num' => $s_num,
                'info' => $info
            ]);

        if ($updatedRows > 0) {
            return response()->json(['success' => "Изменено !", 'OldSerialNumber' => $OldSerialNumber, 'NewSerialNumber' => $s_num]);
        } else {
            return response()->json(['error' => "Ошибка сервера"]);
        }
    }


    function ShowChanges(Request $request)
    {
        $dt = $request->input('dt');
        $code = $request->input('code');
        $ExtraImagesList = extra_images::where('dt', $dt)->where('code', $code)->where('dt', $dt)->orderBy('s_num', 'asc')->get();


        return view('admin.albums.ExtraImagesList', compact('ExtraImagesList'));
    }
}
