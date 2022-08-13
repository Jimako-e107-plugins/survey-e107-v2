<?php

// Generated e107 Plugin Admin Area 

require_once('../../../class2.php');
if (!getperms('P'))
{
	e107::redirect('admin');
	exit;
}

require('admin_menu.php');

e107::js("footer", e_PLUGIN."survey/admin/js/survey-admin.js");
 
class survey_ui extends e_admin_ui
{

	protected $pluginTitle		= 'Survey';
	protected $pluginName		= 'survey';
	//	protected $eventName		= 'survey-survey'; // remove comment to enable event triggers in admin. 		
	protected $table			= 'survey';
	protected $pid				= 'survey_id';
	protected $perPage			= 10;
	protected $batchDelete		= true;
	protected $batchExport     = true;
	protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	protected $tabs				= array(LAN_PLUGIN_SURVEY, LAN_PLUGIN_MESSAGES, ADLAN_SUR50);

	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.

	protected $listOrder		= 'survey_id DESC';

	protected $fields 		= array(
		'checkboxes' =>   array('title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',),
		'survey_id' =>   array('title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',),
		'survey_code' =>   array(
			'title' => 'Survey Code', 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => ADLAN_SUR70,
			'readParms' => '',   'class' => 'left', 'thclass' => 'left',
		),

		'survey_name' =>   array(
			'title' => ADLAN_SUR10, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => ADLAN_SUR40,
			'readParms' => '', 'writeParms' => array('size' => 'xxlarge'), 'class' => 'left', 'thclass' => 'left',
		),

		'survey_url' => array(
			'title' => LAN_SEFURL, 'type' => 'text', 'data' => 'str', 'inline' => true, 'width' => 'auto', 'help' => '', 'readParms' => '',
			'writeParms' => array('size' => 'xxlarge', 'sef' => 'survey_name'), 'class' => 'left', 'thclass' => 'left',
		),
		
		'survey_slogan' =>   array(
			'title' => LAN_SUMMARY, 'type' => 'textarea', 'data' => 'str', 'width' => 'auto',
			'help' => ADLAN_SUR69, 'readParms' => '',
			'writeParms' => array('size' => 'block-level'), 'class' => 'left', 'thclass' => 'left',
		),

		'survey_mailto' =>   array(
			'title' => ADLAN_SUR15, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => ADLAN_SUR43,
			'readParms' => '', 'writeParms' => array('size' => 'xxlarge'), 'class' => 'left', 'thclass' => 'left',
		),

		'survey_once' =>   array(
			'title' => ADLAN_SUR12, 'type' => 'boolean', 'data' => 'int', 'width' => 'auto',
			'help' => '', 'readParms' => '', 'writeParms' => 'label=yesno', 'class' => 'left', 'thclass' => 'left',
		),

		'survey_save_results' =>   array(
			'title' => ADLAN_SUR17, 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => ADLAN_SUR45,
			'readParms' => '', 'writeParms' => 'label=yesno',  'class' => 'left', 'thclass' => 'left',
		),


		/*  'survey_class' =>   array ( 'title' => LAN_USERCLASS, 'type' => 'userclass', 'data' => 'int', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
 		  'survey_user' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_parms' =>   array ( 'title' => 'Parms', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		 */
		
		 'survey_lastfnum' =>   array ( 'title' => 'Lastfnum', 'type' => 'hidden', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		


		'survey_template' =>   array(
			'title' => LAN_TEMPLATE, 'tab' => 0, 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto',
			'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',
		),
 
		'survey_neededpar' =>   array(
			'title' => 'Needed Param in URL', 'type' => 'boolean', 'data' => 'str', 'width' => 'auto',
			'help' => 'Survey is not displayed without param in URL', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',
		),



		'survey_class'		=>   array(
			'title' => ADLAN_SUR11,	'type' => 'userclass', 'data' => 'int', 'inline' => true,
			'batch' => true, 'filter' => true, 'width' => 'auto', 'help' => ADLAN_SUR11,
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left'
		),

		'survey_viewclass'		=>   array(
			'title' => ADLAN_SUR18,	'type' => 'userclass', 'data' => 'int', 'inline' => true, 'batch' => true, 'filter' => true, 'width' => 'auto', 'help' => ADLAN_SUR42,
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',
		),

		'survey_editclass'		=>   array(
			'title' => ADLAN_SUR68,	'type' => 'userclass', 'data' => 'int', 'inline' => true, 'batch' => true, 'filter' => true, 'width' => 'auto', 'help' => '',
			'readParms' => '', 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left',
		),

		'survey_forum' =>   array(
			'title' => ADLAN_SUR16, 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto',
			'help' => '', 'readParms' => '', 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left',
		),

		'survey_message' =>   array(
			'title' => ADLAN_SUR20, 'type' => 'bbarea', 'data' => 'str', 'width' => 'auto', 'tab' => 1,
			'help' => ADLAN_SUR20_HELP, 'readParms' => '',
			'writeParms' => array('size' => 'block-level'),  'class' => 'left', 'thclass' => 'left',
		),
		'survey_submit_message' =>   array(
			'title' => ADLAN_SUR21, 'type' => 'bbarea', 'data' => 'str', 'width' => 'auto',  'tab' => 1,
			'help' => ADLAN_SUR21_HELP, 'readParms' => '',
			'writeParms' => array('size' => 'block-level'),   'class' => 'left', 'thclass' => 'left',
		),

		'survey_message1' =>   array(
			'title' => ADLAN_SUR_MESSAGETOP, 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'tab' => 1,
			'help' => ADLAN_SUR_MESSAGETOP_HELP, 'readParms' => '',
			'writeParms' => array('size' => 'block-level'),  'class' => 'left', 'thclass' => 'left',
		),
		'survey_message2' =>   array(
			'title' => ADLAN_SUR_MESSAGEBOT, 'type' => 'textarea', 'data' => 'str', 'width' => 'auto',  'tab' => 1,
			'help' => ADLAN_SUR_MESSAGEBOT_HELP, 'readParms' => '',
			'writeParms' => array('size' => 'block-level'),  'class' => 'left', 'thclass' => 'left',
		),


		'survey_error1' =>     array(
			'title' => 'Wrong parameter message', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto',  'tab' => 1,
			'help' => ADLAN_SUR_MESSAGEBOT_HELP, 'readParms' => '',
			'writeParms' => array('size' => 'block-level'),  'class' => 'left', 'thclass' => 'left',
		),
 
		'survey_parms' =>   array('title' => 'Parms', 'type' => 'method', 'data' => 'json',  'tab'=>2, 
		'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => array('nolabel'=>true, 'default'=>''), 'class' => 'left', 'thclass' => 'left',),
 
		'options' =>   array('title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',),


	);

	protected $fieldpref = array('survey_id', 'survey_code', 'survey_name', 'survey_class', 'survey_url', 'survey_template');


	//	protected $preftabs        = array('General', 'Other' );
	protected $prefs = array(
		'xxx'		=> array('title' => 'Xxx', 'tab' => 0, 'type' => 'text', 'data' => 'str', 'help' => 'help'),
	);


	public function init()
	{
		// Set drop-down values (if any). 
		$templates = e107::getLayouts('survey', 'survey', 'front', null, false, false);
		$this->fields['survey_template']['writeParms'] = $templates;

		if (e107::isInstalled('forum'))
		{
			require_once(e_PLUGIN . 'forum/forum_class.php');
			$forum = new e107forum;
			$survey_forum[0] = LAN_NONE;
			$forumList = $forum->forumGetAllowed();
			foreach ($forumList as $key => $val)
			{
				$survey_forum[$key] = $val['forum_name'];
			}

			$this->fields['survey_forum']['writeParms']['optArray'] = $survey_forum;
		}
	}


	// ------- Customize Create --------

	public function beforeCreate($new_data, $old_data)
	{
		if ($new_data['survey_once'] && $new_data['survey_class'] != e_UC_PUBLIC)
		{
			$new_data['survey_save_results'] = 1;
		}
		/* it cant be null and it is editable only update */
		$new_data['survey_parms'] = '';
 
		return $new_data;
	}

	public function afterCreate($new_data, $old_data, $id)
	{
		// do something
	}

	public function onCreateError($new_data, $old_data)
	{
		// do something		
	}


	// ------- Customize Update --------

	public function beforeUpdate($new_data, $old_data, $id)
	{
		if ($new_data['survey_once'] && $new_data['survey_class'] != e_UC_PUBLIC)
		{
			$new_data['survey_save_results'] = 1;
		}

		$tp = e107::getParser();
 
		$i = 0;
	 
		foreach ($_POST['field_type'] as $key => $val)
		{ 
			if ($_POST['field_text'][$key])
			{
				
				//			echo "[".$_POST['field_number'][$key]."]";
				$fields[$i]['field_number']	=	$_POST['field_number'][$key];
				//$fields[$i]['field_order']	=	$tp->toDB($_POST['field_order'][$key]);
				$fields[$i]['field_order']	=	$i;
				$fields[$i]['field_text']	= 	$tp->toDB($_POST['field_text'][$key]);
				$fields[$i]['field_req']	=	$tp->toDB($_POST['field_req'][$key]);
				$fields[$i]['field_hidden']	=	$tp->toDB($_POST['field_hidden'][$key]);
				$fields[$i]['field_type']	=	$tp->toDB($_POST['field_type'][$key]);
				$fields[$i]['field_choices']	=	$tp->toDB($_POST['field_choices'][$key]);
				$fields[$i]['field_userclass']	=	$tp->toDB($_POST['field_userclass'][$key]);
				$fields[$i]['field_help_text']	=	$tp->toDB($_POST['field_help_text'][$key]);
			
				$i++;
			}
		}
	 
		$new_data['survey_parms'] = $fields;

		if ($_POST['field_text'][$_POST['newfield']])
		{
			$new_data['survey_lastfnum'] = $old_data['survey_lastfnum'] + 1;
		}
 
		return $new_data;
	}

	public function afterUpdate($new_data, $old_data, $id)
	{
		// do something	
	}

	public function onUpdateError($new_data, $old_data, $id)
	{
		// do something		
	}

	// left-panel help menu area. 
	public function renderHelp()
	{
		$caption = ADLAN_SUR65;
		include "help.php";

		return array('caption' => $caption, 'text' => $text);
	}
}
 

class survey_form_ui extends e_admin_form_ui
{
	static $fieldtypes = array();
	static $movedown = array();
	static $moveup = array();

	function init() {
		
		for ($i = 1; $i <= 20; $i++)
		{
			$x = "ADLAN_SURTYPE_" . $i;
			if (defined($x))
			{
				$fieldtypes[$i] = constant($x);
			}
		}
		survey_form_ui::$fieldtypes = $fieldtypes;


		foreach ($_POST as $k => $v)
		{
			if (preg_match("/down_(\d*?)_x/", $k, $matches))
			{
				survey_form_ui::$movedown = $matches[1];
			}
			if (preg_match("/up_(\d*?)_x/", $k, $matches))
			{
				survey_form_ui::$moveup = $matches[1];
			}
		}

	}

	function form_select($form_name, $form_options, $form_value)
	{
		$ret = "\n<select name='" . $form_name . "' class='tbox'>";
		$form_options[0] = ADLAN_SUR30;
		foreach ($form_options as $key => $val)
		{
			$sel = ($key == $form_value) ? " SELECTED" : "";
			$ret .= "\n<option value='{$key}' {$sel}>{$val}</option>";
		}
		$ret .= "\n</select>";
		return $ret;
	}

	
	function survey_parms($curVal,$mode) {

		
		$this->init();
 
		$controller = e107::getAdminUI()->getController();
		$id = $controller->getId();


		if ($mode == "write")
		{
			$_POST['existing'] = $id;
			$_POST['edit'] = true;

			$survey_parms = $curVal;
			$editf["survey_id"] = $id;
 
            require "admin_fields.php";
		}
 
		return $text;
	}
}




class survey_messages_form_ui extends e_admin_form_ui
{
}



new survey_adminArea();

require_once(e_ADMIN . "auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN . "footer.php");
exit;
