<?php
function pegawai($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

$hasil = pegawai("SELECT * FROM organisasi WHERE level='pegawai'");

// query untuk nambah data
function tambah($tambah_produk)
{
    global $koneksi;
    $username_pegawai = htmlspecialchars($tambah_produk['username_pegawai']);
    $nama_pegawai = htmlspecialchars($tambah_produk['nama_pegawai']);
    $password = $tambah_produk['password_pegawai1'];
    $password2 = $tambah_produk['password_pegawai2'];

    //cek username

    $result = mysqli_query($koneksi, "SELECT username FROM organisasi WHERE username   = '$username_pegawai'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username telah dipakai! coba username lain')
    </script>";
        return false;
    }

    //konfirm pass

    if ($password !== $password2) {
        echo "<script>
       alert ('Konfirmasi tidak sesuai')
        </script>";

        return false;
    }

    //menambahkan data ke database


    $insert = "INSERT INTO `organisasi`(`username`, `nama`, `password`, `level`) 
    VALUES ('$username_pegawai','$nama_pegawai','$password','pegawai')";

    mysqli_query($koneksi, $insert);

    return mysqli_affected_rows($koneksi);
}

if (isset($_POST["submit"])) {


    if (tambah($_POST) > 0) {
        echo "
        <script>
        alert('Berhasil Di Tambahkan');
        document.location.href ='?page=petugas/crud_pegawai';
        </script>";
    } else {
        echo "<script>
        alert('Gagal! Di Tambahkan');
        </script>";
    }
}

?>
<main>
    <div class="head-title">
        <!-- navigasi mini -->
        <div class="left">
            <ul class="breadcrumb">
                <li>
                    <a href="?page=dashboard" class="active">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Petugas</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <a href="#divOne" class="btn-tambah">
                <i class='bx bx-list-plus'></i>
                <span class="text">Tambah Pegawai</span>
            </a>
        </div>
    </div>


    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Daftar Petugas
                </h3>
                <span class="btn-cari">
                    <input type="text" id="myInput" class="cari" onkeyup="myFunction()" placeholder="Cari Nama.." title="Type in a name">
                    <i class="bx bx-search"></i>
                </span>

                <i class='bx bx-filter'></i>
            </div>
            <table id="myTable">
                <thead class="header">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($hasil as $pegawai_data) : ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $pegawai_data['username']; ?></td>
                            <td><?php echo $pegawai_data['nama']; ?></td>

                            <td>
                                <a href="?page=petugas/hapus&id=<?php echo $pegawai_data['id'] ?>" class="hapus" onclick="return confirm('Yakin Di Hapus')"><i class='bx bxs-trash'></i></a>
                                &nbsp; | &nbsp;
                                <a href="?page=petugas/edit&id=<?php echo $pegawai_data['id'] ?>" class="edit"><i class='bx bx-edit'></i></a>
                            </td>
                        </tr>
                        <?php $count++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<!-- POP UP FORM -->
<div class="overlay" id="divOne">
    <div class="wraper">
        <a href="#" class="close">&times;</a>
        <div class="konten">
            <div class="kontener">
                <form action="" method="post">
                    <label>USERNAME</label><br>
                    <input type="text" placeholder="Username Pegawai" name=" username_pegawai" required><br>
                    <label>NAMA</label><br>
                    <input type="text" placeholder="Nama Pegawai" name=" nama_pegawai" required><br>
                    <label>PASSWORD</label><br>
                    <input type="password" placeholder="Password" name=" password_pegawai1" required><br>
                    <label>KONFIR PASSWORD</label><br>
                    <input type="password" placeholder="Password" name=" password_pegawai2" required><br>
                    <input class="tomobol" type="submit" value="submit" name="submit">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Jawa script -->
<!-- search data -->
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<!-- sorting data -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filterIcon = document.querySelector('.bx-filter');
        const tableBody = document.querySelector('table tbody');
        let sortOrder = 'asc'; // Initial sorting order

        filterIcon.addEventListener('click', function() {
            // Get the column index to sort (assuming the first column is the numeric index)
            const columnIndex = 0;

            // Clone the rows into an array for sorting
            const rows = Array.from(tableBody.querySelectorAll('tr'));

            // Sort the rows based on the text content of the specified column
            rows.sort((a, b) => {
                const aValue = a.cells[columnIndex].textContent.trim();
                const bValue = b.cells[columnIndex].textContent.trim();
                return sortOrder === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            });

            // Empty the table body
            tableBody.innerHTML = '';

            // Append the sorted rows back to the table body
            rows.forEach(row => tableBody.appendChild(row));

            // Toggle the sort order for the next click
            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
        });
    });
</script>