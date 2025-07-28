<!-- INI KODE ASLIKU YG KURIRNYA BLM BISA MILIH -->




<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shopping Cart</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>

                <tbody class="align-middle">
                    <?php foreach ($cartItems as $item) { ?>
                        <tr>
                            <td class="align-middle">
                                <img src="<?php echo base_url('assets/foto_produk/' . ($item['image'] ?? 'default.jpg')); ?>" alt="" style="width: 50px;"> Colorful Stylish Shirt
                            </td>
                            <td class="align-middle">Rp <?php echo $item['price']; ?></td>
                            <td class="align-middle">
                                <?php echo $item['qty']; ?>
                            </td>
                            <td class="align-middle">Rp <?php echo $item['price'] * $item['qty']; ?></td>
                            <td class="align-middle"><a href="<?php echo site_url('main/delete_cart/' . $item['rowid']); ?>"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="col-lg-4">
            <!-- Coupon -->
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code" name="kode_voucher" id="kode_voucher">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="btn-voucher">Apply Coupon</button>
                    </div>
                </div>
            </form>

            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium"><?php echo  $total; ?></h6>
                    </div>

                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Dikirim dari</h6>
                        <h6 class="font-weight-medium">
                            <?php
                            echo $this->session->userdata("kotaAsal");
                            ?>
                        </h6>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <h6 class="font-weight-medium">Dikirim ke</h6>
                        <h6 class="font-weight-medium">
                            <?php
                            echo $this->session->userdata("kotaTujuan");
                            ?>
                        </h6>
                    </div>

                    <!-- KURIR -->
                    <div class="d-flex justify-content-between">
                        <?php
                        $this->load->helper('toko');

                        $id_kota_asal = $this->session->userdata('idKotaAsal');
                        $id_kota_tujuan = $this->session->userdata('idKotaTujuan');
                        ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <select name="ongkir" id="ongkir" class="form-control">
                            <?php getOngkir($id_kota_asal, $id_kota_tujuan, '1000', 'jne:sicepat:jnt'); ?>
                        </select>
                    </div>

                    <!-- BIAYA KURIR -->
                    <div class="d-flex justify-content-between mt-3">
                        <h6 class="font-weight-medium">Biaya Kurir</h6>
                        <h6 class="font-weight-medium" id="biaya_ongkir"></h6>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <h6 class="font-weight-medium">Potongan Harga</h6>
                        <h6 class="font-weight-medium" id="potongan_harga"></h6>
                    </div>
                </div>

                <!-- Hidden input untuk diskon -->
                <input type="hidden" name="diskon" id="diskon_hidden" value="0">


                <!-- TOTAL FINAL -->
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold" id="total_final"></h5>
                    </div>

                    <button id="pay-button" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- midtrans form -->
<form id="payment-form" method="post" action="<?= site_url() ?>/main/finish">
    <input type="hidden" name="result_type" id="result-type" value=""></div>
    <input type="hidden" name="result_data" id="result-data" value=""></div>
</form>

<!-- Cart End -->

<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-0KyAHHYCoe79FBEy"></script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script type="text/javascript">
    var ongkir_value = 0;
    var diskon_value = 0;
    var totalBelanja = <?= $total; ?>; // ambil nilai total dari PHP

    // LOGIC ONGKIR
    $('#ongkir').change(function() {
        ongkir_value = parseInt($('#ongkir').val()) || 0;
        $('#biaya_ongkir').html('Rp' + ongkir_value.toLocaleString('id-ID'));

        let totalFinal = totalBelanja + ongkir_value - diskon_value;
        $("#total_final").text("Rp" + totalFinal.toLocaleString('id-ID'));
    });

    // logic add voucher
    $('#btn-voucher').click(function(e) {
        e.preventDefault();
        let kode = $('#kode_voucher').val();

        $.ajax({
            url: '<?= site_url() ?>/main/add_voucher',
            type: 'POST',
            data: {
                kode_voucher: kode
            },
            success: function(res) {
                let response = JSON.parse(res);

                if (response.status == 'valid') {
                    diskon_value = parseInt(response.nominal_discount);
                    $('#diskon_hidden').val(diskon_value); // set value
                    $('#potongan_harga').text('Rp' + diskon_value.toLocaleString('id-ID'));

                    let totalFinal = totalBelanja + ongkir_value - diskon_value;

                    $('#total_final').text('Rp' + totalFinal.toLocaleString('id-ID'));

                    alert('Voucher berhasil diterapkan! Diskon Rp' + diskon_value.toLocaleString('id-ID'));
                } else {
                    alert('Voucher tidak valid atau sudah expired');
                }
            }
        });
    });

    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        $.ajax({
            url: '<?= site_url() ?>/main/proses_transaksi',
            type: 'POST',
            data: {
                ongkir: ongkir_value,
                diskon: diskon_value
            },
            cache: false,

            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script>




<!-- NOTES YG BLM -->

<!-- 
- list kurir blm bisa muncul krn limit, bsk coba lg
- midtrans simulator
-->