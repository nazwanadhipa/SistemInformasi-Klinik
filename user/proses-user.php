<?php

require "../config.php";

if (isset($_POST['simpan'])) {
    $username   = trim(htmlspecialchars($_POST['username']));
    $nama       = trim(htmlspecialchars($_POST['fullname']));
    $jabatan    = $_POST['username'];
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $gambar     = htmlspecialchars($_FILES['gambar']['name']);
    $password   = trim(htmlspecialchars($_POST['password']));
    $password2  = trim(htmlspecialchars($_POST['password2']));

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername)) {
        echo "<script>
                alert('username sudah terpakai, user gagal di registrasi!');
                window.location = 'tambah-user.php';
        </script>";
        return;
    }

    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password anda tidak sesuai, user baru gagal di registrasi!');
                window.location = 'tambah-user.php';
        </script>";
        return;
    }

    $pass = password_hash ($password, PASSWORD_DEFAULT);

    if ($gambar != null) {
        $url = 'tambah-user.php';
        $gambar = uploadGbr($url);
    }else{
        $gambar = 'user.png';
    }

    mysli_query($koneksi, "INSERT INTO tbl_user VALUES (null, '$username', '$nama', '$pass', '$jabatan', '$alamat', '$gambar')");

    echo "<script>
            alert('User berhasil di registrasi!');
            window.location = 'tambah-user.php';
        </script>";
    return;
}

?>