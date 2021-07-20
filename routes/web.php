<?php

use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/test', function () {
//   \Spatie\Permission\Models\Permission::create([
//      'name' => 'manage categories'
//   ]);
    $user = auth()->user();
//    $user->givePermissionTo(\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN);
    $user->assignRole(\RolePermissions\Models\Role::ROLE_TEACHER);
    return $user->permissions;
});


require __DIR__ . '/auth.php';
