<?php if (! defined('BASEPATH')) exit('No direct script access allowed');


function getDetailCity($cityId)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=" . $cityId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: key_raja_ongkir_anda"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    return $data;
}

function getOngkir($origin, $destination, $weight, $courier)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            // GANTI KEY RAJA ONGKIR KITA = shipping cost
            "key: BzxlGtll01dab13b477ce625AZP7qoGq"
        ),
        CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier . "",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    $data = json_decode($response, true);

    echo "<option value=''>Pilih Kurir</option>";
    for ($i = 0; $i < count($data['data']); $i++) {
        echo "<option value='" . $data['data'][$i]['cost'] . "'>" . $data['data'][$i]['name'] . ", " . $data['data'][$i]['description'] . ", " . $data['data'][$i]['cost'] . "</option>";
    }

    // return $data;
}

function searchKota($nama_kota)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=" . $nama_kota . "&limit=5&offset=0",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: key_raja_ongkir_anda"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = $response;
    return $data;
}


// MASIH 0 SEMUA LIST KURIRNYA. BSK LIAT YG DR DOSEN GMN
// pop up midtrans gabisa. cek gpt terakhir blm - udh bisa lancar deng