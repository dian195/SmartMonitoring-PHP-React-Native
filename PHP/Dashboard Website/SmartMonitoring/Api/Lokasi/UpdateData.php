<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/Lokasi.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new Lokasi($db);

    //get parameter
    $item->id = isset($_GET['id']) ? $_GET['id'] : "";
    $item->lokasi_name = isset($_GET['lokasi_name']) ? $_GET['lokasi_name'] : "";
    $item->status = isset($_GET['status']) ? $_GET['status'] : "";

    //Pakai body
    //$data = json_decode(file_get_contents("php://input"));

    //$item->id = $data->id;
    //$item->lokasi_Name = $data->lokasi_Name;
    //$item->created = date('Y-m-d H:i:s');

    try{
        if ($item->id != "")
        {
            if($item->UpdateData()){
                http_response_code(200);
                echo json_encode(
                    array("message" => "Data berhasil disimpan !")
                );
            } else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Gagal insert data ! Cek isi parameter !")
                );
            }
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