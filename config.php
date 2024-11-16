<?php

date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sisteminformasi';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

// if(!$koneksi) {
//     die('Koneksi gagal!');
// } else {
//     echo "Koneksi berhasil!";
// }

$main_url = "http://localhost/sistem-informasi-klinik/";

function uploadGbr($url){
    $namefile   = $_FILES['gambar']['name'];
    $ukuran     = $_FILES['gambar']['size'];
    $tmp        = $_FILES['gambar']['tmp_name'];

    $ekstensiValid  = ['jpg','jpeg','png','gif'];
    $ekstensiFile   = explode('.', $namafile);
    $ekstensiFile   = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        echo "<script>
                alert('input user gagal, file bukan gambar!');
                window.location = '$url';
            </script>";
            die();
    }

    if ($ukuran > 1000000) {
        echo "<script>
                alert('input user gagal, maksimal ukuran gambar 1 MB!');
                window.location = '$url';
            </script>";
            die();
    }

    $namafileBaru = time() . '-' . $namafile;

    move_uploaded_file($tmp, '.../asset/gambar' . $namafileBaru);
    return $namafileBaru;
}
?>