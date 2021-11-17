<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../Config/database.php';
include_once '../../Class/Grafik.php';

$database = new DB();
$db = $database->getConnection();

$items = new Grafik($db);
$items->kategori = isset($_GET['kategori']) ? $_GET['kategori'] : "0";
$items->lokasi_id = isset($_GET['lokasi_id']) ? $_GET['lokasi_id'] : "";

$stmt = $items->getDataTahunan();
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {

    $borderWidth = 1;
    $lineTension = 0.3;

    $userArr = array();
    $e = array();
    //$userArr["body"] = array();
    //$userArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        if ($items->lokasi_id == "") {

            http_response_code(404);
            $e = array(
                "lineTension" => floatval($lineTension),
                "label" => "",
                "data" => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
                "backgroundColor" => [
                    "rgba(153, 102, 255, 0.2)",
                ],
                "borderColor" => [
                    "rgba(153, 102, 255, 1)",
                ],
                "borderWidth" => floatval($borderWidth),
            );

            array_push($userArr, $e);

        } else {
            if ($items->kategori == "0" || $items->kategori == "1") //Temperature
            {
                $e = array(
                    "lineTension" => floatval($lineTension),
                    "label" => "Temperature",
                    "data" => [
                        floatval($suhu_udara_1), //intval untuk integer
                        floatval($suhu_udara_2),
                        floatval($suhu_udara_3),
                        floatval($suhu_udara_4),
                        floatval($suhu_udara_5),
                        floatval($suhu_udara_6),
                        floatval($suhu_udara_7),
                        floatval($suhu_udara_8),
                        floatval($suhu_udara_9),
                        floatval($suhu_udara_10),
                        floatval($suhu_udara_11),
                        floatval($suhu_udara_12),
                    ],
                    "backgroundColor" => [
                        "rgba(255, 99, 132, 0.2)",
                    ],
                    "borderColor" => [
                        "rgba(255, 99, 132, 1)",
                    ],
                    "borderWidth" => floatval($borderWidth),
                );

                array_push($userArr, $e);
            }

            if ($items->kategori == "0" || $items->kategori == "2") //Humidity
            {
                $e = array(
                    "lineTension" => floatval($lineTension),
                    "label" => "Humidity",
                    "data" => [
                        floatval($Kelembaban_Udara_1), //intval untuk integer
                        floatval($Kelembaban_Udara_2),
                        floatval($Kelembaban_Udara_3),
                        floatval($Kelembaban_Udara_4),
                        floatval($Kelembaban_Udara_5),
                        floatval($Kelembaban_Udara_6),
                        floatval($Kelembaban_Udara_7),
                        floatval($Kelembaban_Udara_8),
                        floatval($Kelembaban_Udara_9),
                        floatval($Kelembaban_Udara_10),
                        floatval($Kelembaban_Udara_11),
                        floatval($Kelembaban_Udara_12),
                    ],
                    "backgroundColor" => [
                        "rgba(54, 162, 235, 0.2)",
                    ],
                    "borderColor" => [
                        "rgba(54, 162, 235, 1)",
                    ],
                    "borderWidth" => floatval($borderWidth),
                );

                array_push($userArr, $e);
            }

            /*if ($items->kategori == "0" || $items->kategori == "3") //Soil Moisture
            {
                $e = array(
                    "lineTension" => floatval($lineTension),
                    "label" => "Soil Moisture",
                    "data" => [
                        floatval($Kelembaban_Tanah_1), //intval untuk integer
                        floatval($Kelembaban_Tanah_2),
                        floatval($Kelembaban_Tanah_3),
                        floatval($Kelembaban_Tanah_4),
                        floatval($Kelembaban_Tanah_5),
                        floatval($Kelembaban_Tanah_6),
                        floatval($Kelembaban_Tanah_7),
                        floatval($Kelembaban_Tanah_8),
                        floatval($Kelembaban_Tanah_9),
                        floatval($Kelembaban_Tanah_10),
                        floatval($Kelembaban_Tanah_11),
                        floatval($Kelembaban_Tanah_12),
                    ],
                    "backgroundColor" => [
                        "rgba(255, 206, 86, 0.2)",
                    ],
                    "borderColor" => [
                        "rgba(255, 206, 86, 1)",
                    ],
                    "borderWidth" => floatval($borderWidth),
                );

                array_push($userArr, $e);
            }*/

            if ($items->kategori == "0" || $items->kategori == "4") //Earth Temperature
            {
                $e = array(
                    "lineTension" => floatval($lineTension),
                    "label" => "Earth Temperature",
                    "data" => [
                        floatval($Suhu_Tanah_1), //intval untuk integer
                        floatval($Suhu_Tanah_2),
                        floatval($Suhu_Tanah_3),
                        floatval($Suhu_Tanah_4),
                        floatval($Suhu_Tanah_5),
                        floatval($Suhu_Tanah_6),
                        floatval($Suhu_Tanah_7),
                        floatval($Suhu_Tanah_8),
                        floatval($Suhu_Tanah_9),
                        floatval($Suhu_Tanah_10),
                        floatval($Suhu_Tanah_11),
                        floatval($Suhu_Tanah_12),
                    ],
                    "backgroundColor" => [
                        "rgba(75, 192, 192, 0.2)",
                    ],
                    "borderColor" => [
                        "rgba(75, 192, 192, 1)",
                    ],
                    "borderWidth" => floatval($borderWidth),
                );

                array_push($userArr, $e);
            }

            if ($items->kategori == "0" || $items->kategori == "5") //Water Level
            {
                $e = array(
                    "lineTension" => floatval($lineTension),
                    "label" => "Water Level",
                    "data" => [
                        floatval($Ketinggian_Air_1), //intval untuk integer
                        floatval($Ketinggian_Air_2),
                        floatval($Ketinggian_Air_3),
                        floatval($Ketinggian_Air_4),
                        floatval($Ketinggian_Air_5),
                        floatval($Ketinggian_Air_6),
                        floatval($Ketinggian_Air_7),
                        floatval($Ketinggian_Air_8),
                        floatval($Ketinggian_Air_9),
                        floatval($Ketinggian_Air_10),
                        floatval($Ketinggian_Air_11),
                        floatval($Ketinggian_Air_12),
                    ],
                    "backgroundColor" => [
                        "rgba(153, 102, 255, 0.2)",
                    ],
                    "borderColor" => [
                        "rgba(153, 102, 255, 1)",
                    ],
                    "borderWidth" => floatval($borderWidth),
                );

                array_push($userArr, $e);
            }
        }
    }

    http_response_code(200);
    echo json_encode($userArr);

} else {
    http_response_code(404);
    $e = array(
        "lineTension" => floatval($lineTension),
        "label" => "",
        "data" => [
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
        ],
        "backgroundColor" => [
            "rgba(153, 102, 255, 0.2)",
        ],
        "borderColor" => [
            "rgba(153, 102, 255, 1)",
        ],
        "borderWidth" => floatval($borderWidth),
    );

    array_push($userArr, $e);
    echo json_encode($userArr);
}
