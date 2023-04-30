<x-app-layout>
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Total Collections</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-activity"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>GHS{{number_format($totalCollections,2)}}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Total Commissions</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>GHS{{number_format($totalCharges,2)}}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Users</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$totalUsers}}</h6>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">


                            <div class="card-body">
                                <h5 class="card-title">Transactions</h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Collections',
                                                data: [],
                                            }, {
                                                name: 'Charges',
                                                data: []
                                            },],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'month',
                                                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Nov", "Dec"]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">


                            <div class="card-body">
                                <h5 class="card-title">Recent Transactions</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Event</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($recentTransactions as $transaction)
                                        <tr>
                                            <td>{{number_format($transaction->amount,2)}}</td>
                                            <td>{{$transaction->name}}</td>
                                            <td>{{$transaction->phone_number}}</td>
                                            <td><a target="_blank" href="{{\App\Services\UtilityService::APP_URL."/w/".$transaction->wedding->tag}}" class="text-primary">{{$transaction->wedding->tag}}</a></td>
                                            <td>
                                                @if($transaction->success)
                                                    <span class="badge bg-success-light text-success">Success</span>

                                                @else

                                                    <span
                                                        class="badge bg-danger-light p-3 text-danger">Failed/Pending</span>

                                                @endif
                                            </td>
                                            <td>{{$transaction->created_at}}</td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="card-body pb-0">
                                <h5 class="card-title">Recent Events</h5>

                                <table class="table table-borderless">

                                    <thead>
                                    <tr>
                                        <th scope="col">Photo</th>
                                        <th scope="col">tag</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($recentWeddings as $wedding)
                                        <tr>
                                            <th scope="row"><a><img
                                                        src="{{$wedding->photo_one}}" alt=""></a></th>
                                            <td><a  target="_blank" href="{{\App\Services\UtilityService::APP_URL."/w/".$wedding->tag}}" class="text-primary fw-bold">{{$wedding->tag}}</a></td>
                                            <td><a href="{{route("users.show",$wedding->user_id)}}"
                                                   class="text-primary fw-bold">{{$wedding->user->first_name}}</a></td>
                                            <td>{{$wedding->created_at}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">


                    <div class="card-body">
                        <h5 class="card-title">Balances</h5>

                        <div class="activity">

                            <div class="activity-item text-center">
                                <h1>GHS{{number_format($balance,2)}}</h1>
                                <small>Payswitch Balance</small>
                                <a class="d-block" href="https://dashboard.theteller.net/login" target="_blank">Login to
                                    Dashboard</a>
                            </div><!-- End activity item-->

                        </div>

                    </div>
                </div><!-- End Recent Activity -->

            {{--                <!-- Budget Report -->--}}
            {{--                <div class="card">--}}
            {{--                    <div class="filter">--}}
            {{--                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>--}}
            {{--                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">--}}
            {{--                            <li class="dropdown-header text-start">--}}
            {{--                                <h6>Filter</h6>--}}
            {{--                            </li>--}}

            {{--                            <li><a class="dropdown-item" href="#">Today</a></li>--}}
            {{--                            <li><a class="dropdown-item" href="#">This Month</a></li>--}}
            {{--                            <li><a class="dropdown-item" href="#">This Year</a></li>--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}

            {{--                    <div class="card-body pb-0">--}}
            {{--                        <h5 class="card-title">Budget Report <span>| This Month</span></h5>--}}

            {{--                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>--}}

            {{--                        <script>--}}
            {{--                            document.addEventListener("DOMContentLoaded", () => {--}}
            {{--                                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({--}}
            {{--                                    legend: {--}}
            {{--                                        data: ['Allocated Budget', 'Actual Spending']--}}
            {{--                                    },--}}
            {{--                                    radar: {--}}
            {{--                                        // shape: 'circle',--}}
            {{--                                        indicator: [{--}}
            {{--                                            name: 'Sales',--}}
            {{--                                            max: 6500--}}
            {{--                                        },--}}
            {{--                                            {--}}
            {{--                                                name: 'Administration',--}}
            {{--                                                max: 16000--}}
            {{--                                            },--}}
            {{--                                            {--}}
            {{--                                                name: 'Information Technology',--}}
            {{--                                                max: 30000--}}
            {{--                                            },--}}
            {{--                                            {--}}
            {{--                                                name: 'Customer Support',--}}
            {{--                                                max: 38000--}}
            {{--                                            },--}}
            {{--                                            {--}}
            {{--                                                name: 'Development',--}}
            {{--                                                max: 52000--}}
            {{--                                            },--}}
            {{--                                            {--}}
            {{--                                                name: 'Marketing',--}}
            {{--                                                max: 25000--}}
            {{--                                            }--}}
            {{--                                        ]--}}
            {{--                                    },--}}
            {{--                                    series: [{--}}
            {{--                                        name: 'Budget vs spending',--}}
            {{--                                        type: 'radar',--}}
            {{--                                        data: [{--}}
            {{--                                            value: [4200, 3000, 20000, 35000, 50000, 18000],--}}
            {{--                                            name: 'Allocated Budget'--}}
            {{--                                        },--}}
            {{--                                            {--}}
            {{--                                                value: [5000, 14000, 28000, 26000, 42000, 21000],--}}
            {{--                                                name: 'Actual Spending'--}}
            {{--                                            }--}}
            {{--                                        ]--}}
            {{--                                    }]--}}
            {{--                                });--}}
            {{--                            });--}}
            {{--                        </script>--}}

            {{--                    </div>--}}
            {{--                </div><!-- End Budget Report -->--}}

            {{--                <!-- Website Traffic -->--}}
            {{--                <div class="card">--}}
            {{--                    <div class="filter">--}}
            {{--                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>--}}
            {{--                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">--}}
            {{--                            <li class="dropdown-header text-start">--}}
            {{--                                <h6>Filter</h6>--}}
            {{--                            </li>--}}

            {{--                            <li><a class="dropdown-item" href="#">Today</a></li>--}}
            {{--                            <li><a class="dropdown-item" href="#">This Month</a></li>--}}
            {{--                            <li><a class="dropdown-item" href="#">This Year</a></li>--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}

            {{--                    <div class="card-body pb-0">--}}
            {{--                        <h5 class="card-title">Website Traffic <span>| Today</span></h5>--}}

            {{--                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>--}}

            {{--                        <script>--}}
            {{--                            document.addEventListener("DOMContentLoaded", () => {--}}
            {{--                                echarts.init(document.querySelector("#trafficChart")).setOption({--}}
            {{--                                    tooltip: {--}}
            {{--                                        trigger: 'item'--}}
            {{--                                    },--}}
            {{--                                    legend: {--}}
            {{--                                        top: '5%',--}}
            {{--                                        left: 'center'--}}
            {{--                                    },--}}
            {{--                                    series: [{--}}
            {{--                                        name: 'Access From',--}}
            {{--                                        type: 'pie',--}}
            {{--                                        radius: ['40%', '70%'],--}}
            {{--                                        avoidLabelOverlap: false,--}}
            {{--                                        label: {--}}
            {{--                                            show: false,--}}
            {{--                                            position: 'center'--}}
            {{--                                        },--}}
            {{--                                        emphasis: {--}}
            {{--                                            label: {--}}
            {{--                                                show: true,--}}
            {{--                                                fontSize: '18',--}}
            {{--                                                fontWeight: 'bold'--}}
            {{--                                            }--}}
            {{--                                        },--}}
            {{--                                        labelLine: {--}}
            {{--                                            show: false--}}
            {{--                                        },--}}
            {{--                                        data: [{--}}
            {{--                                            value: 1048,--}}
            {{--                                            name: 'Search Engine'--}}
            {{--                                        },--}}
            {{--                                            {--}}
            {{--                                                value: 735,--}}
            {{--                                                name: 'Direct'--}}
            {{--                                            },--}}
            {{--                                            {--}}
            {{--                                                value: 580,--}}
            {{--                                                name: 'Email'--}}
            {{--                                            },--}}
            {{--                                            {--}}
            {{--                                                value: 484,--}}
            {{--                                                name: 'Union Ads'--}}
            {{--                                            },--}}
            {{--                                            {--}}
            {{--                                                value: 300,--}}
            {{--                                                name: 'Video Ads'--}}
            {{--                                            }--}}
            {{--                                        ]--}}
            {{--                                    }]--}}
            {{--                                });--}}
            {{--                            });--}}
            {{--                        </script>--}}

            {{--                    </div>--}}
            {{--                </div><!-- End Website Traffic -->--}}

            <!-- News & Updates Traffic -->
                {{--                <div class="card">--}}
                {{--                    <div class="filter">--}}
                {{--                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>--}}
                {{--                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">--}}
                {{--                            <li class="dropdown-header text-start">--}}
                {{--                                <h6>Filter</h6>--}}
                {{--                            </li>--}}

                {{--                            <li><a class="dropdown-item" href="#">Today</a></li>--}}
                {{--                            <li><a class="dropdown-item" href="#">This Month</a></li>--}}
                {{--                            <li><a class="dropdown-item" href="#">This Year</a></li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}

                {{--                    <div class="card-body pb-0">--}}
                {{--                        <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>--}}

                {{--                        <div class="news">--}}
                {{--                            <div class="post-item clearfix">--}}
                {{--                                <img src="assets/img/news-1.jpg" alt="">--}}
                {{--                                <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>--}}
                {{--                                <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>--}}
                {{--                            </div>--}}

                {{--                            <div class="post-item clearfix">--}}
                {{--                                <img src="assets/img/news-2.jpg" alt="">--}}
                {{--                                <h4><a href="#">Quidem autem et impedit</a></h4>--}}
                {{--                                <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>--}}
                {{--                            </div>--}}

                {{--                            <div class="post-item clearfix">--}}
                {{--                                <img src="assets/img/news-3.jpg" alt="">--}}
                {{--                                <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>--}}
                {{--                                <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>--}}
                {{--                            </div>--}}

                {{--                            <div class="post-item clearfix">--}}
                {{--                                <img src="assets/img/news-4.jpg" alt="">--}}
                {{--                                <h4><a href="#">Laborum corporis quo dara net para</a></h4>--}}
                {{--                                <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>--}}
                {{--                            </div>--}}

                {{--                            <div class="post-item clearfix">--}}
                {{--                                <img src="assets/img/news-5.jpg" alt="">--}}
                {{--                                <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>--}}
                {{--                                <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>--}}
                {{--                            </div>--}}

                {{--                        </div><!-- End sidebar recent posts-->--}}

                {{--                    </div>--}}
                {{--                </div><!-- End News & Updates -->--}}

            </div><!-- End Right side columns -->

        </div>
    </section>

</x-app-layout>
