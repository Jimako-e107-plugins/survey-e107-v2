<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

require('admin_menu.php') ;
 
				
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

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'survey_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'survey_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_code' =>   array ( 'title' => 'Survey Code', 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 
			'readParms' => '', 'writeParms' => array('size'=>'xxlarge'), 'class' => 'left', 'thclass' => 'left',  ),
		
		
		  'survey_name' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 
			'readParms' => '', 'writeParms' => array('size'=>'xxlarge'), 'class' => 'left', 'thclass' => 'left',  ),
			
		  'survey_mailto' =>   array ( 'title' => 'Email to' , 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 
			'readParms' => '', 'writeParms' => array('size'=>'xxlarge'), 'class' => 'left', 'thclass' => 'left',  ),

		/*  'survey_class' =>   array ( 'title' => LAN_USERCLASS, 'type' => 'userclass', 'data' => 'int', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_once' =>   array ( 'title' => 'Once', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_viewclass' =>   array ( 'title' => 'Viewclass', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_editclass' =>   array ( 'title' => 'Editclass', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_mailto' =>   array ( 'title' => 'Mailto', 'type' => 'email', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_forum' =>   array ( 'title' => 'Forum', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_save_results' =>   array ( 'title' => 'Results', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_user' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_parms' =>   array ( 'title' => 'Parms', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_message' =>   array ( 'title' => 'Message', 'type' => 'bbarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_submit_message' =>   array ( 'title' => 'Message', 'type' => 'bbarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_lastfnum' =>   array ( 'title' => 'Lastfnum', 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		 */
		  'survey_url' => array ( 'title' => LAN_SEFURL, 'type' => 'text', 'data' => 'str', 'inline'=>true, 'width' => 'auto', 'help' => '', 'readParms' => '', 
			'writeParms' => array('size'=>'xxlarge', 'sef'=>'survey_name'), 'class' => 'left', 'thclass' => 'left', ),			

			'survey_template' =>   array ( 'title' => LAN_TEMPLATE, 'tab' => 0, 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto', 
			  'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
	//	  'survey_message' =>   array ( 'title' => ADLAN_SUR20, 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 
	//		'help' => 'See old templating in readme file)', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
			
		  'survey_message1' =>   array ( 'title' => ADLAN_SUR_MESSAGETOP, 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto', 
			'help' => ADLAN_SUR_MESSAGETOP_HELP, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'survey_message2' =>   array ( 'title' => ADLAN_SUR_MESSAGEBOT, 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto', 
			'help' => ADLAN_SUR_MESSAGEBOT_HELP, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
 		  'survey_error1' =>     array ( 'title' => 'Wrong parameter message', 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto', 
			'help' => ADLAN_SUR_MESSAGEBOT_HELP, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
			
		  'survey_neededpar' =>   array ( 'title' => 'Needed Param in URL', 'type' => 'boolean', 'data' => 'str', 'width' => 'auto', 
			'help' => 'Survey is not displayed without param in URL', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
			
		  'survey_slogan' =>   array ( 'title' => 'Slogan', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 
			'help' => 'HELP', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),			
					  
		  'survey_class'		=>   array ( 'title' => LAN_VISIBILITY,	'type' => 'userclass', 'data' => 'int', 'inline'=>true, 
			'batch'=>true, 'filter'=>true, 'width' => 'auto', 'help' => ADLAN_SUR11, 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left'  ),
					  
		  'survey_viewclass'		=>   array ( 'title' => ADLAN_SUR18,	'type' => 'userclass', 'data' => 'int', 'inline'=>true, 'batch'=>true, 'filter'=>true, 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),

			
 
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),


		);		
		
		protected $fieldpref = array('survey_id' , 'survey_code', 'survey_name', 'survey_class', 'survey_url', 'survey_template');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
			'xxx'		=> array('title'=> 'Xxx', 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'help'),
		); 

	
		public function init()
		{
		// Set drop-down values (if any). 
	    $templates = e107::getLayouts('survey','survey', 'front', null, false, false);
	    $this->fields['survey_template']['writeParms'] = $templates;
	    
	    $sql = e107::getDb();
			// message
			$this->messages[0] = 'Select message';
			if($sql->select('survey_messages'))
			{
				while ($row = $sql->fetch())
				{
					$this->messages[$row['message_id']] = $row['message_shortcut'];
				}
			}
			$this->fields['survey_message1']['writeParms'] = $this->messages;			
			$this->fields['survey_message2']['writeParms'] = $this->messages;
			$this->fields['survey_error1']['writeParms']   = $this->messages;
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
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
		
		public function oldadminPagexxx()
		{
			$mainadmin = e_PLUGIN_ABS.'survey/admin_configv1.php';
    	header("location:".$mainadmin); exit; 
		}	
 
			
}
				


class survey_form_ui extends e_admin_form_ui
{

}		


class survey_messages_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Survey';
		protected $pluginName		= 'survey';
	//	protected $eventName		= 'survey-survey_messages'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'survey_messages';
		protected $pid				= 'message_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'message_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'message_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'message_shortcut' =>   array ( 'title' => 'Shortcut', 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'batch' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'message_text' =>   array ( 'title' => 'Text', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'batch' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('message_id', 'message_shortcut', 'message_text');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 

	
		public function init()
		{
			// Set drop-down values (if any). 
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
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
		
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
			
}
				


class survey_messages_form_ui extends e_admin_form_ui
{

}		
				
 
		
new survey_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>