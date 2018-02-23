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

use App\Book;
//Eloquent モデル 「/app/Book.php」 を 参照 できるようにするため。
use Illuminate\Http\Request;
//Eloquent モデル 「/app/Book.php」 を 参照 できるようにするため。

Route::post('/books','BooksController@store');
Route::post('/books/update','BooksController@update');
Route::get('/','BooksController@index');

Route::delete('/book/{book}','BooksController@delete');
Route::post('/booksedit/{books}','BooksController@edit');

