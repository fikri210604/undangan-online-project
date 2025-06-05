<?php include("../includes/db.php"); 

// Pagination Data Setup
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query total data untuk pagination
$total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role = 'tamu'");
$total_result = mysqli_fetch_assoc($total_query);
$total_data = $total_result['total'];
$total_pages = ceil($total_data / $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
  <?php include "../asset/sidebar.php"; ?>

  <div class="container mt-4 p-4">
    <h2>Data User</h2>
    <div class="bg-light p-4 rounded shadow-lg mt-3">
      <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTamu">
          + Tambah Tamu
        </button>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr class="bg-primary text-white">
              <th class="bg-primary">No</th>
              <th class="bg-primary">Email</th>
              <th class="bg-primary">Nama Lengkap</th>
              <th class="bg-primary">Alamat</th>
              <th class="bg-primary">Kode Unik</th>
              <th class="bg-primary">Role</th>
              <th class="bg-primary">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $result = mysqli_query($conn, "SELECT * FROM users");
            $modals = "";

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
                    <button type='button' class='btn btn-warning btn-sm fas fa-edit' data-bs-toggle='modal' data-bs-target='#editTamu{$row['id']}'></button>
                    <a href='crud-tamu/hapus.php?id={$row['id']}' class='btn btn-danger btn-sm fas fa-trash' onclick='return confirm(\"Hapus data ini?\")'></a>
                  </td>
                </tr>
              ";

              // Buat modal edit user dan simpan di variabel
              $modals .= "
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
        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-4">
          <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=1">&laquo;</a>
            </li>
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page - 1 ?>">&lsaquo;</a>
            </li>
            <li class="page-item active">
              <span class="page-link"><?= $page ?></span>
            </li>
            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page + 1 ?>">&rsaquo;</a>
            </li>
            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $total_pages ?>">&raquo;</a>
            </li>
          </ul>
        </nav>
        <?php
        echo $modals;
        ?>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Tamu -->
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
              <input type="email" name="email" id="email" class="form-control" required />
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" id="nama" class="form-control" required />
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" name="alamat" id="alamat" class="form-control" required />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" required />
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

  <!-- Bootstrap JS dan Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXlROj0PqvGiDUO7q0A2KgG9c1F7e5Pbb6h1gIi6ZyZ4l4F8Lxa6EJfNhzFv"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"
    integrity="sha384-wH4PgLf4sS8vLHTmMTKYQhr9vVQ0pYhwN0DzKLIxtbd4OJJgUjG1zFoynQj1g3KG"
    crossorigin="anonymous"></script>
</body>

</html>