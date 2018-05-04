@extends('layouts.master')

@section('content')

<h2>Create a Meigara</h2>

    <hr>

    <form method="POST" action="/Realtimes">
      {{ csrf_field()}}
      <div class="form-group">
        <label for="code">code</label>
        <input type="text" class="form-control" id="code" name="code">
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">追加</button>
      </div>

    </form>


@endsection
