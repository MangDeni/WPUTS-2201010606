<?php
// Menghubungkan dengan file koneksi.php
require_once('koneksi.php');

// Sistem tambah data

if (isset($_GET['id'])) {

  $nim = mysqli_real_escape_string($mysqli, $_GET['id']);

  // Query untuk ambil data
  $sql = "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'";

  // Eksekusi query
  $result = mysqli_query($mysqli, $sql);

  // Cek apakah data ditemukan
  if (mysqli_num_rows($result) > 0) {

    $data = mysqli_fetch_assoc($result);
  } else {
    // Jika data tidak ditemukan
    echo "Data tidak ditemukan.";
    $data = [];
  }

  mysqli_close($mysqli);
}

?>

<?php 
  // HEADER
  require_once('header.php');
?>

 <!-- konten -->
 <div class="container">
  <h5 class="text-center mt-5">DETAIL MAHASISWA</h5>
  <form class="shadow rounded py-4 px-3 my-4">
    <div class="mb-3">
      <label for="nim" class="form-label">Nim</label>
      <input readonly type="text" class="form-control" id="nim" name="nim" value="<?= $data['nim'] ?>">
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input readonly type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Jurusan</label>
      <input readonly type="text" class="form-control" id="nama" name="nama" value="<?= $data['jurusan'] ?>">
    </div>
    <div class="mb-3">
      <label for="gender" class="form-label">Jenis Kelamin</label>
      <input readonly type="text" class="form-control" id="gender" name="gender" value="<?= $data['gender'] ?>">
    </div>

  </form>
</div>