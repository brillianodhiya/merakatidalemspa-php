<?php
        include 'koneksi.php'; // Assume this is your database connection file
        $id = $_GET['id']; // Get the id from the URL
        $query = "DELETE FROM komhar WHERE id_komhar = '$id'"; // Query to delete the data
        $result = mysqli_query($koneksi, $query); // Execute the query
        if ($result) {
            echo "<script>alert('Data berhasil dihapus!')</script>";
            echo "<script>window.location ='?page=komhar'</script>";
        } else {
            echo "<script>alert('Data gagal dihapus!')</script>";
            echo "<script>window.location ='?page=komhar'</script>";
        }
?>