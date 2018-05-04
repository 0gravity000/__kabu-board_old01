@extends('layouts.master')

@section('content')

<h2>通知設定</h2>

    <hr>

    <form method="POST" action="/Realtimes/configed_changerate">
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
        <label for="value">騰落率</label>
        {{ $realtime->changerate }}
      </div>
      <!--
      <div class="form-group">
        <label for="upperlimit">上限値</label>
        <input type="text" class="form-control" id="upperlimit" name="upperlimit" value={{ $realtime->upperlimit }}>
      </div>
      <div class="form-group">
        <label for="lowerlimit">下限値</label>
        <input type="text" class="form-control" id="lowerlimit" name="lowerlimit" value={{ $realtime->lowerlimit }}>
      </div>
    -->
      <div class="form-group">
        <label for="changerate_range">変化率</label>
        <input type="text" class="form-control" id="changerate_range" name="changerate_range" value={{ $realtime->changerate_range }}>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="set" value="set">設定</button>
        <button type="submit" class="btn btn-primary" name="delete" value="delete">削除</button>
      </div>

    </form>


@endsection
