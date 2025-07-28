  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Tambah Voucher</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Voucher</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Data Voucher</h3>
              </div>
              <!-- form start -->
              <form class="form-horizontal" method="post" action="<?php echo site_url('voucher/save');?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputKode" class="col-sm-3 col-form-label">Kode Voucher</label>
                    <div class="col-sm-9">
                      <input type="text" name="kdVoucher" class="form-control" id="inputKode" placeholder="Kode Voucher">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputTgl" class="col-sm-3 col-form-label">Tanggal Berakhir</label>
                    <div class="col-sm-9">
                      <input type="date" name="tglBerakhir" class="form-control" id="inputTgl" placeholder="Tanggal Berakhir">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputNominal" class="col-sm-3 col-form-label">Nominal Diskon</label>
                    <div class="col-sm-9">
                      <input type="number" name="nominalDskn" class="form-control" id="inputNominal" placeholder="Nominal Diskon">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Simpan</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
