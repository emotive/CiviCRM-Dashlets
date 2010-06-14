<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1', {'packages':['piechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create our data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Donor Range');
        data.addColumn('number', '# Donations');
        data.addRows([
          ['< $100', <?php echo $_GET['1'] ?>],
          ['$101-250',  <?php echo  $_GET['2'] ?>],
          ['$251-500',  <?php echo  $_GET['3'] ?>],
          ['$501-1000',  <?php echo  $_GET['4'] ?>],
          ['1000+',  <?php echo  $_GET['5'] ?>]
        ]);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('donorgraph_div'));
        chart.draw(data, {width: 300, height: 150, is3D: false, legendFontSize: 11});
      }
    </script>
    
<div id="donorgraph_div"></div>    
