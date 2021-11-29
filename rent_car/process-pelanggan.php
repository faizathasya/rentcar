<?php
include("connection.php");

if (isset($_POST["simpan_pelanggan"])) {
    // tampung data input anggota dari user
    
    $id_pelanggan = $_POST["id_pelanggan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $alamat_pelanggan = $_POST["alamat_pelanggan"];
    $kontak = $_POST["kontak"];

    //membuat perintah sql untuk insert data ke table anggota
    $sql = "insert into pelanggan values
    ('id_pelanggan','$nama_pelanggan','$alamat_pelanggan','$kontak')";

    //eksekusi perintah sql
    

    //direct ke halaman list-anggota
    if (mysqli_query($connect, $sql)) {
        header('Location:list-pelanggan.php');
    } else {
        printf('Gagal'.mysqli_error($connect));
        exit();
    }

# untuk update

}else if(isset($_POST["edit_pelanggan"])){
        # menampung dulu data yang akan di update
        $id_pelanggan = $_POST["id_pelanggan"];
        $nama_pelanggan = $_POST["nama_pelanggan"];
        $alamat_pelanggan = $_POST["alamat_pelanggan"];
        $kontak = $_POST["kontak"];
        
        $sql = "update pelanggan set id_pelanggan='$id_pelanggan',
        nama_pelanggan='$nama_pelanggan', alamat_pelanggan='$alamat_pelanggan',
        kontak='$kontak' where id_pelanggan='$id_pelanggan'";
        
        if (mysqli_query($connect, $sql)) {
            header('Location:list-pelanggan.php');
        } else {
            printf('Gagal'.mysqli_error($connect));
            exit();
        }
        
}
?>