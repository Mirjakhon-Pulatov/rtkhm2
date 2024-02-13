<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Content_typesController;
use App\Http\Controllers\FieldsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CrudContentTypesController;
use App\Http\Controllers\ExtraImagesController;
use App\Models\Visitor;
use App\Http\Middleware\LogVisitorMiddleware;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Pages;
use App\Http\Controllers\BlogsController;
use Spatie\Sitemap\SitemapGenerator;

Route::get('/', function (){
    return view('admin.mainpage');
});


Route::middleware('LogVisitorMiddleware')->group(function () {

//    Sitni silkalari

});


Route::get('/admin/login', function () {
    return view('admin.login');
})->name('login');
Route::post('/login/ajax', [AuthController::class, 'ajaxLogin'])->name('login.ajax');


// admin panel start
Route::prefix('admin')->middleware('auth')->group(function () {


    Route::get('/profile', [AuthController::class, 'profile'])->name('profile.index');
    Route::put('/profile/{id}', [AuthController::class, 'profile_update'])->name('profile.update');

    Route::get('/clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');


        SitemapGenerator::create('https://kmt.uz')->writeToFile(base_path('sitemap.xml'));

        return redirect()->back()->with('success', 'Кэш Очищен');
    })->name('cache-clear');


    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::delete('/logs', [AuthController::class, 'delete_logs'])->name('delete_logs');
    Route::delete('/visitors', [AuthController::class, 'delete_visitors'])->name('delete_visitors');
    Route::get('/', function () {

        return view('admin.dashboard');
    });


    Route::fallback(function () {
        return view('admin.error.404');
    });


    Route::resource('/files', FilesController::class);
    Route::delete('/file/', [FilesController::class, 'destroy'])->name('file.delete');

    //    for backups start
    Route::get('/backup', [BackupController::class, 'backups'])->name('backups');
    Route::get('/export_database', [BackupController::class, 'export_database'])->name('export_database');
    Route::get('/download_backup/{name}', [BackupController::class, 'download_database'])->name('download_database');
    Route::delete('/delete_backup', [BackupController::class, 'delete_backups'])->name('delete_backups');
    //    for backups end


    // settings startn
    Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings');
    Route::post('/setting_create', [\App\Http\Controllers\SettingController::class, 'store'])->name('setting.create');
    Route::put('/setting_update', [\App\Http\Controllers\SettingController::class, 'update'])->name('setting.update');
    Route::delete('/setting_delete', [\App\Http\Controllers\SettingController::class, 'destroy'])->name('setting.destroy');
    Route::post('/changeIsMenu', [\App\Http\Controllers\UserController::class, 'ChangeisMenu'])->name('changeIsMenu');
    // settings end

    Route::get('/add-menu', [MenuController::class, 'store'])->name('add-menu');
    Route::post('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/delete-menu', [MenuController::class, 'Delete'])->name('menu.delete');
    Route::get('/menu/{id}/{lang?}', [MenuController::class, 'PageUpdate'])->name('pageUpdate');
    Route::post('/menu/update/{id}/{lang?}', [MenuController::class, 'update'])->name('menu.update');
    Route::post('/menu/{id}', [MenuController::class, 'Delete']);

    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::post('/add_user', [\App\Http\Controllers\UserController::class, 'add_user'])->name('user_add');
    Route::delete('/delete_user', [\App\Http\Controllers\UserController::class, 'delete_user'])->name('delete_user');

    Route::get('/albums', [AlbumController::class, 'index'])->name('albums');
    Route::post('/albums', [AlbumController::class, 'store'])->name('storealbum');
    Route::get('/album/{id}', [AlbumController::class, 'ShowAlbum'])->name('showalbum');
    Route::post('/add-photo', [AlbumController::class, 'addPhoto'])->name('addPhoto');
    Route::put('/update_album/{id}', [AlbumController::class, 'update'])->name('update_album');
    Route::delete('/delete_album/', [AlbumController::class, 'destroy'])->name('delete_album');
    Route::get('/openfolder', [AlbumController::class, 'OpenFolder'])->name('OpenFolder');
    Route::post('/setImage', [AlbumController::class, 'setImage'])->name('SetImage');
    Route::post('/DeleteImageContent', [AlbumController::class, 'DeleteImageContent'])->name('DeleteImageContent');

    Route::get('/openfolderExtra', [ExtraImagesController::class, 'OpenFolder'])->name('openfolderExtra');
    Route::post('/SetImageExtra', [ExtraImagesController::class, 'SetImageExtra'])->name('SetImageExtra');
    Route::post('/DeleteImageExtra', [ExtraImagesController::class, 'DeleteExtraImage'])->name('DeleteImageExtra');
    Route::post('/GetDataExtra', [ExtraImagesController::class, 'GetDataExtra'])->name('GetDataExtra');
    Route::post('/ExtraImagesDataUpdate', [ExtraImagesController::class, 'ExtraImagesDataUpdate'])->name('ExtraImagesDataUpdate');
    Route::get('/ShowChangesExtraImagesList', [ExtraImagesController::class, 'ShowChanges'])->name('ShowChangesExtraImagesList');

    Route::post('/delete-photo', [AlbumController::class, 'deletePhoto'])->name('delete-photo');

    Route::get('/content_types', [Content_typesController::class, 'index'])->name('content_types');
    Route::post('/content_types_add', [Content_typesController::class, 'store'])->name('content_types_add');
    Route::get('/content_types/edit/{id}', [Content_typesController::class, 'edit'])->name('content_types_edit');
    Route::put('/update/{id}', [Content_typesController::class, 'update'])->name('content_types_update');
    Route::delete('/content_types_delete', [Content_typesController::class, 'destroy'])->name('content_types_delete');

    Route::post('deletefield', [FieldsController::class, 'destroy'])->name('destroyfields');

    Route::post('/add-fields', [FieldsController::class, 'store'])->name('add-fields');

    Route::post('/is_head', [FieldsController::class, 'IS_head'])->name('IS_head');
    Route::post('/is_index', [FieldsController::class, 'IS_index'])->name('is_index');
    Route::post('/is_slug', [FieldsController::class, 'IS_slug'])->name('is_slug');
    Route::post('/CrateLangForContentType', [LanguageController::class, 'CrateLangForContentType'])->name('CrateLangForContentType');

    Route::get('/languages', [LanguageController::class, 'index'])->name('languages');
    Route::post('/store-lang', [LanguageController::class, 'store'])->name('store-lang');
    Route::post('/update-lang', [LanguageController::class, 'update'])->name('update-lang');
    Route::post('/delete-lang', [LanguageController::class, 'destroy'])->name('delete-lang');


    Route::get('/content/{dt}/{fastlink?}', [CrudContentTypesController::class, 'index'])->name('contentTypePage');
    Route::get('/content-add/{dt}/', [CrudContentTypesController::class, 'create'])->name('contentTypePageAdd');
    Route::post('/content/delete', [CrudContentTypesController::class, 'destroy'])->name('contentTypeDelete');

    Route::post('/content-add/{dt}', [CrudContentTypesController::class, 'store'])->name('content-add');

    Route::get('/content-edit/{dt?}/{id?}/{lang?}', [CrudContentTypesController::class, 'edit'])->name('contentTypeEdit');
    Route::post('/content/{dt}/create', [CrudContentTypesController::class, 'update'])->name('contentUpdate');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// admin panel end
