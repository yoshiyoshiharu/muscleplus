
  <canvas id="myPieChart" data-url="{{config('app.url')}}"></canvas>
　　　　　　　
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
  <script>
    const app_url = document.getElementById('myPieChart').dataset.url;
    const user_id = @json($user->id);
    const url = app_url + '/ajax/tags/' + user_id;
    console.log(url);
    var parts = [];
    var count = [];
    fetch(url)
     .then(response => response.json())
     .then(data => {
       for(key in data){
         parts.push(key);
         count.push(data[key]);
       }

       var ctx = document.getElementById("myPieChart");
       var myPieChart = new Chart(ctx, {
       type: 'pie',
       data: {
         datasets: [{
             data: count,
             backgroundColor: [
                 'rgb(255, 99, 132)',
                 'rgb(255, 159, 64)',
                 'rgb(255, 205, 86)',
                 'rgb(75, 192, 192)',
                 'rgb(54, 162, 235)',
                 'rgb(153, 102, 255)',
                 'rgb(201, 203, 207)'
             ]
         }],
         labels: parts
      },
      options: {
         title: {
             display: true,
             fontSize: 30,
             text: '記録統計'
         }
       }
     });

     });

   </script>
