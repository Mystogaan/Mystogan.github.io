<?php
    require 'koneksi.php';
    $query = "SELECT * FROM komen";
    $result = mysqli_query($conn, $query);
    $komentar = [];
    while($row = mysqli_fetch_assoc($result)) {
        $komentar[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/comment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'navbar.php'; ?>
    <br>
    <br>
    <br>
    <table class = "comment-container">
        <tr>
            <th>Id</th>
            <th>Komentar</th>
            <th>Action</th>
        </tr>
        <?php foreach($komentar as $komen): ?>
            <tr>
            <td><?= $komen['id'] ?></td>
            <td><?= $komen['comment'] ?></td>
            <td>
                <div>
                    <a href="edit.php?id=<?= $komen['id'] ?>">
                        <button class="edit-data">
                        <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                        </button>
                    </a>
                </div>
                <div>
                    <a href="delete.php?id=<?= $komen['id'] ?>" onclick="return confirm('Yakin untuk menghapus data ini?')">
                        <button class="delete-data">
                        <i class="fa-solid fa-trash-can" style="color: #ffffff;"></i>
                        </button>
                    </a>
                </div>
        </tr>
        <?php endforeach; ?>
    </table>
        <script src="script/script.js"></script>
</body>
</html>