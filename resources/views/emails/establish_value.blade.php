<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>kabuboard</title>
	</head>
    <body>
      <h1>条件が成立しました(現在値)</h1>

      <p>コード: {{ $establish_code }}</p>

      <p>銘柄名: {{ $establish_name }}</p>

      <p>現在値: {{ $establish_value }}</p>

      <p>上限値: {{ $establish_upperlimit }}</p>

      <p>下限値: {{ $establish_lowerlimit }}</p>

    </body>
</html>