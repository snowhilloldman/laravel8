<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\UserController;


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
  Route::get('r/filemanager', function () {
    return redirect(config('app.url') . '/laravel-filemanager/demo');
  });
  // $router->post('ckeditor/upload', 'CkeditorController@upload');
  $router->post('uploads', 'CkeditorController@upload');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});