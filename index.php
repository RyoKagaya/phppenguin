<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- ログイン画面のヘッダー -->
    <header>
        <h1>ログイン</h1>
    </header>

    <!-- ログインボタン -->
    <main>
        <div class="login-container">
            <button id="google-login-btn">
                <img src="img/google_logo_icon_169090..webp" alt="Google Icon" class="google-icon"> Googleでログイン
            </button>
        </div>
    </main>

    <!-- フッター -->
    <footer>
        <p>&copy; 2024 RATIO TALK. All rights reserved.</p>
    </footer>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- Firebase Authentication Script -->
    <script type="module">
        // 必要なFirebaseライブラリを読み込み
        import { initializeApp } 
            from "https://www.gstatic.com/firebasejs/11.0.2/firebase-app.js";
        import { getAuth, signInWithPopup, GoogleAuthProvider } 
            from "https://www.gstatic.com/firebasejs/11.0.2/firebase-auth.js";

        // FirebaseConfig
        const firebaseConfig = {
            apiKey: "AIzaSyARzP__ljFcbCdlgQ7S-FRfxDQzqQkukPU",
            authDomain: "expense-approval-c5bb0.firebaseapp.com",
            projectId: "expense-approval-c5bb0",
            storageBucket: "expense-approval-c5bb0.appspot.com",
            messagingSenderId: "185611188636",
            appId: "1:185611188636:web:dd15134857affc8c557059"
        };
        const app = initializeApp(firebaseConfig);

        // Google Auth 認証
        const provider = new GoogleAuthProvider();
        const auth = getAuth();

        // ログインボタンのクリックイベント
        $("#google-login-btn").on("click", function() {
            signInWithPopup(auth, provider)
                .then((result) => {
                    // ユーザー情報取得
                    const user = result.user;
                    alert(`ようこそ、${user.displayName}さん！`);
                    // 遷移先
                    location.href = "http://localhost/php/php05/penguin.php";
                })
                .catch((error) => {
                    console.error("ログインエラー:", error);
                    alert("ログインに失敗しました。再試行してください。");
                });
        });
    </script>
</body>
</html>