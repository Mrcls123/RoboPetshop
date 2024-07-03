<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js
pdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ht
ml2canvas/0.4.1/html2canvas.min.js"></script>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Grafik Transaksi Penjualan Barang
                        <div class="col-sm-2 mt-3">
                            <input type="number" id="tahun-trans" class="form-control" value="<?= date('Y')?>"
                                onchange="chartTransaksi()">
                        </div>
                    </div>
                    <div class="card-body"><canvas id="chartTransaksi" width="100%" height="40"></canvas></div>
                    <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-outline-primary btn-sm" onclick="downloadChartTransaski('PDF')">Unduh
                            PDF</button>
                        <a id="download-trans" download="chart-transaksi.png">
                            <button class="btn btn-outline-secondary btn-sm"
                                onclick="downloadChartTransaski('PNG')">Unduh PNG</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Grafik Pegawai
                        <div class="col-sm-2 mt-3">
                            <input type="number" id="tahun-peg" class="form-control" value="<?= date('Y')?>"
                                onchange="chartPegawai()">
                        </div>
                    </div>
                    <div class="card-body"><canvas id="chartPeg" width="100%" height="40"></canvas></div>
                    <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-outline-primary btn-sm" onclick="downloadChartPegawai('PDF')">Unduh
                            PDF</button>
                        <a id="download-peg" download="chart-pegawai.png">
                            <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartPegawai('PNG')">Unduh
                                PNG</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Grafik Transaksi Pembelian
                        <div class="col-sm-2 mt-3">
                            <input type="number" id="tahun-pemb" class="form-control" value="<?= date('Y')?>"
                                onchange="chartPembelian()">
                        </div>
                    </div>
                    <div class="card-body"><canvas id="chartPembelian" width="100%" height="40"></canvas></div>
                    <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-outline-primary btn-sm" onclick="downloadChartPembelian('PDF')">Unduh
                            PDF</button>
                        <a id="download-pemb" download="chart-pembelian.png">
                            <button class="btn btn-outline-secondary btn-sm"
                                onclick="downloadChartPembelian('PNG')">Unduh PNG</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Grafik Penjualan Layanan
                        <div class="col-sm-2 mt-3">
                            <input type="number" id="tahun-lay" class="form-control" value="<?= date('Y')?>"
                                onchange="chartLayanan()">
                        </div>
                    </div>
                    <div class="card-body"><canvas id="chartLay" width="100%" height="40"></canvas></div>
                    <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-outline-primary btn-sm" onclick="downloadChartLayanan('PDF')">Unduh
                            PDF</button>
                        <a id="download-lay" download="chart-layanan.png">
                            <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartLayanan('PNG')">Unduh
                                PNG</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    chartTransaksi()
    chartPegawai()
    chartPembelian()
    chartLayanan()
});
// =========================== TRANSAKSI =========================== //
function setLineChartTrans(dataset) {
    // Area Chart Example
    var ctx = document.getElementById("chartTransaksi");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep",
                "Okt", "Nov", "Des"
            ],
            datasets: [{
                label: "Total",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: dataset,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

function chartTransaksi() {
    var tahun = $('#tahun-trans').val();
    $.ajax({
        url: "/chart-transaksi",
        method: "POST",
        data: {
            'tahun': tahun,
        },
        success: function(response) {
            var result = JSON.parse(response)

            dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            $.each(result.data, function(i, val) {
                dataset[val.month - 1] = val.total
            });
            setLineChartTrans(dataset)
        }
    });
}

// =========================== CUSTOMER =========================== //
function setBarChart(dataset) {
    // Bar Chart Example
    var ctx = document.getElementById("chartPeg");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep",
                "Okt", "Nov", "Des"
            ],
            datasets: [{
                label: "Jumlah",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: dataset,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

function chartPegawai() {
    var tahun = $('#tahun-peg').val();
    $.ajax({
        url: "/chart-pegawai",
        method: "POST",
        data: {
            'tahun': tahun,
        },
        success: function(response) {
            var result = JSON.parse(response)

            dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            $.each(result.data, function(i, val) {
                dataset[val.month - 1] = val.total
            });
            setBarChart(dataset)
        }
    });
}

// Pembelian
function setPieChart(dataset) {
    var ctx = document.getElementById("chartPembelian");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep",
                "Okt", "Nov", "Des"
            ],
            datasets: [{
                data: dataset,
                backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#196F3D', '#1700FF',
                    '#FF0000', '#FFF700', '#000000', '#FF4882', '#00F0FF', '#FF7C00'
                ],
            }],
        },
    });
}

function chartPembelian() {
    var tahun = $('#tahun-pemb').val();
    $.ajax({
        url: "/chart-pembelian",
        method: "POST",
        data: {
            'tahun': tahun,
        },
        success: function(response) {
            var result = JSON.parse(response)
            dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            $.each(result.data, function(i, val) {
                dataset[val.month - 1] = val.total
            });
            setPieChart(dataset)
        }
    });
}

// Supplier
function setLineChartLay(dataset) {
    // Area Chart Example
    var ctx = document.getElementById("chartLay");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep",
                "Okt", "Nov", "Des"
            ],
            datasets: [{
                label: "Jumlah",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: dataset,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

function chartLayanan() {
    var tahun = $('#tahun-lay').val();
    $.ajax({
        url: "/chart-layanan",
        method: "POST",
        data: {
            'tahun': tahun,
        },
        success: function(response) {
            var result = JSON.parse(response)

            dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            $.each(result.data, function(i, val) {
                dataset[val.month - 1] = val.total
            });
            setLineChartLay(dataset)
        }
    });
}

function downloadChartImg(download, chart) {
    var img = chart.toDataURL("image/jpg", 1.0).replace("image/jpg", "image/octet-stream")
    download.setAttribute("href", img)
}

function downloadChartPDF(chart, name) {
    html2canvas(chart, {
        onrendered: function(canvas) {
            var img = canvas.toDataURL("image/jpg", 1.0)
            var doc = new jsPDF('p', 'pt', 'A4')
            var lebarKonten = canvas.width
            var tinggiKonten = canvas.height
            var tinggiPage = lebarKonten / 592.28 * 841.89
            var leftHeight = tinggiKonten
            var position = 0
            var imgWidth = 595.28
            var imgHeight = 595.28 / lebarKonten * tinggiKonten
            if (leftHeight < tinggiPage) {
                doc.addImage(img, 'PNG', 0, 0, imgWidth, imgHeight)
            } else {
                while (leftHeight > 0) {
                    doc.addImage(img, 'PNG', 0, position, imgWidth, imgHeight)
                    leftHeight -= tinggiPage
                    position -= 841.89
                    if (leftHeight > 0) {
                        pdf.addPage()
                    }
                }
            }
            doc.save(name)
        }
    });
}

function downloadChartTransaski(type) {
    var download = document.getElementById('download-trans')
    var chart = document.getElementById('chartTransaksi')

    if (type == "PNG") {
        downloadChartImg(download, chart)
    } else {
        downloadChartPDF(chart, "Chart-Transaksi.pdf")
    }
}

function downloadChartPegawai(type) {
    var download = document.getElementById('download-peg')
    var chart = document.getElementById('chartPeg')

    if (type == "PNG") {
        downloadChartImg(download, chart)
    } else {
        downloadChartPDF(chart, "Chart-Pegawai.pdf")
    }
}

function downloadChartPembelian(type) {
    var download = document.getElementById('download-pemb')
    var chart = document.getElementById('chartPembelian')

    if (type == "PNG") {
        downloadChartImg(download, chart)
    } else {
        downloadChartPDF(chart, "Chart-Pembelian.pdf")
    }
}

function downloadChartLayanan(type) {
    var download = document.getElementById('download-lay')
    var chart = document.getElementById('chartLay')

    if (type == "PNG") {
        downloadChartImg(download, chart)
    } else {
        downloadChartPDF(chart, "Chart-Layanan.pdf")
    }
}
</script>
<?= $this->endSection() ?>