<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
header("location: ../otentikasi/index.php");
exit();
}

require "../config.php";

$title = "Pasien - Yakes Medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if ($dataUser['jabatan'] == 3) {
    echo "<script>
        alert('Halaman tidak ditemukan..');
        window.location = '../index.php';
    </script>";
    exit();
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Pasien</h1>
    </div>
    <a href="<?= $main_url?>pasien/tambah-pasien.php" class="btn 
    btn-outline-secondary btn-sm mb-3" title="tambah pasien baru">
    <i class="bi bi-plus-lg align-top"></i>Pasien Baru</a>


    <table class="table table-responsive table-hover" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pasien</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Telpon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $queryPasien = mysqli_query($koneksi, "SELECT * FROM 
            tbl_pasien");
            while($pasien = mysqli_fetch_assoc($queryPasien)){ ?>

            <tr>
                <td><?= $no++; ?></td>
                <td > <?= $pasien['id'] ?></td>
                <td><?= $pasien['nama'] ?></td>
                <td><?= in_date ($pasien ['tgl_lahir']) ?></td>
                <td>
                    <?php
                    if ($pasien['gender'] == 'P') {
                        echo 'Pria';
                    } else  {
                        echo 'Wanita';
                    }
                    ?>
                </td>
                <td><?= $pasien['telpon'] ?></td>
                <td><?= $pasien['alamat'] ?></td>
                <td>
                    <a href="edit-pasien.php?id=<?= $pasien 
                    ['id'] ?> "class="btn btn-sm btn-outline-warning" title="edit pasien">
                    <i class="bi bi-pen align-top"></i></a>

                    <a href="proses-pasien.php?id=<?= $pasien 
                    ['id'] ?>&aksi=hapus-pasien" onclick="return 
                    confirm('Anda yakin menghapus pasien ini ?')" 
                    class="btn btn-sm
                    btn-outline-danger" title="hapus pasien">
                    <i class="bi bi-trash align-top"></i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>
    
</main>



<?php

require "../template/footer.php"

?>
