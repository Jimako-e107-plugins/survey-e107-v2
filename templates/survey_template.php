<?php
	/**
	 * e107 website system
	 *
	 * Copyright (C) 2008-2017 e107 Inc (e107.org)
	 * Released under the terms and conditions of the
	 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
	 *
	 */ 

/* view.php */	 
 
$SURVEY_TEMPLATE['view']['search'] 	= " 
<div class='row text-center' id='view_search' >  
  <div class='col-md-12 well'>  
    <form  action='{ACTION}' method='POST' class='form-inline' >  
      <div class='form-group'>       
        <input type='text' class='form-control tbox' name='search_text' value='{SEARCH_TEXT}' placeholder='{SEARCH_TEXT}'>  
      </div>  
      <input type='submit' class='button btn btn-default' name='search' value='".LAN_SUR11."'>  
      <div class='radio'>  
        <label>    
          <input type='checkbox' class='tbox'  name='list'>".LAN_SUR12."   
        </label>
      </div>  
    </form>  
  </div>  
</div>
";  
 
 
$SURVEY_TEMPLATE['view']['resultsbox'] 	= "
<div class='row text-left' id='view_resultsbox'>     
  <div class='col-md-6'>    
    <ul class='list-group'>  
      <li class='list-group-item'> 
        <span class='badge'>{NUMRESULTS}
        </span>".LAN_SUR14.":
      </li>  
      <li class='list-group-item'> 
        <span class='badge'>{FIRST_RESPONSE}
        </span>".LAN_SUR19.":
      </li>  
      <li class='list-group-item'> 
        <span class='badge'>{LAST_RESPONSE}
        </span>".LAN_SUR20.":
      </li>
    </ul>    
  </div>  
  <div class='col-md-6'>  
    <a href='word.php?{SURVEY_ID}' target='_blank' rel='nofollow' >
      <img src='images/Word.png' alt='".LAN_SUR100."' title='".LAN_SUR100."' width='32' height='32' border='0'></a>
    <a href='excel.php?{SURVEY_ID} target='_blank' rel='nofollow' '>
      <img src='images/Excel.png' title='".LAN_SUR101."' alt='".LAN_SUR101."' width='32' height='32' border='0'></a>
    <a href=\"javascript:open_window('view.php?{SURVEY_ID}.{SEARCH_TEXT}.{SELECTED_REC}{OPTS}')\">
      <img src='images/print.png' alt='".LAN_SUR35."' title='".LAN_SUR34."' width='32' height='32' border='0'></a>  
  </div>
</div>
";

 