<style>
body {color:#636260; margin: 0px;}
table {border: 1px solid #DDD;border-collapse: collapse;margin: 0.5em 0.1em;width: 99%;background-color: #f7f7f7;}
td {border: 1px groove #DDD;padding: 4px;vertical-align: top;font-size: 11px; font-family: Verdana, sans-serif;}
.rowhead {font-weight: bold;background-color: #E6E6E6;}
.rowtotal {font-weight: bold;}






</style>

<div id=graph></div>


<?php



// Dimensions here: http://code.google.com/apis/analytics/docs/gdata/gdataReferenceDimensionsMetrics.html#m1Visitor
// Codebase here: http://code.google.com/p/gapi-google-analytics-php-interface/


function secs2hms($secs) { 
  if ($secs<0) return false; 
  $m = (int)($secs / 60); $s = $secs % 60; 
  $h = (int)($m / 60); $m = $m % 60; 
  return array(sprintf('%02d',$m), sprintf('%02d',$s)); 
} 

include 'config.inc';

require 'inc/gapi.class.php';

$ga = new gapi(ga_email,ga_password);

$ga->requestReportData(ga_profile_id,array('date'),array('pageviews','visits', 'newVisits', 'timeOnSite'), array('-date'), $filter=null, $start_date=date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 4, date("Y"))), $end_date=Date('Y-m-d'));

echo "<div id=data><table><tr class='rowhead'><td>Date</td><td>Visits</td><td>Page Views</td><td>First Time</td><td>Time Spent</tr>";
foreach($ga->getResults() as $result)
{
  echo '<tr>';
  echo '<td>'.substr($result, 4, -2).'/'.substr($result, -2).'</td>';
  echo '<td>' . $result->getVisits() . '</td>';
  echo '<td>' . $result->getPageviews() . '</td>';
  echo '<td>' . $result->getnewVisits() . '</td>';
  echo '<td>' . implode(':', secs2hms(($result->gettimeOnSite()/$result->getVisits()))) . '</td>';
  echo '</tr>';
  
  if ($result->getPageviews() > $chartheight)
  		$chartheight = $result->getPageviews();
  
  $chart_visits = $chart_visits.$result->getVisits().",";
  $chart_pageviews = $chart_pageviews.$result->getPageviews().",";
  $chart_labels = $chart_labels.substr($result, 4, -2)."/".substr($result, -2)."|";
  
}
  echo '<tr class="rowtotal">';
  echo '<td></td>';
  echo '<td>' . $ga->getVisits() . '</td>';
  echo '<td>' . $ga->getPageviews() . '</td>';
  echo '<td>' . $ga->getnewVisits() . '</td>';
  echo '<td>' . implode(':', secs2hms(($ga->gettimeOnSite()/$ga->getVisits()))) . '</td>';
  echo '</tr>';

echo "</table></div>";

$chart = "<img src='http://chart.apis.google.com/chart?cht=bvg&chco=4D89F9,C6D9FD&chbh=20,4,20&chxt=x&chd=t:".substr($chart_visits, 0, -1)."|".substr($chart_pageviews, 0, -1)."&chs=355x150&chl=".substr($chart_labels, 0, -1)."&chds=0,".($chartheight+20)."'>";

?>

<script>
document.getElementById('graph').innerHTML = "<?php echo $chart ?>";
</script>