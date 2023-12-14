<?php

namespace App\Http\Controllers;

use App\Models\extra_images;
use App\Models\Featured_images;
use App\Models\gallerys;
use App\Models\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrudContentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($dt)
    {

        if (Schema::hasTable($dt)) {
            $findtable = DB::select("SELECT * FROM `$dt`");
            $findContentTYpe = DB::select("SELECT * FROM `content_types` WHERE dt = '$dt' ");
            $findFeilds = DB::select("SELECT * FROM `fields`  WHERE dt = '$dt' AND  is_head = '1' ");
            return view('admin.content.index', compact('findtable', 'findContentTYpe', 'findFeilds'));
        } else {
            return view('admin.error.404');
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($dt)
    {
        if (Schema::hasTable($dt)) {
            $findtable = DB::select("SELECT * FROM `$dt`");
            $findContentTYpe = DB::select("SELECT * FROM `content_types` WHERE dt = '$dt' ");
            $findFeilds = DB::select("SELECT * FROM `fields`  WHERE dt = '$dt' ");
            return view('admin.content.add', compact('findtable', 'findContentTYpe', 'findFeilds'));
        } else {
            return view('admin.error.404');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $dt)
    {
        $table = $dt;
        $data = $request->all();
        unset($data['_token']);
        $mysqlFormat = Carbon::now()->format('Y-m-d H:i:s');
        $data['created_at'] = $mysqlFormat;
        $data['updated_at'] = $mysqlFormat;
        DB::table($table)->insert($data);
        return redirect()->route('contentTypePage', $table);

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
    public function edit(Request $request, $dt, $id, $lang = null)
    {

        if (isset($lang)) {

            if (!DB::table('lang_tags')->where('lang', $lang)->exists()) {
                return view('admin.error.404');
            }
        }

        if (Schema::hasTable($dt) && DB::table($dt)->where('id', $id)->exists()) {


            $Languages = Languages::all();
            if (isset($lang)) {

                $langDt = $dt . $lang;

                $code = DB::select(" select code from `$dt` where id =  $id");
                $code = $code[0]->code;

                $data = DB::select(" select * from `$langDt` where code = '$code' ");


                if (!$data) {
                    $data = DB::select(" select * from `$dt` where id = '$id' ");
                } else {
                    $dataid = $data[0]->id;
                }

                $findContentTYpe = DB::select(" select * from `content_types` where dt =  '$langDt' ");
                $contentID = $findContentTYpe[0]->id;
                $findFeilds = DB::select(" select * from `fields` where dt =  '$langDt' ");

                $featuredImage = Featured_images::where('article', $code)->first();

                if (isset($dataid)) {
                    $ExtraImages = extra_images::where('code', $dataid)->where('dt', $langDt)->orderBy('s_num', 'asc')->get();
                } else {
                    $ExtraImages = [];
                }


                if ($featuredImage) {
                    $imageId = $featuredImage->image_id;
                    $FuturedImage = gallerys::where('id', $imageId)->first();
                    if ($FuturedImage) {
                        $FuturedImage = $FuturedImage->file;
                    } else {
                        $FuturedImage = "";
                    }


                } else {
                    $FuturedImage = "";
                }

                $CurrentLang = $lang;
                return view('admin.content.edit', compact('data', 'code', 'FuturedImage', 'findContentTYpe', 'findFeilds', 'ExtraImages', 'CurrentLang', 'Languages'));
            } else {


                $data = DB::select(" select * from `$dt` where id = '$id' ");

                $code = DB::select(" select code from `$dt` where id =  $id");
                $code = $code[0]->code;
                $findContentTYpe = DB::select(" select * from `content_types` where dt =  '$dt' ");
                $contentID = $findContentTYpe[0]->id;
                $findFeilds = DB::select(" select * from `fields` where dt =  '$dt' ");


                $featuredImage = Featured_images::where('article', $code)->first();

                $ExtraImages = extra_images::where('code', $id)->where('dt', $dt)->orderBy('s_num', 'asc')->get();

                if ($featuredImage) {
                    $imageId = $featuredImage->image_id;
                    $FuturedImage = gallerys::where('id', $imageId)->first();
                    if ($FuturedImage) {
                        $FuturedImage = $FuturedImage->file;
                    } else {
                        $FuturedImage = "";
                    }


                } else {
                    $FuturedImage = "";
                }


                return view('admin.content.edit', compact('data', 'code', 'FuturedImage', 'findContentTYpe', 'findFeilds', 'ExtraImages', 'Languages'));
            }


        } else {
            return view('admin.error.404');
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $dt)
    {
        $table = $dt;
        $data = $request->all();
        unset($data['_token']);

        $position = strpos($table, "__");

        if ($position !== false) {


            $has = DB::table($table)->where('code', $request->input('code'))->count();

            if ($has > 0) {
                $data['updated_at'] = date("Y-m-d H:i:s");

                DB::table($table)->where('code', $request->input('code'))->update($data);
            } else {

                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");

                DB::table($table)->insert($data);
            }


            $table = substr($table, 0, $position);
            return redirect()->back()->with('success', "Обновлено !");

        } else {
            // Если "__" не найдено, оставляем весь текст без изменений
            $table = $table;
//
//            dd($data);

            DB::table($table)->where('code', $request->input('code'))->update($data);
            return redirect()->back()->with('success', "Обновлено !");
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $delete_table = $request->input('delete_table');
        $delete_id = $request->input('delete_id');
        $content_id = $request->input('content_id');

        // GET CODE FOR THIS CONTENT
        $CODE_QUERY = DB::select("SELECT code FROM `$delete_table`");
        $CODE_QUERY = $CODE_QUERY[0]->code;

        // CHECK HAS OTHER LANGS

        $checklang = DB::select("SELECT type_id, lang FROM `lang_tags` where type_id = '$content_id' ");

        if (count($checklang) > 0) {
            foreach ($checklang as $lang){
                // delete from Lang table
                $lang_table = $delete_table .$lang->lang;
                DB::statement("DELETE FROM `$lang_table` WHERE `$lang_table`.`code` =  '$CODE_QUERY' ");
            }
        }


        // delete images and futured  images keyin yozaman

        DB::statement("DELETE FROM `$delete_table` WHERE `$delete_table`.`id` =  '$delete_id' ");
        return redirect()->back()->with('success', 'Удалено !');
    }
}
