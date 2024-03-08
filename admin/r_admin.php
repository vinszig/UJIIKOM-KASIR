<?php
require '../koneksi_database/koneksi.php';

function admin($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

$hasil = admin("SELECT * FROM organisasi WHERE level='admin'");

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
                    <a class="active" href="#">Admin</a>
                </li>
            </ul>
        </div>
        <!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download'></i>
					<span class="text">Download PDF</span>
				</a> -->
    </div>

    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Daftar Admin</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($hasil as $admin_all) : ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $admin_all['username']; ?></td>
                            <td><?php echo $admin_all['nama']; ?></td>
                            <td><?php echo $admin_all['password']; ?></td>
                        </tr>
                        <?php $count++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>