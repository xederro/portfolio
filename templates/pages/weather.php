  <div class="container" style="width: 100%">

    <div class="container-sm">
      <div class="card mt-4 w-100 p-0" style="width: 300px">
          <div class="card-header">
              <h1 class="h1">Weather: <span id="time"></span></h1>
          </div>
          <ul class="list-group list-group-flush">
              <li class="list-group-item list-group-item-dark">
                  <h6>
                      <i class="bi bi-thermometer-half"></i>
                      <span id="temperature"></span> &deg;C
                  </h6>
              </li>
              <li class="list-group-item list-group-item-dark">
                  <h6>
                      <i class="bi bi-speedometer"></i>
                      <span id="pressure"></span> hPa
                  </h6>
              </li>
              <li class="list-group-item list-group-item-dark">
                  <h6>
                      <i class="bi bi-droplet"></i>
                      <span id="humidity"></span> %
                  </h6>
              </li>
              <li class="list-group-item list-group-item-dark">
                  <h6>
                      <i class="bi bi-sun"></i>
                      <span id="light"></span> lux
                  </h6>
              </li>
          </ul>
      </div>


        <div class="card my-4 w-100 p-0">
            <div class="card-header">
                <div class="row">
                    <h1 class="h1 col-9">Charts:</h1>
                    <div class="btn-group col">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span data-feather="calendar"></span>
                            <span id="sort">Hour</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><button class="dropdown-item" value="Hour" onclick="change('Hour')">Hour</button></li>
                            <li><button class="dropdown-item" value="Day" onclick="change('Day')">Day</button></li>
                            <li><button class="dropdown-item" value="Week" onclick="change('Week')">Week</button></li>
                            <li><button class="dropdown-item" value="Month" onclick="change('Month')">Month</button></li>
                            <li><button class="dropdown-item" value="Year" onclick="change('Year')">Year</button></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card mt-4">
                    <div class="card-header">
                        <h1 class="h2">Temperature</h1>
                    </div>
                    <div class="card-body">
                        <canvas class="my-4 w-100" id="tempChart" width="900" height="380"></canvas>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h1 class="h2">Pressure</h1>
                    </div>
                    <div class="card-body">
                        <canvas class="my-4 w-100" id="presChart" width="900" height="380"></canvas>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h1 class="h2">Humidity</h1>
                    </div>
                    <div class="card-body">
                        <canvas class="my-4 w-100" id="humChart" width="900" height="380"></canvas>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h1 class="h2">Ambient Light</h1>
                    </div>
                    <div class="card-body">
                        <canvas class="my-4 w-100" id="lightChart" width="900" height="380"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/weather.min.js"></script>
    <script>
      graphInit();
      dataUpdate(false);
    </script>
  </div>
