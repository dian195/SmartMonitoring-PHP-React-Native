<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../Config/database.php';
    include_once '../../Class/Monitoring.php';

    $database = new DB();
    $db = $database->getConnection();

    $items = new Monitoring($db);
    $items->lokasi_id = isset($_GET['lokasi_id']) ? $_GET['lokasi_id'] : "";
    
    $stmt = $items->getDataMonitoring();
    $itemCount = $stmt->rowCount();

    //echo json_encode($itemCount);
    
    if($itemCount > 0){
        
        $userArr = array();
        //$userArr["body"] = array();
        //$userArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "lokasi_id" => $lokasi_id,
                "lokasi_name" => $lokasi_name,
                "Suhu_Udara" => $Suhu_Udara,
                "kelembaban_Udara" => $kelembaban_Udara,
                "Suhu_Tanah" => $Suhu_Tanah,
                //"Kelembaban_Tanah" => $Kelembaban_Tanah,
                "Ketinggian_Air" => $Ketinggian_Air,
                "Last_Update" => $Last_Update,
                "Status_Lokasi" => $Status_Lokasi
            );

            array_push($userArr, $e);
        }
        
        http_response_code(200);
        echo json_encode($userArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Data not found.")
        );
    }
?>