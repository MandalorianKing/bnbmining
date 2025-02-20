<?php


session_start();

// Giriş bilgileri (şifre bcrypt ile şifrelenmiş)
$admin_username = "adminke";
$admin_password_hash = '$2a$12$CCUy4T31u4Eoxr2ceKV85uSFC8UXIWSbsqFdOj0m3W6ZtSvjqESim'; // "123456" için bcrypt şifresi

// Kullanıcı giriş kontrolü
if (!isset($_SESSION['logged_in']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    if ($_POST["username"] === $admin_username && password_verify($_POST["password"], $admin_password_hash)) {
        $_SESSION["logged_in"] = true;
    } else {
        $login_error = "Hatalı kullanıcı adı veya şifre!";
    }
}

// Eğer giriş yapılmamışsa giriş formunu göster
if (!isset($_SESSION['logged_in'])): ?>
    <!DOCTYPE html>
    <html lang="tr">
    <head>
        <meta charset="UTF-8">
        <title>Admin Giriş</title>
        <style>
            body { background-color: #121212; color: white; text-align: center; font-family: Arial; }
            form { background: #1e1e1e; padding: 20px; border-radius: 8px; width: 300px; margin: 100px auto; }
            input { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #555; background: #333; color: white; }
            button { background: #ffcc00; border: none; padding: 10px; width: 100%; cursor: pointer; }
            button:hover { background: orange; }
        </style>
    </head>
    <body>
        <h2>Admin Girişi</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required><br>
            <input type="password" name="password" placeholder="Şifre" required><br>
            <button type="submit" name="login">Giriş Yap</button>
        </form>
        <?php if (isset($login_error)) echo "<p style='color:red;'>$login_error</p>"; ?>
    </body>
    </html>
    <?php exit; 
endif;



$servername = "localhost";
$username = "dfdgdfg54fd4";
$password = "dfdgdfg54fd4";
$dbname = "dfdgdfg54fd4";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imagePath = "";
    
    // Eğer yeni bir resim yükleniyorsa, işlemi yap
if (!empty($_FILES['image']['name'])) {
    $targetDir = "uploads/";
    $fileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)); // Dosya uzantısını al
    $allowedTypes = ['jpg', 'jpeg', 'png']; // İzin verilen uzantılar

    if (in_array($fileType, $allowedTypes)) {
        $imagePath = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    } else {
        echo "<script>alert('Sadece JPG ve PNG formatları destekleniyor!');</script>";
    }
}


    if (isset($_POST['create'])) {
        $stmt = $conn->prepare("INSERT INTO tokens (name, deposit, earn, daily_earnings, image_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $_POST['name'], $_POST['deposit'], $_POST['earn'], $_POST['daily_earnings'], $imagePath);
        $stmt->execute();
    } elseif (isset($_POST['update'])) {
        if ($imagePath === "") {
            $stmt = $conn->prepare("UPDATE tokens SET name=?, deposit=?, earn=?, daily_earnings=? WHERE id=?");
            $stmt->bind_param("ssssi", $_POST['name'], $_POST['deposit'], $_POST['earn'], $_POST['daily_earnings'], $_POST['id']);
        } else {
            $stmt = $conn->prepare("UPDATE tokens SET name=?, deposit=?, earn=?, daily_earnings=?, image_url=? WHERE id=?");
            $stmt->bind_param("sssssi", $_POST['name'], $_POST['deposit'], $_POST['earn'], $_POST['daily_earnings'], $imagePath, $_POST['id']);
        }
        $stmt->execute();
    } elseif (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM tokens WHERE id=?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
    }
}

$result = $conn->query("SELECT * FROM tokens");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Token Yönetimi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        h1 { color: #ffcc00; }
        form {
            background-color: #1e1e1e;
            padding: 15px;
            border-radius: 8px;
            margin: 10px auto;
            display: inline-block;
            width: 300px;
            text-align: left;
        }
        input, button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            background: #333;
            color: white;
            border: 1px solid #555;
            border-radius: 4px;
        }
        button { cursor: pointer; }
        button:hover { background: #ffcc00; color: black; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #1e1e1e;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }
        th { background-color: #333; }
        img { width: 50px; border-radius: 5px; }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .delete-btn, .update-btn {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .delete-btn { background: red; color: white; }
        .update-btn { background: orange; color: black; }
        .delete-btn:hover { background: darkred; }
        .update-btn:hover { background: darkorange; }
    </style>
</head>
<body>

    <h1>Admin Panel - Token Yönetimi</h1>

    <h2>Token Ekle</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Token Adı" required><br>
        <input type="text" name="deposit" placeholder="Deposit" required><br>
        <input type="text" name="earn" placeholder="Earn" required><br>
        <input type="text" name="daily_earnings" placeholder="Daily Earnings" required><br>
        <input type="file" name="image" required><br>
        <button type="submit" name="create">Ekle</button>
    </form>

    <h2>Token Listesi</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Token Adı</th>
            <th>Deposit</th>
            <th>Earn</th>
            <th>Daily Earnings</th>
            <th>Görsel</th>
            <th>İşlemler</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['deposit'] ?></td>
            <td><?= $row['earn'] ?></td>
            <td><?= $row['daily_earnings'] ?>%</td>
            <td><img src="<?= $row['image_url'] ?>"></td>
            <td class="action-buttons">
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="delete" class="delete-btn">Sil</button>
                </form>
                <button onclick="fillUpdateForm(<?= $row['id'] ?>, '<?= $row['name'] ?>', '<?= $row['deposit'] ?>', '<?= $row['earn'] ?>', '<?= $row['daily_earnings'] ?>')" class="update-btn">Güncelle</button>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Token Güncelle</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="update_id">
        <input type="text" name="name" id="update_name" placeholder="Token Adı" required><br>
        <input type="text" name="deposit" id="update_deposit" placeholder="Deposit" required><br>
        <input type="text" name="earn" id="update_earn" placeholder="Earn" required><br>
        <input type="text" name="daily_earnings" id="update_daily_earnings" placeholder="Daily Earnings" required><br>
        <input type="file" name="image"><br>
        <button type="submit" name="update">Güncelle</button>
    </form>

    <script>
        function fillUpdateForm(id, name, deposit, earn, daily_earnings) {
            document.getElementById('update_id').value = id;
            document.getElementById('update_name').value = name;
            document.getElementById('update_deposit').value = deposit;
            document.getElementById('update_earn').value = earn;
            document.getElementById('update_daily_earnings').value = daily_earnings;
        }
    </script>

</body>
</html>

<?php $conn->close(); ?>
