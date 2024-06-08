<div class="card-body p-0" id="cadres-container">

    <canvas id="myChart" width="400" height="400"></canvas>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Occuper', 'Disponible'],
            datasets: [{
                data: [{{ $occuper }}, {{ $dispo }}],
                backgroundColor: ['red', 'green'],
            }]
        },
        options: {
        }
    });
</script>
