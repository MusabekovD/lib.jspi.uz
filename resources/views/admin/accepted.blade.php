<canvas id="countStudents" width="300" height="300"></canvas>
<script>
    $(function() {

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        {{ $studentsCount }},
                        {{ $accepted }}                        
                    ],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)'
                    ]
                }],
                labels: [
                    'Nazoratchilar soni',
                    'Qabul qilganlar soni'
                    
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