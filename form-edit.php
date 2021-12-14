<?php

include("config.php");

if (!isset($_GET['id'])) {
    // kalau tidak ada id di query string
    header('Location: list-siswa.php');
}

//ambil id dari query string
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM calon_siswa WHERE id=$id";
$query = mysqli_query($db, $sql);
$siswa = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if (mysqli_num_rows($query) < 1) {
    die("data tidak ditemukan...");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="d-flex h-100 text-white bg-secondary">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">

        <header class="p-3 bg-secondary text-white mb-auto">
            <div class="container-fluid">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="./index.php" class="nav-link px-2 text-white">Home</a></li>
                        <li><a href="./form-daftar.php" class="nav-link px-2 text-white">Daftar</a></li>
                        <li><a href="./list-siswa.php" class="nav-link px-2 text-white">List Pendaftar</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="px-3 mx-auto" style="max-width:42em">
            <div class="container p-0 card shadow border-0 rounded" style="min-width: 40rem;">
                <div class="card-header bg-success text-center">
                    <h3>Formulir Mahasiswa Baru</h3>
                </div>
                <form id="formMahasiswa" autocomplete="off" action="proses-edit.php" method="POST" class="bg-success text-white" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>">
                <div class="form-group mt-3 mx-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" placeholder="Nama Lengkap Calon Siswa" class="form-control" minlength="3" maxlength="40" value="<?php echo $siswa['nama'] ?>">
                </div>
                <div class="form-group mt-3 mx-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Alamat Lengkap Siswa"><?php echo $siswa['alamat'] ?></textarea>
                </div>
                <div class="form-group mt-3 mx-3">
                    <label for="sekolah_asal">Sekolah Asal</label>
                    <input type="text" name="sekolah_asal" placeholder="Sekolah Asal Calon Siswa" class="form-control" minlength="1" value="<?php echo $siswa['sekolah_asal'] ?>">
                </div>
                <div class="form-group mt-3 mx-3">
                    <label for="agama">Agama</label>
                    <?php $agama = $siswa['agama']; ?>
                    <select name="agama" class="form-control">
                        <option>Pilih Agama Calon Siswa</option>
                        <option <?php echo ($agama == 'Islam') ? "selected" : "" ?>>Islam</option>
                        <option <?php echo ($agama == 'Kristen') ? "selected" : "" ?>>Kristen</option>
                        <option <?php echo ($agama == 'Hindu') ? "selected" : "" ?>>Hindu</option>
                        <option <?php echo ($agama == 'Budha') ? "selected" : "" ?>>Budha</option>
                        <option <?php echo ($agama == 'Atheis') ? "selected" : "" ?>>Atheis</option>
                    </select>
                </div>
                <div class="form-group mt-3 mx-3">
                    <label for="jenis_kelamin">Jenis Kelamin</label><br>
                    <?php $jk = $siswa['jenis_kelamin']; ?>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" <?php echo ($jk == 'Laki-laki') ? "checked" : "" ?>> Laki-laki<br>
                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo ($jk == 'Perempuan') ? "checked" : "" ?>> Perempuan<br>
                </div>
                <div class="form-group mt-3 mx-3">
                    <label for="foto">Foto</label><br><br>
                    <input type="file" name="foto" value=""><br><br>
                    <input type="checkbox" name="ubah_foto" value="true"> Centang jika ingin mengubah foto<br>
                </div>
                <button name="simpan" type="submit" class="btn btn-primary form-group mt-3 mx-3 my-4" style="margin-top: 20px;">Simpan</button>
            </form>
            </div>
        </main>

        <footer class="mt-auto text-white-50 text-center">
            <p>powered by <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>