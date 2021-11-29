<?php
include("connection.php");
# menampung data yang dikirim

$id_sewa = $_POST["id_sewa"];
$tgl_sewa = $_POST["tgl_sewa"];
$id_pelanggan = $_POST["id_pelanggan"];
$id_karyawan = $_POST["id_karyawan"];
$mobil = $_POST["id_mobil"]; 
$durasi = $_POST["jumlah_hari"];
//array
//$total_bayar = $_POST["total_bayar"];
$total_bayar=0;
print_r($_POST);
for ($i=0; $i < count($mobil); $i++) { 
    // select mobil
    $id_mobil = $mobil[$i];
    $sql = "select * from mobil where id_mobil ='".$id_mobil."'";
    $hasil = mysqli_query($connect, $sql);
    $car = mysqli_fetch_array($hasil);
    $biaya = $car["biaya_sewa_per_hari"];
    $total = $biaya * $durasi;
    $total_bayar += $total;
}

// $total_bayar = $total_bayar*$durasi;
# perintah SQL untuk insert ke table sewa
$sql = "insert into sewa values
('$id_sewa','$id_karyawan','$id_pelanggan','$tgl_sewa','$total_bayar','$durasi')";
echo $sql;

if (mysqli_query($connect, $sql)) {
    # jika berhasil insert ke tabel sewa
    # insert ke tabel detail sewa
    for ($i=0; $i < count($mobil); $i++) { 
        $id_mobil = $mobil[$i];
        $sql = "insert into detail_sewa values
        ('$id_sewa','$id_mobil')";
        if (mysqli_query($connect, $sql)) {
            
        }else {
            # jika gagal insert ke table detail_sewa
            echo mysqli_error($connect);
            exit;
        }
    }
    header('Location:list-sewa.php');
}else{
    # jia gagal insert tabel sewa
    echo mysqli_error($connect);
}
?>