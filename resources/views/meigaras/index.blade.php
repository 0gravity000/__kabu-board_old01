@extends('layouts.master')

@section('content')
<h2>銘柄一覧</h2>
<a href="/Meigaras/reload">更新</a>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>コード</th>
        <th>銘柄名</th>
        <th>市場</th>
        <th>#</th>
        <th>#</th>
      </tr>
    </thead>
    <tbody>
      @foreach($Meigaras as $meigara)
        <tr>
          <td>{{ $meigara->code }}</td>
          <td>{{ $meigara->name }}</td>
          <td>{{ $meigara->market }}</td>
          <td>#</td>
          <td>#</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
