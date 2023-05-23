<?php
// Menghubungkan dengan file koneksi.php
require('koneksi.php');

// Sistem tambah data
// cara cek adalah bila method request = POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // $_POST
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $jurusan = $_POST['jurusan'];
  $gender = $_POST['gender'];

  // Menambah data baru
  $sql = "INSERT INTO tb_mahasiswa (
      nim, 
      nama, 
      jurusan, 
      gender
    ) VALUES (
      '$nim', 
      '$nama', 
      '$jurusan', 
      '$gender'
    )";

  if (mysqli_query($mysqli, $sql)) {
    // Diisi untuk memunculkan alert
    echo "<div></div>";
    // Alert
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>
    <script>Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Berhasil Disimpan',
      showConfirmButton: false,
      timer: 1500
    })</script>
    ";
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
  <h5 class="text-center mt-5">TAMBAH MAHASISWA</h5>
  <form class="shadow rounded py-4 px-3 my-4" action="create.php" method="POST">
    <div class="mb-3">
      <label for="nim" class="form-label">Nim</label>
      <input required type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan Nim Anda">
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input required type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Lengkap">
    </div>
    <div class="mb-3">
      <label for="jurusan" class="form-label">Jurusan</label>
      <select class="form-select" id="jurusan" name="jurusan">
        <option selected disabled>Pilih Jurusan</option>
        <option value="TI-MTI">TI-MTI</option>
        <option value="TI-KAB">TI-KAB</option>
        <option value="DKV">DKV</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="gender" class="form-label">Jenis Kelamin</label>
      <select class="form-select" id="gender" name="gender">
        <option selected disabled>Pilih Jenis Kelamin</option>
        <option value="laki-laki">Laki-Laki</option>
        <option value="perempuan">Perempuan</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>