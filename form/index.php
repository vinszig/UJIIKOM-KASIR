<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
    <title>login</title>
</head>

<body>
    <div class="container">
        <div class="judul">
            LOGIN <br>
        </div>
        <form class="mt-4" action="cek_login.php" method="post">
            <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "gagal") {
                    echo "<div class='eror'><p>Username atau Password tidak sesuai !</p></div>";
                }
            }
            ?>
            <div class="form">
                <div class="input">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="inputt" placeholder="Enter username" name="username">
                </div>
                <div class="input">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="inputt" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="input">
                    <button type="submit" class="btn">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>