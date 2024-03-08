<?php
include '../koneksi_database/koneksi.php';

function register($data)
{
    global $koneksi;

    //variable sama seperti "name" di input 

    $nama = strtolower(stripslashes($data["nama"]));
    $alamat = ($data["alamat"]);
    $notlp = ($data["notp"]);
    // $password = ($data["password"]);
    // $password2 = ($data["password2"]);


    //cek username

    $result = mysqli_query($koneksi, "SELECT nama_pelanggan FROM pelanggan WHERE nama_pelanggan   = '$nama'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('nama telah dipakai! coba nama lain')
    </script>";
        return false;
    }

    //konfirm pass

    // if ($password !== $password2) {
    //     echo "<script>
    //    alert ('Konfirmasi tidak sesuai')
    //     </script>";

    //     return false;
    // }

    //menambahkan data ke database
    mysqli_query($koneksi, "INSERT INTO `pelanggan`(`nama_pelanggan`, `alamat`, `nomor_telepon`) 
    VALUES ('$nama','$alamat','$notlp')");

    return mysqli_affected_rows($koneksi);
}
if (isset($_POST["regis"])) {

    if (register($_POST) > 0) {
        echo "<script>
              alert('Anda Berhasil Terdaftar Menjadi Member');
          </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regis Member</title>
    <link rel="stylesheet" href="../css/form.css">
</head>

<body>
    <div class="container">
        <div class="judul">
            Register <br>
        </div>
        <form class="mt-4" action="" method="post">
            <div class="form">
                <div class="input">
                    <label>nama :</label>
                    <input type="text" class="inputt" placeholder="Enter username" name="nama" required>
                </div>
                <div class="input">
                    <label for="">Alamat :</label>
                    <input type="text" name="alamat" class="inputt" placeholder="alamat" required>
                </div>
                <div class="input">
                    <label for="">No tlp :</label>
                    <input type="text" name="notp" class="inputt" placeholder="nomer telepon" required>
                </div>
                <!-- <div class="input">
                    <label>Password :</label>
                    <input type="password" class="inputt" name="password" minlength="8" required>
                </div>
                <div class="input">
                    <label>Konfirmasi Password :</label>
                    <input type="password" class="inputt" name="password2" required>
                </div> -->
                <div class="input">
                    <button type="submit" class="btn" name="regis">Registrasi</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>