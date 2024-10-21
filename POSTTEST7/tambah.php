<?php
require 'koneksi.php';
session_start();
date_default_timezone_set('Asia/Makassar');

if (isset($_POST['submit'])) {
    $nama_novel = $_POST['novel_name'];
    $comment = $_POST['reason'];

    $tmp_name = $_FILES['image']['tmp_name'];
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];

    $maxSize = 10 * 1024 * 1024;
    $validExtensions = ['jpg', 'jpeg', 'png', 'svg'];
    $fileExtension = explode('.', $file_name);
    $fileExtension = strtolower(end($fileExtension));

    if (!in_array($fileExtension, $validExtensions)) {
        echo "
            <script>
                alert('Format file tidak didukung!');
            </script>
        ";
    } elseif ($file_size > $maxSize) {
        echo "
            <script>
                alert('Ukuran file terlalu besar! Maksimal 10MB.');
                window.location.href = 'home.php';
            </script>
        ";
    } else {
        $newFileName = date('Y-m-d H.i.s') . '.' . $fileExtension;
        if (move_uploaded_file($tmp_name, __DIR__.'/assets/'.$newFileName)){
            $sql = "INSERT INTO komen (foto, nama_novel, comment, username) VALUES ('$newFileName', '$nama_novel', '$comment', '".$_SESSION['name']."')";
            $result = mysqli_query($conn, $sql);
            if($result) 
            {
                echo "
                    <script>
                        alert('Berhasil menambahkan saran baru!');
                        document.location.href = 'comment.php';
                    </script>";
            } 
            else 
            {
                echo "
                    <script>
                        alert('Gagal menambahkan saran!');
                        document.location.href = 'comment.php';
                    </script>";
            }
        } else
        {
            echo "
                <script>
                    alert('Gagal mengupload gambar!');
                </script>
            ";
        }
    }
}
?>