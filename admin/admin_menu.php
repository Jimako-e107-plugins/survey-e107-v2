  <?php 
  
 
e107::lan('survey',true, true);


  class survey_adminArea extends e_admin_dispatcher
  {

  protected $modes = array(

  'main' => array(
  'controller' => 'survey_ui',
  'path' => null,
  'ui' => 'survey_form_ui',
  'uipath' => null
  ),

 

  );


  protected $adminMenu = array(


  'main/list' => array('caption'=> ADLAN_SUR_MAINCONF, 'perm' => 'P'),
	'main/create' => array('caption' => LAN_PLUGIN_ADD_SURVEY, 'perm' => 'P'),
  );

  protected $adminMenuAliases = array(
  'main/edit' => 'main/list',
 
  );

  protected $menuTitle = 'Survey';
  }
