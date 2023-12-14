<?php

namespace App\Http\Controllers;

use App\Models\Content_types;
use App\Models\Languages;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use App\Models\fields;
use function Laravel\Prompts\select;

class Content_typesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin')
        {
            $Content_types = Content_types::where('status', '1')->get();
            return view('admin.content_types.content_types', compact('Content_types'));
        }else{
            return redirect()->route('dashboard');
        }

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


        $tableName = $request->input('table_name');


        if (Schema::hasTable($tableName)) {
            // Таблица существует
            return redirect()->back()->with('error', 'Такая таблица уже существует в базе данных !');

        } else {
            // Таблица не существует
            DB::statement("
                CREATE TABLE $tableName (
                    id INT AUTO_INCREMENT not null PRIMARY KEY,
                    code VARCHAR(255),
                    slug VARCHAR(1000),
                    visited int(50),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
            ");

            Content_types::create([
                'name' => $request->input('type_name'),
                'dt' => $request->input('table_name'),
                'desc' => $request->input('type_desc'),
                'status' => '1',
                'is_menu' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $modelName = $tableName;
            $modelPath = app_path('Models');
            $className = $modelName;
            $filePath = $modelPath . DIRECTORY_SEPARATOR . $className . '.php';

            // Проверяем, существует ли уже модель
            if (!File::exists($filePath)) {
                // Создаем файл модели
                File::put($filePath, '<?php

                namespace App\Models;

                use Illuminate\Database\Eloquent\Model;

                class ' . $className . ' extends Model
                {
                    protected $table = \'' . $tableName . '\';

                    protected $guarded = [];
                }');

            } else {
                // Если модель уже существует, вы можете выполнить необходимые действия
                return redirect()->back()->with('error', 'Такая таблица уже существует в базе данных !');
            }


            return redirect()->back()->with('success', 'Конент тип  добавлен !');
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
     * @param Request $request
     * @param Content_types $content_types
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, Content_types $content_types)
    {
        $fields_list = fields::where('dt',)->get();
        $content_types = Content_types::find($request->id);

        if (!$content_types || is_numeric($content_types)) {
            return redirect()->route('content_types');
        }

        $AllContent_types = Content_types::where('id', '!=', $request->id)->get();
        $fields_list = fields::where('dt', $content_types->dt)->get();
        $langs = Languages::all();

        return view('admin.content_types.edit_content_types', compact(['content_types', 'fields_list', 'AllContent_types', 'langs']));

    }

    /**
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
//        dd($request->all());
        $content_types = Content_types::find($id);
        $name = $request->input('name');
        $desc = $request->input('desc');

        $content_types->name = $name;
        $content_types->desc = $desc;
        $content_types->update();

        return redirect()->back()->with('success', 'Успешно изменено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $name = DB::table('content_types')->where('id', $request->input('delete_id'))->value('dt');
        DB::table('fields')->where('dt', '=', $name)->delete();
        DB::table('content_types')->where('id', '=', $request->input('delete_id'))->delete();
        DB::statement("DROP TABLE `$name`");

        // check languages




        $modelName = $name;
        $modelPath = app_path('Models');
        $className = $modelName;
        $filePath = $modelPath . DIRECTORY_SEPARATOR . $className . '.php';

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('content_types')->with('success', 'Конент тип удалён');
        } else {
            return redirect()->route('content_types')->with('error', 'Модель не найдена');
        }


    }
}
