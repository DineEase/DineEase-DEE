
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  
  <!-- Material Icons -->

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/common.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/inventory manager.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>


<h2>INVENTORIES</h2>


<div class="row">
<div class="column">
  <div class="card">
  <i class="fa-solid fa-warehouse"></i>
    <h3>Inventory 1</h3>
    <button class="button">  View More <i class="fa-solid fa-circle-arrow-right"></i></button>
  </div>
</div>


<div class="column">
  <div class="card">
  <i class="fa-solid fa-warehouse"></i>
    <h3>Inventory 2</h3>
    <button class="button">  View More <i class="fa-solid fa-circle-arrow-right"></i></button>

  </div>
</div>

<div class="column">
  <div class="card">
  <i class="fa-solid fa-warehouse"></i>
    <h3>Inventory 3</h3>
      <button class="button">  View More <i class="fa-solid fa-circle-arrow-right"></i></button>

  </div>
</div>

<div class="column">
  <div class="card">
  <i class="fa-solid fa-warehouse"></i>
    <h3>Inventory 4</h3>
      <button class="button">  View More <i class="fa-solid fa-circle-arrow-right"></i></button>

  </div>
</div>
</div>

  <div class="charts">

        <div class="charts-card">
          <p class="chart-title">Inventories</p>
          <div id="bar-chart"></div>
        </div>

        <div class="charts-card">
          <p class="chart-title">Recieved Orders & Mark Out Stocks</p>
          <div id="area-chart"></div>
        </div>

      </div>
    </main>

  </div>

  <!-- Scripts -->
  <!-- ApexCharts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
  <!-- Custom JS -->
      <script>
          // BAR CHART
          const barChartOptions = {
          series: [
              {
              data: [10, 8, 6, 4],
              },
          ],
          chart: {
              type: 'bar',
              height: 350,
              toolbar: {
              show: false,
              },
          },
          colors: ['#246dec', '#cc3c43', '#367952', '#f5b74f'],
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
              categories: ['Inventory1', 'Inventory2', 'Inventory3', 'Inventory4'],
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
          series: [
              {
              name: 'Mak Out Stock',
              data: [31, 40, 28, 51, 42, 109, 100],
              },
              {
              name: 'Recieved orders',
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
          yaxis: [
              {
              title: {
                  text: 'Make Out Stock',
              },
              },
              {
              opposite: true,
              title: {
                  text: 'Recieved Orders',
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

<!-- <body>
<div class="container">

  <section class="main">
    <div class="main-top">
      <h1>Inventories</h1>
    </div>
    <div class="main-skills">
      <div class="card">
        <i class="fa-solid fa-warehouse"></i>
        <h3>Inventory 1</h3>
        <p>This is the inventory of vegetables.</p>
        <button>view more</button>
      </div>
      <div class="card">
        <i class="fa-solid fa-warehouse"></i>
        <h3>Inventory 2</h3>
        <p>JThis is the inventory of vegetables.</p>
        <button>view more</button>
      </div>
      <div class="card">
        <i class="fa-solid fa-warehouse"></i>
        <h3>Inventory 3</h3>
        <p>This is the inventory of vegetables.</p>
        <button>view more</button>
      </div>
      <div class="card">
        <i class="fa-solid fa-warehouse"></i>
        <h3>Inventory 4</h3>
        <p>This is the inventory of vegetables.</p>
        <button>view more</button>
      </div>
    </div> -->

    <!-- <section class="main-course">
      <h1>My courses</h1>
      <div class="course-box">
        <ul>
          <li class="active">In progress</li>
          <li>explore</li>
          <li>incoming</li>
          <li>finished</li>
        </ul>
        <div class="course">
          <div class="box">
            <h3>HTML</h3>
            <p>80% - progress</p>
            <button>continue</button>
            <i class="fab fa-html5 html"></i>
          </div>
          <div class="box">
            <h3>CSS</h3>
            <p>50% - progress</p>
            <button>continue</button>
            <i class="fab fa-css3-alt css"></i>
          </div>
          <div class="box">
            <h3>JavaScript</h3>
            <p>30% - progress</p>
            <button>continue</button>
            <i class="fab fa-js-square js"></i>
          </div>
        </div>
      </div>
    </section>
  </section>
</div> -->
</body>
