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
    $posts = App\Post::where('status','PUBLISHED')->take(5)->orderBy('created_at')->get();
    // Get the difference
    // $toTake = 5 - $posts->count();
    // $nonFeaturedPosts = TCG\Voyager\Models\Post::where('status','PUBLISHED')->take($toTake)->orderBy('created_at')->get();

    return view('home', ['posts' => $posts]);
});
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::auth();


//Posts
Route::group(['prefix' => 'blog'], function () {
    Route::get('{slug}', 'PostsController@get')->name('getPost');

    Route::get('/', 'PostsController@index')->name('posts');
});

// Categories
Route::group(['prefix' => 'category'], function () {
  Route::get('{slug}', function($slug){
    $category = TCG\Voyager\Models\Category::where('slug', $slug)->first();

    return view('posts.post', compact($category->toArray()));
  })->name('getCategory');

    Route::get('/', function(){
        $categories = TCG\Voyager\Models\Category::all();

        return view('posts.post', ['categories' => $categories->all()]);
    })->name('allCategories');

});

Route::group(['prefix' => 'tag'], function () {
    Route::get('{slug}', function($slug){
        $tag = \App\Tag::where('slug', $slug)->first();

        return $tag;
    })->name('getTag');

    Route::get('/', function(){
        $tags = \App\Tag::all();

        return $tags;
    })->name('allTags');

});

// Needs to be last since it involves slugs
// Routes for the pages
Route::get('{slug}', function($slug){
    $page = TCG\Voyager\Models\Page::where('slug', $slug)->firstOrFail();

    return view('posts.post', $page->toArray());
})->name('getPage');
Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
