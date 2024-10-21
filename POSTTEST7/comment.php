<?php
    require 'koneksi.php';
    $query = "SELECT * FROM komen";
    $result = mysqli_query($conn, $query);
    $komentar = [];
    while($row = mysqli_fetch_assoc($result)) {
        $komentar[] = $row;
    }

    $query = "SELECT * FROM user";
    $result = mysqli_query($conn, $query);
    $user = [];
    while($row = mysqli_fetch_assoc($result)) {
        $user[] = $row;
    }

    if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $query = "SELECT * FROM komen WHERE username LIKE '%$search%'";
        $result = mysqli_query($conn, $query);
        $komentar = [];
        while($row = mysqli_fetch_assoc($result)) {
            $komentar[] = $row;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/comment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'navbar.php'; ?>
    <br>
    <br>
    <br>
    <br>
    <!-- Search bar -->
    <form action="comment.php" method="post" class="search-bar">
        <input type="text" name="search" placeholder="Search Nama User">
    </form>

    <table class="comment-table" id="comment-table">
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Foto</th>
            <th>Nama Novel</th>
            <th>Komen</th>
            <th>Action</th>
        </tr>
        <?php foreach($komentar as $komen): ?>
            <tr>
                <td><?= $komen['id'] ?></td>
                <td><?= $komen['username'] ?></td>
                <td><img src="assets/<?= $komen['foto'] ?>" alt="Foto" width="100"></td>
                <td><?= $komen['nama_novel'] ?></td>
                <td><?= $komen['comment'] ?></td>
                <td>
                    <div class="action-icons">
                        <a href="edit.php?id=<?= $komen['id'] ?>">
                            <button class="edit-data">
                                <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                            </button>
                        </a>
                        <a href="delete.php?id=<?= $komen['id'] ?>" onclick="return confirm('Yakin untuk menghapus data ini?')">
                            <button class="delete-data">
                                <i class="fa-solid fa-trash-can" style="color: #ffffff;"></i>
                            </button>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <script>
        const search = document.querySelector('input[name="search"]');
        const commentTable = document.getElementById('comment-table');
        let timeoutId;

        search.addEventListener('keyup', function() {
            clearTimeout(timeoutId);
            
            timeoutId = setTimeout(() => {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', window.location.href, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(xhr.responseText, 'text/html');
                        const newTable = doc.getElementById('comment-table');
                        commentTable.innerHTML = newTable.innerHTML;
                    }
                };
                xhr.send('search=' + encodeURIComponent(search.value));
            }, 100); 
        });
    </script>
</body>
</html>
