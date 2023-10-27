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

Route::prefix('manage/')->name('manage.')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {

        Route::group(['middleware' => [Localization::class]], function () {
            if (Schema::hasTable('database_routes')) {
                $database_routes = DB::table('database_routes')->where('resides_at', 'user')->get();
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
