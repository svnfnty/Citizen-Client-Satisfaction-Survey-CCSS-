



 <?php  
 $connect = mysqli_connect("localhost", "root", "zxlecya", "ccss_db");  
 $query = "SELECT description, count(*) as number FROM ccss_ratings GROUP BY description";  
 $result = mysqli_query($connect, $query);  
 ?>  

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Ratings', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["description"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Ratings in Clients',  
                      //is3D:true,  
                      pieHole: 0.1  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script> 