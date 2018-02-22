@extends('layouts.app') 
@section('content') 

<!-- Bootstrap の 定形 コード… -->

<div class="panel-body">
    <!-- バリデーションエラーの 表示 に 使用 -->
    @include('common.errors') 
    <!-- バリデーションエラーの 表示 に 使用 --> 

<!-- 本 登 録 フォーム --> 
    <form action="{{ url('books')}}" method="POST" class="form-horizontal">
         {{csrf_field()}} 
         
         <!-- 本 のタイトル --> 
         <div class="form-group">
             <label for="book" class="col-sm-3 control-label">Book</label>
             <div class="col-sm-6">
                 <input type="text" name="item_name" id="book-name"class="form-control">
             </div>
         </div> <!-- 本 登 録 ボタン -->
     
         <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Save </button>
            </div>
        </div>
    </form>
</div> 

<!-- Book: 既 に 登 録 されてる 本 のリスト --> 
@endsection