<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>

<body>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script>
        $.getJSON("../file.json", function(json) {
            //
            console.log(json);
            var labels = json.map(function(item) {
                return item.prenom;
            });
            var datas = json.map(function(item) {
                return item.score;
            });
            var data = {
                labels: labels,
                datasets: [{
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: datas
                }]
            };
            var ctx = document.getElementById("myChart").getContext("2d");
            ctx.canvas.width = 750;
            ctx.canvas.height = 400;
            var myChart = new Chart(ctx).Bar(data);
        });
    </script>
</body>