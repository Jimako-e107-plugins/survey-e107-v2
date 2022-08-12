<?php
/*
 * Survey - an e107 plugin by Jimako (https://www.e107sk.com)
 *
 * Released under the terms and conditions of the
 * Apache License 2.0 (see LICENSE file or http://www.apache.org/licenses/LICENSE-2.0)
 *
 * Shortcodes used in templates
*/

if (!defined('e107_INIT')) { exit; }
    
class survey_shortcodes extends e_shortcode
{

	/* {MESSAGE_TOP} */
	function sc_message_top($parm = '')
	{
		return e107::getParser()->toHTML($this->var["survey_message1"], TRUE);
	}

	/* {MESSAGE_BOTTOM} */
	function sc_message_bottom($parm = '')
	{
		return e107::getParser()->toHTML($this->var["survey_message2"], TRUE);
	}

	/* {SURVEY_MESSAGE} */
	function sc_survey_message($parm = '')
	{
		return e107::getParser()->toHTML($this->var["survey_message"], TRUE);
	}

	/* {SURVEY_SUBMIT_MESSAGE} */	
	function sc_survey_submit_message($parm = '')
	{
		return e107::getParser()->toHTML($this->var["survey_message"], TRUE);
	}

	/* {SURVEY_NAME} */
	function sc_survey_name($parm = '')
	{
		return e107::getParser()->toHTML($this->var["survey_name"], TRUE);
	}
	


}