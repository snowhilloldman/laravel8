<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\UserController;

// use Encore\Admin\Admin;

Admin::routes();

Route::group([
  'prefix' => config('admin.route.prefix'),
  'namespace' => config('admin.route.namespace'),
  'middleware' => config('admin.route.middleware'),
  'as' => config('admin.route.prefix') . '.',
], function (Router $router) {
  $router->get('/', 'HomeController@index')->name('home');
  $router->resource('user', UserController::class);
  $router->resource('category', CategoryController::class);
  $router->resource('post', PostController::class);
  $router->resource('news', NewsController::class);
  $router->resource('org', OrgController::class);
  $router->resource('ugc', UgcController::class);

  Route::get('r/student', function () {
    return redirect(config('app.url') . '/student');
  });
  // Route::get('r/filemanager2', function () {
  //   return redirect(config('app.url') . '/laravel-filemanager/demo');
  // });
  // $router->post('ckeditor/upload', 'CkeditorController@upload');
  $router->post('uploads', 'CkeditorController@upload');

});

// Route::group([
//   'namespace' => 'App\Admin\API',
//   'prefix' => 'admin/api',
//   'middleware' => ['admin'],
//   'as' => 'admin.api.'
// ], function (Router $router) {
//   // 其他路由定义...
//   $router->get('city', function () {
//     exit('asdf');
//     // $provinceId = $request->get('q');
//     // return DB::select->where('parent_id', $provinceId)->get(['id', DB::raw('name as text')]);
//     return [1 => 'beijing', 2 => 'shanghai'];
//     exit;
//   });
// });