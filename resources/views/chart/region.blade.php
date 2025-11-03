<canvas id="countStudents" width="500" height="500"></canvas>
<script>
    $(function() {

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        @foreach($stat as $itemValue)
                        {{$itemValue->soni}},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                        'rgb(54, 150, 235)',
                        'rgb(25, 99, 132)',
                        'rgb(54, 180, 235)',
                        'rgb(255, 99, 190)',
                        'rgb(54, 150, 210)',
                        'rgb(60, 50, 132)',
                        'rgb(44, 188, 235)',
                        'rgb(255, 45, 70)',
                        'rgb(255, 162, 23)',
                        'rgb(225, 10, 132)',
                        'rgb(54, 160, 215)',
                        'rgb(212, 20, 142)'
                    ]
                }],
                labels: [
                    @foreach($stat as $itemName)
                        "{{$itemName->adress}}",
                    @endforeach

                ]
            },
            options: {
                maintainAspectRatio: false
            }
        };

        var ctx = document.getElementById('countStudents').getContext('2d');
        new Chart(ctx, config);
    });
</script>