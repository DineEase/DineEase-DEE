<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/manager.css">

    <title><?php echo SITENAME; ?></title>
</head>

<body>

    <div class="body-template" id="content">
        <div class="container">
            <div class="navbar-template">
                <nav class="navbar">
                    <div class="topbar">
                        <div class="logo-item">
                            <i class="bx bx-menu" id="sidebarOpen"></i>
                            <img src="<?php echo URLROOT ?>/public/img/login/dineease-logo.svg" alt="DineEase Logo">
                            <div class="topbar-title">
                                DINE<span>EASE</span>
                            </div>
                        </div>
                        <div class="navbar-content">
                            <div class="profile-details">
                                <span class="material-symbols-outlined material-symbols-outlined-topbar ">notifications </span>
                                Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; | &nbsp; <?php echo  $_SESSION['user_name'] ?></span>
                                <img src="<?php echo URLROOT ?>/public/img/login/profilepic.png" alt="profile-photo" class="profile" />
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="sidebar-template">
                <nav class="sidebar">
                    <div class="sidebar-container">
                        <div class="menu_content">
                            <hr class='separator'>
                            <ul class="menu_items">
                                <div class="menu_title menu_menu"></div>
                                <li class="item">
                                    <a href="" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    home
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">Dashboard </span>
                                        </button>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="#" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    manage_accounts
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">Users </span>
                                        </button>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="#" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    restaurant_menu
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">Menus </span>
                                        </button>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="#" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    percent
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">Discounts </span>
                                        </button>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="#" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    currency_exchange
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">Refund </span>
                                        </button>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="#" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    flip_to_front
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">Tables </span>
                                        </button>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="#" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    inventory_2
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">Inventory </span>
                                        </button>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="#" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    reviews
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">Reviews </span>
                                        </button>
                                    </a>
                                </li>
                                <!-- End -->


                            </ul>
                            <hr class='separator'>

                            <ul class="menu_items">
                                <div class="menu_title menu_user"></div>
                                <li class="item">
                                    <a href="#" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    account_circle
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">My Account </span>
                                        </button>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="<?php echo URLROOT; ?>/users/logout" class="nav_link">
                                        <button class="button-sidebar-menu">
                                            <span class="navlink_icon">
                                                <span class="material-symbols-outlined ">
                                                    logout
                                                </span>
                                            </span>
                                            <span class="button-sidebar-menu-content">Logout</span>
                                        </button>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="main-cards">

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">PRODUCTS</p>
                        <span class="material-icons-outlined text-blue">inventory_2</span>
                    </div>
                    <span class="text-primary font-weight-bold">249</span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">PURCHASE ORDERS</p>
                        <span class="material-icons-outlined text-orange">add_shopping_cart</span>
                    </div>
                    <span class="text-primary font-weight-bold">83</span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">SALES ORDERS</p>
                        <span class="material-icons-outlined text-green">shopping_cart</span>
                    </div>
                    <span class="text-primary font-weight-bold">79</span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">INVENTORY ALERTS</p>
                        <span class="material-icons-outlined text-red">notification_important</span>
                    </div>
                    <span class="text-primary font-weight-bold">56</span>
                </div>

            </div>

            <div class="charts">

                <div class="charts-card">
                    <p class="chart-title">Calender</p>
                    <div class="month">
                        <ul>
                            <li class="prev">&#10094;</li>
                            <li class="next">&#10095;</li>
                            <li>
                                August<br>
                                <span style="font-size:18px">2021</span>
                            </li>
                        </ul>
                    </div>

                    <ul class="weekdays">
                        <li>Mo</li>
                        <li>Tu</li>
                        <li>We</li>
                        <li>Th</li>
                        <li>Fr</li>
                        <li>Sa</li>
                        <li>Su</li>
                    </ul>

                    <ul class="days">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                        <li>6</li>
                        <li>7</li>
                        <li>8</li>
                        <li>9</li>
                        <li><span class="active">10</span></li>
                        <li>11</li>
                        <li>12</li>
                        <li>13</li>
                        <li>14</li>
                        <li>15</li>
                        <li>16</li>
                        <li>17</li>
                        <li>18</li>
                        <li>19</li>
                        <li>20</li>
                        <li>21</li>
                        <li>22</li>
                        <li>23</li>
                        <li>24</li>
                        <li>25</li>
                        <li>26</li>
                        <li>27</li>
                        <li>28</li>
                        <li>29</li>
                        <li>30</li>
                        <li>31</li>
                    </ul>
                </div>

                <div class="charts-card">
                    <p class="chart-title">Reservation statistic</p>
                    <div id="bar-chart"></div>
                </div>

                <div class="charts-card">
                    <p class="chart-title">Purchase and Sales Orders</p>
                    <div id="area-chart"></div>
                </div>

                <div class="charts-card">
                    <p class="chart-title">Reservation by status</p>
                    <div id="piechart"></div>
                </div>

            </div>
            </main>
            <!-- End Main -->


            <!-- Scripts -->
            <!-- ApexCharts -->

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
        <!-- Custom JS -->
        <script>
            // SIDEBAR TOGGLE

            let sidebarOpen = false;
            const sidebar = document.getElementById('sidebar');

            function openSidebar() {
                if (!sidebarOpen) {
                    sidebar.classList.add('sidebar-responsive');
                    sidebarOpen = true;
                }
            }

            function closeSidebar() {
                if (sidebarOpen) {
                    sidebar.classList.remove('sidebar-responsive');
                    sidebarOpen = false;
                }
            }

            // ---------- CHARTS ----------

            // BAR CHART
            const barChartOptions = {
                series: [{
                    data: [10, 8, 6, 4, 2],
                }, ],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false,
                    },
                },
                colors: ['#246dec', '#cc3c43', '#367952', '#f5b74f', '#4f35a1'],
                plotOptions: {
                    bar: {
                        distributed: true,
                        borderRadius: 4,
                        horizontal: false,
                        columnWidth: '40%',
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                xaxis: {
                    categories: ['finished', 'deposited', 'waiting payemnt', 'pending', 'canceled'],
                },
                yaxis: {
                    title: {
                        text: 'Count',
                    },
                },
            };

            const barChart = new ApexCharts(
                document.querySelector('#bar-chart'),
                barChartOptions
            );
            barChart.render();

            // AREA CHART
            const areaChartOptions = {
                series: [{
                        name: 'Purchase Orders',
                        data: [31, 40, 28, 51, 42, 109, 100],
                    },
                    {
                        name: 'Sales Orders',
                        data: [11, 32, 45, 32, 34, 52, 41],
                    },
                ],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false,
                    },
                },
                colors: ['#4f35a1', '#246dec'],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: 'smooth',
                },
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                markers: {
                    size: 0,
                },
                yaxis: [{
                        title: {
                            text: 'Purchase Orders',
                        },
                    },
                    {
                        opposite: true,
                        title: {
                            text: 'Sales Orders',
                        },
                    },
                ],
                tooltip: {
                    shared: true,
                    intersect: false,
                },
            };

            const areaChart = new ApexCharts(
                document.querySelector('#area-chart'),
                areaChartOptions
            );
            areaChart.render();
        </script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Reservation Count'],
                    ['finished', 8],
                    ['Deposited', 6],
                    ['Waiting Payment', 4],
                    ['Pending', 3],
                    ['Canceled', 3]

                ]);

                // Optional; add a title and set the width and height of the chart
                var options = {
                    'title': 'Reservation Status',
                    'width': 550,
                    'height': 400
                };

                // Display the chart inside the <div> element with id="piechart"
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
</body>

</html>