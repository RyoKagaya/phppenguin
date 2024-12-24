<?php

$question = $_POST["question"];
$answer = $_POST["answer"];

$c = ",";

$str = $question.$c.$answer;

$file = fopen("data.csv","a");
fwrite($file,$str."\n");
fclose($file);

header("Location: penguin.php");
exit;