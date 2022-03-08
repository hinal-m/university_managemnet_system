@extends('University.layouts.master')
@section('title','University')
@section('content')
<style>
    @import url("https://fonts.googleapis.com/css?family=Poppins");

    * {
        font-family: "Poppins", sans-serif;
    }

    #chart {
        max-width: 760px;
        margin: 35px auto;
        opacity: 0.9;
    }

    .apexcharts-tooltip {
        background: #f3f3f3;
        color: black;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$college}}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Colleges</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$student}}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Student</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$admission}}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Admissions</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Count Of Data</h6>
                    </div>
                    <div class="card-body">
                        <div id="monthy"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.33.2/apexcharts.min.js"></script> -->
<script type="text/javascript" src="{{ asset('js/apexcharts.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('university.chart') }}",
        type: 'GET',
        dataType: "JSON",
        async: false,
        success: function(data) {
            chartData(data.data.admission, data.data.college, data.data.student)
        }
    });

    function chartData(admission, college, student) {

        var options = {
            series: [{
                    name: "Admission",
                    data: [admission]
                },
                {
                    name: "College",
                    data: [college]
                },
                {
                    name: "Student",
                    data: [student]
                }
            ],
            chart: {
                type: "bar",
                height: 350,
                background: '#fff'
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "55%",
                    endingShape: "rounded"
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            xaxis: {
                categories: [
                    "Total Count"
                ],
                labels: {
                    style: {
                        fontSize: "11px",
                        cssClass: ".apexcharts-margin"
                    },
                    hideOverlappingLabels: false,
                    show: true,
                    rotate: 0,
                    rotateAlways: false,
                    minHeight: 100,
                    maxHeight: 2000
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val;
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#monthy"), options);
        chart.render();
    }
</script>
@endsection