<?php
include("connection-pelanggan.php");
if (isset ($_POST["simpan-pelanggan"])) {
    #proses insert new data
    // tampung data input pelanggan dari user
    $id_pelanggan = $_POST["id_pelanggan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $telepon = $_POST["telepon"];
    $alamat = $_POST["alamat"];

    //membuat perintah sql untuk insert data ke table pelanggan
    $sql = "insert into pelanggan values 
    ('$id_pelanggan', '$nama_pelanggan', '$alamat', '$telepon' )";

    //eksekusi perintah SQL
    mysqli_query($connect, $sql);

    //direct ke halaman list pelanggan
    header("location:list-pelanggan.php");
}

if (isset($_POST["edit_pelanggan"])) {
    #tampung data yang akan di update
    $id_pelanggan = $_POST["id_pelanggan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $telepon = $_POST["kontak"];
    $alamat = $_POST["alamat"];

    #perintah sql update ke tabel pelanggan
    $sql = "update pelanggan set nama_pelanggan ='$nama_pelanggan',
    kontak ='$kontak',alamat ='$alamat'  where id_pelanggan='$id_pelanggan'";

    #eksekusi perintah sql
    mysqli_query($connect, $sql);

    //redirect ke halaman list pelanggan
    header("location:list-pelanggan.php");
}
?>