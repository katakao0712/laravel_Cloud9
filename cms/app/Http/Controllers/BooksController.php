<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;

class BooksController extends Controller
{
    //
        public function update (Request $request){
           $validator = Validator::make($request->all(), [
           'id' => 'required',
           'item_name' => 'required|min:3|max:255',
           'item_number' => 'required|min:1|max:3',
           'item_amount' => 'required|max:6',
           'published' => 'required',
           ]); 
           
           //バリデーション： エラー
           if ($validator->fails()) {
               return redirect('/')
               ->withInput()
               ->withErrors($validator); 
           }
           
           //データ 更新
           $books = Book::find($request->id);
           $books->item_name = $request->item_name;
           $books->item_number = $request->item_number;
           $books->item_amount = $request->item_amount;
           $books->published = $request->published;
           $books->save();
           return redirect('/');
        }
        
        public function store(Request $request){
            //バリデーション
            $validator = Validator::make($request->all(),[
                'item_name' => 'required|max:255', 
                'item_number' => 'required|min:1|max:3', 
                'item_amount' => 'required|max:6',
                'published' => 'required',
            ]);
                //バリデーション:エラー 
                if ($validator->fails()) {
                        return redirect('/')
                            ->withInput()
                            ->withErrors($validator);
                }
            //Eloquentモデル
            $books = new Book; 
            $books->item_name = $request->item_name;
            $books->item_number = $request->item_number;
            $books->item_amount = $request->item_amount;
            $books->published = $request->published;
            $books->save();// 「/」 ルートにリダイレクト
            \Session::flash('flash_message', '記事の作成に成功しました');
            return redirect('/');
        }
        
        public function index(){
            $books = Book::orderBy('created_at', 'asc')->get();
            return view('books', [
               'books' => $books 
            ]);
        }
        
        public function edit(Book $books){
            //{books}id 値 を 取得 => Book $books id 値 の１レコード 取得
            return view('booksedit', ['book' => $books]);
        }
        
        
        public function delete(Book $book){
            $book->delete();
            Session::flash('flash_message', '記事の削除に成功しました');
            return redirect('/');
        }
        
        
}
