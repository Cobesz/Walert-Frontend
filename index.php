<?php

$servername = "localhost";
$username = "root";
$password = "root";
$db = "walert";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM prototype";

$results = mysqli_query($conn, $query);

//var_dump($results);
while ($row = mysqli_fetch_assoc($results)) {
    $id = $row['id'];
    $datetime = $row['datetime'];
    $total = $row['totalwater'];
    $douche = $row['douche'];
    $keukenkraan = $row['keukenkraan'];
    $wastafel = $row['wastafel'];
}


// Close the connection
mysqli_close($conn);

//maand gedeelte

//query
// SELECT DAY(datetime) as day, MAX(totalwater), MAX(douche), MAX(keukenkraan), MAX(wastafel) FROM prototype WHERE MONTH(datetime) = MONTH(NOW()) GROUP BY day

//jaar gedeelte

//query optellen

?>

<html>
<head>
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
          href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Verbruik per dag'],
                ['Douche',      <?= $douche ?>],
                ['Keukenkraan',  <?= $keukenkraan ?>],
                ['Wastafel', <?= $wastafel ?>]
            ]);

            var options = {
                title: 'Water Verbruik. Totaal verbruik is <?=$total?> Liter',
                backgroundColor: 'none',
                slices: {
                    1: {offset: 0.1},
                    2: {offset: 0.1}
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

    <!--jQuery-->
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>


</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>

<div id="datetimepicker" class="input-append date">
    <input type="text"></input>
    <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
</div>


<script type="text/javascript"
        src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
<script type="text/javascript"
        src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
</script>
<script type="text/javascript"
        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
</script>
<script type="text/javascript"
        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
</script>
<script type="text/javascript">
    $('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
//        language: 'pt-BR'
    });
</script>
</body>
</html>