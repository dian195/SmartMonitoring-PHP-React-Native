<?php
    class Monitoring{

        // conn
        private $conn;

        // table
        private $dbTable = "tbllokasi";

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
        public function __construct($db){
            $this->conn = $db;
        }

        // GET Users
        public function getDataMonitoring(){

            if ($this->lokasi_id != "")
            {
            $sqlQuery = "select aa.id, bb.id lokasi_id, bb.lokasi_name, ifnull(aa.Suhu_Udara, 0) Suhu_Udara, ifnull(aa.kelembaban_Udara, 0) kelembaban_Udara, ifnull(aa.Suhu_Tanah, 0) Suhu_Tanah, 
            ifnull(aa.Kelembaban_Tanah, 0) Kelembaban_Tanah, ifnull(aa.Ketinggian_Air, 0) Ketinggian_Air, DATE_FORMAT(aa.Last_Update, '%d/%m/%Y %H:%i:%s') Last_Update, ifnull(aa.Status_Lokasi, '-') Status_Lokasi from tbllokasi bb 
            left join tblmonitoring aa on aa.lokasi_id=bb.id where bb.id=? order by bb.id, bb.Lokasi_Name ";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(1, $this->lokasi_id);
                    $stmt->execute();
                    return $stmt;
            }
            else
            {
                $sqlQuery = "select aa.id, bb.id lokasi_id, bb.lokasi_name, ifnull(aa.Suhu_Udara, 0) Suhu_Udara, ifnull(aa.kelembaban_Udara, 0) kelembaban_Udara, ifnull(aa.Suhu_Tanah, 0) Suhu_Tanah, 
                ifnull(aa.Kelembaban_Tanah, 0) Kelembaban_Tanah, ifnull(aa.Ketinggian_Air, 0) Ketinggian_Air, DATE_FORMAT(aa.Last_Update, '%d/%m/%Y %H:%i:%s') Last_Update, ifnull(aa.Status_Lokasi, '-') Status_Lokasi from tbllokasi bb 
                left join tblmonitoring aa on aa.lokasi_id=bb.id order by bb.id, bb.Lokasi_Name";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
            }
        }

        public function UpdateData() {

            $ReturnMessage = "";
            
            if (isset($this->lokasi_id) == true)
            {
                if ($this->lokasi_id == "")
                {
                    $ReturnMessage = "Lokasi_ID tidak boleh kosong !";
                    return $ReturnMessage;
                }
            }
            else
            {
                $ReturnMessage = "Lokasi_ID tidak boleh kosong !";
                return $ReturnMessage;
            }

            //cek data lokasi
            $cek_lokasi = "";
            $sqlQuery = "SELECT count(*) jumlah FROM tbllokasi WHERE id = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->lokasi_id);
            if($stmt->execute()){ /*nothing*/ } else { 
                $ReturnMessage = "Lokasi tidak ditemukan !";
                return $ReturnMessage;
             }

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $cek_lokasi = $dataRow['jumlah'];

            if ($cek_lokasi == "0")
            {
                $ReturnMessage = "Lokasi tidak ditemukan !";
                return $ReturnMessage;
            }

            if ($cek_lokasi == "")
            {
                $ReturnMessage = "Lokasi tidak ditemukan !";
                return $ReturnMessage;
            }
            //End

            $sqlSet = "";
            $status_lokasiStat = "";
            $ketinggian_airStat = "";
            $kelembaban_tanahStat = "";
            $suhu_tanahStat = "";
            $kelembaban_udaraStat = "";
            $suhu_udaraStat = "";
            $lokasi_nameStat = "";

            //Update             
            if (isset($this->status_lokasi) == true && $this->status_lokasi != "")
            {
                $status_lokasiStat = "OK";

                if ($sqlSet == "")
                {
                    $sqlSet = $sqlSet . " SET status_lokasi = :status_lokasi ";
                }
                else
                {
                    $sqlSet = $sqlSet . ", status_lokasi = :status_lokasi ";
                }
            }

            if (isset($this->ketinggian_air) == true && $this->ketinggian_air != "")
            {
                $ketinggian_airStat = "OK";

                if ($sqlSet == "")
                {
                    $sqlSet = $sqlSet . " SET ketinggian_air = :ketinggian_air ";
                }
                else
                {
                    $sqlSet = $sqlSet . ", ketinggian_air = :ketinggian_air ";
                }
            }

            if (isset($this->kelembaban_tanah) == true && $this->kelembaban_tanah != "")
            {
                $kelembaban_tanahStat = "OK";

                if ($sqlSet == "")
                {
                    $sqlSet = $sqlSet . " SET kelembaban_tanah = :kelembaban_tanah ";
                }
                else
                {
                    $sqlSet = $sqlSet . ", kelembaban_tanah = :kelembaban_tanah ";
                }
            }
            
            if (isset($this->suhu_tanah) == true && $this->suhu_tanah != "")
            {
                $suhu_tanahStat = "OK";

                if ($sqlSet == "")
                {
                    $sqlSet = $sqlSet . " SET suhu_tanah = :suhu_tanah ";
                }
                else
                {
                    $sqlSet = $sqlSet . ", suhu_tanah = :suhu_tanah ";
                }
            }

            if (isset($this->kelembaban_udara) == true && $this->kelembaban_udara != "")
            {
                $kelembaban_udaraStat = "OK";

                if ($sqlSet == "")
                {
                    $sqlSet = $sqlSet . " SET kelembaban_udara = :kelembaban_udara ";
                }
                else
                {
                    $sqlSet = $sqlSet . ", kelembaban_udara = :kelembaban_udara ";
                }
            }
            
            if (isset($this->suhu_udara) == true && $this->suhu_udara != "")
            {
                $suhu_udaraStat = "OK";

                if ($sqlSet == "")
                {
                    $sqlSet = $sqlSet . " SET suhu_udara = :suhu_udara ";
                }
                else
                {
                    $sqlSet = $sqlSet . ", suhu_udara = :suhu_udara ";
                }
            }

            if ($sqlSet == "")
            {
                $ReturnMessage = "Tidak ada parameter terisi !";
                return $ReturnMessage;
            }

            // sanitize
            if ($status_lokasiStat == "OK")
            {
                $this->status_lokasi=htmlspecialchars(strip_tags($this->status_lokasi));
            }

            if ($ketinggian_airStat == "OK")
            {
                $this->ketinggian_air=htmlspecialchars(strip_tags($this->ketinggian_air));
            }

            if ($kelembaban_tanahStat == "OK")
            {
                $this->kelembaban_tanah=htmlspecialchars(strip_tags($this->kelembaban_tanah));
            }

            if ($suhu_tanahStat == "OK")
            {
                $this->suhu_tanah=htmlspecialchars(strip_tags($this->suhu_tanah));
            }

            if ($kelembaban_udaraStat == "OK")
            {
                $this->kelembaban_udara=htmlspecialchars(strip_tags($this->kelembaban_udara));
            }

            if ($suhu_udaraStat == "OK")
            {
                $this->suhu_udara=htmlspecialchars(strip_tags($this->suhu_udara));
            }

            $this->lokasi_id=htmlspecialchars(strip_tags($this->lokasi_id));

            //Insert lokasi history
            $sqlQuery = "SELECT count(*) jumlah FROM tblmonitoring WHERE lokasi_id = :lokasi_id and date(last_update) = date(sysdate()) and " . str_replace(",", "AND", str_replace(" SET "," ", $sqlSet)) . "";
            $sqlQueryHistory = "";
            $stmt = $this->conn->prepare($sqlQuery);

            if ($status_lokasiStat == "OK")
            {
                $stmt->bindParam(":status_lokasi", $this->status_lokasi);
            }

            if ($ketinggian_airStat == "OK")
            {
                $stmt->bindParam(":ketinggian_air", $this->ketinggian_air);
            }

            if ($kelembaban_tanahStat == "OK")
            {
                $stmt->bindParam(":kelembaban_tanah", $this->kelembaban_tanah);
            }

            if ($suhu_tanahStat == "OK")
            {
                $stmt->bindParam(":suhu_tanah", $this->suhu_tanah);
            }

            if ($kelembaban_udaraStat == "OK")
            {
                $stmt->bindParam(":kelembaban_udara", $this->kelembaban_udara);
            }

            if ($suhu_udaraStat == "OK")
            {
                $stmt->bindParam(":suhu_udara", $this->suhu_udara);
            }

            $stmt->bindParam(":lokasi_id", $this->lokasi_id);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $cek_lokasi = $dataRow['jumlah'];

            $sqlQuery = "";
            if ($cek_lokasi == "0")
            {
                $sqlQuery = "INSERT INTO tblmonitoring_his " . $sqlSet . ", Update_Time=NOW(), lokasi_id=:lokasi_id";
            }
            else
            {
                if ($cek_lokasi == "")
                {
                    $sqlQuery = "INSERT INTO tblmonitoring_his " . $sqlSet . ", Update_Time=NOW(), lokasi_id=:lokasi_id";
                }
                else
                {
                    return "Tidak ada perubahan data";
                }
            }

            if ($sqlQuery != "")
            {
                $stmt = $this->conn->prepare($sqlQuery);
            
                // bind data
                if ($status_lokasiStat == "OK")
                {
                    $stmt->bindParam(":status_lokasi", $this->status_lokasi);
                }

                if ($ketinggian_airStat == "OK")
                {
                    $stmt->bindParam(":ketinggian_air", $this->ketinggian_air);
                }

                if ($kelembaban_tanahStat == "OK")
                {
                    $stmt->bindParam(":kelembaban_tanah", $this->kelembaban_tanah);
                }

                if ($suhu_tanahStat == "OK")
                {
                    $stmt->bindParam(":suhu_tanah", $this->suhu_tanah);
                }

                if ($kelembaban_udaraStat == "OK")
                {
                    $stmt->bindParam(":kelembaban_udara", $this->kelembaban_udara);
                }

                if ($suhu_udaraStat == "OK")
                {
                    $stmt->bindParam(":suhu_udara", $this->suhu_udara);
                }
                
                $stmt->bindParam(":lokasi_id", $this->lokasi_id);
            
                if($stmt->execute()){ /*nothing*/ } else { 
                    $ReturnMessage = "Gagal update data !";
                    return $ReturnMessage;
                }
            }
            //End

            //cek data monitoring apakah udah ada atau belum
            $sqlQuery = "SELECT count(*) jumlah FROM tblmonitoring WHERE lokasi_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->lokasi_id);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $cek_lokasi = $dataRow['jumlah'];

            $sqlQuery = "";
            if ($cek_lokasi == "0")
            {
                $sqlQuery = "INSERT INTO tblmonitoring " . $sqlSet . ", last_update=NOW(), lokasi_id=:lokasi_id";
            }
            else
            {
                if ($cek_lokasi == "")
                {
                    $sqlQuery = "INSERT INTO tblmonitoring " . $sqlSet . ", last_update=NOW(), lokasi_id=:lokasi_id";
                }
                else
                {
                    $sqlQuery = "UPDATE tblmonitoring " . $sqlSet . ", last_update=NOW() WHERE lokasi_id = :lokasi_id";
                }
            }
            
            //End
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // bind data
            if ($status_lokasiStat == "OK")
            {
                $stmt->bindParam(":status_lokasi", $this->status_lokasi);
            }

            if ($ketinggian_airStat == "OK")
            {
                $stmt->bindParam(":ketinggian_air", $this->ketinggian_air);
            }

            if ($kelembaban_tanahStat == "OK")
            {
                $stmt->bindParam(":kelembaban_tanah", $this->kelembaban_tanah);
            }

            if ($suhu_tanahStat == "OK")
            {
                $stmt->bindParam(":suhu_tanah", $this->suhu_tanah);
            }

            if ($kelembaban_udaraStat == "OK")
            {
                $stmt->bindParam(":kelembaban_udara", $this->kelembaban_udara);
            }

            if ($suhu_udaraStat == "OK")
            {
                $stmt->bindParam(":suhu_udara", $this->suhu_udara);
            }
            
            $stmt->bindParam(":lokasi_id", $this->lokasi_id);
        
            if($stmt->execute()){ /*nothing*/ } else { 
                $ReturnMessage = "Gagal update data !";
                return $ReturnMessage;
            }

            //Update tbllokasi jika lokasi_name diisi
            $sqlSet = "";
            if (isset($this->lokasi_name) == true && $this->lokasi_name != "")
            {
                $lokasi_nameStat = "OK";

                if ($sqlSet == "")
                {
                    $sqlSet = $sqlSet . " SET lokasi_name = :lokasi_name ";
                }
                else
                {
                    $sqlSet = $sqlSet . ", lokasi_name = :lokasi_name ";
                }
            }

            if ($lokasi_nameStat == "OK")
            {
                //Update master lokasi name 
                $sqlQuery = "UPDATE tbllokasi " . $sqlSet . " WHERE id = :id";               
                $stmt = $this->conn->prepare($sqlQuery);
                
                // sanitize
                $this->lokasi_name=htmlspecialchars(strip_tags($this->lokasi_name));
                $stmt->bindParam(":id", $this->lokasi_id);      
                $stmt->bindParam(":lokasi_name", $this->lokasi_name);        
                if($stmt->execute()){ 
                    $ReturnMessage = "Data berhasil diupdate !";
                    return $ReturnMessage;
                 } else { 
                    $ReturnMessage = "Gagal update data !";
                    return $ReturnMessage;
                 }
            }
            else
            {
                $ReturnMessage = "Data berhasil diupdate !";
                return $ReturnMessage;
            }
        }
    }
?>