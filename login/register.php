<?php
require_once 'db.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    if (!str_ends_with($email, '@apps.kct.ac.jp')) {
        $msg = "エラー: 指定されたドメインのメールアドレスのみ登録可能です。";
    } else {
        $stmt = $pdo->prepare("INSERT INTO user_accounts (name, email, password, create_date) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['name'], $email, password_hash($_POST['password'], PASSWORD_DEFAULT), date('Y-m-d H:i:s')]);
        header("Location: login.php?status=registered");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head><meta charset="UTF-8"><title>新規登録</title></head>
<body>
    <h2>アカウント作成</h2>
    <p style="color:red;"><?= htmlspecialchars($msg) ?></p>
    <form method="POST">
        <div>名前: <input type="text" name="name" required></div>
        <div>メール: <input type="email" name="email" required placeholder="xxx@apps.kct.ac.jp"></div>
        <div>パスワード: <input type="password" name="password" required></div>
        <button type="submit">登録する</button>
    </form>
    <p><a href="login.php">既にアカウントをお持ちの方はこちら</a></p>
</body>
</html>