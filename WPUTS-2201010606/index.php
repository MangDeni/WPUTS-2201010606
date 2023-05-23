<?php
// menghubungkan dengan file koneksi.php
require_once('koneksi.php');

// READ DATA
function read_data() {
  global $mysqli;
  $query = "SELECT * FROM tb_mahasiswa";
  $result = mysqli_query($mysqli, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    return $data;
  } else {
    // Jika query kosong, kembalikan array kosong
    return array();
  }
}

// DELETE DATA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nim = $_POST['nim'];

  // Query untuk menghapus data MAHASISWA berdasarkan ID(nim)
  $query = "DELETE FROM tb_mahasiswa WHERE nim = '$nim'";

  // Eksekusi query
  if(mysqli_query($mysqli, $query)) {
    // Memunculkan alert
    echo "<div></div>";
    // Alert
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/backspace.css' rel='stylesheet'>
    <script>Swal.fire('Data Di Hapus!','Data Berhasil Di Hapus!','info')</script>
    ";
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
}


// Sistem cari data
function read_by_search() {
  global $mysqli;
  global $mulai_dari;

  $search_query = isset($_GET['search']) ? $_GET['search'] : '';

  $sql = "SELECT * FROM tb_mahasiswa WHERE nama LIKE '%$search_query%'";
  $result = mysqli_query($mysqli, $sql);

  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
      }
      return $data;
  } else {
      return array();
  }
}

// Panggil fungsi untuk membaca data
if (isset($_GET['search'])) {
  $data_tabel = read_by_search();
} else {
  $data_tabel = read_data();
}
?>

<?php 
  // HEADER
  require_once('header.php');
?>

<main class="container my-5">
  <!-- TABLE -->
  <div class="p-2 shadow">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="scope">Nim</th>
          <th class="scope">Nama</th>
          <th class="scope">Jurusan</th>
          <th class="scope">Jenis Kelamin</th>
          <th class="scope"></th>
        </tr>
      </thead>
      <tbody>
        <?php 
          for($i = 0; $i < count($data_tabel); $i++) {
        ?>
        <tr>
          <th scope="row"><?= $data_tabel[$i]['nim'] ?></th>
          <th scope="row"><?= $data_tabel[$i]['nama'] ?></th>
          <th scope="row"><?= $data_tabel[$i]['jurusan'] ?></th>
          <th scope="row"><?= $data_tabel[$i]['gender'] ?></th>
          <th scope="row">
            <div class="row">
              <div class="col">
                <a href="detail.php?id=<?= $data_tabel[$i]['nim'] ?>" style="width:100%" class="btn btn-primary">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 10.9794C11 10.4271 11.4477 9.97937 12 9.97937C12.5523 9.97937 13 10.4271 13 10.9794V16.9794C13 17.5317 12.5523 17.9794 12 17.9794C11.4477 17.9794 11 17.5317 11 16.9794V10.9794Z" fill="currentColor" /><path d="M12 6.05115C11.4477 6.05115 11 6.49886 11 7.05115C11 7.60343 11.4477 8.05115 12 8.05115C12.5523 8.05115 13 7.60343 13 7.05115C13 6.49886 12.5523 6.05115 12 6.05115Z" fill="currentColor" /><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12Z" fill="currentColor" /></svg>
                </a>
              </div>
              <div class="col">
                <a href="update.php?id=<?= $data_tabel[$i]['nim'] ?>" style="width:100%" class="btn btn-warning">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M21.2635 2.29289C20.873 1.90237 20.2398 1.90237 19.8493 2.29289L18.9769 3.16525C17.8618 2.63254 16.4857 2.82801 15.5621 3.75165L4.95549 14.3582L10.6123 20.0151L21.2189 9.4085C22.1426 8.48486 22.338 7.1088 21.8053 5.99367L22.6777 5.12132C23.0682 4.7308 23.0682 4.09763 22.6777 3.70711L21.2635 2.29289ZM16.9955 10.8035L10.6123 17.1867L7.78392 14.3582L14.1671 7.9751L16.9955 10.8035ZM18.8138 8.98525L19.8047 7.99429C20.1953 7.60376 20.1953 6.9706 19.8047 6.58007L18.3905 5.16586C18 4.77534 17.3668 4.77534 16.9763 5.16586L15.9853 6.15683L18.8138 8.98525Z" fill="currentColor" /><path d="M2 22.9502L4.12171 15.1717L9.77817 20.8289L2 22.9502Z" fill="currentColor" /></svg>
                </a>
              </div>
              <div class="col">
                <form action="index.php" method="POST">
                  <input type="hidden" value="<?= $data_tabel[$i]['nim'] ?>" name="nim">
                  <button type="submit" onclick="return confirm('Menghapus Data Mahasiswa')" style="width:100%" class="btn btn-danger">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.7427 8.46448L19.1569 9.87869L17.0356 12L19.157 14.1214L17.7428 15.5356L15.6214 13.4142L13.5 15.5355L12.0858 14.1213L14.2072 12L12.0859 9.87878L13.5002 8.46457L15.6214 10.5858L17.7427 8.46448Z" fill="currentColor" /><path fill-rule="evenodd" clip-rule="evenodd" d="M8.58579 19L2.29289 12.7071C1.90237 12.3166 1.90237 11.6834 2.29289 11.2929L8.58579 5H22.5857V19H8.58579ZM9.41421 7L4.41421 12L9.41421 17H20.5857V7H9.41421Z" fill="currentColor" /></svg>
                  </button>
                </form>
              </div>
            </div>
          </th>
        </tr>
        <?php 
          }
        ?>
      </tbody>
    </table>
  </div>
</main>