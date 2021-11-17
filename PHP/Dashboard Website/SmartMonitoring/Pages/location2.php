<header id="header-navbar" class="content-mini content-mini-full">
    <ul class="nav-header pull-right"></ul>
    <ul class="nav-header pull-left">
        <li class="hidden-md hidden-lg">
            <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                <i class="fa fa-navicon"></i>
            </button>
        </li>
        <li class="hidden-xs hidden-sm">
            <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                <i class="fa fa-ellipsis-v"></i>
            </button>
        </li>
        <li>
            <table border="0">
                <tr>
                    <td width="100px">Lokasi</td>
                    <td width="30px">:</td>
                    <td><label id="lblLokasiName" /></td>
                </tr>
                <tr>
                    <td>Last Update</td>
                    <td>:</td>
                    <td><label id="lblLastUpdate" /></td>
                </tr>
                <tr>
                    <td>Status Lokasi</td>
                    <td>:</td>
                    <td><label id="lblStatusLokasi" /></td>
                </tr>
            </table>
        </li>
    </ul>
    <!-- END Header Navigation Left -->
</header>
<!-- END Header -->
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content content-narrow" style="margin-top: 30px">

        <!-- Chart.js Charts (initialized in js/pages/base_comp_charts.js), for more examples you can check out http://www.chartjs.org/docs/ -->
        <div class="row">
            <div class="col-lg-3">
                <!-- Lines Chart -->
                <div class="block">
                    <div class="block-header">
                        <ul class="block-options">
                            <li></li>
                        </ul>
                        <h3 class="block-title">Temperature</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <!-- Lines Chart Container -->
                        <div style="height: 245px">
                            <div id="chartTemperature"></div>
                        </div>
                    </div>
                </div>
                <!-- END Lines Chart -->
            </div>
            <div class="col-lg-3">
                <!-- Lines Chart -->
                <div class="block">
                    <div class="block-header">
                        <ul class="block-options">
                            <li></li>
                        </ul>
                        <h3 class="block-title">Humidity</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <!-- Lines Chart Container -->
                        <div style="height: 245px">
                            <div id="chartHumidity"></div>
                        </div>
                    </div>
                </div>
                <!-- END Lines Chart -->
            </div>
            <div class="col-lg-3">
                <!-- Lines Chart -->
                <div class="block">
                    <div class="block-header">
                        <ul class="block-options">
                            <li></li>
                        </ul>
                        <h3 class="block-title">Earth Temperature</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <!-- Lines Chart Container -->
                        <div style="height: 245px">
                            <div id="chartEarthcTemp"></div>
                        </div>
                    </div>
                </div>
                <!-- END Lines Chart -->
            </div>
            <div class="col-lg-3">
                <!-- Lines Chart -->
                <div class="block">
                    <div class="block-header">
                        <ul class="block-options">
                            <li></li>
                        </ul>
                        <h3 class="block-title">Water Level</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <!-- Lines Chart Container -->
                        <div style="height: 245px">
                            <div id="chartWaterLevel"></div>
                        </div>
                    </div>
                </div>
                <!-- END Lines Chart -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Lines Chart -->
                <div class="block">
                    <div class="block-header">
                        <ul class="block-options">
                            <li>
                                <select class="form-control" size="1" name="ddlFilterLineChart1" id="ddlFilterLineChart1">
                                    <option value="0">All</option>
                                    <option value="1">Temperature</option>
                                    <option value="2">Humidity</option>
                                    <option value="4">Earth Temperature</option>
                                    <option value="5">Water Level</option>
                                </select>
                            </li>
                            <li>
                                <select class="form-control" size="1" name="ddlFilterLineChart2" id="ddlFilterLineChart2">
                                    <option value="0">Tahunan</option>
                                    <option value="1">Mingguan</option>
                                </select>
                            </li>
                            <li></li>
                        </ul>
                        <h3 class="block-title">Grafik Data</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <!-- Lines Chart Container -->
                        <div style="height: 245px">
                            <canvas id="chartLine" style="height: 100%; width: 100%"></canvas>
                            <canvas id="chartLineMingguan" style="height: 100%; width: 100%"></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Lines Chart -->
            </div>
        </div>
        <!-- END Chart.js Charts -->
    </div>
    <!-- END Page Content -->
</main>
<!-- Page JS Code -->

<input type="hidden" id="lokasi_Name" name="lokasi_Name">
<input type="hidden" id="last_Update" name="last_Update">
<input type="hidden" id="status_Lokasi" name="status_Lokasi">

<script>
    var ctx2 = document.getElementById('chartLine').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: []
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
                duration: 0
            }
        }
    });


    var ctx = document.getElementById('chartLineMingguan').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: []
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
                duration: 0
            }
        }
    });

    //Temperature
    var optionsTemperature = {
        series: [],
        chart: {
            height: 265,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "55%",
                },
                dataLabels: {
                    show: true,
                    name: {
                        show: true,
                        fontSize: "16px",
                        fontFamily: undefined,
                        fontWeight: 600,
                        color: undefined,
                        offsetY: -40,
                    },
                    value: {
                        show: true,
                        fontSize: "25px",
                        fontFamily: undefined,
                        fontWeight: 400,
                        color: undefined,
                        offsetY: 0,
                        formatter: function(val) {
                            return val;
                        },
                    },
                },
            },
        },
        labels: [""],
    };

    //Kelembaban Udara - Humidity
    var optionsHumidity = {
        series: [],
        chart: {
            height: 265,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "55%",
                },
                dataLabels: {
                    show: true,
                    name: {
                        show: true,
                        fontSize: "16px",
                        fontFamily: undefined,
                        fontWeight: 600,
                        color: undefined,
                        offsetY: -40,
                    },
                    value: {
                        show: true,
                        fontSize: "25px",
                        fontFamily: undefined,
                        fontWeight: 400,
                        color: undefined,
                        offsetY: 0,
                        formatter: function(val) {
                            return val;
                        },
                    },
                },
            },
        },
        labels: [""],
    };

    //Earth Temp -- Suhu Tanah
    var optionsEarthcTemp = {
        series: [],
        chart: {
            height: 265,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "55%",
                },
                dataLabels: {
                    show: true,
                    name: {
                        show: true,
                        fontSize: "16px",
                        fontFamily: undefined,
                        fontWeight: 600,
                        color: undefined,
                        offsetY: -40,
                    },
                    value: {
                        show: true,
                        fontSize: "25px",
                        fontFamily: undefined,
                        fontWeight: 400,
                        color: undefined,
                        offsetY: 0,
                        formatter: function(val) {
                            return val;
                        },
                    },
                },
            },
        },
        labels: [""],
    };

    //Water Level
    var optionsWaterLevel = {
        series: [],
        chart: {
            height: 265,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "55%",
                },
                dataLabels: {
                    show: true,
                    name: {
                        show: true,
                        fontSize: "16px",
                        fontFamily: undefined,
                        fontWeight: 600,
                        color: undefined,
                        offsetY: -40,
                    },
                    value: {
                        show: true,
                        fontSize: "25px",
                        fontFamily: undefined,
                        fontWeight: 400,
                        color: undefined,
                        offsetY: 0,
                        formatter: function(val) {
                            return val;
                        },
                    },
                },
            },
        },
        labels: [""],
    };

    var chart = new ApexCharts(
        document.querySelector("#chartTemperature"),
        optionsTemperature
    );

    var chart2 = new ApexCharts(
        document.querySelector("#chartHumidity"),
        optionsHumidity
    );

    var chart4 = new ApexCharts(
        document.querySelector("#chartEarthcTemp"),
        optionsEarthcTemp
    );

    var chart5 = new ApexCharts(
        document.querySelector("#chartWaterLevel"),
        optionsWaterLevel
    );

    chart.render();
    chart2.render();
    chart4.render();
    chart5.render();

    var args = {};
    setInterval(function() {

        $.ajax({
            type: "GET",
            url: "http://localhost:7788/smartmonitoring/api/monitoring/GetData.php?lokasi_id=2",
            contentType: "application/json; charset=utf-8",
            data: {},
            dataType: "json",
            success: function(msg) {
                console.log(msg);

                var chartData = msg[0].Suhu_Udara;
                var chartData2 = msg[0].kelembaban_Udara;
                var chartData3 = msg[0].Kelembaban_Tanah;
                var chartData4 = msg[0].Suhu_Tanah;
                var chartData5 = msg[0].Ketinggian_Air;

                var LokasiName = msg[0].lokasi_name;
                var LastUpdate = msg[0].Last_Update;
                var StatusLokasi = msg[0].Status_Lokasi;

                $('#lblLokasiName').html(LokasiName);
                $('#lblLastUpdate').html(LastUpdate);
                $('#lblStatusLokasi').html(StatusLokasi);

                chart.updateSeries([chartData]);
                chart2.updateSeries([chartData2]);
                chart4.updateSeries([chartData4]);
                chart5.updateSeries([chartData5]);

            }
        });

        $.ajax({
            type: "GET",
            url: "http://localhost:7788/smartmonitoring/api/chart/GetDataMingguan.php?lokasi_id=2&kategori=" + document.getElementById('ddlFilterLineChart1').value,
            contentType: "application/json; charset=utf-8",
            data: {},
            dataType: "json",
            success: function(msg) {
                console.log('data chart1 = ', msg);
                //myLineChart.data.datasets[0].data[2] = 50; // Would update the first dataset's value of 'March' to be 50
                //myLineChart.update(); // Calling update now animates the position of March from 90 to 50.
                myChart.data.datasets = msg;
                myChart.update();
            }
        });

        $.ajax({
            type: "GET",
            url: "http://localhost:7788/smartmonitoring/api/chart/GetDataTahunan.php?lokasi_id=2&kategori=" + document.getElementById('ddlFilterLineChart1').value,
            contentType: "application/json; charset=utf-8",
            data: {},
            dataType: "json",
            success: function(msg2) {
                console.log('data chart2 = ', msg2);

                //myLineChart.data.datasets[0].data[2] = 50; // Would update the first dataset's value of 'March' to be 50
                //myLineChart.update(); // Calling update now animates the position of March from 90 to 50.
                myChart2.data.datasets = msg2;
                myChart2.update();
            }
        });

    }, 2000);

    window.onload = function() {

        var ctx2 = document.getElementById('chartLine').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: []
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 0
                }
            }
        });


        var ctx = document.getElementById('chartLineMingguan').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: []
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 0
                }
            }
        });

        if (document.getElementById('ddlFilterLineChart2').value == '0') {
            document.getElementById('chartLine').style.display = 'block';
            document.getElementById('chartLineMingguan').style.display = 'none';
        } else {
            document.getElementById('chartLine').style.display = 'none';
            document.getElementById('chartLineMingguan').style.display = 'block';
        }
    }

    document.getElementById('ddlFilterLineChart2').onchange = function() {
        if (this.value == '0') {
            document.getElementById('chartLine').style.display = 'block';
            document.getElementById('chartLineMingguan').style.display = 'none';
        } else {
            document.getElementById('chartLine').style.display = 'none';
            document.getElementById('chartLineMingguan').style.display = 'block';
        }
    };
</script>
