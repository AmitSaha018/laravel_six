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

// Route::get('/', function () {
//     return view('pages.index');
// });

Route::get('/','PostController@ShowAllPost');

Route::get('/ContactUs','Hellocontroller@Contact')->name('contact');
Route::get('/AboutUs','Hellocontroller@About')->name('AboutUs');


//category routes--------------

Route::get('/AllCategory','CategoryController@AllCategory')->name('all.category');
Route::get('/AddCategory','CategoryController@AddCategory')->name('add.category');
Route::post('/StoreCategory','CategoryController@StoreCategory')->name('store.category');
Route::get('view/category/{id}','CategoryController@ViewCategory');
Route::get('delete/category/{id}','CategoryController@DeleteCategory');
Route::get('edit/category/{id}','CategoryController@EditCategory');
Route::post('update/category/{id}','CategoryController@UpdateCategory');

//Posts Routes-----------------
Route::get('/WritePost','PostController@WritePost')->name('write.post');
Route::post('store/Post','PostController@StorePost')->name('store.post');
Route::get('/AllPost','PostController@AllPost')->name('all.post');
Route::get('view/post/{id}','PostController@ViewPost');
Route::get('edit/post/{id}','PostController@EditPost');
Route::post('update/post/{id}','PostController@UpdatePost');
Route::get('delete/post/{id}','PostController@DeletePost');

//Student routes------------
// Route::get('/Student','Studentcontroller@Student')->name('Student');
// Route::post('/StoreStudent','Studentcontroller@Store')->name('store.student');
// Route::get('/AllStudent','Studentcontroller@index')->name('all.student');
// Route::get('view/student/{id}','Studentcontroller@show');
// Route::get('delete/student/{id}','Studentcontroller@destroy');
// Route::get('edit/Student/{id}','Studentcontroller@edit');
// Route::post('update/Student/{id}','Studentcontroller@update');
//----------------------------

//Resource Route------------

Route::resource('/student', 'StudentController');









/*
Route::get('/about',function(){
    return view('about',['channel' => 'Apsara']);
});
*/

/*
Route::get('/about','Hellocontroller@Manush');

Route::get('/blog','Hellocontroller@Blog');*/



/*Route::get('/contact',function(){
    return view('pages.contact');
})->middleware('age');



Route::get(md5('/contactus'),'bollocontroller@Bolo')
    ->name('contact');




Route::get('/apsara',function(){
    echo "eta apsara page";
});


Route::get('/home',function(){
    return view('home');
});
*/

