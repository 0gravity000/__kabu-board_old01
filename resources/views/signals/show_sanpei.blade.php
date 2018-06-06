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

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>コード</th>
        <th>銘柄名</th>
        <th>終値</th>
        <th>前日終値</th>
        <th>始値</th>
        <th>高値</th>
        <th>安値</th>
        <th>出来高</th>
      </tr>
    </thead>
    <tbody>
          @for($i = 0; $i < count($Dailys); $i++)
        <tr>
            <td>{{ array_get($Dailys[$i], 'code') }}</td>
            <td>{{ array_get($Dailys[$i], 'name') }}</td>
            <td>{{ array_get($Dailys[$i], 'endValue') }}</td>
            <td>{{ array_get($Dailys[$i], 'preEndvalue') }}</td>
            <td>{{ array_get($Dailys[$i], 'startValue') }}</td>
            <td>{{ array_get($Dailys[$i], 'highValue') }}</td>
            <td>{{ array_get($Dailys[$i], 'lowValue') }}</td>
            <td>{{ array_get($Dailys[$i], 'volume') }}</td>
        </tr>
          @endfor
    </tbody>
  </table>
</div>

@endsection
