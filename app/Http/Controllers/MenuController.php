<?php

namespace App\Http\Controllers;

use App\Models\Languages;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function create(Request $request)
    {

        $current_id = $request->input('parent_id');

        $findParrentLavel = DB::table('menus')
            ->where('id', $current_id)->value('level');

        if ($findParrentLavel === null) {
            $level = 0;
        } else if ($findParrentLavel == 0) {
            $level = 1;
        } else {
            if ($findParrentLavel == 0) {
                $level = 1;
            } else {
                $level = $findParrentLavel + 1;
            }
        }

        $title = $request->input('title');
        $parent_id = $request->input('parent_id');
        $link = $request->input('link');
        $index = $request->input('index');
        $created_at = Carbon::now();
        $updated_at = Carbon::now();

        $findLanguageTable = DB::select("SELECT * FROM `langs` ");

        foreach ($findLanguageTable as $language) {

            $langmenu = "menus" . $language->slug;
            DB::statement("  INSERT INTO `$langmenu` (`title`, `parent_id`, `link`, `index`, `level`, `created_at`, `updated_at`) VALUES ( '$title', '$parent_id', '$link', '$index', '$level', '$created_at', '$updated_at') ");
        }


//            $langmenu = "menu" . $lang->slug;
//            $langsContentypes = DB::select("SELECT dt FROM `content_types` where dt = '$langmenu' ");


//
//
        Menu::create([
            'title' => $request->input('title'),
            'parent_id' => $request->input('parent_id'),
            'link' => $request->input('link'),
            'index' => $request->input('index'),
            'level' => $level,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);

        return redirect()->route('add-menu');


    }

    public function PageUpdate($id, $lang = null)
    {
        if (isset($lang)) {
            $MENULANG = "menus" . $lang;
            $menus_currnet = DB::select("SELECT * FROM `$MENULANG` WHERE id = '$id' ");
            $Languages = Languages::all();
            $menus = DB::select("SELECT * FROM `$MENULANG`");
            $CurrentLang = $lang;
            return view('admin.menu.edit-menu', compact('menus_currnet', 'menus', 'Languages', 'CurrentLang'));
        } else {

            $ms = Menu::where('id', $id)->first();
            $Languages = Languages::all();
            $menus = Menu::all();

            if ($ms) {
                return view('admin.menu.edit-menu', compact('ms', 'menus', 'Languages'));
            } else {
                return redirect()->route('add-menu');
            }
        }
    }

    public function update(Request $request, $dt, $id, $lang = null)
    {

        $current_id = $request->input('id');

        $lang = $request->input('lang');

        if (isset($lang)) {


            $menu_table = "menus" . $lang;
            $menuItem = DB::select("SELECT id FROM `$menu_table` WHERE id  = '$current_id' ");

            if ($menuItem) {

                $findParrentLavel = DB::table("$menu_table")
                    ->where('id', $current_id)->value('level');

                if ($findParrentLavel === null) {
                    $level = 0;
                } else if ($findParrentLavel == 0) {
                    $level = 1;
                } else {
                    if ($findParrentLavel == 0) {
                        $level = 1;
                    } else {
                        $level = $findParrentLavel + 1;
                    }
                }
                $input_title = $request->input('title');
                $input_title = addslashes($input_title);
                $title = $input_title;
                $parent_id = $request->input('parent_id');
                $link = $request->input('link');
                $index = $request->input('index');
                $level = $level;
                $updated_at = Carbon::now();

                $update_query = DB::update("UPDATE `$menu_table` SET `title` = '$title', `parent_id` = '$parent_id', `link` = '$link', `index` = '$index', `level` = '$level', `updated_at` = '$updated_at' WHERE `$menu_table`.`id` = $current_id");


                return redirect()->back()->with('success', 'Меню успешно изменен');

            } else {
                return redirect()->route('add-menu');
            }


        } else {
            $current_id = $request->input('id');

            $findParrentLavel = DB::table('menus')
                ->where('id', $current_id)->value('level');


            if ($findParrentLavel === null) {
                $level = 0;
            } else if ($findParrentLavel == 0) {
                $level = 1;
            } else {
                if ($findParrentLavel == 0) {
                    $level = 1;
                } else {
                    $level = $findParrentLavel + 1;
                }
            }
            $update_query = DB::table('menus')
                ->where('id', $current_id)
                ->update([
                    'title' => $request->input('title'),
                    'parent_id' => $request->input('parent_id'),
                    'link' => $request->input('link'),
                    'index' => $request->input('index'),
                    'level' => $level,
                    'updated_at' => Carbon::now()
                ]);

            return redirect()->route('add-menu')->with('success', 'Меню успешно изменен');
        }


    }

    public function store()
    {

        // $menus = Menu::all();

        $menus = Menu::with('parent')->get();
        return view('admin.menu.add-menu', ['menus' => $menus]);
    }

    public function Delete(Request $request)
    {

        $menuId = $request->input('delete_id');
        DB::table('menus')->where('id', $menuId)->delete();

        // return dd($menuId);

        return redirect()->route('add-menu')->with('success', 'Меню успеншно удален');
    }
}
