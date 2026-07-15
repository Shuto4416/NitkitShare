<?php
require_once 'db.php';
session_start();
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    if (!str_ends_with($email, '@apps.kct.ac.jp')) {
        $msg = "指定ドメインのみログイン可能です。";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM user_accounts WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            die("ログイン成功！ようこそ " . htmlspecialchars($user['name']) . " さん");
        } else {
            $msg = "メールアドレスまたはパスワードが違います。";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head><meta charset="UTF-8"><title>ログイン</title></head>
<body>
    <?php if(isset($_GET['status']) && $_GET['status'] == 'registered'): ?>
        <p style="color:green;">アカウント登録が完了しました。ログインしてください。</p>
    <?php endif; ?>

    <h2>ログイン</h2>
    <p style="color:red;"><?= htmlspecialchars($msg) ?></p>
    <form method="POST">
        <div>メール: <input type="email" name="email" required></div>
        <div>パスワード: <input type="password" name="password" required></div>
        <button type="submit">ログイン</button>
    </form>
    <p><a href="register.php">新規アカウント作成はこちら</a></p>
</body>
</html>