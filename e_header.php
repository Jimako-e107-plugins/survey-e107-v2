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
 
 