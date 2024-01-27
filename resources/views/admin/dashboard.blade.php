@extends('admin.layout.layout')
@section('header-links')
    <!-- DataTables -->
    <link href="{{ asset('public/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-name')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="mb-sm-0 mb-5 font-size-18">О CMS</h4>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div>
                                <blockquote class="blockquote font-size-16 mb-0">
                                    <p>CMS (Content Management System) представляет собой программное обеспечение,
                                        предназначенное для управления контентом веб-сайта. Она облегчает создание,
                                        редактирование и управление различными типами контента, такими как тексты,
                                        изображения, видео и другие элементы. CMS позволяет пользователям без
                                        специальных навыков программирования эффективно управлять своим
                                        онлайн-пространством.
                                    </p>

                                    <p>
                                        "B CMS" была разработана программистами компании Bizzone Group. Эта CMS,
                                        представляет собой индивидуальное решение, созданное специально для
                                        нужд клиентов Bizzone Group. Такие системы часто разрабатываются с учетом
                                        конкретных требований и особенностей бизнеса клиентов, обеспечивая более
                                        эффективное управление контентом и функциональностью в рамках конкретных задач и
                                        бизнес-процессов.</p>

                                    <p>B CMS является интеллектуальной собственностью Bizzone Group, и любое его
                                        использование без соответствующего разрешения является нарушением законов об
                                        авторских правах. </p>

                                    <h5>
                                        Контакты
                                    </h5>
                                    <p>
                                        <a href="tel: +998997008360"> <i class="bx bx-phone"></i> +998 (99) 700-83-60
                                        </a>

                                        <a href="https://t.me/erkinov_8360" target="_blank"> <i class="bx bxl-telegram"></i>
                                            Telegram </a>
                                    </p>

                                    <br>
                                    <footer class="blockquote-footer">Дата обновления <cite title="Source Title">14.12.2023
                                            v1.1</cite></footer>
                                </blockquote>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Журнал активности сайта</h4>
                        <form action="{{ route('delete_visitors') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger waves-effect waves-light">
                                Очистить
                            </button>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="line_chart_dashed" data-colors='["--bs-primary", "--bs-danger", "--bs-success"]'
                                class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @php
            $days = [];
            $count = [];

            $visitorsByDay = DB::select(' SELECT DATE(created_at) as day, COUNT(*) as count FROM visitors GROUP BY day  ');

            foreach ($visitorsByDay as $data) {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $data->day);
                $formattedDate = $date->isoFormat('D MMM');
                array_push($days, $formattedDate);
                array_push($count, $data->count);
            }

        @endphp

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Журнал активности B-CMS</h4>
                        <form action="{{ route('delete_logs') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger waves-effect waves-light">
                                Очистить
                            </button>
                        </form>

                    </div>

                    <div class="table-responsive">
                        <table id="files-table" class=" table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>IP</th>
                                    <th>Время входа</th>
                                </tr>
                            </thead>


                            <tbody>

                                @php
                                    $results = DB::select('SELECT * FROM `logs`');
                                @endphp

                                @foreach ($results as $result)
                                    <tr>
                                        <td>{{ $result->ip }}</td>
                                        <td>
                                            @php
                                                echo date('H:i d.m.Y', strtotime($result->time));
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('footer-links')
    <!-- Required datatable js -->
    <script src="{{ asset('public/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    {{--    <script src="{{ asset('public/assets/admin/js/pages/apexcharts.init.js') }}"></script> --}}
    <script>
        function getChartColorsArray(e) {
            if (null !== document.getElementById(e)) {
                var t = document.getElementById(e).getAttribute("data-colors");
                if (t)
                    return (t = JSON.parse(t)).map(function(e) {
                        var t = e.replace(" ", "");
                        if (-1 === t.indexOf(",")) {
                            var r = getComputedStyle(document.documentElement).getPropertyValue(t);
                            return r || t;
                        }
                        var o = e.split(",");
                        return 2 != o.length ? t : "rgba(" + getComputedStyle(document.documentElement)
                            .getPropertyValue(o[0]) + "," + o[1] + ")";
                    });
                console.warn("data-colors Attribute not found on:", e);
            }
        }

        var lineChartdashedColors = getChartColorsArray("line_chart_dashed");
        lineChartdashedColors &&
            ((options = {
                    chart: {
                        height: 380,
                        type: "line",
                        zoom: {
                            enabled: !1
                        },
                        toolbar: {
                            show: !1
                        }
                    },
                    colors: lineChartdashedColors,
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        width: [3, 4, 3],
                        curve: "straight",
                        dashArray: [0, 8, 5]
                    },
                    series: [{
                        name: "Поситители",
                        data: [
                            @php

                                foreach ($count as $c) {
                                    echo $c . ',';
                                }

                            @endphp
                        ]
                    }, ],
                    markers: {
                        size: 0,
                        hover: {
                            sizeOffset: 6
                        }
                    },
                    xaxis: {
                        categories: [
                            @php

                                foreach ($days as $day) {
                                    echo "\"" . $day . "\",";
                                }

                            @endphp
                        ]
                    },
                    tooltip: {
                        y: [{
                                title: {
                                    formatter: function(e) {
                                        return e + " ";
                                    },
                                },
                            },
                            {
                                title: {
                                    formatter: function(e) {
                                        return e + " per session";
                                    },
                                },
                            },
                            {
                                title: {
                                    formatter: function(e) {
                                        return e;
                                    },
                                },
                            },
                        ],
                    },
                    grid: {
                        borderColor: "#f1f1f1"
                    },
                }),
                (chart = new ApexCharts(document.querySelector("#line_chart_dashed"), options)).render());
    </script>
    <script>
        $(document).ready(function() {
            $('#files-table').DataTable();
        });
    </script>
@endsection
