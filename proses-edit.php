<?php
include("config.php");

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah = $_POST['sekolah_asal'];

    if(isset($_POST['ubah_foto'])){
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        $fotobaru = date('dmYHis').$foto;
        $path = "images/".$fotobaru;

        if(move_uploaded_file($tmp, $path)){
            $sql= "Select * From calon_siswa WHERE id='$id'";
            $query = mysqli_query($db, $sql);
            $data = mysqli_fetch_array($query);
    
            if(is_file("images/".$data['foto'])) 
                unlink("images/".$data['foto']);
            
            $sql = "Update calon_siswa set nama='$nama', alamat='$alamat', jenis_kelamin='$jk', agama='$agama', sekolah_asal='$sekolah', foto='$fotobaru' Where id='$id'";
            $query = mysqli_query($db, $sql);
    
            if ($query) {
                header('Location: list-siswa.php');
            } else {
                die("Gagal menyimpan perubahan...");
            }
        } else{
            echo "alert(Maaf, Gambar gagal untuk diupload.)";
            header('Location: list-siswa.php');
        }
    } 
    else {
        $sql = "Update calon_siswa set nama='$nama', alamat='$alamat', jenis_kelamin='$jk', agama='$agama', sekolah_asal='$sekolah' Where id='$id'";
        $query = mysqli_query($db, $sql);

        if ($query) {
            header('Location: list-siswa.php');
        } else {
            die("Gagal menyimpan perubahan...");
        }
    }
} else{
    die('Akses Dilarang ...');
}