<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/Monitoring.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new Monitoring($db);

    //get parameter
    $item->lokasi_id = isset($_GET['lokasi_id']) ? $_GET['lokasi_id'] : "";
    $item->lokasi_name = isset($_GET['lokasi_name']) ? $_GET['lokasi_name'] : "";
    $item->suhu_udara = isset($_GET['suhu_udara']) ? $_GET['suhu_udara'] : "";
    $item->kelembaban_udara = isset($_GET['kelembaban_udara']) ? $_GET['kelembaban_udara'] : "";
    $item->suhu_tanah = isset($_GET['suhu_tanah']) ? $_GET['suhu_tanah'] : "";
    //$item->kelembaban_tanah = isset($_GET['kelembaban_tanah']) ? $_GET['kelembaban_tanah'] : "";
    $item->kelembaban_tanah = "";
    $item->ketinggian_air = isset($_GET['ketinggian_air']) ? $_GET['ketinggian_air'] : "";
    $item->status_lokasi = isset($_GET['status_lokasi']) ? $_GET['status_lokasi'] : "";

    //Pakai body
    //$data = json_decode(file_get_contents("php://input"));

    //$item->id = $data->id;
    //$item->lokasi_Name = $data->lokasi_Name;
    //$item->created = date('Y-m-d H:i:s');

    try{
        if ($item->lokasi_id != "" && $item->suhu_udara != "" && $item->kelembaban_udara != "" 
                && $item->suhu_tanah != "" && $item->kelembaban_tanah != "" && $item->ketinggian_air != "" && $item->status_lokasi != "")
        {
            $message = $item->UpdateData();

                if ($message == "Data berhasil diupdate !")
                {
                    http_response_code(200);
                    
                }else{
                    http_response_code(404);
                }

                echo json_encode(
                    array("message" => $message)
                );
        }
        else
        {
            http_response_code(404);
            echo json_encode(
                array("message" => "Cek kembali parameter !")
            );
        }
    }catch(PDOException $exception){
        http_response_code(404);
        echo json_encode(
            array("message" => $exception->getMessage())
        );
    }
?>