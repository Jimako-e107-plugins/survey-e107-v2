<?php

if (!defined('e107_INIT'))
{ 
	require_once("../../class2.php");
}


if (!e107::isInstalled('survey'))
{
	e107::redirect();
	exit;
}

if(USER_AREA)
{
	e107::js('survey','js/survey_cal.min.js');
	e107::css('survey','survey_cal.min.css');
	
	e107::css('inline','
	.survey .form-group {
	  margin: 0px;
	 }
	 
	 .survey .e-survey {
	 
	        padding-top: 20px;
	 }
	');
	
  
	
}

if(ADMIN_AREA)
{
	e107::js('survey','js/survey.min.js');
}
 
  /*
$translated_strings= array(
'LAN_SUR_SLOGAN' => LAN_SUR_SLOGAN,	
);


	    $tmp = explode(".", e_QUERY);   // $tmp, because $qs is used
	    if(is_numeric($tmp[0]))  // legacy url
			{
				define('e_PAGETITLE', 'Surveys' );
			}
			else
			{
				$tp = e107::getParser();
				$survey_url = $tmp[0];	 // At least one parameter here
				$where = 'survey_url ="'.$survey_url.'"';  
				$pagetitle =   e107::getDB()->retrieve('survey', 'survey_slogan', $where);
				$pagetitle =   $tp->simpleParse($pagetitle, $translated_strings);
				$pagetitle =   $tp->toText($pagetitle, false, 'TITLE');
		
 
				define('e_PAGETITLE', $pagetitle );
			 
			}
			*/
			
?>