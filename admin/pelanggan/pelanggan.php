<?php
function pelanggan($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

$hasil = pelanggan("SELECT * FROM pelanggan WHERE pelangganID != 3;");


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
                    <a class="active" href="#">Pelanggan</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <a href="../../form/regis_member.php" target="_blank" class="btn-tambah">
                <i class='bx bx-list-plus'></i>
                <span class="text">Tambah Pelanggan</span>
            </a>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Daftar Pelanggan
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
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Tlp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($hasil as $pelanggan_data) : ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $pelanggan_data['nama_pelanggan']; ?></td>
                            <td><?php echo $pelanggan_data['alamat']; ?></td>
                            <td><?php echo $pelanggan_data['nomor_telepon']; ?></td>
                            <td>
                                <a href="?page=produk/hapus&pelangganID=<?php echo $pelanggan_data['pelangganID'] ?>" class="hapus" onclick="return confirm('Yakin Di Hapus')"><i class='bx bxs-trash'></i></a>
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
<!-- Jawa script -->
<!-- search data -->
<script>
    // wschol
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
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
    // chat gpt
    document.addEventListener("DOMContentLoaded", function() {
        const filterIcon = document.querySelector('.bx-filter');
        const tableBody = document.querySelector('table tbody');
        let sortOrder = 'asc'; 

        filterIcon.addEventListener('click', function() {
            const columnIndex = 0;

            const rows = Array.from(tableBody.querySelectorAll('tr'));

            rows.sort((a, b) => {
                const aValue = a.cells[columnIndex].textContent.trim();
                const bValue = b.cells[columnIndex].textContent.trim();
                return sortOrder === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            });

            tableBody.innerHTML = '';

            rows.forEach(row => tableBody.appendChild(row));

            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
        });
    });
</script>