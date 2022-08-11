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

  'message' => array(
  'controller' => 'survey_messages_ui',
  'path' => null,
  'ui' => 'survey_messages_form_ui',
  'uipath' => null
  ),

  );


  protected $adminMenu = array(


  'main/list' => array('caption'=> ADLAN_SUR_MAINCONF, 'perm' => 'P'),
  'surveys' => array('caption'=> 'Surveys', 'perm' => 'P', 'uri'=>'admin_configv1.php'  ),
  'message/list' => array('caption'=> 'Defined messages', 'perm' => 'P'),
  'message/create' => array('caption'=> 'Add message', 'perm' => 'P'),
  );

  protected $adminMenuAliases = array(
  'main/edit' => 'main/list',
  'message/edit' => 'message/list'
  );

  protected $menuTitle = 'Survey';
  }
