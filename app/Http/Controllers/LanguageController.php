<?php

namespace App\Http\Controllers;

use App\Models\Content_types;
use App\Models\fields;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Languages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\LangTags;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\select;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin')
        {
            $langs = Languages::all();
            return view('admin.language.languages', compact('langs'));
        }else
        {
            return redirect()->route('dashboard');
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function CrateLangForContentType(Request $request)
    {

        $ContentType = $request->input('ContentType');
        $ContentTypeID = $request->input('ContentTypeID');
        $Lang_slug = $request->input('Lang_slug');
        $resultinput = $request->input('resultinput');

        $modelName = $ContentType . $Lang_slug;


        if ($resultinput == '1') {
            LangTags::create([
                'type_id' => $ContentTypeID,
                'lang' => $Lang_slug,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            Content_types::create([
                'name' => $modelName,
                'dt' => $modelName,
                'desc' => $modelName,
                'status' => '0',
                'is_menu' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $checkFields = fields::where('dt', $ContentType)->get();
            // Check has TABLE

            if (Schema::hasTable($modelName)) {
                return response()->json(['error' => 'Такая таблица уже существует в базе данных !', 'ContentType' => $ContentType, 'ContentTypeID' => $ContentTypeID, 'Lang_slug' => $Lang_slug, 'resultinput' => $resultinput]);
            } else {


                $sql = "CREATE TABLE $modelName (";
                $sql .= "id INT AUTO_INCREMENT not null PRIMARY KEY, \n";
                $sql .= "code VARCHAR(255), \n";

                foreach ($checkFields as $tag) {

                    if ($tag->type == "DATE" || $tag->type == "DATETIME") {
                        $sql .= "$tag->name $tag->type, \n";
                    } elseif (is_numeric($tag->type)) {
                        $sql .= "$tag->name int, \n";
                    } else {
                        $sql .= "$tag->name $tag->type($tag->max), \n";
                    }

                    if (strpos($tag->type, 'dt_') !== false)
                        $sql .= "$tag->name VARCHAR(500), \n";

                    if ($tag->type == "file" || $tag->type == "image")
                        $sql .= "$tag->name VARCHAR(500), \n";

                }

                $sql .= "slug VARCHAR(1000), \n";
                $sql .= "visited int(50), \n";
                $sql .= "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, \n";
                $sql .= "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ) \n";

                DB::statement($sql);

                $create_index_for_code = "CREATE INDEX index_code ON $modelName(code)";
                DB::statement($create_index_for_code);

                $checkindex = "SHOW INDEX FROM $ContentType";
                $result = DB::select($checkindex);

                foreach ($result as $index) {
                    $col = $index->Column_name;
                    if ($col != "id")
                        DB::statement("CREATE INDEX index_$col ON $modelName($col)");
                }
            }


            foreach ($checkFields as $tag) {
                $newTag = $tag->replicate(); // Копирование текущей строки
                $newTag->dt = $modelName; // Замена значения в столбце dt
                $newTag->save(); // Сохранение новой строки
            }


            //  CREATE MODEL
            $modelPath = app_path('Models');
            $className = $modelName;
            $filePath = $modelPath . DIRECTORY_SEPARATOR . $className . '.php';

            if (!File::exists($filePath)) {
                // Создаем файл модели
                File::put($filePath, '<?php

                namespace App\Models;

                use Illuminate\Database\Eloquent\Model;

                class ' . $className . ' extends Model
                {
                    protected $table = \'' . $modelName . '\';

                    protected $guarded = [];
                }');

            } else {
                return response()->json(['error' => 'Такая модель уже есть !', 'ContentType' => $ContentType, 'ContentTypeID' => $ContentTypeID, 'Lang_slug' => $Lang_slug, 'resultinput' => $resultinput]);
            }
            return response()->json(['success' => 'Добавлено', 'ContentType' => $ContentType, 'ContentTypeID' => $ContentTypeID, 'Lang_slug' => $Lang_slug, 'resultinput' => $resultinput]);
        } else {

            $modelPath = app_path('Models');
            $className = $modelName;
            $filePath = $modelPath . DIRECTORY_SEPARATOR . $className . '.php';

            DB::statement("DROP TABLE `$modelName`");

            fields::where('dt', $modelName)->delete();

            Content_types::where('dt', $modelName)->delete();

            DB::table('lang_tags')->where('type_id', $ContentTypeID)->delete();

            if (File::exists($filePath)) {
                File::delete($filePath);
                return response()->json(['success' => 'Удалено']);
            } else {
                return response()->json(['error' => 'Модель не  найдена']);
            }


            return response()->json(['success' => 'Удалено']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $code = $request->input('code_lang');

        $table_menu = "menus" . $code;

        if (Languages::where('lang', $request->input('lang'))->exists()) {
            // A record with the same 'lang' value already exists
            // You may want to handle this case, e.g., return an error response or take appropriate action
            return redirect()->back()->with('error', 'Такой язык уже есть !');
        }

        Languages::create([
            'lang' => $request->input('lang'),
            'slug' => $code,
        ]);

        if (Schema::hasTable($table_menu)) {
            return redirect()->back()->with('error', 'Такая таблица уже есть !');
        } else {
            DB::statement("
                CREATE TABLE `$table_menu` (
                  `id` int AUTO_INCREMENT not null PRIMARY KEY,
                  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `parent_id` bigint UNSIGNED DEFAULT NULL,
                  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `index` int NOT NULL,
                  `level` int NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL
            )
            ");

            DB::statement("INSERT INTO `$table_menu` SELECT * FROM menus");


        }


        Content_types::create([
            'name' => $table_menu,
            'dt' => $table_menu,
            'desc' => $table_menu,
            'status' => '0',
            'is_menu' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        $modelName = $table_menu;
        $modelPath = app_path('Models');
        $className = $modelName;
        $filePath = $modelPath . DIRECTORY_SEPARATOR . $className . '.php';


        if (!File::exists($filePath)) {
            // Создаем файл модели
            File::put($filePath, '<?php

                namespace App\Models;

                use Illuminate\Database\Eloquent\Model;

                class ' . $className . ' extends Model
                {
                    protected $table = \'' . $table_menu . '\';

                    protected $guarded = [];
                }');

        } else {
            return redirect()->back()->with('Error', 'Что то  пошло не так такая  Модель уже есть !');
        }


        return redirect()->back()->with('success', 'Добавлено');
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
    public function update(Request $request)
    {
        $code = $request->input('code-lang');
        $lang = $request->input('lang');
        $id = $request->input('id');

        DB::statement("UPDATE `langs` SET `lang` = '$lang' WHERE `langs`.`id` = $id");

        return redirect()->back()->with('success', 'Изменено !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $code = $request->input('code-lang');
        $lang = $request->input('lang');
        $id = $request->input('deleteid');

        DB::table('langs')->where('id', $id)->delete();


        return redirect()->back()->with('success', 'Язык удалён !');
    }
}
