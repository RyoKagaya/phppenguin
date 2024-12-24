<?php

?>

<html>
<head>
<meta charset="utf-8">
<title>ペンギンチャット</title>
</head>
<body>
<form action="chatlog.php" method="post">
	質問: <input type="text" name="question">
    <button type="submit">送信</button>
</form>

<!-- 回答を表示 -->
<?php if(isset($_GET['question'])&& isset($_GET['answer'])):?>
    <h2>ラティペンの回答</h2>
    <p>質問：<?= htmlspecialchars($_GET['question'],ENT_QUOTES) ?></p>
    <p>回答：<?= htmlspecialchars($_GET['answer'],ENT_QUOTES) ?></p>
<?php endif; ?>
<ul>
<li><a href="index.php">ログイン画面に戻る</a></li>
</ul>
</body>
</html>