<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;

class BooksController extends Controller
{
    
        public function __construct(){
        $this->middleware('auth');
        //「認 証 していたら 表示 する」 という 処 理 です。 
        //ログイン 認 証 してなければ 非 表示 になります。 
        }
    
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
           $books = Book::where('user_id',Auth::user()->id)->find($request->id);
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
            $books->user_id = Auth::user()->id;
            $books->item_name = $request->item_name;
            $books->item_number = $request->item_number;
            $books->item_amount = $request->item_amount;
            $books->published = $request->published;
            $books->save();// 「/」 ルートにリダイレクト
            \Session::flash('flash_message', '記事の作成に成功しました');
            return redirect('/');
        }
        
        public function index(){
            $books = Book::where('user_id', Auth::user()->id)
            ->orderBy('created_at','desc')
            ->paginate(3);
            return view('books', [
               'books' => $books 
            ]);
        }
        
        public function edit($book_id){
            $books = Book::where('use_id' , Anth::user()->id)->find($book_id);
            //{books}id 値 を 取得 => Book $books id 値 の１レコード 取得
            return view('booksedit', ['book' => $books]);
        }
        
        
        public function delete(Book $book){
            $book->delete();
            Session::flash('flash_message', '記事の削除に成功しました');
            return redirect('/');
        }
        
        
}
