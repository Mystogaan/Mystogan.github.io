<?php
    require 'koneksi.php';
    date_default_timezone_set('Asia/Makassar'); 

    $id = $_GET['id'];
    if (isset($_POST['update'])) {
        $nama_novel = $_POST['nama_novel'];
        $comment = $_POST['comment'];
        $oldimg = $_POST['oldimg'];

        if ($_FILES['foto']['error'] === 4) {
            $file_name = $oldimg;
        } else {
            $tmp_name = $_FILES['foto']['tmp_name'];
            $file_name = $_FILES['foto']['name'];
            $file_size = $_FILES['foto']['size'];

            $maxSize = 10 * 1024 * 1024; // 10MB dalam byte
            $validExtensions = ['jpg', 'jpeg', 'png', 'svg'];
            $fileExtension = explode('.', $file_name);
            $fileExtension = strtolower(end($fileExtension));

            if (!in_array($fileExtension, $validExtensions)) {
                echo "
                    <script>
                        alert('Format file tidak didukung!');
                    </script>
                ";
                exit;
            } elseif ($file_size > $maxSize) {
                echo "
                    <script>
                        alert('Ukuran file terlalu besar! Maksimal 10MB.');
                        window.location.href = 'home.php';
                    </script>
                ";
                exit;
            } else {
                $newFileName = date('Y-m-d H.i.s') . '.' . $fileExtension;
                if (move_uploaded_file($tmp_name, __DIR__.'/assets/'.$newFileName)) {
                    $foto = $newFileName;
                    if ($oldimg && file_exists(__DIR__.'/assets/'.$oldimg)) {
                        unlink(__DIR__.'/assets/'.$oldimg); // Hapus foto lama
                    }
                } else {
                    echo "
                        <script>
                            alert('Gagal mengupload gambar!');
                        </script>
                    ";
                    exit;
                }
            }
        }

        $query = "UPDATE komen SET nama_novel = ?, comment = ?, foto = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $nama_novel, $comment, $foto, $id);
        if ($stmt->execute()) {
            echo "
                <script>
                    alert('Data berhasil diupdate!');
                    window.location.href = 'comment.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Gagal mengupdate data!');
                </script>
            ";
        }
        $stmt->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/edit.css">
</head>
<body>
    <h1>Edit Comment</h1>
    <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM komen WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $komentar = $result->fetch_assoc();
        $stmt->close();

        $foto = $komentar['foto'];
        $nama_novel = $komentar['nama_novel'];
        $comment = $komentar['comment'];
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="oldimg" value="<?= $foto ?>">

        <div class="input-field">
            <label for="foto" class="label-field">Foto</label>
            <input type="file" name="foto" id="foto">
            <input type="hidden" name="foto_old" value="<?php echo $foto; ?>">
            <img src="assets/<?php echo $foto; ?>" alt="Current Photo" style="max-width: 100px; max-height: 100px;">
        </div>
        <div class="input-field">
            <label for="nama_novel" class="label-field">Nama Novel</label>
            <input type="text" name="nama_novel" id="nama_novel" value="<?php echo $nama_novel;?>" required>
        </div>
        <div class="input-field">
            <label for="comment" class="label-field">Comment</label>
            <textarea name="comment" id="comment" required><?php echo $comment; ?></textarea>
        </div>
        <input type="submit" value="Update" name="update" class="button">
    </form>
</body>
<script src="script/script.js"></script>
</html>