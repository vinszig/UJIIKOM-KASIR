<?php
function produk($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

$hasil = produk("SELECT * FROM produk");

// query untuk nambah data
function tambah($tambah_paket)
{
    global $koneksi;
    $nama_p = htmlspecialchars($tambah_paket['nama_produk']);
    $harga = htmlspecialchars($tambah_paket['harga']);
    $stok = htmlspecialchars($tambah_paket['stok']);

    //cek nama priduk

    $result = mysqli_query($koneksi, "SELECT nama_produk FROM produk WHERE nama_produk   = '$nama_p'");

    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('nama produk sudah ada')
        </script>";
        return false;
    }


    $insert = "INSERT INTO `produk`(`nama_produk`, `harga`, `stok`) 
    VALUES ('$nama_p','$harga', '$stok')";


    mysqli_query($koneksi, $insert);

    return mysqli_affected_rows($koneksi);
}

if (isset($_POST["submit"])) {


    if (tambah($_POST) > 0) {
        echo "
        <script>
        alert('Berhasil Di Tambahkan');
        document.location.href ='?page=produk/crud_barang';
        </script>";
    } else {
        echo "<script>
        alert('Gagal! Di Tambahkan');
        document.location.href ='?page=produk/crud_barang';
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
                    <a class="active" href="#">Produk</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <a href="#divOne" class="btn-tambah">
                <i class='bx bx-list-plus'></i>
                <span class="text">Tambah Produk</span>
            </a>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Daftar Produk
                </h3>
                <span class="btn-cari">
                    <input type="text" id="searchInput" placeholder="Search..." class="cari">
                    <i class="bx bx-search"></i>
                </span>

                <i class='bx bx-filter'></i>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($hasil as $produk_data) : ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $produk_data['nama_produk']; ?></td>
                            <td><?php echo number_format($produk_data['harga']); ?></td>
                            <td><?php echo $produk_data['stok']; ?></td>
                            <td>
                                <!-- <a href="?page=produk/hapus&produkid=<?php echo $produk_data['produkID'] ?>" class="hapus" onclick="return confirm('Yakin Di Hapus')"><i class='bx bxs-trash'></i></a>
                                &nbsp; | &nbsp; -->
                                <a href="?page=produk/edit&produkid=<?php echo $produk_data['produkID'] ?>" class="edit"><i class='bx bx-edit'></i></a>
                            </td>
                        </tr>
                        <?php $count++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<!-- MAIN -->
<!-- POP UP FORM -->
<div class="overlay" id="divOne">
    <div class="wraper">
        <a href="#" class="close">&times;</a>
        <div class="konten">
            <div class="kontener">
                <form action="" method="post">
                    <label>Nama Produk</label><br>
                    <input type="text" placeholder="nama barang" name=" nama_produk" required><br>
                    <label>Harga</label><br>
                    <input type="number" placeholder="harga" name=" harga" required><br>
                    <label>stok</label><br>
                    <input type="number" placeholder="stok" name=" stok" required><br>
                    <input class="tomobol" type="submit" value="submit" name="submit">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Jawa script -->
<!-- search data -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchIcon = document.querySelector('.bx-search');
        const tableRows = document.querySelectorAll('table tbody tr');

        searchIcon.addEventListener('click', function() {
            // Get user input from a search input field (assuming the input has an ID of "searchInput")
            const searchInput = document.getElementById('searchInput').value.toLowerCase();

            // Loop through table rows to check for matches and display/hide rows accordingly
            tableRows.forEach(row => {
                const rowData = row.textContent.toLowerCase();
                if (rowData.includes(searchInput)) {
                    row.style.display = ''; // Show row if it matches search criteria
                } else {
                    row.style.display = 'none'; // Hide row if it doesn't match search criteria
                }
            });
        });
    });
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