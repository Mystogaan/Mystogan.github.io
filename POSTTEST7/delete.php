<?php
    require 'koneksi.php';
    $id = $_GET['id'];
    $query = "DELETE FROM komen WHERE id = $id";
    unlink(__DIR__.'/assets/'.$oldimg); // Hapus foto lama
    $result = mysqli_query($conn, $query);
    $result = mysqli_query($conn, "DELETE FROM komen WHERE id = $id");
    if ($result) {
        echo "
            <script>
                alert('Berhasil menghapus saran!');
                document.location.href = 'comment.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menghapus saran!');
                document.location.href = 'comment.php';
            </script>
        ";
    }
?>