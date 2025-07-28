  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Hitung Ongkir</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Hitung Ongkir</li>
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
                <h3 class="card-title">Ongkir</h3>
              </div>


              <!-- form start -->
               <div class="card-body">
                  <form action="#" method="POST">
                    
                    <!-- Pencarian Kota Asal -->
                    <div class="form-group">
                        <label for="search_from">Cari Kota Asal</label>
                        <input type="text" id="search_from" class="form-control" placeholder="Cari Kota Asal">
                    </div>
                    
                    <!-- Select Kota Asal -->
                    <div class="form-group">
                        <label for="city_from">Kota Asal</label>
                        <select id="city_from" name="city_from" class="form-control">
                           
                        </select>
                    </div>


                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function() {
        // Ketika user mengetik di search_from
        $('#search_from').on('keyup', function() {
            var search = $(this).val().toLowerCase();
         
            // Cek jika input tidak kosong
            if (search.length >= 2) {
                $.ajax({
                    url: '<?= base_url('index.php/adminpanel/search_kota') ?>',  // Ganti dengan URL API-mu
                    type: 'GET',
                    data: { kota: search },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        var cityFromSelect = $('#city_from');
                        cityFromSelect.empty();  // Kosongkan dropdown sebelumnya
                        cityFromSelect.append('<option value="">Pilih Kota Asal</option>'); // Default option

                         // Tambahkan hasil dari API ke dropdown
                         if (response && response.data) {
                                response.data.forEach(function(city) {
                                  cityFromSelect.append('<option value="' + city.id + '">' + city.label + '</option>');
                                });
                            } else {
                              cityFromSelect.append('<option value="">Tidak ada kota ditemukan</option>');
                            }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat memuat data kota.');
                    }
                });
            } else {
                // Kosongkan dropdown jika input terlalu pendek
                $('#city_from').empty();
                $('#city_from').append('<option value="">Pilih Kota Asal</option>');
            }
        });
      });
        


</script>