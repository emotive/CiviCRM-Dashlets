<?php 
// Show errors remove later
error_reporting(E_ALL);
ini_set('display_errors', '1');



include 'config.inc';

require 'inc/gapi.class.php';

$ga = new gapi(ga_email,ga_password);

//$ga->requestReportData(ga_profile_id,array('campaign'),array('cpc','cpm','adCost','visits'));
$ga->requestReportData(ga_profile_id,array('campaign'),array('itemRevenue','adCost'), array('-itemRevenue'), $filter=null, $start_date=date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 600, date("Y"))), $end_date=Date('Y-m-d'));



foreach($ga->getResults() as $result)
{
echo "<strong>".$result->getCampaign()."</strong><br>";
echo "Total Costs: $".$result->getadCost()."<br>";
//echo "Total Visitors: ".$result->getvisits()."<br>";

//echo "CPC: $".round($result->getCPC(),2)."<br>";
//echo "CPM: $".round($result->getCPM(),2)."<br>";

echo "Total Raised: $".$result->getitemRevenue()."<br>";


echo "<br>";

}


?>