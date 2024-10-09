<?php
    require 'koneksi.php';
    $id = $_GET['id'];
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];
        $query = "UPDATE komen SET comment = '$comment' WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "
                <script>
                    alert('Berhasil mengubah komentar!');
                    document.location.href = 'comment.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Gagal mengubah komentar!');
                    document.location.href = 'comment.php';
                </script>
            ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/edit.css">
</head>
<body>
    <h1>Edit Comment</h1>
    <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM komen WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $komentar = [];
        while($row = mysqli_fetch_assoc($result)) {
            $komentar[] = $row;
        }
        $komentar = $komentar[0];
        $comment = $komentar['comment'];
    ?>
    <form action="" method="post">
        <div class="input-field">
            <label for="comment" class="label-field">Comment</label>
            <textarea name="comment" id="comment" value="<?php echo $comment;?>" required><?php echo $comment; ?></textarea>
        </div>
        <input type="submit" value="Update" name="update" class="button">
    </form>
</body>
<script src="script/script.js"></script>
</html>