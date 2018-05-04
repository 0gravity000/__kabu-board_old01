@extends('layouts.master')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    You are logged in!

    <h2>Thank you for visiting!</h2>
    <div class="table-responsive">
      <table class="table table-striped">
        Kabuboard へようこそ。</br>
        </br>
        このサイトはYahooファイナンス株式のデータを参考にしています。</br>
        <a href="https://stocks.finance.yahoo.co.jp/" target="_blank">Yahooファイナンス株式</a>
      </table>
    </div>

@endsection
