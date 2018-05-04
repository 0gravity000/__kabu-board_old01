<!DOCTYPE html>
<html lang="ja">
    <head>
      <meta charset="UTF-8">
      <title>kabuboard</title>
    </head>
    <body>
      <h1>条件が成立しました（急騰急落）</h1>

      <p>コード: {{ $establish_code }}</p>

      <p>銘柄名: {{ $establish_name }}</p>

      <p>騰落率:</p>
      <p> {{ $establish_pre_changerate }} ー＞  {{ $establish_changerate }}　：  {{ $establish_changerate_range }}</p>

      <p>回数: {{ $establish_changecount }} 回目</p>

    </body>
</html>
