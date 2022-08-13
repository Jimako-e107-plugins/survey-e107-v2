<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|	survey.php
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}

require_once(e_HANDLER . "userclass_class.php");
//require_once(e_HANDLER."np_class.php"); fix me
require_once(e_PLUGIN . "survey/survey.inc.php");
e107::plugLan('survey', e_LANGUAGE . '_front');

$tp = e107::getParser();

$survey_class = e107::getSingleton('survey', e_PLUGIN . 'survey/survey.class.php');

$tmp = explode(".", e_QUERY);   // $tmp, because $qs is used

$survey_data = array();

if ($tmp[0])
{
	if (is_numeric($tmp[0]))  // legacy url
	{
		$survey_id = $tmp[0];
		$survey_data =  $survey_class->get_data_by_id($survey_id);
	}
	else
	{
		$survey_url = $tmp[0];	 // At least one parameter here
		$survey_data =  $survey_class->get_data_by_url($survey_url);
	}
}
else
{
	$survey_data['survey_name'] = LAN_PLUGIN_SURVEY_NAME;
	$survey_data['survey_slogan'] = SITEDESCRIPTION;
}

$survey_class->set_meta_tags($survey_data);



/* OLD CODE */
global $survey_fields, $translated_strings;  //fix me

$translated_strings = array(
	'LAN_SUR_NAME_01' => LAN_SUR_NAME_01,
	'LAN_SUR_NAME_02' => LAN_SUR_NAME_02,
	'LAN_SUR_Q_01' => LAN_SUR_Q_01,
	'LAN_SUR_Q_02' => LAN_SUR_Q_02,
	'LAN_SUR_Q_03' => LAN_SUR_Q_03,
	'LAN_SUR_Q_04' => LAN_SUR_Q_04,
	'e_PLUGIN_ABS' => e_PLUGIN_ABS,  // because simpleparse 
	'LAN_SUR_A_01' => LAN_SUR_A_01,
	'LAN_SUR_A_02' => LAN_SUR_A_02,
	'LAN_SUR_A_03' => LAN_SUR_A_03,
	'LAN_SUR_A_04' => LAN_SUR_A_04,
	'LAN_SUR_A_05' => LAN_SUR_A_05,
	'LAN_SUR_SUMMARY' => LAN_SUR_SUMMARY,
);


 
function np($url, $from, $view, $total, $td, $qs = "")
{
	/*
		# Next previous pages
		# - parameter #1:		string $url, refer url
		# - parameter #2:		int $from, start figure
		# - parameter #3:		int $view, items per page
		# - parameter #4:		int $total, total items
		# - parameter #5:		string $td, comfort text
		# - parameter #6:		string $qs, QUERY_STRIING, default null
		# - return				null
		# - scope					public
		*/
	if ($total == 0)
	{
		return;
	}



	$ns = new e107table;

	echo "<table style='width:100%'>
  <tr>";
	if ($from > 1)
	{
		$s = $from - $view;
		echo "<td style='width:33%' class='nextprev'>";
		if ($qs != "")
		{
			$text = "<div style='text-align:left'><span class='smalltext'><a href='{$url}?{$qs}.{$s}'>" . NP_1 . "</a></span></div>";
		}
		else
		{
			$text = "<div style='text-align:left'><span class='smalltext'><a href='{$url}?{$s}'>" . NP_1 . "</a></span></div>";
		}
		echo $text;
	}
	else
	{
		echo "<td style='width:33%'>&nbsp;";
	}

	echo "</td>\n<td style='width:34%' class='nextprev'>";
	$start = $from + 1;
	$finish = $from + $view;
	if ($finish > $total)
	{
		$finish = $total;
	}
	$text = "<div style='text-align:center'><span class='smalltext'>$td $start - $finish of $total</span></div>";
	echo $text;

	$s = $from + $view;
	if ($s < $total)
	{
		echo "</td><td style='width:33%' class='nextprev'>";
		if ($qs != "")
		{
			$text = "<div style='text-align:right'><span class='smalltext'><a href='" . $url . "?" . $qs . "." . $s . "'>" . NP_2 . "</a></span></div></td>";
		}
		else
		{
			$text = "<div style='text-align:right'><span class='smalltext'><a href='" . $url . "?" . $s . "'>" . NP_2 . "</a></span></div></td>";
		}
		echo $text;
	}
	else
	{
		echo "</td><td style='width:33%'>&nbsp;</td>";
	}
	echo "</tr>\n</table>";
}

function already_voted($userlist)
{
	if (USER == TRUE)
	{
		$voted = explode(".", $userlist);
		if (in_array(USERID, $voted))
		{
			return TRUE;
		}
	}
	return FALSE;
}

require_once(HEADERF);
$arg = explode(".", e_QUERY);
 
if (e_QUERY)
{
	$tmp = explode(".", e_QUERY);   // $tmp, because $qs is used
	if (is_numeric($tmp[0]))
	{  // legacy url
		$arg[0] = $survey_id = $tmp[0];
	}
	else
	{
		$survey_url = $tmp[0];	 // At least one parameter here
		$where = 'survey_url ="' . $survey_url . '"';
		$arg[0] =   $sql->retrieve('survey', 'survey_id', $where);
	}
}


function getfield($f)
{
	global $fdata;
	foreach ($fdata as $field)
	{
		if ($f == $field['field_number'])
		{
			return $field;
		}
	}
}

function parse_survey_message($message)
{
	$tmp = explode("\n", $message);
	$ret = '';
	for ($c = 0; $c < count($tmp); $c++)
	{
		if (preg_match("/\{(.*?)=(.*?)\}/", $tmp[$c], $m))
		{
			$field = getfield($m[2]);
			if ($m[1] == "Q")
			{
				$ret .= show_form_question($field);
			}
			if ($m[1] == "F")
			{
				$ret .= show_form_field($field);
			}
		}
		else
		{
			$ret .= $tmp[$c];
		}
	}
	return $ret;
}

function isImage($url)
{
	$params = array('http' => array(
		'method' => 'HEAD'
	));
	$ctx = stream_context_create($params);
	$fp = @fopen($url, 'rb', false, $ctx);
	if (!$fp)
		return false;  // Problem with url

	$meta = stream_get_meta_data($fp);
	if ($meta === false)
	{
		fclose($fp);
		return false;  // Problem reading data from url
	}

	$wrapper_data = $meta["wrapper_data"];
	if (is_array($wrapper_data))
	{
		foreach (array_keys($wrapper_data) as $hh)
		{
			if (substr($wrapper_data[$hh], 0, 19) == "Content-Type: image") // strlen("Content-Type: image") == 19 
			{
				fclose($fp);
				return true;
			}
		}
	}

	fclose($fp);
	return false;
}

function show_survey($snum = NULL, $return = false)
{
	global   $tell_required, $_res, $fdata, $survey_class, $tp, $translated_strings;

	$ret = '';
	$snum = intval($snum);
	e107::getDb()->select("survey", "*", "survey_id='{$snum}' ");
	$template   = e107::getTemplate('survey');
 
	if ($row = e107::getDb()->fetch())
	{
 
		// replace LAN strings	  
		$title = '';
		$row['survey_slogan'] = $tp->simpleParse($row['survey_slogan'], $translated_strings);

		// set correct template, for errors too
		$surveytemplate = 'view';
		if (!empty($row['survey_template']))
		{
			$surveytemplate = $row['survey_template'];
		}

		$array = ['survey_neededpar' => $row['survey_neededpar']];
		$data = e107::getEvent()->trigger('survey_displayed', $array);
 
		$fdata = e107::unserialize($row['survey_parms']);
  
		$frm = new myform;
		$ret .= $frm->form_open("post", e_SELF);
		$ret .= $frm->form_hidden("survey_id", $row['survey_id']);
		$ret .= $frm->form_hidden("survey_time", time());



		// TODO  check_class doen't work !!!
		if (check_class($row['survey_viewclass']) && $row['survey_save_results'])
		{
			if (deftrue('BOOTSTRAP'))
			{
				$ret .= "<div class='row'><div class='col-md-12 text-center'>[<a href='" . e_PLUGIN_ABS . "survey/view.php?{$row['survey_id']}'>" . LAN_SUR1 . "</a>]</div></div>";
				$ret .= "<div class='row'><div class='col-md-12 text-center'>[<a href='" . e_PLUGIN_ABS . "survey/stats.php?{$row['survey_id']}'>" . LAN_SUR13 . "</a>]</div></div>";
			}
			else
			{
				$ret .= "<tr><td colspan='2' style='text-align:center;'>[<a href='" . e_PLUGIN_ABS . "survey/view.php?{$row['survey_id']}'>" . LAN_SUR1 . "</a>]</td></tr>";
				$ret .= "<tr><td colspan='2' style='text-align:center;'>[<a href='" . e_PLUGIN_ABS . "survey/stats.php?{$row['survey_id']}'>" . LAN_SUR13 . "</a>]</td></tr>";
			}
		}

		if (preg_match("/\{Q=(\d*?)\}/", $row['survey_message']))
		{


			if (deftrue('BOOTSTRAP'))
			{
				$ret .= "<div class='row'><div class='col-md-12'>";
				$ret .= parse_survey_message($row['survey_message']);
				$ret .= "</div></div>";
			}
			else
			{
				$ret .= "<tr><td>";
				$ret .= parse_survey_message($row['survey_message']);
				$ret .= "</td></tr>";
			}
		}
		else
		{
			$survey_message = $tp->toHTML($row['survey_message'], false, 'TITLE');

			if (deftrue('BOOTSTRAP'))
			{
				$ret .= "<div class='row'><div class='col-md-12'>{$survey_message}</div></div>";
			}
			else
			{
				$ret .= "<tr><td colspan='2'>{$survey_message}</td></tr>";
			}
			foreach ($fdata as $field)
			{

				$field['field_text']    = $tp->simpleParse($field['field_text'], $translated_strings);

				if (!$field['field_hidden'] && $field['field_type'] != 9)
				{     
					$fn = $field['field_number'];
					if (deftrue('BOOTSTRAP'))
					{
						$ret .= "<div class='row question'>";
					}
					else
					{
						$ret .= "\n<tr>";
					}
					if ($field['field_type'] != 13) //not inline radio  not full line
					{
						if ($field['field_type'] != 6) //separator
						{
							if (deftrue('BOOTSTRAP'))
							{
								$ret .= "<div class='col-md-6 text-left'>";
								$ret .= show_form_question($field);
								$ret .= "</div>";
								$ret .= "<div class='col-md-6 text-left'>";
							}
							else
							{
								$ret .= "<td class='forumheader3' style='vertical-align:top;' >";
								$ret .= show_form_question($field);
								$ret .= "</td>";
								$ret .= "<td class='forumheader3' >";
							}
						}
						elseif ($field['field_type'] == 6)
						{

							if (deftrue('BOOTSTRAP'))
							{
								$ret .= "<div class='col-md-12 text-left'>";
							}
							else
							{
								$ret .= "<td colspan='2'>";
							}
						}
						else
						{

							if (deftrue('BOOTSTRAP'))
							{
								$ret .= "<div class='col-md-12'>";
							}
							else
							{
								$ret .= "<td colspan='2'>";
							}
						}

						$ret .= show_form_field($field);
						if (deftrue('BOOTSTRAP'))
						{
							$ret .= "</div></div>";
						}
						else
						{
							$ret .= "</td></tr>";
						}
					}
					else
					{    // full line md-12

						if (deftrue('BOOTSTRAP'))
						{
							$ret .= "<div class='col-md-12'>";
							$ret .= show_form_question($field);
							$ret .= "</div>";
							$ret .= "</div>";
							$ret .= "<div class='row'>";
							$ret .= "<div class='col-md-12'>";
							$ret .= show_form_field($field);
							$ret .= "</div></div>";
						}
						else
						{
							$ret .= "<td class='forumheader3' style='vertical-align:top;' colspan='2' >";
							$ret .= show_form_question($field);
							$ret .= "</td>";
							$ret .= "</tr>";
							$ret .= "\n<tr>";
							$ret .= "<td class='forumheader3' colspan='2' >";
							$ret .= show_form_field($field);
							$ret .= "</td></tr>";
						}
					}
				}
				if ($field['field_req'])
				{
					$dispreqmes = true;
				}
			}
		}
		if ($dispreqmes)
		{

			if (deftrue('BOOTSTRAP'))
			{
				$ret .= "<div class='row'><div class='col-md-12 text-left'>" . LAN_SUR4 . "</div></div>";
			}
			else
			{
				$ret .= "<tr><td class='forumheader3' colspan='2'>" . LAN_SUR4 . "</td></tr>";
			}
		}

		if (deftrue('BOOTSTRAP'))
		{
			$ret .= "<div class='row'><div class='col-md-12 text-center'>";
			$ret .= e107::getForm()->submit("submit",  LAN_SUR5, array('class' => 'btn btn-raised btn-primary'));
			$ret .= "</div></div>";
		}
		else
		{
			$ret .= "<tr><td class='forumheader' colspan='2' style='text-align:center;'>";
			$ret .= e107::getForm()->submit("submit",  LAN_SUR5, array('class' => 'btn btn-raised btn-primary'));
			$ret .= "</td></tr>";
		}


		$ret .= $frm->form_close();
		if (deftrue('BOOTSTRAP'))
		{
			$ret .= "</div>";
			 
		}
		else
		{
			$ret .= "</table>";
		}

		/*
		if($row['survey_message2']){ 
		  $ret .= $tp->parseTemplate($tp->toHTML($row['survey_message2'], false, 'TITLE'));
		}  */
	}
	//  $title = $tp->lanVars($tp->toHTML($row['survey_name']));

	if ($return) return $ret;

	e107::getRender()->tablerender($title, $ret, 'survey');
}

if ($_POST['submit'])
{
	$cnv = new convert;
	$mailto_addresses = "";
	$submit_time = time();
	$mailtext = LAN_SUR42 . ": " . $cnv->convert_date($submit_time, "long") . "\n\n";


	$sql->select("survey", "*", "survey_id=" . intval($_POST['survey_id']));
	if ($row = $sql->fetch())
	{
		extract($row);
	}

	/** custom code replaced by event **/
	// add survey URL to email for automatic parsing received emails */
	$array = ['survey_neededpar' => $row['survey_neededpar']];
	$data = e107::getEvent()->trigger('survey_submitted', $array);


	if ($survey_class != e_UC_PUBLIC && $survey_once)
	{
		if (already_voted($survey_user))
		{
			$ns->tablerender("Error - {$survey_name}", LAN_SUR2);
			require_once(FOOTERF);
			exit;
		}
	}

	if (!check_class($survey_class))
	{
		$ns->tablerender("Error - {$survey_name}", LAN_SUR6);
		require_once(FOOTERF);
		exit;
	}


	$parms = unserialize($survey_parms);
	$reshow = 0;
	$mailtext .= "[S]\n";
	foreach ($parms as $parm)
	{
		$fn = $parm['field_number'];
		$v = $_POST['results'][$fn];
		$fvalue[$f] = $v;

		// CHECK FOR EMPTY REQUIRED FIELDS		
		if ($parm['field_req'])
		{
			switch ($parm['field_type'])
			{
				case 2:	//textarea
				case 7:	//date
				case 8:	//name
				case 10:	//email
				case 11:	//number
				case 12: //emailto
				case 1:  //text

					if (ltrim(rtrim($v)) == "")
					{
						$tell_required[$fn] = 1;
						$reshow = 1;
					}
					break;
				case 3:  //checkbox
					if (!count($_POST['results'][$fn]))
					{
						$tell_required[$fn] = 1;
						$reshow = 1;
					}
					break;
				case 4:	//radio
				case 13:	//inline-radio
					if (!$_POST['results'][$fn])
					{
						$tell_required[$fn] = 1;
						$reshow = 1;
					}
					break;
				case 14:  //raty
					if (!$_POST['results'][$fn])
					{
						$tell_required[$fn] = 1;
						$reshow = 1;
					}
					break;
				case 5:  //dropdown
					if ($v == "---")
					{
						$tell_required[$fn] = 1;
						$reshow = 1;
					}
					break;
			}
		}
		// CHECK FIELD CONTENTS
		switch ($parm['field_type'])
		{
			case 12:	//emailto
				if ($v && !preg_match("#([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", $v))
				{
					$error_text[$fn] = LAN_SUR40;
					$reshow = 1;
				}
				else
				{
					$mailto_addresses .= $v . ",";
				}
				break;
			case 10:	//email
				if ($v && !preg_match("#([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", $v))
				{
					$error_text[$fn] = LAN_SUR40;
					$reshow = 1;
				}
				break;
			case 11:	//number
				if (!is_numeric($v))
				{
					$error_text[$fn] = LAN_SUR41;
					$reshow = 1;
				}
				break;
		}
		if ($parm['field_type'] == 3) //checkbox
		{
			$ser = array();
			foreach ($v as $x)
			{
				$ser[] = $tp->toDB($x);
			}
			$_res[$fn] = serialize($ser);
			unset($ser);
		}
		elseif ($parm['field_type'] == 14) //raty change ID to values
		{
			// $v ID value
			$options = explode("~", $parm['field_choices']);
			$v = $options[$v - 1];
			$_res[$fn] = $tp->toDB($v);
		}

		else
		{
			$_res[$fn] = $tp->toDB($v);
		}

		switch ($parm['field_type'])
		{
			case (3):  //checkbox
				$mailtext .= "[Q-{$fn}]{$parm['field_text']}| " . implode(", ", $v) . " [\Q-{$fn}]\n";
				break;
			case (6): //separator
				$mailtext .= "{$parm['field_text']} \n";
			case (12): //emailto
				break;
			default:
				$mailtext .= "[Q-{$fn}]{$parm['field_text']}| {$v} [\Q-{$fn}]\n";
				break;
		}
	}
	$mailtext .= "[\S]\n";

	if ($reshow)
	{
		//show_survey($_POST['survey_id']);
		e107::getSingleton('survey')->show_survey();
		require_once(FOOTERF);
		exit;
	}
	if ($survey_forum)
	{
		require_once(e_PLUGIN . "forum/forum_class.php");
		$survey_forum = new e107forum;
		$postInfo = array();
		$threadInfo = array();

		if (USER)
		{
			$postInfo['post_user'] = USERID;
			$threadInfo['thread_lastuser'] = USERID;
			$threadInfo['thread_user'] = USERID;
			$threadInfo['thread_lastuser_anon'] = '';
		}
		else
		{
			$postInfo['post_user_anon'] = $_POST['anonname'];
			$threadInfo['thread_lastuser_anon'] = $_POST['anonname'];
			$threadInfo['thread_user_anon'] = $_POST['anonname'];
		}

		$postInfo['post_ip'] = e107::getIPHandler()->getIP(FALSE);

		$time = time();


		// START -- experimental image display code

		$newMailText = array();
		$checkLinks = explode(" ", $mailtext);

		foreach ($checkLinks as $convertLink)
		{
			if (preg_match("/\bhttp\b/i", $convertLink))
			{
				if (isImage($convertLink))
				{
					$convertLink = "<img src='" . $convertLink . "' />";
				}
			}

			array_push($newMailText, $convertLink);
		}

		$mailtext = implode(" ", $newMailText);

		// END -- experimental image display code

		$postInfo['post_entry'] = $tp->toDB($mailtext);
		$postInfo['post_forum'] = $forumId;
		$postInfo['post_datestamp'] = $time;
		$threadInfo['thread_lastpost'] = $time;
		$threadInfo['thread_sticky'] = 0;
		$threadInfo['thread_name'] = $row['survey_name'];
		$threadInfo['thread_forum_id'] = $row['survey_forum'];
		$threadInfo['thread_active'] = 1;
		$threadInfo['thread_datestamp'] = $time;
		$threadInfo['thread_options'] = '';

		$survey_forum->threadAdd($threadInfo, $postInfo);
		$survey_forum->forumUpdateCounts($forumId);
	}

	if ($survey_mailto)
	{
		require_once(e_HANDLER . "mail.php");
		sendemail($survey_mailto, LAN_SUR7 . "{$survey_code}-{$survey_name}", strip_tags($mailtext));
	}

	if ($mailto_addresses)
	{
		require_once(e_HANDLER . "mail.php");
		sendemail($mailto_addresses, LAN_SUR7 . "{$survey_code}-{$survey_name}", strip_tags($mailtext));
	}

	if (USER == TRUE && !already_voted($survey_user))
	{
		$survey_user .= "." . USERID;
		$sql->update("survey", "survey_user='{$survey_user}' WHERE survey_id='$survey_id' ");
	}
	$results = serialize($_res);

	$sid = intval($_POST['survey_id']);
	$sql->insert("survey_results", "0,{$submit_time},{$sid},'{$results}'");
	$text = LAN_SUR8;
	if ($survey_submit_message)
	{
		$text = $tp->toHTML($survey_submit_message, true);
	}

	if (check_class($survey_viewclass) && $survey_save_results)
	{
		$text .= "<br /><br /><div style='text-align:center;'>";
		$text .= "[<a href='" . e_PLUGIN_ABS . "survey/view.php?" . $survey_id . "'>" . LAN_SUR1 . "</a>]";
		$text .= "</div>";
	}

	$ns->tablerender(LAN_SUR9, $text, 'survey_submitted');

	require_once(FOOTERF);
	exit;
}


e107::getSingleton('survey')->show_survey();

//show_survey($arg[0]);
require_once(FOOTERF);
