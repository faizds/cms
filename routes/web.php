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
    return view('welcome');
});

// Route::get('/about', function () {
//     return "Hi about page";
// });

// Route::get('/contact', function () {
//     return "Hi I am contact";
// });

// Route::get('/post/{id}/{name}', function($id,$name){
//     return "This is post number ".$id." ".$name;
// });

// Route::get('admin/posts/example', array('as'=>'admin.home', function(){

// $url = route('admin.home');

// return "this url is ".$url;

// }));

// Route::get('/post/{id}', 'PostController@index');

// Route::resource('post', 'PostController');

Route::get('/contact', 'PostController@contact');

Route::get('post/{id}/{name}/{password}', 'PostController@show_post');

// DATABASE RAW SQL QUERIES

Route::get('/insert', function(){

    DB::insert('insert into posts(title,content) values(?,?)', ['Laravel is awesome', 'Laravel is the best thing that has happened to PHP, PERIOD']);

});

Route::get('/read', function(){

    $results = DB::select('select * from posts where id = ?', [1]);

    return var_dump($results);

    // foreach($results as $post){
    //     return $post->title;
    // }

});

Route::get('/update', function(){

    $updated = DB::update('update posts set title = "Update title" where id=?', [1]);

});

Route::get('/delete', function(){

    $deleted = DB::delete('delete from posts where id=?', [1]);

    return $deleted;

});

// ELOQUENT

use App\Post;

Route::get('/eloqread', function(){

    $posts = Post::all();

    foreach($posts as $post){
        echo $post->title;
        return $post->title;
    }

    // return only display first data of the table
    // echo display all data of the table

});

Route::get('/eloqfind', function(){

    $post = Post::find(3);

    return $post->title;

    // foreach($posts as $post){
    //     return $post->title;
    // }

});

Route::get('/findwhere', function(){

    $posts = Post::where('id', 5)->orderBy('id','desc')->take(1)->get();

    return $posts;

});

Route::get('/findmore', function(){

    // $posts = Post::findOrFail(2);

    // return $posts;

    $posts = Post::where('users_count', '<', 50)->firstOrFail();

});

Route::get('/basicinsert', function(){

    $post = new Post;

    $post->title = 'New Eloquent title insert';
    $post->content = 'Wow eloquent is really cool, look at this content';

    $post->save();
});

Route::get('/basicinsertupdate', function(){

    $post = Post::find(2);

    $post->title = 'New Eloquent title insert 2';
    $post->content = 'Wow eloquent is really cool, look at this content 2';

    $post->save();
});

Route::get('/eloqcreate', function(){

    Post::create(['title'=>'the create method', 'content'=>'WOW I am learning alot with Edwin']);

});

Route::get('/eloqupdate', function(){

    Post::where('id', 4)->where('is_admin', 0)->update(['title'=>'NEW PHP TITLE', 'content'=>'My instructor is good']);

});

Route::get('/eloqdelete', function(){

    $post = Post::find(2);

    $post->delete();

});

Route::get('/eloqdelete2', function(){

    Post::destroy([4,5]);

    // Post::where('is_admin', 0)->delete();

});

Route::get('/softdelete', function(){

    Post::find(1)->delete();

});

Route::get('/readsoftdelete', function(){

    // $post = Post::find(1);

    // return $post;

    // $post = Post::withTrashed()->where('id', 1)->get();

    // return $post;

    $post = Post::onlyTrashed()->where('is_admin', 0)->get();

    return $post;

});

Route::get('/restore', function(){

    Post::withTrashed()->where('is_admin', 0)->restore();

});

Route::get('/forcedelete', function(){

    Post::onlyTrashed()->where('is_admin', 0)->forcedelete();

});