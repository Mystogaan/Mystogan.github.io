<?php
    require 'koneksi.php';
    $id = $_GET['id'];
    $query = "DELETE FROM komen WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "
            <script>
                alert('Berhasil menghapus komentar!');
                document.location.href = 'comment.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menghapus komentar!');
                document.location.href = 'comment.php';
            </script>
        ";
    }
?>