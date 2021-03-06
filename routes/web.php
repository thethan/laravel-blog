<?php

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

Route::get('/', function () {
    $posts = App\Post::where('status', 'PUBLISHED')->take(5)->orderBy('created_at')->get();
    // Get the difference
    // $toTake = 5 - $posts->count();
    // $nonFeaturedPosts = TCG\Voyager\Models\Post::where('status','PUBLISHED')->take($toTake)->orderBy('created_at')->get();

    return view('home', ['posts' => $posts]);
});
Route::group(['prefix' => 'admin'], function () {
    // Have to override for Posts for tags


    /*
    |--------------------------------------------------------------------------
    | Voyager Routes
    |--------------------------------------------------------------------------
    |
    | This file is where you may override any of the routes that are included
    | with Voyager.
    |
    */

    Route::group(['as' => 'voyager.'], function () {
        event('voyager.routing', app('router'));

        $namespacePrefix = '\\TCG\\Voyager\\Http\\Controllers\\';

        Route::get('login', ['uses' => $namespacePrefix . 'VoyagerAuthController@login', 'as' => 'login']);
        Route::post('login', ['uses' => $namespacePrefix . 'VoyagerAuthController@postLogin', 'as' => 'postlogin']);

        Route::group(['middleware' => ['admin.user']], function () use ($namespacePrefix) {
            event('voyager.admin.routing', app('router'));

            // Main Admin and Logout Route
            Route::get('/', ['uses' => $namespacePrefix . 'VoyagerController@index', 'as' => 'dashboard']);
            Route::get('logout', ['uses' => $namespacePrefix . 'VoyagerController@logout', 'as' => 'logout']);
            Route::post('upload', ['uses' => $namespacePrefix . 'VoyagerController@upload', 'as' => 'upload']);

            Route::get('profile', ['uses' => $namespacePrefix . 'VoyagerController@profile', 'as' => 'profile']);

            try {
                foreach (\TCG\Voyager\Models\DataType::all() as $dataTypes) {
                    if($dataTypes->id === 1){
                        Route::resource($dataTypes->slug, 'PostsController');

                    }else {
                        Route::resource($dataTypes->slug, $namespacePrefix.'VoyagerBreadController');
                    }
                }
            } catch (\InvalidArgumentException $e) {
                throw new \InvalidArgumentException("Custom routes hasn't been configured because: " . $e->getMessage(), 1);
            } catch (\Exception $e) {
                // do nothing, might just be because table not yet migrated.
            }

            // Role Routes
            Route::resource('roles', $namespacePrefix . 'VoyagerRoleController');

            // Menu Routes
            Route::group([
                'as' => 'menus.',
                'prefix' => 'menus/{menu}',
            ], function () use ($namespacePrefix) {
                Route::get('builder', ['uses' => $namespacePrefix . 'VoyagerMenuController@builder', 'as' => 'builder']);
                Route::post('order', ['uses' => $namespacePrefix . 'VoyagerMenuController@order_item', 'as' => 'order']);

                Route::group([
                    'as' => 'item.',
                    'prefix' => 'item',
                ], function () use ($namespacePrefix) {
                    Route::delete('{id}', ['uses' => $namespacePrefix . 'VoyagerMenuController@delete_menu', 'as' => 'destroy']);
                    Route::post('/', ['uses' => $namespacePrefix . 'VoyagerMenuController@add_item', 'as' => 'add']);
                    Route::put('/', ['uses' => $namespacePrefix . 'VoyagerMenuController@update_item', 'as' => 'update']);
                });
            });

            // Settings
            Route::group([
                'as' => 'settings.',
                'prefix' => 'settings',
            ], function () use ($namespacePrefix) {
                Route::get('/', ['uses' => $namespacePrefix . 'VoyagerSettingsController@index', 'as' => 'index']);
                Route::post('/', ['uses' => $namespacePrefix . 'VoyagerSettingsController@store', 'as' => 'store']);
                Route::put('/', ['uses' => $namespacePrefix . 'VoyagerSettingsController@update', 'as' => 'update']);
                Route::delete('{id}', ['uses' => $namespacePrefix . 'VoyagerSettingsController@delete', 'as' => 'delete']);
                Route::get('{id}/move_up', ['uses' => $namespacePrefix . 'VoyagerSettingsController@move_up', 'as' => 'move_up']);
                Route::get('{id}/move_down', ['uses' => $namespacePrefix . 'VoyagerSettingsController@move_down', 'as' => 'move_down']);
                Route::get('{id}/delete_value', ['uses' => $namespacePrefix . 'VoyagerSettingsController@delete_value', 'as' => 'delete_value']);
            });

            // Admin Media
            Route::group([
                'as' => 'media.',
                'prefix' => 'media',
            ], function () use ($namespacePrefix) {
                Route::get('/', ['uses' => $namespacePrefix . 'VoyagerMediaController@index', 'as' => 'index']);
                Route::post('files', ['uses' => $namespacePrefix . 'VoyagerMediaController@files', 'as' => 'files']);
                Route::post('new_folder', ['uses' => $namespacePrefix . 'VoyagerMediaController@new_folder', 'as' => 'new_folder']);
                Route::post('delete_file_folder', ['uses' => $namespacePrefix . 'VoyagerMediaController@delete_file_folder', 'as' => 'delete_file_folder']);
                Route::post('directories', ['uses' => $namespacePrefix . 'VoyagerMediaController@get_all_dirs', 'as' => 'get_all_dirs']);
                Route::post('move_file', ['uses' => $namespacePrefix . 'VoyagerMediaController@move_file', 'as' => 'move_file']);
                Route::post('rename_file', ['uses' => $namespacePrefix . 'VoyagerMediaController@rename_file', 'as' => 'rename_file']);
                Route::post('upload', ['uses' => $namespacePrefix . 'VoyagerMediaController@upload', 'as' => 'upload']);
            });

            // Database Routes
            Route::group([
                'as' => 'database.',
                'prefix' => 'database',
            ], function () use ($namespacePrefix) {
                Route::post('bread/create', ['uses' => $namespacePrefix . 'VoyagerDatabaseController@addBread', 'as' => 'create_bread']);
                Route::post('bread/', ['uses' => $namespacePrefix . 'VoyagerDatabaseController@storeBread', 'as' => 'store_bread']);
                Route::get('bread/{id}/edit', ['uses' => $namespacePrefix . 'VoyagerDatabaseController@addEditBread', 'as' => 'edit_bread']);
                Route::put('bread/{id}', ['uses' => $namespacePrefix . 'VoyagerDatabaseController@updateBread', 'as' => 'update_bread']);
                Route::delete('bread/{id}', ['uses' => $namespacePrefix . 'VoyagerDatabaseController@deleteBread', 'as' => 'delete_bread']);
            });

            Route::resource('database', $namespacePrefix . 'VoyagerDatabaseController');
        });
    });


});

Route::auth();


//Posts
Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('{slug}', 'PostsController@get')->name('show');

    Route::get('/', 'PostsController@blogindex')->name('all');
});

// Categories
Route::group(['prefix' => 'category', 'as' => 'categories.'], function () {
    Route::get('{slug}', function ($slug) {
        $category = TCG\Voyager\Models\Category::where('slug', $slug)->first();

        return view('categories.show', compact('category'));
    })->name('show');

    Route::get('/', function () {
        $categories = TCG\Voyager\Models\Category::all();

        return view('posts.post', ['categories' => $categories->all()]);
    })->name('allCategories');

});

Route::group(['prefix' => 'tags', 'as' => 'tags.'], function () {
    Route::get('{slug}', function ($slug) {
        $tag = \App\Tag::where('slug', $slug)->first();

        return view('tags.show', compact('tag'));
    })->name('show');

    Route::get('/', function () {
        $tags = \App\Tag::all();

        return $tags;
    })->name('allTags');

});


// Needs to be last since it involves slugs
// Routes for the pages
Route::get('{slug}', function ($slug) {
    $page = TCG\Voyager\Models\Page::where('slug', $slug)->firstOrFail();

    return view('posts.post', $page->toArray());
})->name('getPage');

//Auth::routes();







Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
