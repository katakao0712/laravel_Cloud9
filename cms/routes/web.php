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

Route::get('/', function () {
   $books = Book::orderBy('created_at', 'asc')->get();
   return view('books', [ 'books' => $books ]);
});

Route::post('/books'. function(Request $request){
    $validator = Validator::make($request->all(),
    [ 'item_name' => 'required|max:255', ]);
    
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    
    $books = new Book; 
    $books->item_name = $request->item_name;
    $books->item_number = '1';
    $books->item_amount = '1000';
    $books->published = '2017-03-07 00:00:00';
    $books->save();// 「/」 ルートにリダイレクト
    return redirect('/');
});



//Route::delete('/book/{book}'. function(Book $book){
    //
//});
