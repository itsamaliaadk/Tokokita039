<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manajemen Voucher Diskon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manajemen Voucher Diskon</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Voucher</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Kode Voucher</th>   
                      <th>Tanggal Berakhir</th>  
                      <th>Nominal Diskon</th>             
                      <th style="width: 150px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php $no=1; foreach($voucher as $val){?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $val->kode_voucher; ?></td>
                      <td><?php echo $val->tgl_berakhir; ?></td>
                      <td><?php echo $val->nominal_discount; ?></td>
                      <td><div class="btn-group">
                        <a href="<?php echo site_url('voucher/get_by_id/'.$val->id_voucher);?>" class="btn btn-warning">Edit</a>
                        <a href="<?php echo site_url('voucher/delete/'.$val->id_voucher);?>" onclick="return confirm('Yakin Akan Hapus Data Ini?')" class="btn btn-danger">Hapus</a></div>
                      </td>
                    </tr>
					<?php $no++; } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
			  <a href="<?php echo site_url('voucher/add');?>" class="btn btn-sm btn-info float-left">Tambah Voucher</a>
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
