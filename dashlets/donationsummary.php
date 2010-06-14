<style>
table {border: 1px solid #DDD;border-collapse: collapse;margin: 0.5em 0.1em;width: 99%;background-color: #f7f7f7;}
td {border: 1px groove #DDD;padding: 4px;vertical-align: top;font-size: 11px; font-family: Verdana, sans-serif;}
.rowhead {font-weight: bold;background-color: #E6E6E6;}
.rowtotal {font-weight: bold;}
</style>


<?php 


include 'config.inc';

$link = mysql_connect($mysql_host, $mysql_login, $mysql_pass);
mysql_select_db($mysql_db, $link);


//Get all time totals
$result = mysql_query("SELECT total_amount FROM civicrm_contribution", $link);
$total_donations = mysql_num_rows($result);

$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution", $link);
$total_raised = mysql_fetch_array($result);


//Get today
$result = mysql_query("SELECT total_amount FROM civicrm_contribution where Date(receive_date) = Date(CURDATE())", $link);
$today_donations = mysql_num_rows($result);

$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution where Date(receive_date) = Date(CURDATE())", $link);
$today_raised = mysql_fetch_array($result);


//Get yesterday
$result = mysql_query("SELECT total_amount FROM civicrm_contribution where Date(receive_date) = Date(CURDATE()-1)", $link);
$yesterday_donations = mysql_num_rows($result);

$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution where Date(receive_date) = Date(CURDATE()-1)", $link);
$yesterday_raised = mysql_fetch_array($result);


//Get this week
$result = mysql_query("SELECT total_amount FROM civicrm_contribution WHERE YEARweek(receive_date) = YEARweek(CURRENT_DATE)", $link);
$thisweek_donations = mysql_num_rows($result);

$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution WHERE YEARweek(receive_date) = YEARweek(CURRENT_DATE)", $link);
$thisweek_raised = mysql_fetch_array($result);


//Get last week
$result = mysql_query("SELECT total_amount FROM civicrm_contribution WHERE YEARweek(receive_date) = YEARweek(CURRENT_DATE - INTERVAL 7 DAY) ", $link);
$lastweek_donations = mysql_num_rows($result);

$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution WHERE YEARweek(receive_date) = YEARweek(CURRENT_DATE - INTERVAL 7 DAY) ", $link);
$lastweek_raised = mysql_fetch_array($result);


//Get this month
$result = mysql_query("SELECT total_amount FROM civicrm_contribution WHERE MONTH(receive_date) = MONTH(CURDATE())", $link);
$thismonth_donations = mysql_num_rows($result);

$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution WHERE MONTH(receive_date) = MONTH(CURDATE())", $link);
$thismonth_raised = mysql_fetch_array($result);


//Get last month
$result = mysql_query("SELECT total_amount FROM civicrm_contribution WHERE MONTH(receive_date) = (MONTH(CURDATE())-1)", $link);
$lastmonth_donations = mysql_num_rows($result);

$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution WHERE MONTH(receive_date) = (MONTH(CURDATE())-1)", $link);
$lastmonth_raised = mysql_fetch_array($result);


//Get this month
$result = mysql_query("SELECT total_amount FROM civicrm_contribution WHERE quarter(receive_date) = quarter(CURDATE())", $link);
$thisquarter_donations = mysql_num_rows($result);

$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution WHERE quarter(receive_date) = quarter(CURDATE())", $link);
$thisquarter_raised = mysql_fetch_array($result);



?>


<table>
	<tr class='rowhead'>
		<td></td>
		<td>Total $</td>
		<td># Donations</td>
		<td>Average Gift</td>
	</tr>
	<tr>
		<td>Today</td>
		<td>$<?php echo number_format($today_raised['total'],2) ?></td>
		<td><?php echo $today_donations ?></td>
		<td>$<?php echo number_format($today_raised['total']/$today_donations,2) ?></td>
	</tr>
	<tr>
		<td>Yesterday</td>
		<td>$<?php echo number_format($yesterday_raised['total'],2) ?></td>
		<td><?php echo $yesterday_donations ?></td>
		<td>$<?php echo number_format($yesterday_raised['total']/$yesterday_donations,2) ?></td>
	</tr>
	<tr>
		<td>This Week</td>
		<td>$<?php echo number_format($thisweek_raised['total'],2) ?></td>
		<td><?php echo $thisweek_donations ?></td>
		<td>$<?php echo number_format($thisweek_raised['total']/$thisweek_donations,2) ?></td>
	</tr>	
	<tr>
		<td>Last Week</td>
		<td>$<?php echo number_format($lastweek_raised['total'],2) ?></td>
		<td><?php echo $lastweek_donations ?></td>
		<td>$<?php echo number_format($lastweek_raised['total']/$lastweek_donations,2) ?></td>
	</tr>
	<tr>
		<td>This Month</td>
		<td>$<?php echo number_format($thismonth_raised['total'],2) ?></td>
		<td><?php echo $thismonth_donations ?></td>
		<td>$<?php echo number_format($thismonth_raised['total']/$thismonth_donations,2) ?></td>
	</tr>
	<tr>
		<td>Last Month</td>
		<td>$<?php echo number_format($lastmonth_raised['total'],2) ?></td>
		<td><?php echo $lastmonth_donations ?></td>
		<td>$<?php echo number_format($lastmonth_raised['total']/$lastmonth_donations,2) ?></td>
	</tr>
	<tr>
		<td>This Quarter</td>
		<td>$<?php echo number_format($thisquarter_raised['total'],2) ?></td>
		<td><?php echo $thisquarter_donations ?></td>
		<td>$<?php echo number_format($thisquarter_raised['total']/$thisquarter_donations,2) ?></td>
	</tr>
	<tr class='rowtotal'>
		<td>All Time</td>
		<td>$<?php echo number_format($total_raised['total'],2) ?></td>
		<td><?php echo $total_donations ?></td>
		<td>$<?php echo number_format($total_raised['total']/$total_donations,2) ?></td>
	</tr>
</table>