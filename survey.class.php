<?php

class survey
{

	static $survey_data = array();

	function __construct()
	{
		 
	}

	function get_data_by_id($id = NULL) {
		$data = array();
		if($id > 0 ) {
			$where = 'survey_id ="' . $id . '" LIMIT 1';
			$data = e107::getDB()->retrieve('survey', "*", $where);

			$data['survey_name'] = $this->parse_lans($data['survey_name']);
			$data['survey_slogan'] = $this->parse_lans($data['survey_slogan']);

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
}