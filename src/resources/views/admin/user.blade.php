@extends('layouts/base')

@section('title', 'ユーザー管理')
@section('css')
<link rel="stylesheet" href="{{ asset('css/articleList.css') }}">
@endsection

@section('content')

@if(Session::has('flashmessage'))
    <script>
        $(window).on('load',function(){
            $('#myModal').modal('show');
        });
    </script>

    <!-- モーダルウィンドウの中身 -->
    <div class="modal fade" id="myModal" tabindex="-1"
        role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    {{ session('flashmessage') }}
                </div>
                <div class="modal-footer text-center">
                </div>
            </div>
        </div>
    </div>
@endif

<form id="form2" class="form_wrap" action="user/download" method="POST">
  @csrf
  <p>何も入力しなければ全期間ダウンロードされます</p>
    <div class="csv_import_textarea">
      <input type="text" class="input" name="year" >年
      <input type="text" class="input" name="month">月
      <input type="text" class="input" name="day">日から<br>
      <input type="text" class="input" name="yearEnd" >年
      <input type="text" class="input" name="monthEnd">月
      <input type="text" class="input" name="dayEnd">日までを
      <input type="submit" value="csvダウンロード">
    </div>  
  </form>
  <form enctype="multipart/form-data" method="post" action={{route("admin/user")}}>
    @csrf
    <fieldset>
      <legend>ファイルインポート</legend>
      Filename(CSVファイルのみ対応しています): <input type="file" name="upfile" accept=".csv"/><br />
      <input type="submit" value="Upload" />
    </fieldset>
  </form><br><br><br><br>
  <table border="1">
    @foreach ( $data as $row ) 
      <tr><td>名前 {{$row['name']}}</td>
      <td>メール: {{$row["email"]}} </td>
      <td>ID: {{$row['user_id']}}</td> 
      <td>パス {{$row['password'] }}</td>
      <td>仮登録日時 {{$row['created_at'] }}</td>
      <td>本登録日時 {{$row['email_verified_at'] }}</td>
      <td>更新日時 {{$row['updated_at'] }}</td></tr>
      </div>
    @endforeach
  </table>

@endsection













