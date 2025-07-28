<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Transaksi</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Transaksi</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 6%">No</th>
                    <th style="width: 20%;">Tanggal</th>
                    <th style="width: 23%;">Total</th>
                    <th style="width: 23%;">Status</th>
                    <th style="width: 200px"> Opsi</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($tbl_order as $key => $value): ?>
                    <tr>
                      <td><?php echo $page + $key + 1 ?></td>
                      <td><?php echo $value['tglOrder'] ?></td>
                      <td><?php echo number_format($value['grand_total']) ?></td>
                      <td>
                        <span class="badge bg-dark text-white p-2">
                          <?php echo $value['statusOrder'] ?>
                        </span>
                      </td>
                      <td>
                        <a href="" class="btn btn-info">Detail</a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>

            <!-- /.card-body -->
            <!-- pagination -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <?php
                $total_pages = ceil($total_rows / $per_page);
                $current = ($page / $per_page) + 1;

                // Tombol «
                if ($current > 1) {
                  $prev_page = $page - $per_page;
                  echo '<li class="page-item"><a class="page-link" href="' . site_url('transaksi/index/' . $prev_page) . '">&laquo;</a></li>';
                }

                // Nomor halaman
                for ($i = 1; $i <= $total_pages; $i++) {
                  $start = ($i - 1) * $per_page;
                  $active = ($i == $current) ? 'active' : '';
                  echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . site_url('transaksi/index/' . $start) . '">' . $i . '</a></li>';
                }

                // Tombol »
                if ($current < $total_pages) {
                  $next_page = $page + $per_page;
                  echo '<li class="page-item"><a class="page-link" href="' . site_url('transaksi/index/' . $next_page) . '">&raquo;</a></li>';
                }
                ?>
              </ul>
            </div>

          </div>

        </div>

      </div>
  </section>

</div>