<?php
include("connection.php");
if (isset($_POST["simpan_karyawan"])) {
    # proses insert new data
    // tampung data input anggota dari user
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat_karyawan = $_POST["alamat_karyawan"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);

    // membuat perintah SQL utk insert data ke tbl anggota
    $sql = "insert into karyawan values ('',
    '$nama_karyawan','$alamat_karyawan','$kontak','$username','$password')";

    // eksekusi perintah / menjalankan perintah SQL
    # eksekusi perintah SQL
    if (mysqli_query($connect, $sql)) {
        header("location:list-karyawan.php");
    }else {
        echo mysqli_error($connect);
    }
}

if (isset($_POST["edit_karyawan"])) {
    # tampung data yg akan diupdate
    $id_karyawan = $_POST["id_karyawan"];
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat_karyawan = $_POST["alamat_karyawan"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);


    if (empty($_POST["password"])) {
        $sql = "update karyawan set
        nama_karyawan= '$nama_petugas',
        alamat_karyawan= '$alamat_karyawan',
        kontak= '$kontak',
        password= '$password',
        where id_karyawan= '$id_karyawan'";
    

        # eksekusi perintah SQL
        if (mysqli_query($connect, $sql)) {
            header("location:list-karyawan.php");
        }else {
            echo mysqli_error($connect);
        }
    }
}
?>