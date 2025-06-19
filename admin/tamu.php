<?php include("../includes/db.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .card-custom {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .table th {
      white-space: nowrap;
    }

    .form-control-sm {
      height: 38px;
    }

    .search-form .btn {
      height: 38px;
    }

    .modal-header {
      background-color: #0d6efd;
      color: white;
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    .modal-footer {
      border-bottom-left-radius: 0.5rem;
      border-bottom-right-radius: 0.5rem;
    }
  </style>
</head>

<body>
  <?php include "../asset/sidebar.php"; ?>

  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold text-dark">Manajemen Data User</h2>
      <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahTamu">
        <i class="bi bi-plus-circle me-1"></i> Tambah User
      </button>
    </div>

    <div class="card card-custom p-4">
      <form action="" method="GET" class="row g-2 align-items-center mb-3 search-form">
        <div class="col-md-6">
          <input type="text" name="cari" placeholder="Cari Nama Tamu..." class="form-control form-control-sm"
            value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
        </div>
        <div class="col-md-auto">
          <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i> Cari</button>
        </div>
      </form>

      <?php include("../includes/cari-user.php"); ?>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle table-striped">
          <thead class="table-primary text-center align-middle">
            <tr>
              <th>No</th>
              <th class="position-relative">
                Email
                <button type="button" class="btn btn-sm p-0 ms-1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-funnel-fill"></i>
                </button>
                <div class="dropdown-menu p-2">
                  <input type="text" name="filter_email" class="form-control form-control-sm"
                    placeholder="Cari Email..."
                    value="<?= isset($_GET['filter_email']) ? htmlspecialchars($_GET['filter_email']) : '' ?>">
                </div>
              </th>

              <th class="position-relative">
                Nama Lengkap
                <button type="button" class="btn btn-sm p-0 ms-1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-funnel-fill"></i>
                </button>
                <div class="dropdown-menu p-2">
                  <input type="text" name="filter_nama" class="form-control form-control-sm" placeholder="Cari Nama..."
                    value="<?= isset($_GET['filter_nama']) ? htmlspecialchars($_GET['filter_nama']) : '' ?>">
                </div>
              </th>

              <th class="position-relative">
                Alamat
                <button type="button" class="btn btn-sm p-0 ms-1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-funnel-fill"></i>
                </button>
                <div class="dropdown-menu p-2">
                  <input type="text" name="filter_alamat" class="form-control form-control-sm"
                    placeholder="Cari Alamat..."
                    value="<?= isset($_GET['filter_alamat']) ? htmlspecialchars($_GET['filter_alamat']) : '' ?>">
                </div>
              </th>

              <th class="position-relative">
                Kode Unik
                <button type="button" class="btn btn-sm p-0 ms-1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-funnel-fill"></i>
                </button>
                <div class="dropdown-menu p-2">
                  <input type="text" name="filter_kode" class="form-control form-control-sm" placeholder="Cari Kode..."
                    value="<?= isset($_GET['filter_kode']) ? htmlspecialchars($_GET['filter_kode']) : '' ?>">
                </div>
              </th>

              <th class="position-relative">
                Role
                <button type="button" class="btn btn-sm p-0 ms-1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-funnel-fill"></i>
                </button>
                <div class="dropdown-menu p-2">
                  <select name="filter_role" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <option value="admin" <?= (isset($_GET['filter_role']) && $_GET['filter_role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                    <option value="tamu" <?= (isset($_GET['filter_role']) && $_GET['filter_role'] == 'tamu') ? 'selected' : '' ?>>Tamu</option>
                  </select>
                </div>
              </th>

              <th>Aksi</th>
            </tr>
          </thead>

          <!-- Filter Data pada setiap Kolom-->
          <?php
          $email = isset($_GET['filter_email']) ? $_GET['filter_email'] : '';
          $nama = isset($_GET['filter_nama']) ? $_GET['filter_nama'] : '';
          $alamat = isset($_GET['filter_alamat']) ? $_GET['filter_alamat'] : '';
          $kode = isset($_GET['filter_kode']) ? $_GET['filter_kode'] : '';
          $role = isset($_GET['filter_role']) ? $_GET['filter_role'] : '';

          $query = "SELECT * FROM users WHERE 1=1";

          if (!empty($email)) {
            $query .= " AND email LIKE '%" . mysqli_real_escape_string($conn, $email) . "%'";
          }
          if (!empty($nama)) {
            $query .= " AND nama_lengkap LIKE '%" . mysqli_real_escape_string($conn, $nama) . "%'";
          }
          if (!empty($alamat)) {
            $query .= " AND alamat LIKE '%" . mysqli_real_escape_string($conn, $alamat) . "%'";
          }
          if (!empty($kode)) {
            $query .= " AND kode_unik LIKE '%" . mysqli_real_escape_string($conn, $kode) . "%'";
          }
          if (!empty($role)) {
            $query .= " AND role = '" . mysqli_real_escape_string($conn, $role) . "'";
          }
          $result = mysqli_query($conn, $query);
          ?>


          <tbody>
            <?php
            $limit = 10;
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            $cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';
            $role = "WHERE role IN ('tamu', 'admin')";
            if (!empty($cari)) {
              $role .= " AND nama LIKE '%$cari%'";
            }

            $total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users $role");
            $total_result = mysqli_fetch_assoc($total_query);
            $total_data = $total_result['total'];
            $total_pages = ceil($total_data / $limit);

            $query = "SELECT * FROM users $role ORDER BY id DESC LIMIT $limit OFFSET $offset";
            $result = mysqli_query($conn, $query);

            $no = $offset + 1;
            $modals = "";

            while ($row = mysqli_fetch_assoc($result)) {
              echo "
                <tr class='text-center'>
                  <td>$no</td>
                  <td>{$row['email']}</td>
                  <td>{$row['nama']}</td>
                  <td>{$row['alamat']}</td>
                  <td>{$row['kode_unik']}</td>
                  <td><span class='badge bg-secondary text-uppercase'>{$row['role']}</span></td>
                  <td>
                    <button class='btn btn-warning btn-sm me-1' data-bs-toggle='modal' data-bs-target='#editTamu{$row['id']}'><i class='bi bi-pencil-square'></i></button>
                    <a href='crud-tamu/hapus.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus data ini?\")'><i class='bi bi-trash'></i></a>
                    <a href='crud-tamu/kirim_email.php?id={$row['id']}' class='btn btn-primary btn-sm' target='_blank'><i class='bi bi-envelope-fill me-1'></i> Kirim Email</a>
                  </td>
                </tr>
              ";

              $modals .= "
                <div class='modal fade' id='editTamu{$row['id']}' tabindex='-1'>
                  <div class='modal-dialog'>
                    <form action='crud-tamu/edit.php' method='POST'>
                      <input type='hidden' name='id' value='{$row['id']}'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title'>Edit User</h5>
                          <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                        </div>
                        <div class='modal-body'>
                          <div class='mb-3'>
                            <label class='form-label'>Email</label>
                            <input type='email' name='email' class='form-control' value='{$row['email']}' required>
                          </div>
                          <div class='mb-3'>
                            <label class='form-label'>Nama Lengkap</label>
                            <input type='text' name='nama' class='form-control' value='{$row['nama']}' required>
                          </div>
                          <div class='mb-3'>
                            <label class='form-label'>Alamat</label>
                            <input type='text' name='alamat' class='form-control' value='{$row['alamat']}' required>
                          </div>
                          <div class='mb-3'>
                            <label class='form-label'>Password Baru (opsional)</label>
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

      <nav class="mt-4" aria-label="Navigasi halaman">
        <ul class="pagination justify-content-center">
          <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=1&cari=<?= urlencode($cari) ?>">&laquo;</a>
          </li>
          <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page - 1 ?>&cari=<?= urlencode($cari) ?>">&lsaquo;</a>
          </li>
          <li class="page-item active"><span class="page-link"><?= $page ?></span></li>
          <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page + 1 ?>&cari=<?= urlencode($cari) ?>">&rsaquo;</a>
          </li>
          <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $total_pages ?>&cari=<?= urlencode($cari) ?>">&raquo;</a>
          </li>
        </ul>
      </nav>

      <?= $modals ?>
    </div>
  </div>

  <!-- Modal Tambah User -->
  <div class="modal fade" id="tambahTamu" tabindex="-1">
    <div class="modal-dialog">
      <form action="crud-tamu/tambah.php" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <input type="text" name="alamat" class="form-control" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required />
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
