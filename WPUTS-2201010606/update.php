<?php
// Menghubungkan dengan file koneksi.php
require_once('koneksi.php');

// Sistem update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Mendapatkan data dari form update
  $id = $_POST['nim'];
  $judul = $_POST['nama'];
  $gender = $_POST['gender'];
  $kategori = $_POST['jurusan'];
  
  // Update data MAHASISWA ke database
  $query = "UPDATE tb_mahasiswa SET 
      nama='$judul', 
      jurusan='$kategori', 
      gender='$gender' 
    WHERE nim='$id'";

  $result = mysqli_query($mysqli, $query);

  // Cek apakah update berhasil
  if($result) {
    // Memunculkan alert
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
  } else {
    echo "Update data MAHASISWA gagal";
  }
}

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

?>

<?php 
  // HEADER
  require_once('header.php');
?>

 <!-- konten -->
 <div class="container">
  <h5 class="text-center mt-5">TAMBAH MAHASISWA</h5>
  <form class="shadow rounded py-4 px-3 my-4" action="update.php?id=<?= $data['nim']; ?>" method="POST">
    <div class="mb-3">
      <label for="nim" class="form-label">Nim</label>
      <input required readonly type="text" class="form-control" id="nim" name="nim" value="<?= $data['nim'] ?>">
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input required type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
    </div>
    <div class="mb-3">
      <label for="jurusan" class="form-label">Jurusan</label>
      <select class="form-select" id="jurusan" name="jurusan">
        <option selected disabled>Pilih Jurusan</option>
        <option value="TI-MTI" <?php if ($data['jurusan'] == 'TI-MTI') { echo 'selected'; } ?>>TI-MTI</option>
        <option value="TI-KAB" <?php if ($data['jurusan'] == 'TI-KAB') { echo 'selected'; } ?>>TI-KAB</option>
        <option value="DKV" <?php if ($data['jurusan'] == 'DKV') { echo 'selected'; } ?>>DKV</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="gender" class="form-label">Jenis Kelamin</label>
      <select class="form-select" id="gender" name="gender">
        <option selected disabled>Pilih Jenis Kelamin</option>
        <option value="laki-laki" <?php if ($data['gender'] == 'laki-laki') { echo 'selected'; } ?>>Laki-Laki</option>
        <option value="perempuan" <?php if ($data['gender'] == 'perempuan') { echo 'selected'; } ?>>Perempuan</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
  </form>
</div>