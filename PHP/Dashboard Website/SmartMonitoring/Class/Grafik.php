<?php
class Grafik
{

    // conn
    private $conn;

    // table
    private $dbTable = "";

    // col
    public $id;
    public $lokasi_id;
    public $lokasi_name;
    public $suhu_udara;
    public $kelembaban_udara;
    public $suhu_tanah;
    public $kelembaban_tanah;
    public $ketinggian_air;
    public $last_update;
    public $status_lokasi;

    // db conn
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET Users
    public function getDataMingguan()
    {

        $sqlQuery = "";

        $sqlQuery = "select ifnull(sum(case when DATE(date_update) = date_1 then suhu_udara else 0 end), 0) suhu_udara_1,
                ifnull(sum(case when DATE(date_update) = date_2 then suhu_udara else 0 end), 0) suhu_udara_2,
                ifnull(sum(case when DATE(date_update) = date_3 then suhu_udara else 0 end), 0) suhu_udara_3,
                ifnull(sum(case when DATE(date_update) = date_4 then suhu_udara else 0 end), 0) suhu_udara_4,
                ifnull(sum(case when DATE(date_update) = date_5 then suhu_udara else 0 end), 0) suhu_udara_5,
                ifnull(sum(case when DATE(date_update) = date_6 then suhu_udara else 0 end), 0) suhu_udara_6,
                ifnull(sum(case when DATE(date_update) = date_7 then suhu_udara else 0 end), 0) suhu_udara_7,
                -- Kelembaban
                ifnull(sum(case when DATE(date_update) = date_1 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_1,
                ifnull(sum(case when DATE(date_update) = date_2 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_2,
                ifnull(sum(case when DATE(date_update) = date_3 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_3,
                ifnull(sum(case when DATE(date_update) = date_4 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_4,
                ifnull(sum(case when DATE(date_update) = date_5 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_5,
                ifnull(sum(case when DATE(date_update) = date_6 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_6,
                ifnull(sum(case when DATE(date_update) = date_7 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_7,
                -- suhu tanah
                ifnull(sum(case when DATE(date_update) = date_1 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_1,
                ifnull(sum(case when DATE(date_update) = date_2 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_2,
                ifnull(sum(case when DATE(date_update) = date_3 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_3,
                ifnull(sum(case when DATE(date_update) = date_4 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_4,
                ifnull(sum(case when DATE(date_update) = date_5 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_5,
                ifnull(sum(case when DATE(date_update) = date_6 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_6,
                ifnull(sum(case when DATE(date_update) = date_7 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_7,
                -- Kelembaban_Tanah
                ifnull(sum(case when DATE(date_update) = date_1 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_1,
                ifnull(sum(case when DATE(date_update) = date_2 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_2,
                ifnull(sum(case when DATE(date_update) = date_3 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_3,
                ifnull(sum(case when DATE(date_update) = date_4 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_4,
                ifnull(sum(case when DATE(date_update) = date_5 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_5,
                ifnull(sum(case when DATE(date_update) = date_6 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_6,
                ifnull(sum(case when DATE(date_update) = date_7 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_7,
                -- Ketinggian_Air
                ifnull(sum(case when DATE(date_update) = date_1 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_1,
                ifnull(sum(case when DATE(date_update) = date_2 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_2,
                ifnull(sum(case when DATE(date_update) = date_3 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_3,
                ifnull(sum(case when DATE(date_update) = date_4 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_4,
                ifnull(sum(case when DATE(date_update) = date_5 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_5,
                ifnull(sum(case when DATE(date_update) = date_6 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_6,
                ifnull(sum(case when DATE(date_update) = date_7 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_7,
                -- status_lokasi
                ifnull((case when DATE(date_update) = date_1 then status_lokasi else '' end), '') status_lokasi_1,
                ifnull((case when DATE(date_update) = date_2 then status_lokasi else '' end), '') status_lokasi_2,
                ifnull((case when DATE(date_update) = date_3 then status_lokasi else '' end), '') status_lokasi_3,
                ifnull((case when DATE(date_update) = date_4 then status_lokasi else '' end), '') status_lokasi_4,
                ifnull((case when DATE(date_update) = date_5 then status_lokasi else '' end), '') status_lokasi_5,
                ifnull((case when DATE(date_update) = date_6 then status_lokasi else '' end), '') status_lokasi_6,
                ifnull((case when DATE(date_update) = date_7 then status_lokasi else '' end), '') status_lokasi_7 from
                (SELECT max(update_time) date_update, lokasi_id, suhu_udara, Kelembaban_Udara, Suhu_Tanah, Kelembaban_Tanah, Ketinggian_Air, status_lokasi,
                DATE(rangedateinweeks.date_1) date_1, DATE(rangedateinweeks.date_2) date_2, DATE(rangedateinweeks.date_3) date_3, DATE(rangedateinweeks.date_4) date_4,
                DATE(rangedateinweeks.date_5) date_5, DATE(rangedateinweeks.date_6) date_6, DATE(rangedateinweeks.date_7) date_7 FROM rab_smartmon.tblmonitoring_his,
                rangedateinweeks where DATE(update_time) between DATE(rangedateinweeks.date_1) and DATE(rangedateinweeks.date_7) and lokasi_id=? group by lokasi_id, DATE(update_time)) dataa";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->lokasi_id);
        $stmt->execute();
        return $stmt;
    }

    public function getDataMingguanMobile()
    {

        $sqlQuery = "";

        $sqlQuery = "select ifnull(sum(case when DATE(date_update) = date_1 then suhu_udara else 0 end), 0) suhu_udara_1,
        ifnull(sum(case when DATE(date_update) = date_2 then suhu_udara else 0 end), 0) suhu_udara_2,
        ifnull(sum(case when DATE(date_update) = date_3 then suhu_udara else 0 end), 0) suhu_udara_3,
        ifnull(sum(case when DATE(date_update) = date_4 then suhu_udara else 0 end), 0) suhu_udara_4,
        ifnull(sum(case when DATE(date_update) = date_5 then suhu_udara else 0 end), 0) suhu_udara_5,
        ifnull(sum(case when DATE(date_update) = date_6 then suhu_udara else 0 end), 0) suhu_udara_6,
        ifnull(sum(case when DATE(date_update) = date_7 then suhu_udara else 0 end), 0) suhu_udara_7,
        -- Kelembaban
        ifnull(sum(case when DATE(date_update) = date_1 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_1,
        ifnull(sum(case when DATE(date_update) = date_2 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_2,
        ifnull(sum(case when DATE(date_update) = date_3 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_3,
        ifnull(sum(case when DATE(date_update) = date_4 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_4,
        ifnull(sum(case when DATE(date_update) = date_5 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_5,
        ifnull(sum(case when DATE(date_update) = date_6 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_6,
        ifnull(sum(case when DATE(date_update) = date_7 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_7,
        -- suhu tanah
        ifnull(sum(case when DATE(date_update) = date_1 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_1,
        ifnull(sum(case when DATE(date_update) = date_2 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_2,
        ifnull(sum(case when DATE(date_update) = date_3 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_3,
        ifnull(sum(case when DATE(date_update) = date_4 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_4,
        ifnull(sum(case when DATE(date_update) = date_5 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_5,
        ifnull(sum(case when DATE(date_update) = date_6 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_6,
        ifnull(sum(case when DATE(date_update) = date_7 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_7,
        -- Kelembaban_Tanah
        ifnull(sum(case when DATE(date_update) = date_1 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_1,
        ifnull(sum(case when DATE(date_update) = date_2 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_2,
        ifnull(sum(case when DATE(date_update) = date_3 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_3,
        ifnull(sum(case when DATE(date_update) = date_4 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_4,
        ifnull(sum(case when DATE(date_update) = date_5 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_5,
        ifnull(sum(case when DATE(date_update) = date_6 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_6,
        ifnull(sum(case when DATE(date_update) = date_7 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_7,
        -- Ketinggian_Air
        ifnull(sum(case when DATE(date_update) = date_1 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_1,
        ifnull(sum(case when DATE(date_update) = date_2 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_2,
        ifnull(sum(case when DATE(date_update) = date_3 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_3,
        ifnull(sum(case when DATE(date_update) = date_4 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_4,
        ifnull(sum(case when DATE(date_update) = date_5 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_5,
        ifnull(sum(case when DATE(date_update) = date_6 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_6,
        ifnull(sum(case when DATE(date_update) = date_7 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_7,
        -- status_lokasi
        ifnull((case when DATE(date_update) = date_1 then status_lokasi else '' end), '') status_lokasi_1,
        ifnull((case when DATE(date_update) = date_2 then status_lokasi else '' end), '') status_lokasi_2,
        ifnull((case when DATE(date_update) = date_3 then status_lokasi else '' end), '') status_lokasi_3,
        ifnull((case when DATE(date_update) = date_4 then status_lokasi else '' end), '') status_lokasi_4,
        ifnull((case when DATE(date_update) = date_5 then status_lokasi else '' end), '') status_lokasi_5,
        ifnull((case when DATE(date_update) = date_6 then status_lokasi else '' end), '') status_lokasi_6,
        ifnull((case when DATE(date_update) = date_7 then status_lokasi else '' end), '') status_lokasi_7 from
        (SELECT max(update_time) date_update, lokasi_id, suhu_udara, Kelembaban_Udara, Suhu_Tanah, Kelembaban_Tanah, Ketinggian_Air, status_lokasi,
        DATE(rangedateinweeks.date_1) date_1, DATE(rangedateinweeks.date_2) date_2, DATE(rangedateinweeks.date_3) date_3, DATE(rangedateinweeks.date_4) date_4,
        DATE(rangedateinweeks.date_5) date_5, DATE(rangedateinweeks.date_6) date_6, DATE(rangedateinweeks.date_7) date_7 FROM rab_smartmon.tblmonitoring_his, rab_smartmon.tbllokasi,
        rangedateinweeks where rab_smartmon.tblmonitoring_his.lokasi_id=rab_smartmon.tbllokasi.id and DATE(update_time) between DATE(rangedateinweeks.date_1) and DATE(rangedateinweeks.date_7) and rab_smartmon.tbllokasi.lokasi_name=? group by lokasi_id, DATE(update_time)) dataa";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->lokasi_id);
        $stmt->execute();
        return $stmt;
    }

    public function getDataTahunan()
    {

        $sqlQuery = "";

        $sqlQuery = "select 
        ifnull(avg(case when MONTH(date_update) = 1 then suhu_udara else 0 end), 0) suhu_udara_1,
        ifnull(avg(case when MONTH(date_update) = 2 then suhu_udara else 0 end), 0) suhu_udara_2,
        ifnull(avg(case when MONTH(date_update) = 3 then suhu_udara else 0 end), 0) suhu_udara_3,
        ifnull(avg(case when MONTH(date_update) = 4 then suhu_udara else 0 end), 0) suhu_udara_4,
        ifnull(avg(case when MONTH(date_update) = 5 then suhu_udara else 0 end), 0) suhu_udara_5,
        ifnull(avg(case when MONTH(date_update) = 6 then suhu_udara else 0 end), 0) suhu_udara_6,
        ifnull(avg(case when MONTH(date_update) = 7 then suhu_udara else 0 end), 0) suhu_udara_7,
        ifnull(avg(case when MONTH(date_update) = 8 then suhu_udara else 0 end), 0) suhu_udara_8,
        ifnull(avg(case when MONTH(date_update) = 9 then suhu_udara else 0 end), 0) suhu_udara_9,
        ifnull(avg(case when MONTH(date_update) = 10 then suhu_udara else 0 end), 0) suhu_udara_10,
        ifnull(avg(case when MONTH(date_update) = 11 then suhu_udara else 0 end), 0) suhu_udara_11,
        ifnull(avg(case when MONTH(date_update) = 12 then suhu_udara else 0 end), 0) suhu_udara_12,
        -- Kelembaban
        ifnull(avg(case when MONTH(date_update) = 1 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_1,
        ifnull(avg(case when MONTH(date_update) = 2 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_2,
        ifnull(avg(case when MONTH(date_update) = 3 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_3,
        ifnull(avg(case when MONTH(date_update) = 4 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_4,
        ifnull(avg(case when MONTH(date_update) = 5 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_5,
        ifnull(avg(case when MONTH(date_update) = 6 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_6,
        ifnull(avg(case when MONTH(date_update) = 7 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_7,
        ifnull(avg(case when MONTH(date_update) = 8 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_8,
        ifnull(avg(case when MONTH(date_update) = 9 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_9,
        ifnull(avg(case when MONTH(date_update) = 10 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_10,
        ifnull(avg(case when MONTH(date_update) = 11 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_11,
        ifnull(avg(case when MONTH(date_update) = 12 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_12,
        -- suhu tanah
        ifnull(avg(case when MONTH(date_update) = 1 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_1,
        ifnull(avg(case when MONTH(date_update) = 2 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_2,
        ifnull(avg(case when MONTH(date_update) = 3 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_3,
        ifnull(avg(case when MONTH(date_update) = 4 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_4,
        ifnull(avg(case when MONTH(date_update) = 5 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_5,
        ifnull(avg(case when MONTH(date_update) = 6 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_6,
        ifnull(avg(case when MONTH(date_update) = 7 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_7,
        ifnull(avg(case when MONTH(date_update) = 8 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_8,
        ifnull(avg(case when MONTH(date_update) = 9 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_9,
        ifnull(avg(case when MONTH(date_update) = 10 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_10,
        ifnull(avg(case when MONTH(date_update) = 11 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_11,
        ifnull(avg(case when MONTH(date_update) = 12 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_12,
        -- Kelembaban_Tanah
        ifnull(avg(case when MONTH(date_update) = 1 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_1,
        ifnull(avg(case when MONTH(date_update) = 2 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_2,
        ifnull(avg(case when MONTH(date_update) = 3 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_3,
        ifnull(avg(case when MONTH(date_update) = 4 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_4,
        ifnull(avg(case when MONTH(date_update) = 5 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_5,
        ifnull(avg(case when MONTH(date_update) = 6 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_6,
        ifnull(avg(case when MONTH(date_update) = 7 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_7,
        ifnull(avg(case when MONTH(date_update) = 8 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_8,
        ifnull(avg(case when MONTH(date_update) = 9 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_9,
        ifnull(avg(case when MONTH(date_update) = 10 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_10,
        ifnull(avg(case when MONTH(date_update) = 11 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_11,
        ifnull(avg(case when MONTH(date_update) = 12 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_12,
        -- Ketinggian_Air
        ifnull(avg(case when MONTH(date_update) = 1 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_1,
        ifnull(avg(case when MONTH(date_update) = 2 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_2,
        ifnull(avg(case when MONTH(date_update) = 3 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_3,
        ifnull(avg(case when MONTH(date_update) = 4 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_4,
        ifnull(avg(case when MONTH(date_update) = 5 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_5,
        ifnull(avg(case when MONTH(date_update) = 6 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_6,
        ifnull(avg(case when MONTH(date_update) = 7 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_7,
        ifnull(avg(case when MONTH(date_update) = 8 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_8,
        ifnull(avg(case when MONTH(date_update) = 9 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_9,
        ifnull(avg(case when MONTH(date_update) = 10 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_10,
        ifnull(avg(case when MONTH(date_update) = 11 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_11,
        ifnull(avg(case when MONTH(date_update) = 12 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_12,
        -- status_lokasi
        ifnull((case when MONTH(date_update) = 1 then status_lokasi else '' end), '') status_lokasi_1,
        ifnull((case when MONTH(date_update) = 2 then status_lokasi else '' end), '') status_lokasi_2,
        ifnull((case when MONTH(date_update) = 3 then status_lokasi else '' end), '') status_lokasi_3,
        ifnull((case when MONTH(date_update) = 4 then status_lokasi else '' end), '') status_lokasi_4,
        ifnull((case when MONTH(date_update) = 5 then status_lokasi else '' end), '') status_lokasi_5,
        ifnull((case when MONTH(date_update) = 6 then status_lokasi else '' end), '') status_lokasi_6,
        ifnull((case when MONTH(date_update) = 7 then status_lokasi else '' end), '') status_lokasi_7,
        ifnull((case when MONTH(date_update) = 8 then status_lokasi else '' end), '') status_lokasi_8,
        ifnull((case when MONTH(date_update) = 9 then status_lokasi else '' end), '') status_lokasi_9,
        ifnull((case when MONTH(date_update) = 10 then status_lokasi else '' end), '') status_lokasi_10,
        ifnull((case when MONTH(date_update) = 11 then status_lokasi else '' end), '') status_lokasi_11,
        ifnull((case when MONTH(date_update) = 12 then status_lokasi else '' end), '') status_lokasi_12 
        from 
 (SELECT max(update_time) date_update, lokasi_id, suhu_udara, Kelembaban_Udara, Suhu_Tanah, Kelembaban_Tanah, Ketinggian_Air, status_lokasi FROM rab_smartmon.tblmonitoring_his 
  where YEAR(update_time) = YEAR(sysdate()) and lokasi_id=? group by lokasi_id, MONTH(update_time)) dataa";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->lokasi_id);
        $stmt->execute();
        return $stmt;
    }

    public function getDataTahunanMobile()
    {

        $sqlQuery = "";

        $sqlQuery = "select 
        ifnull(avg(case when MONTH(date_update) = 1 then suhu_udara else 0 end), 0) suhu_udara_1,
        ifnull(avg(case when MONTH(date_update) = 2 then suhu_udara else 0 end), 0) suhu_udara_2,
        ifnull(avg(case when MONTH(date_update) = 3 then suhu_udara else 0 end), 0) suhu_udara_3,
        ifnull(avg(case when MONTH(date_update) = 4 then suhu_udara else 0 end), 0) suhu_udara_4,
        ifnull(avg(case when MONTH(date_update) = 5 then suhu_udara else 0 end), 0) suhu_udara_5,
        ifnull(avg(case when MONTH(date_update) = 6 then suhu_udara else 0 end), 0) suhu_udara_6,
        ifnull(avg(case when MONTH(date_update) = 7 then suhu_udara else 0 end), 0) suhu_udara_7,
        ifnull(avg(case when MONTH(date_update) = 8 then suhu_udara else 0 end), 0) suhu_udara_8,
        ifnull(avg(case when MONTH(date_update) = 9 then suhu_udara else 0 end), 0) suhu_udara_9,
        ifnull(avg(case when MONTH(date_update) = 10 then suhu_udara else 0 end), 0) suhu_udara_10,
        ifnull(avg(case when MONTH(date_update) = 11 then suhu_udara else 0 end), 0) suhu_udara_11,
        ifnull(avg(case when MONTH(date_update) = 12 then suhu_udara else 0 end), 0) suhu_udara_12,
        -- Kelembaban
        ifnull(avg(case when MONTH(date_update) = 1 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_1,
        ifnull(avg(case when MONTH(date_update) = 2 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_2,
        ifnull(avg(case when MONTH(date_update) = 3 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_3,
        ifnull(avg(case when MONTH(date_update) = 4 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_4,
        ifnull(avg(case when MONTH(date_update) = 5 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_5,
        ifnull(avg(case when MONTH(date_update) = 6 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_6,
        ifnull(avg(case when MONTH(date_update) = 7 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_7,
        ifnull(avg(case when MONTH(date_update) = 8 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_8,
        ifnull(avg(case when MONTH(date_update) = 9 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_9,
        ifnull(avg(case when MONTH(date_update) = 10 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_10,
        ifnull(avg(case when MONTH(date_update) = 11 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_11,
        ifnull(avg(case when MONTH(date_update) = 12 then Kelembaban_Udara else 0 end), 0) Kelembaban_Udara_12,
        -- suhu tanah
        ifnull(avg(case when MONTH(date_update) = 1 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_1,
        ifnull(avg(case when MONTH(date_update) = 2 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_2,
        ifnull(avg(case when MONTH(date_update) = 3 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_3,
        ifnull(avg(case when MONTH(date_update) = 4 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_4,
        ifnull(avg(case when MONTH(date_update) = 5 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_5,
        ifnull(avg(case when MONTH(date_update) = 6 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_6,
        ifnull(avg(case when MONTH(date_update) = 7 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_7,
        ifnull(avg(case when MONTH(date_update) = 8 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_8,
        ifnull(avg(case when MONTH(date_update) = 9 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_9,
        ifnull(avg(case when MONTH(date_update) = 10 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_10,
        ifnull(avg(case when MONTH(date_update) = 11 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_11,
        ifnull(avg(case when MONTH(date_update) = 12 then Suhu_Tanah else 0 end), 0) Suhu_Tanah_12,
        -- Kelembaban_Tanah
        ifnull(avg(case when MONTH(date_update) = 1 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_1,
        ifnull(avg(case when MONTH(date_update) = 2 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_2,
        ifnull(avg(case when MONTH(date_update) = 3 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_3,
        ifnull(avg(case when MONTH(date_update) = 4 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_4,
        ifnull(avg(case when MONTH(date_update) = 5 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_5,
        ifnull(avg(case when MONTH(date_update) = 6 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_6,
        ifnull(avg(case when MONTH(date_update) = 7 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_7,
        ifnull(avg(case when MONTH(date_update) = 8 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_8,
        ifnull(avg(case when MONTH(date_update) = 9 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_9,
        ifnull(avg(case when MONTH(date_update) = 10 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_10,
        ifnull(avg(case when MONTH(date_update) = 11 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_11,
        ifnull(avg(case when MONTH(date_update) = 12 then Kelembaban_Tanah else 0 end), 0) Kelembaban_Tanah_12,
        -- Ketinggian_Air
        ifnull(avg(case when MONTH(date_update) = 1 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_1,
        ifnull(avg(case when MONTH(date_update) = 2 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_2,
        ifnull(avg(case when MONTH(date_update) = 3 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_3,
        ifnull(avg(case when MONTH(date_update) = 4 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_4,
        ifnull(avg(case when MONTH(date_update) = 5 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_5,
        ifnull(avg(case when MONTH(date_update) = 6 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_6,
        ifnull(avg(case when MONTH(date_update) = 7 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_7,
        ifnull(avg(case when MONTH(date_update) = 8 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_8,
        ifnull(avg(case when MONTH(date_update) = 9 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_9,
        ifnull(avg(case when MONTH(date_update) = 10 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_10,
        ifnull(avg(case when MONTH(date_update) = 11 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_11,
        ifnull(avg(case when MONTH(date_update) = 12 then Ketinggian_Air else 0 end), 0) Ketinggian_Air_12,
        -- status_lokasi
        ifnull((case when MONTH(date_update) = 1 then status_lokasi else '' end), '') status_lokasi_1,
        ifnull((case when MONTH(date_update) = 2 then status_lokasi else '' end), '') status_lokasi_2,
        ifnull((case when MONTH(date_update) = 3 then status_lokasi else '' end), '') status_lokasi_3,
        ifnull((case when MONTH(date_update) = 4 then status_lokasi else '' end), '') status_lokasi_4,
        ifnull((case when MONTH(date_update) = 5 then status_lokasi else '' end), '') status_lokasi_5,
        ifnull((case when MONTH(date_update) = 6 then status_lokasi else '' end), '') status_lokasi_6,
        ifnull((case when MONTH(date_update) = 7 then status_lokasi else '' end), '') status_lokasi_7,
        ifnull((case when MONTH(date_update) = 8 then status_lokasi else '' end), '') status_lokasi_8,
        ifnull((case when MONTH(date_update) = 9 then status_lokasi else '' end), '') status_lokasi_9,
        ifnull((case when MONTH(date_update) = 10 then status_lokasi else '' end), '') status_lokasi_10,
        ifnull((case when MONTH(date_update) = 11 then status_lokasi else '' end), '') status_lokasi_11,
        ifnull((case when MONTH(date_update) = 12 then status_lokasi else '' end), '') status_lokasi_12 
        from 
 (SELECT max(update_time) date_update, lokasi_id, suhu_udara, Kelembaban_Udara, Suhu_Tanah, Kelembaban_Tanah, Ketinggian_Air, status_lokasi FROM rab_smartmon.tblmonitoring_his, 
 rab_smartmon.tbllokasi  
  where rab_smartmon.tblmonitoring_his.lokasi_id=rab_smartmon.tbllokasi.id and YEAR(update_time) = YEAR(sysdate()) and rab_smartmon.tbllokasi.lokasi_name=? group by lokasi_id, MONTH(update_time)) dataa";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->lokasi_id);
        $stmt->execute();
        return $stmt;
    }
}
