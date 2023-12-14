<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\fields;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;


class FieldsController extends Controller
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

        $field_name = $request->input('field_name');
        $dt = $request->input('dt');
        $exists = fields::where('name', $field_name)->where('dt', $dt)->exists();

        if ($field_name == "code" || $field_name == "visited" || $field_name == "created_at" || $field_name == "updated_at") {
            return response()->json(['error' => "Такое поле уже существует !"]);
        } elseif ($exists) {
            return response()->json(['error' => "Такое поле уже существует !"]);
        } else {


            $dt = $request->input('dt');
            $type = $request->input('field_type');
            $max = $request->input('max');
            $after = $request->input('after');

            $c_id = $request->input('c_id');


            $serachlang = DB::select("SELECT * FROM `lang_tags` where type_id = '$c_id' ");


            if ($serachlang > 0) {
                foreach ($serachlang as $lang) {

                    $dt_lang = $dt . $lang->lang;


                    if ($type == "DATE" || $type == "DATETIME") {
                        $sql = "ALTER TABLE `$dt_lang` ADD `$field_name` $type AFTER `$after`;";
                    } elseif (is_numeric($type)) {
                        $sql = "ALTER TABLE `$dt_lang` ADD `$field_name` int AFTER `$after`;";
                    } else {
                        $sql = "ALTER TABLE `$dt_lang` ADD `$field_name` $type($max) AFTER `$after`;";
                    }

                    if (strpos($type, 'dt_') !== false)
                        $sql = "ALTER TABLE `$dt_lang` ADD `$field_name` VARCHAR(500) AFTER `$after`;";

                    if ($type == "file" || $type == "image")
                        $sql = "ALTER TABLE `$dt_lang` ADD `$field_name` VARCHAR(500) AFTER `$after`;";

                    DB::statement($sql);

                    fields::create([
                        'dt' => $dt_lang,
                        'name' => $request->input('field_name'),
                        'type' => $request->input('field_type'),
                        'max' => $request->input('max'),
                        'min' => $request->input('min'),
                        'label' => $request->input('desc'),
                        'is_head' => 0,
                        'is_index' => 0,
                        'is_slug' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()

                    ]);

                }
            }


            if ($type == "DATE" || $type == "DATETIME") {
                $sql = "ALTER TABLE `$dt` ADD `$field_name` $type AFTER `$after`;";
            } elseif (is_numeric($type)) {
                $sql = "ALTER TABLE `$dt` ADD `$field_name` int AFTER `$after`;";
            } else {
                $sql = "ALTER TABLE `$dt` ADD `$field_name` $type($max) AFTER `$after`;";
            }

            if (strpos($type, 'dt_') !== false)
                $sql = "ALTER TABLE `$dt` ADD `$field_name` VARCHAR(500) AFTER `$after`;";

            if ($type == "file" || $type == "image")
                $sql = "ALTER TABLE `$dt` ADD `$field_name` VARCHAR(500) AFTER `$after`;";

            DB::statement($sql);

            fields::create([
                'dt' => $request->input('dt'),
                'name' => $request->input('field_name'),
                'type' => $request->input('field_type'),
                'max' => $request->input('max'),
                'min' => $request->input('min'),
                'label' => $request->input('desc'),
                'is_head' => 0,
                'is_index' => 0,
                'is_slug' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ]);

            $modelPath = app_path('Models');
            $filePath = $modelPath . DIRECTORY_SEPARATOR . $dt . '.php';
            // Чтение содержимого файла
            $fileContent = file_get_contents($filePath);


            return response()->json(['success' => "Поле Добавлено !", 'input' => '']);
        }


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
        $dbname = $request->input('dbname');
        $fieldtitle = $request->input('fieldtitle');
        $c_id = $request->input('c_id');

        $serachlang = DB::select("SELECT * FROM `lang_tags` where type_id = '$c_id' ");


        if ($serachlang > 0) {
            foreach ($serachlang as $lang) {

                $db_lang = $dbname . $lang->lang;

                DB::statement("
               ALTER TABLE `$db_lang`
                    DROP `$fieldtitle`;
            ");

                DB::table('fields')->where('name', '=', $fieldtitle)->where('dt', '=', $db_lang)->delete();


            }
        }

        DB::statement("
               ALTER TABLE `$dbname`
                    DROP `$fieldtitle`;
            ");

        DB::table('fields')->where('name', '=', $fieldtitle)->where('dt', '=', $dbname)->delete();

        return redirect()->back()->with('success', 'Успешно удалено');
    }

    public function IS_head(Request $request)
    {
        $nameFeild = $request->input('NaneHead');
        $isChecked = $request->input('isChecked');
        $dt = $request->input('dt');
        $c_id = $request->input('c_id');

        $serachlang = DB::select("SELECT * FROM `lang_tags` where type_id = '$c_id' ");

        if ($serachlang > 0) {
            foreach ($serachlang as $lang) {
                fields::where('name', $nameFeild)->where('dt', $dt . $lang->lang)->update(['is_head' => $isChecked]);
            }
        }


        fields::where('name', $nameFeild)->where('dt', $dt)->update(['is_head' => $isChecked]);


        return response()->json(['success' => 'Изменно']);
    }

    public function IS_index(Request $request)
    {
        $FeildName = $request->input('FeildName');
        $InputValue = $request->input('InputValue');
        $dt = $request->input('dt');
        $c_id = $request->input('c_id');

        $serachlang = DB::select("SELECT * FROM `lang_tags` where type_id = '$c_id' ");

        if ($serachlang > 0) {
            foreach ($serachlang as $lang) {

                $dtlang = $dt . $lang->lang;

                if ($InputValue == "0") {
                    $isIndex = "0";
                    DB::statement("ALTER TABLE `$dtlang` DROP INDEX `index_$FeildName`; ");

                } elseif ($InputValue == "1") {
                    $isIndex = "1";
                    DB::statement(" CREATE INDEX index_$FeildName ON $dtlang($FeildName) ");
                }

                fields::where('name', $FeildName)->where('dt', $dtlang)->update(['is_index' => $isIndex]);


            }
        }

        if ($InputValue == "0") {
            $isIndex = "0";
            DB::statement("ALTER TABLE `$dt` DROP INDEX `index_$FeildName`; ");

        } elseif ($InputValue == "1") {
            $isIndex = "1";
            DB::statement(" CREATE INDEX index_$FeildName ON $dt($FeildName) ");
        }

        fields::where('name', $FeildName)->where('dt', $dt)->update(['is_index' => $isIndex]);

        return response()->json(['success' => 'Изменно', 'input' => $isIndex]);
    }

    public function IS_slug(Request $request)
    {

        $FeildName = $request->input('FeildName');
        $InputValue = $request->input('InputValue');
        $dt = $request->input('dt');
        $c_id = $request->input('c_id');

        $serachlang = DB::select("SELECT * FROM `lang_tags` where type_id = '$c_id' ");

        if ($serachlang > 0) {
            foreach ($serachlang as $lang) {

                fields::where('name', $FeildName)->where('dt', $dt . $lang->lang)->update(['is_slug' => $InputValue]);

            }
        }


        fields::where('name', $FeildName)->where('dt', $dt)->update(['is_slug' => $InputValue]);

        return response()->json(['success' => 'Изменно', 'input' => $InputValue]);

    }

}
