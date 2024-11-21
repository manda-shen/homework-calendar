<?php
// 資料庫連線設定
$host = 'localhost';
$dbname = 'calendar'; // 替換為你的資料庫名稱
$username = 'root';   // 替換為你的資料庫用戶名
$password = '';   // 替換為你的資料庫密碼

// 建立資料庫連線
$conn = new mysqli($host, $username, $password, $dbname);

// 檢查連線
if ($conn->connect_error) {
    die("連線失敗：" . $conn->connect_error);
}

// 如果表單提交，將備忘錄內容存入資料庫
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
    $content = $conn->real_escape_string($_POST['content']);
    $sql = "INSERT INTO memos (content) VALUES ('$content')";
    if ($conn->query($sql) === TRUE) {
        echo "備忘錄儲存成功！<br>";
    } else {
        echo "儲存失敗：" . $conn->error . "<br>";
    }
}

// 從資料庫中取得所有備忘錄，按日期排序
$memos = $conn->query("SELECT content, created_at FROM memos ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>備忘錄</title>
</head>
<body>
    <h1>備忘錄</h1>
    <!-- 表單 -->
    <form method="POST" action="">
        <label for="content">新增備忘錄：</label><br>
        <textarea id="content" name="content" rows="5" cols="50" required></textarea><br>
        <button type="submit">儲存</button>
    </form>

    <h2>歷史備忘錄</h2>
    <?php if ($memos->num_rows > 0): ?>
        <ul>
            <?php while ($row = $memos->fetch_assoc()): ?>
                <li>
                    <strong><?php echo htmlspecialchars($row['created_at']); ?>：</strong>
                    <?php echo nl2br(htmlspecialchars($row['content'])); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>目前沒有備忘錄。</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>
