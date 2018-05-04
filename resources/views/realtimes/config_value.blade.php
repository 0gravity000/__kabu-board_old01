@extends('layouts.master')

@section('content')

<h2>通知設定</h2>

    <hr>

    <form method="POST" action="/Realtimes/configed_value">
      {{ csrf_field()}}
      <div class="form-group">
        <label for="code">コード</label>
        {{ $realtime->code }}
        <input type="hidden" name="code" value={{ $realtime->code }}>
      </div>
      <div class="form-group">
        <label for="name">銘柄名</label>
        {{ $realtime->name }}
      </div>
      <div class="form-group">
        <label for="value">現在値</label>
        {{ $realtime->value }}
      </div>
      <div class="form-group">
        <label for="upperlimit">上限値</label>
        <input type="text" class="form-control" id="upperlimit" name="upperlimit" value={{ $realtime->upperlimit }}>
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>
      <div class="form-group">
        <label for="lowerlimit">下限値</label>
        <input type="text" class="form-control" id="lowerlimit" name="lowerlimit" value={{ $realtime->lowerlimit }}>
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>
      <!--
      <div class="form-group">
        <label for="changerate">変化率</label>
        <input type="text" class="form-control" id="changerate" name="changerate" value={{ $realtime->changerate }}>
      </div>
    -->
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="set" value="set">設定</button>
        <button type="submit" class="btn btn-primary" name="delete" value="delete">削除</button>
      </div>

    </form>


@endsection
