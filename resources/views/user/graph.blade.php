<div id="graphs" class="graphs row" style="display:flex;">
  <div class="pie-graph col-sm-6">
    <canvas id="myPieChart" data-url="{{config('app.url')}}"></canvas>
    <div class="form-group">
      <select id="chart-select" class="form-control" v-model="selectedMonth" @change="getRecords">
          <option v-for="month in months" :value="month">@{{ month.name }}</option>
      </select>
    </div>
  </div>
  <table id="count-table" class="col-sm-6 table table-bordered">
    <tr>
      <thead class="thead-light">
        <th>部位</th>
        <th>回数</th>
      </thead>
    </tr>
    <tr class="table-template" style="display:none;">
      <td class="table-parts"></td>
      <td class="table-count"></td>
    </tr>
  </table>
</div>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>　　　　　　　
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

  <script>
  const app_url = document.getElementById('myPieChart').dataset.url;
  const user_id = @json($user->id);
    new Vue({
      el:'#graphs' ,
      data: {
        selectedMonth: {value:'{{date('Ym')}}' , name:'{{date('Y年m月')}}'},
        months: [] ,
        chart:null
      } ,
      methods: {
        getMonths(){
          fetch(app_url + '/ajax/tags/months/' + user_id)
              .then(response => response.json())
              .then(data => this.months = data);
        } ,
        getRecords(){
          var parts = [];
          var count = [];
          fetch(app_url + '/ajax/tags/' + user_id + '?month=' + this.selectedMonth.value)
           .then(response => response.json())
           .then(data => {
             for(key in data){
               parts.push(key); //部位の配列
               count.push(data[key]); // 回数の配列
             }
             //表
             $('#count-table').find('.table-visible').remove();

             for(var i = 0;i < parts.length ; i++){
               var tableClone = $('.table-template').clone().removeAttr('style').removeClass('table-template').addClass('table-visible');
               tableClone.children('.table-parts').text(parts[i]);
               tableClone.children('.table-count').text(count[i] + '回');
               $('#count-table').append(tableClone);
             }
             //グラフ
             if(this.chart) { // チャートが存在していれば初期化
                this.chart.destroy();
             }
             var ctx = document.getElementById("myPieChart");
             this.chart = new Chart(ctx, {
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
             });

           });
        },
    } ,
    mounted: function(){
    this.getMonths();
    this.getRecords();
  }
    });



   </script>
