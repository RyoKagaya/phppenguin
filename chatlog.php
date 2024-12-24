<?php

// POSTデータを取得

if($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['question'])){
    $question = htmlspecialchars($_POST['question'],ENT_QUOTES);

    // OPEN AI API キー
    $apiKey = ''; //後でOPEN AI API KEYを追加する

    // OPEN AI へのリクエストデータ
    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system','content' => 'あなたは親切なペンギンのラティペンです。'],
            ['role' => 'user','content' => $question],
        ],
        'max_tokens' => 150,
        'temperature' => 0.7,
    ];

    // OpenAI APIにリクエスト
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    // エラーチェック
    if (curl_errno($ch)) {
        $answer = 'エラーが発生しました。後でもう一度お試しください。'. curl_error($ch);
    } else {
        $result = json_decode($response, true);
        $answer = $result['choices'][0]['message']['content'] ?? 'すみません、その質問にはまだ答えられません。';
    }
    curl_close($ch);

    // 会話履歴をCSVファイルに保存
    $c = ","; //区切り文字
    $str = $question . $c .$answer;

    $file = fopen("data.csv","a");
    if($file){
        fwrite($file,$str."\n");
        fclose($file);
    }else{
        $answer = "エラー：会話履歴を保存できませんでした。";
    }

    // penguin.phpにリダイレクト
    header("Location: penguin.php?question=" . urlencode($question) . "&answer=" . urlencode($answer));
    exit;
    } else {
    // 不正なアクセスの場合はpenguin.phpに戻る
    header('Location: penguin.php');
    exit;

}