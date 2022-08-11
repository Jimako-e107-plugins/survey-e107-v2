<?php
e107::lan('survey',true, true);



if(e_PAGE == "admin_configv1.php") {
$adminMenu = array(
	'main/list' => array('caption' => ADLAN_SUR_MAINCONF, 'perm' => 'P', 'uri'=> 'admin_config.php?mode=main&action=list'),
	'surveys' => array('caption' => 'Surveys', 'perm' => 'P', 'uri' => 'admin_configv1.php'),
	'message/list' => array('caption' => 'Defined messages', 'perm' => 'P', 'uri'=> 'admin_config.php?mode=message&action=list'),
	'message/create' => array('caption' => 'Add message', 'perm' =>'P', 'uri' => 'admin_config.php?mode=message&action=create'),
);
 

	$var = array();

	foreach ($adminMenu as $key => $val)
	{
		$var[$key]['text'] = $val['caption'];
		$var[$key]['link'] =  $val['uri'];
		 
	}

$caption = "<span>Surveys</span>";

$text=	e107::getNav()->admin($caption, $_GET['mode'], $var);
}

//survey_adminArea->renderMenu();

$text .= "
<b>&raquo;</b> <u>".ADLAN_SUR10."</u>
".ADLAN_SUR40."
<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR41."</u>
".ADLAN_SUR42."
<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR15."</u>
".ADLAN_SUR43."
<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR44."</u>
".ADLAN_SUR45."<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR46."</u>
".ADLAN_SUR47."
<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR48."</u>
".ADLAN_SUR49."
<br /><br />
<b>".ADLAN_SUR50."</b>
<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR22."</u>
".ADLAN_SUR51."
<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR52."</u>
".ADLAN_SUR53."
<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR34."</u>
".ADLAN_SUR35."
<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR24.":</u>
".ADLAN_SUR54."
<br /><br />
<b>&raquo;</b> <u>".ADLAN_SUR25.":</u>
".ADLAN_SUR55."<br /><br />
<i><u>".ADLAN_SUR56."</u></i>".ADLAN_SUR57."
<br />
<i><u>".ADLAN_SUR58."</u></i>".ADLAN_SUR59."
<br />
<i><u>".ADLAN_SUR60."</u></i> ".ADLAN_SUR61."
<br />
<i><u>".ADLAN_SUR62."</u></i> ".ADLAN_SUR61."
<br />
<i><u>".ADLAN_SUR63."</u></i> ".ADLAN_SUR61."
<br />
<i><u>".ADLAN_SURTYPE_9.":</u></i> ".ADLAN_SUR36."
<br />
<i><u>".ADLAN_SURTYPE_7.":</u></i> ".ADLAN_SUR37."
<br />
";
$ns -> tablerender(ADLAN_SUR65, $text);
?>