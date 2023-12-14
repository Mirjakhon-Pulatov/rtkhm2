<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('visible', 1)->get();
        return view('admin.settings', compact('settings'));
    }

    public function store(Request $request, Setting $setting)
    {
        $setting = new Setting();
        $setting->display_name = $request->input('name');
        $setting->key = $request->input('key');
        $setting->type = $request->input('type');
        $setting->value = $request->input('value');
        $setting->visible = 1;
        $setting->save();

        return redirect()->back();
    }

    public function update(Request $request, Setting $setting)
    {
//        dd($request->all());
        $setting = Setting::find($request->input('setting_id'));

        $value = $request->input('value');

        $setting->value = $value;
        $setting->update();

        return redirect()->back()->with('success', 'Изменено');

    }

    public function destroy(Request $request, Setting $setting)
    {
//        dd($request->all());
        $setting = Setting::where('id', "=", $request->input('setting_id'));
        $setting->delete();

        return redirect()->back();
    }
}
