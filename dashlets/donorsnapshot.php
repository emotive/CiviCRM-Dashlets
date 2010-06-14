<style>
#donorgraph_div {width: 330px;float:left;margin-left:-30px;margin-top:-20px;}
.dashlet_donor_data li {list-style-image: url(/dashlets/images/bullet.gif); padding:0px; margin: 0px;}
</style>

<?php 


include 'config.inc';

$link = mysql_connect($mysql_host, $mysql_login, $mysql_pass);
mysql_select_db($mysql_db, $link);


//Get total number of donations
$result = mysql_query("SELECT id FROM civicrm_contribution", $link);
$total_donations = mysql_num_rows($result);

//Get total number of donors
$result = mysql_query("SELECT DISTINCT contact_id FROM civicrm_contribution", $link);
$total_donors = mysql_num_rows($result);

//Get total dollars raised
$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution", $link);
$total_raised = mysql_fetch_array($result);

//Calculate average gift
$average_gift = round(($total_raised['total']/$total_donations),2);



//Get number of donations $100 and less 
$result = mysql_query("SELECT id FROM civicrm_contribution where total_amount <= 100", $link);
$donor_level_1 = mysql_num_rows($result);

//Get number of donations $101-250  
$result = mysql_query("SELECT id FROM civicrm_contribution where total_amount between 100.01 and 250", $link);
$donor_level_2 = mysql_num_rows($result);

//Get number of donations $251-500 
$result = mysql_query("SELECT id FROM civicrm_contribution where total_amount between 250.01 and 500", $link);
$donor_level_3 = mysql_num_rows($result);

//Get number of donations $501-1000 
$result = mysql_query("SELECT id FROM civicrm_contribution where total_amount between 500.01 and 1000", $link);
$donor_level_4 = mysql_num_rows($result);

//Get number of donations $1000 or more 
$result = mysql_query("SELECT id FROM civicrm_contribution where total_amount > 1000", $link);
$donor_level_5 = mysql_num_rows($result);

// Get total people who have given more than once
$result = mysql_query("SELECT contact_id, count(contact_id) as donations FROM civicrm_contribution GROUP BY contact_id  having donations >= 2;", $link);
$total_repeat = mysql_num_rows($result);

// Get total people signed up for recurring gifts
$result = mysql_query("SELECT DISTINCT contact_id FROM civicrm_contribution_recur", $link);
$total_recurring = mysql_num_rows($result);

// Get total of maxed out donors
$result = mysql_query("SELECT contact_id, SUM(total_amount) as total FROM civicrm_contribution GROUP BY contact_id  having total =".$max_donation, $link);
$total_maxedout = mysql_num_rows($result);

// Get donors within $1000 of maxing out
$result = mysql_query("SELECT contact_id, SUM(total_amount) as total FROM civicrm_contribution GROUP BY contact_id  having total between ".($max_donation-1000). " AND ". ($max_donation-1), $link);
$total_nearmaxed = mysql_num_rows($result);


// Get Total Primary
$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution where receive_date < '".$primary_date."'", $link);
$total_primary = mysql_fetch_array($result);

// Get Total General
$result = mysql_query("SELECT SUM(total_amount) as total FROM civicrm_contribution where receive_date >= '".$primary_date."'", $link);
$total_general = mysql_fetch_array($result);


echo "<p><strong>$".number_format($total_raised['total'],2)."</strong> raised in ".$total_donations." donations from <strong>".$total_donors." people</strong> with an average gift of $".$average_gift."</p>";






?>



<iframe src="/dashlets/charts/donorchart.php?1=<?php echo $donor_level_1 ?>&2=<?php echo $donor_level_2 ?>&3=<?php echo $donor_level_3 ?>&4=<?php echo $donor_level_4 ?>&5=<?php echo $donor_level_5 ?>" id="donorgraph_div" frameborder="0" width="350" height="150" scrolling="no" marginwidth="0" marginheight="0" align="left"  allowTransparency="true"></iframe>


<ul class="dashlet_donor_data">
	<li><strong><?php echo round(($total_repeat/$total_donors)*100,1) ?>%</strong> have given more than twice</li>
	<li><strong><?php echo $total_recurring ?></strong> signed up for recurring gifts</li>
	<li><strong><?php echo $total_maxedout ?></strong> maxed out this cycle</li>
	<li><strong><?php echo $total_nearmaxed ?></strong> close to maxing out</li>
</ul>
<ul class="dashlet_donor_data">
	<li><strong>$<?php echo number_format($total_primary['total'],2) ?></strong> raised in the primary</li>
	<li><strong>$<?php echo number_format($total_general['total'],2) ?></strong> raised in the general</li>
</ul>

<script>
// Refresh the graph - this is needed because the Civi dashboard won't load the chart in time for render
document.getElementById('donorgraph_div').src=document.getElementById('donorgraph_div').src;
</script>