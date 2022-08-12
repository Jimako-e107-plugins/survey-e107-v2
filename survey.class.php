<?php

class survey
{

	static $survey_id = NULL;
	static $survey_data = array();
	static $template = array();

	function __construct()
	{
		survey::$template   = e107::getTemplate('survey');
	}

	function get_data_by_id($id = NULL) {
		$data = array();
		$id = intval($id);
		if($id > 0 ) {
			$where = 'survey_id ="' . $id . '" LIMIT 1';
			$data = e107::getDB()->retrieve('survey', "*", $where);

			$data['survey_name'] = $this->parse_lans($data['survey_name']);
			$data['survey_slogan'] = $this->parse_lans($data['survey_slogan']);
			$data['survey_message1'] = $this->parse_lans($data['survey_message1']);
			$data['survey_message2'] = $this->parse_lans($data['survey_message2']);

			survey::$survey_id = $data['survey_id'];
			survey::$survey_data = $data;
		}
		return $data;
	}

	function get_data_by_url($url = '')
	{
		$data = array();
		if (!empty($url))
		{
			$where = 'survey_url LIKE "' . $url . '" LIMIT 1';
			$data = e107::getDB()->retrieve('survey', "*", $where);
			$data['survey_name'] = $this->parse_lans($data['survey_name']);
			$data['survey_slogan'] = $this->parse_lans($data['survey_slogan']);
			$data['survey_message1'] = $this->parse_lans($data['survey_message1']);
			$data['survey_message2'] = $this->parse_lans($data['survey_message2']);

			survey::$survey_id = $data['survey_id'];
			survey::$survey_data = $data;
		}
		return $data;
	}

	function parse_lans($text = NULL) {
		$text = e107::getParser()->parseTemplate($text,  true);
		return $text;
	}
	
	function set_meta_tags($data=array()){

		$pagetitle = $data['survey_name'];
		$description = 	$data['survey_slogan'];

		/* correct meta tags */
		e107::title($pagetitle);
		e107::meta('description', $description);
		e107::meta('robots', 'noindex, follow');
		e107::route('survey/index');
	}

	function show_survey() 
	{
		$this->survey_access_checks();

		//print_a(survey::$survey_data);

		$ret = '';
		$snum = survey::$survey_id;

		if (survey::$survey_id > 0)
		{
			$title = survey::$survey_data['survey_name'];
			$tpl_key = varset(survey::$survey_data['survey_template']  , "view" );
			$surveytemplate = survey::$template[$tpl_key];
 
			$sc = e107::getScBatch('survey', true)->setVars(survey::$survey_data);

			$ret = e107::getParser()->parseTemplate($surveytemplate['start'], true, $sc);

			$ret .= show_survey($snum, true);

			$ret .= e107::getParser()->parseTemplate($surveytemplate['end'], true, $sc); 

			e107::getRender()->tablerender($title, $ret, 'survey');

		}	

	}

	function survey_access_checks() {

		$title = survey::$survey_data['survey_name'];
		if (!check_class(survey::$survey_data['survey_class']))
		{
			e107::getRender()->tablerender($title , "Error - ". LAN_SUR6);
			return;
		}
		if (survey::$survey_data['survey_class'] != e_UC_PUBLIC && survey::$survey_data['survey_once'])
		{
			if (already_voted(survey::$survey_data['survey_user']))
			{
				e107::getRender()->tablerender($title, "Error - ", LAN_SUR2);
				return;
			}
		}
	}
}