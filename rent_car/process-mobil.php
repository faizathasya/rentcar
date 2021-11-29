<?php
include "connection.php";
if (isset($_POST["simpan_mobil"])) {
    # menampung data yang dikirim ke dalam variable
    $id_mobil = $_POST["id_mobil"];
    $nomor_mobil = $_POST["nomor_mobil"];
    $merk = $_POST["merk"];
    $jenis = $_POST["jenis"];
    $warna = $_POST["warna"];
    $tahun_pembuatan = $_POST["tahun_pembuatan"];
    $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];

    # manage upload file
    $fileName = $_FILES["pictures"]["name"]; // file name
    $extension = pathinfo($_FILES["pictures"]["name"]);
    $ext = $extension["extension"]; //ekstensi file 

    $pictures = time()."-".$fileName;

    # proses upload
    $folderName = "pictures/$pictures";
    if (move_uploaded_file($_FILES["pictures"]["tmp_name"],$folderName)) {
        # proses insert data ke table mobil 
        $sql ="insert into mobil values
        ('$id_mobil','$nomor_mobil','$merk','$jenis',
        '$warna','$tahun_pembuatan','$biaya_sewa_per_hari','$pictures')";

        # eksekusi perintah sql
        mysqli_query($connect, $sql);

        echo "Data mobil berhasil ditambahkan!";
        #direct ke halaman list mobil
        header("location:list-mobil.php");
    }
    else{
        echo "Upload data mobil gagal, silahkan coba lagi";
    }

}
elseif (isset($_POST["update_mobil"])) {
    # menampung data yang dikirim ke dalam variable
    $id_mobil = $_POST["id_mobil"];
    $nomor_mobil = $_POST["nomor_mobil"];
    $merk = $_POST["merk"];
    $jenis = $_POST["jenis"];
    $warna = $_POST["warna"];
    $tahun_pembuatan = $_POST["tahun_pembuatan"];
    $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];

    # jika update data beserta gambar
    if (!empty($_FILES["pictures"]["name"])) {
        #ambil data nama file yg akan dihapus
        $sql = "select * from mobil where id_mobil='$id_mobil'";
        $hasil = mysqli_query($connect, $sql);
        $mobil = mysqli_fetch_array($hasil);
        $oldFileName = $mobil["pictures"];

        # membuat path file yang lama
        $path = "cover/$oldFileName";

        # cek eksistensi file yg lama
        if (file_exists($path)) {
            # hapus file yg lama
            unlink($path); 
            # menghapus sebuah file
        }

        # membuat file nama baru
        $pictures = time()."-".$_FILES["pictures"]["name"];
        $folder = "pictures/$pictures";

        #proses upload file yg baru
        if (move_uploaded_file($_FILES["pictures"]["tmp_name"],$folder)) {
            $sql = "update buku set nomor_mobil='$nomor_mobil',
            merk='$merk',jenis='$jenis',
            warna='$warna',tahun_pembuatan='$tahun_pembuatan',
            biaya_sewa_per_hari='$biaya_sewa_per_hari',pictures='$pictures'
            where id_mobil='$id_mobil'";

            if (mysqli_query($connect, $sql)) {
                # jika update berhasil
                header("location:list-mobil.php");
            } else {
                # jika update gagal
                echo $sql;
                echo mysqli_error($connect);
            }
            
        }
    }
    #jika update data saja
    else {
        $sql = "update mobil set nomor_mobil='$nomor_mobil',
            merk='$merk',jenis='$jenis',
            warna='$warna',tahun_pembuatan='$tahun_pembuatan',
            biaya_sewa_per_hari='$biaya_sewa_per_hari'
            where id_mobil='$id_mobil'";

            if (mysqli_query($connect, $sql)) {
                # jika update berhasil
                header("location:list-mobil.php");
            } else {
                # jika update gagal
                echo $sql;
                echo mysqli_error($connect);
            }
    }
}

elseif (isset($_GET["id_mobil"])) {
    $id_mobil = $_GET["id_mobil"];
    # ambil data dari tabel mobil sesuai id_mobil yg dikirim
    $sql = "select * from mobil where id_mobil='$id_mobil'";
    $hasil = mysqli_query($connect, $sql);
    $mobil = mysqli_fetch_array($hasil);
    $oldFileName = $mobil["pictures"];

    # ambil data name yg dihapus
    $oldFileName = $mobil["id_mobil"];

    # membuat path file yg lama
    $path = "pictures/$oldFileName";

    # hapus file yg ada di folder
    # cek eksistensi yang lama
    if (file_exists($path)) {
        # hapus file yg lama
        unlink($path);
    }

    # hapus data yg ada di tabel mobil
    $sql = "delete from mobil where id_mobil='$id_mobil'";
    if (mysqli_query($connect, $sql)) {
        header("location:list-mobil.php");
    } else {
        mysqli_error($connect);
    }
}