@extends('layouts.master')

@section('content')
<h2>シグナル</h2>
<h3>三兵</h3>
<form method="POST" action="/Signals/show_sanpei">
  {{ csrf_field()}}
  <div class="form-group">
    <label for="year">年</label>
    <input class="form-control" name="year" value="{{ $nowYear }}">
  </div>
  <div class="form-group">
    <label for="month">月</label>
    <input class="form-control" name="month" value="{{ $nowMonth }}">
  </div>
  <div class="form-group">
    <label for="day">日</label>
    <input class="form-control" name="day" value="{{ $nowDay }}">
  </div>
  <button type="submit" class="btn btn-primary">表示</button>
</form>

@endsection
