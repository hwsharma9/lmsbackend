<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\manage\CaptchaController;
use App\Http\Controllers\manage\HomeController;
use App\Http\Controllers\manage\LocalizationController;
use App\Http\Controllers\manage\ProfileController;
use App\Http\Middleware\Localization;
use App\Http\Middleware\RoutePermission;
use App\Models\DatabaseRoute;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('localization/{locale}', LocalizationController::class)->name('localization');
Route::get('change-role/{role}', function (Role $role) {
    session(['role_name' => $role->name]);
    return redirect()->back();
})->name('change-role');
Route::get('tree', [ExportController::class, 'tree']);
Route::get('export/{table}', [ExportController::class, 'exportTable']);

Route::get('get-session', function () {
    $session = session()->all();
    dd($session);
});

Route::get('set-session', function (Request $request) {
    $request->session()->put('name', "Harshwardhan");
    return redirect('get-session');
});

Route::prefix('manage/')->name('manage.')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');

        Route::get('load-captcha', CaptchaController::class)->name('load-captcha');

        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        Route::patch('profile/{admin}/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::post('profile/{admin}/image-upload', [ProfileController::class, 'uploadProfileImage'])->name('profile.image-upload');
        Route::get('profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
        Route::patch('profile/{admin}/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

        Route::group(['middleware' => [Localization::class, RoutePermission::class]], function () {
            if (Schema::hasTable('database_routes')) {
                $database_routes = DB::table('database_routes')->get();
                if ($database_routes) {
                    foreach ($database_routes as $database_route) {
                        $controller = trim("App\\Http\\Controllers\\" . (!is_null($database_route->resides_at) ? $database_route->resides_at . "\\" : '') . $database_route->controller_name);
                        if (file_exists(base_path($controller . ".php"))) {
                            $controller_path = new $controller();
                            Route::{$database_route->method}($database_route->route, [get_class($controller_path), $database_route->function_name])->name($database_route->named_route)->withTrashed();
                        }
                    }
                }
            }
        });
    });
});
