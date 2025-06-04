<?php include("../includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <?php include "../asset/sidebar.php"; ?>
  <div class="container mt-4 p-4">
    <h2>Data User</h2>
    <div class="bg-light p-4 rounded shadow-lg mt-3">
      <div class="table-responsive"></div>
      <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTamu">
          + Tambah Tamu
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead class="bg-dark text-white">
            <tr>
              <th>No</th>
              <th>Email</th>
              <th>Nama Lengkap</th>
              <th>Alamat</th>
              <th>Kode Unik</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $result = mysqli_query($conn, "SELECT * FROM users");
            while ($row = mysqli_fetch_assoc($result)) {
              echo "
              <tr>
                <td>$no</td>
                <td>{$row['email']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['alamat']}</td>
                <td>{$row['kode_unik']}</td>
                <td>{$row['role']}</td>
                <td>
                  <button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editTamu{$row['id']}'>Edit</button>
                  <a href='crud-tamu/hapus.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus data ini?\")'>Hapus</a>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class='modal fade' id='editTamu{$row['id']}' tabindex='-1' aria-labelledby='editTamuLabel{$row['id']}' aria-hidden='true'>
                <div class='modal-dialog'>
                  <form action='crud-tamu/edit.php' method='POST'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='editTamuLabel{$row['id']}'>Edit User</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Tutup'></button>
                      </div>
                      <div class='modal-body'>
                        <div class='mb-3'>
                          <label for='email' class='form-label'>Email</label>
                          <input type='email' name='email' class='form-control' value='{$row['email']}' required>
                        </div>
                        <div class='mb-3'>
                          <label for='nama' class='form-label'>Nama Lengkap</label>
                          <input type='text' name='nama' class='form-control' value='{$row['nama']}' required>
                        </div>
                        <div class='mb-3'>
                          <label for='alamat' class='form-label'>Alamat</label>
                          <input type='text' name='alamat' class='form-control' value='{$row['alamat']}' required>
                        </div>
                        <div class='mb-3'>
                          <label for='password' class='form-label'>Password Baru (opsional)</label>
                          <input type='password' name='password' class='form-control' placeholder='Kosongkan jika tidak diubah'>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                        <button type='submit' class='btn btn-primary'>Simpan</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            ";
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>

  <!-- Modal Tambah -->
  <div class="modal fade" id="tambahTamu" tabindex="-1" aria-labelledby="tambahTamuLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="crud-tamu/tambah.php" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahTamuLabel">Tambah User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class='mb-3'>
              <label for='alamat' class='form-label'>Alamat</label>
              <input type='text' name='alamat' id="alamat" class='form-control' required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</body>

</html>