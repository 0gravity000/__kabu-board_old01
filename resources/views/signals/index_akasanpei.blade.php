@extends('layouts.master')

@section('content')
<h2>シグナル</h2>
<h3>赤三兵</h3>
{{ $today }}
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>コード</th>
        <th>銘柄名</th>
        <th>3日前終値</th>
        <th>2日前終値</th>
        <th>1日前終値</th>
        <th>本日終値</th>
        <th>値上値</th>
        <th>値上率</th>
      </tr>
    </thead>
    <tbody>
      @for($i = 0; $i < count($Sanpeis); $i++)
        <tr>
          <td>{{ array_get($Sanpeis[$i], 'code') }}</td>
          <td>{{ array_get($Sanpeis[$i], 'name') }}</td>
          <td>{{ array_get($Sanpeis[$i], 'endValue03') }}</td>
          <td>{{ array_get($Sanpeis[$i], 'endValue02') }}</td>
          <td>{{ array_get($Sanpeis[$i], 'endValue01') }}</td>
          <td>{{ array_get($Sanpeis[$i], 'endValue') }}</td>
          <td>{{ array_get($Sanpeis[$i], 'upvalue') }}</td>
          <td>{{ array_get($Sanpeis[$i], 'uprate') }}</td>
        </tr>
      @endfor
    </tbody>
  </table>
</div>

@endsection
