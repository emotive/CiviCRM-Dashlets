<?php

include 'config.inc';

$link = mysql_connect($mysql_host, $mysql_login, $mysql_pass);
mysql_select_db($mysql_db, $link);


//Get total number of supporters
$result = mysql_query("SELECT id FROM civicrm_contact", $link);
$total_supporters = mysql_num_rows($result);

//Get total number of records with email
$result = mysql_query("SELECT DISTINCT contact_id FROM civicrm_email", $link);
$total_email = mysql_num_rows($result);

//Get total number of records with full address
$result = mysql_query("SELECT DISTINCT contact_id FROM civicrm_address", $link);
$total_address = mysql_num_rows($result);

//Get total number of donors
$result = mysql_query("SELECT DISTINCT contact_id FROM civicrm_contribution", $link);
$total_donors = mysql_num_rows($result);

//Get total number with phones
$result = mysql_query("SELECT DISTINCT contact_id FROM civicrm_phone", $link);
$total_phone = mysql_num_rows($result);

//Get total number of unsubscribes
$result = mysql_query("SELECT id FROM civicrm_contact where do_not_email = 1 OR do_not_phone = 1 OR do_not_mail = 1", $link);
$total_unsubscribe = mysql_num_rows($result);





?>

<style>
#total_supporters {font-size: 11px; font-family: Verdana, sans-serif; margin-bottom:-20px;}
#percentage_email {float:left;width:100px; background-image: url('http://chart.apis.google.com/chart?cht=p3&chco=C6D9FD&chd=t:<?php echo ($total_email/$total_supporters*100) ?>,<?php echo 100-($total_email/$total_supporters*100) ?>&chs=100x100'); text-align: center;}

#percentage_donors {float:left;width:100px; background-image: url('http://chart.apis.google.com/chart?cht=p3&chco=C6D9FD&chd=t:<?php echo ($total_donors/$total_supporters*100) ?>,<?php echo 100-($total_donors/$total_supporters*100) ?>&chs=100x100'); text-align: center;}

#percentage_address {float:left;width:100px; background-image: url('http://chart.apis.google.com/chart?cht=p3&chco=C6D9FD&chd=t:<?php echo ($total_address/$total_supporters*100) ?>,<?php echo 100-($total_address/$total_supporters*100) ?>&chs=100x100'); text-align: center;}

#percentage_phone {float:left;width:100px; background-image: url('http://chart.apis.google.com/chart?cht=p3&chco=C6D9FD&chd=t:<?php echo ($total_phone/$total_supporters*100) ?>,<?php echo 100-($total_phone/$total_supporters*100) ?>&chs=100x100'); text-align: center;}

#percentage_unsubscribe {float:left;width:100px; background-image: url('http://chart.apis.google.com/chart?cht=p3&chco=C6D9FD&chd=t:<?php echo ($total_unsubscribe/$total_supporters*100) ?>,<?php echo 100-($total_unsubscribe/$total_supporters*100) ?>&chs=100x100'); text-align: center;}

.large_number {font-size: 19px; font-family: Verdana, sans-serif; padding-top:30px;}
.item_description {font-size: 10px; font-family: Verdana, sans-serif;}
#snapshot_container {background-color: #fff; width: 100%}
</style>


<div id="snapshot_container">
	<div id="total_supporters">There are <strong><?php echo $total_supporters ?></strong> supporters in your database.  Of these supporters...</div>
	<div id="percentage_email">
		<p class="large_number"><?php echo round(($total_email/$total_supporters*100),1) ?>%</p>
		<p class="item_description">Have e-mail addresses</p>
	</div>
	<div id="percentage_donors">
		<p class="large_number"><?php echo round(($total_donors/$total_supporters*100),1) ?>%</p>
		<p class="item_description">Are donors</p>
	</div>
	<div id="percentage_address">
		<p class="large_number"><?php echo round(($total_address/$total_supporters*100),1) ?>%</p>
		<p class="item_description">Have complete addresses</p>
	</div>
	<div id="percentage_phone">
		<p class="large_number"><?php echo round(($total_phone/$total_supporters*100),1) ?>%</p>
		<p class="item_description">Have a phone number</p>
	</div>
	<div id="percentage_unsubscribe">
		<p class="large_number"><?php echo round(($total_unsubscribe/$total_supporters*100),1) ?>%</p>
		<p class="item_description">Have requested not to be contacted</p>
	</div>	
</div>

