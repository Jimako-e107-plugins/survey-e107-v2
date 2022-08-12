<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|	survey_config.php
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once('../../class2.php');

if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php");
require_once(e_HANDLER."userclass_class.php");



e107::lan('survey',true, true);

foreach($_POST as $k => $v){
	if(preg_match("/down_(\d*?)_x/",$k,$matches)){
		$movedown=$matches[1];
	}
	if(preg_match("/up_(\d*?)_x/",$k,$matches)){
		$moveup=$matches[1];
	}
}
for($i = 1;$i<=20;$i++){
	$x="ADLAN_SURTYPE_".$i;
	if(defined($x)){
		$fieldtypes[$i]=constant($x);
	}
}
$message="";
function survey_erase($survey_num){
	global $sql, $message;
	if($sql -> select("survey_results","*","results_survey_id={$survey_num}")){
	}
}

class myform extends form {
	function form_select($form_name,$form_options,$form_value){
		$ret = "\n<select name='".$form_name."' class='tbox'>";
		$form_options[0]=ADLAN_SUR30;
		foreach($form_options as $key => $val){
			$sel = ($key == $form_value) ? " SELECTED" : "";
			$ret .= "\n<option value='{$key}' {$sel}>{$val}</option>";
		}
		$ret .= "\n</select>";
		return $ret;
	}
}
 
if($_POST['update'] || isset($moveup) || isset($movedown)){
	$message=ADLAN_SUR33;
	$i=0;
	foreach($_POST['field_type'] as $key => $val){
		if($_POST['field_text'][$key]){
//			echo "[".$_POST['field_number'][$key]."]";
			$fields[$i]['field_number']	=	$_POST['field_number'][$key];
			$fields[$i]['field_text']	= 	$tp->toDB($_POST['field_text'][$key]);
			$fields[$i]['field_req']	=	$tp->toDB($_POST['field_req'][$key]);
			$fields[$i]['field_hidden']	=	$tp->toDB($_POST['field_hidden'][$key]);
			$fields[$i]['field_type']	=	$tp->toDB($_POST['field_type'][$key]);
			$fields[$i]['field_choices']	=	$tp->toDB($_POST['field_choices'][$key]);
			$i++;
		}
	}

	if(isset($moveup)){
		$movefield=$moveup;
		$tempdata=array();
		$tempdata=$fields[$movefield-1];
		$fields[$movefield-1]=$fields[$movefield];
		$fields[$movefield]=$tempdata;
		survey_erase($_POST['existing']);
	}
	if(isset($movedown)){
		$movefield=$movedown;
		$tempdata=array();
		$tempdata=$fields[$movefield+1];
		$fields[$movefield+1]=$fields[$movefield];
		$fields[$movefield]=$tempdata;
		survey_erase($_POST['existing']);
	}

	$ser=serialize($fields);
 
	$parms.="survey_parms='{$ser}'";
	if($_POST['field_text'][$_POST['newfield']]){
		$incr=", survey_lastfnum=survey_lastfnum+1 ";
	}
 
	$sql -> update("survey",$parms.$incr." WHERE survey_id={$_POST['existing']}");
	unset($fields);
	$_POST['edit']=$_POST['existing'];

}

if($message){
	$ns -> tablerender("","<div style='text-align:center;'>{$message}</div>");
}

function survey_existing_dropdown($name,$cur_survey){
	$sql2 = new db;
	$f = new myform;
	$ret = "";
	if($sql2 -> select("survey") > 0){
		$ret .= $f -> form_select_open($name);
		while($row = $sql2 -> fetch()){
			extract($row);
			$sel = ($cur_survey == $survey_id) ? 1 : 0 ;
			$ret .= $f -> form_option($survey_name,$sel,$survey_id);
		}
		$ret .= $f -> form_select_close();
	} else {
		$ret="";
	}
	return $ret;
}

//existing survey dropdown
$f=new myform;
$text = "<div style='text-align:center'>".
$f -> form_open("POST",e_SELF)."
<table class='table fborder' style='width:95%'><tr><td class='forumheader3' style='text-align:center;'>".ADLAN_SUR9.": ";

$survey_dropdown = survey_existing_dropdown("existing",$_POST['existing']);

if($survey_dropdown){
	$text .= $survey_dropdown;
} else {
	$text.="<div style='text-align:center;'>".ADLAN_SUR5."</div>";
}

$text .= "<br />";
if($survey_dropdown){
	$text .= $f -> form_button("submit","edit",ADLAN_SUR6); 
}
 

$text .= "</td></tr></table>".$f -> form_close()."</div>";
e107::getRender() -> tablerender(ADLAN_SUR9,$text);

if( $_POST['edit']){
 
	if($_POST['edit']){
		$sql -> select("survey","*","survey_id =".intval($_POST['existing']));
		$row = $sql -> fetch();
		extract($row);
	}
	$text="<div style='text-align:center;'>".
	$f -> form_open("POST",e_SELF)."
	<table class='fborder' style='width:95%'>";
	$fnum=0;
	if($_POST['edit']){
		$survey_url = preg_replace("/_config/", "", SITEURLBASE.e_PLUGIN_ABS."survey/")."survey.php?{$_POST['existing']}";
		$where = 'survey_id ="'.$_POST['existing'].'"';
		$survey_sef =   $sql->retrieve('survey', 'survey_url', $where);
		$survey_sef = e107::url("survey", "survey1", array('survey_url' => $survey_sef ), "full");
		$text .= "<tr><td colspan='4' class='forumheader' style='text-align:center'>".ADLAN_SUR28." <a class='smalltext' href='{$survey_url}' target='_blank'>{$survey_url}</a></td></tr>";
		$text .= "<tr><td colspan='4' class='forumheader' style='text-align:center'>".ADLAN_SUR28." <a class='smalltext' href='{$survey_sef}' target='_blank'>{$survey_sef}</a></td></tr>";
		$text .= "<tr><td colspan='4'>";
		$text .= "<table style='width:100%'><tr><td>";
	}
 
 
	$submit_name="add";
	$submit_value=ADLAN_SUR19;
	if($_POST['edit']){
		$text .= $f -> form_hidden("existing",$_POST['existing']);

		$text .= "</td></tr></table></span></div></td></tr>";
		$text .= "<tr><td colspan='4'>";
		$text .= "<table class='table'>";
		$text .= "<tr><td class='fcaption'>&nbsp;</td>";
		$text .= "<td class='fcaption'>".ADLAN_SUR22."</td>";
		$text .= "<td class='fcaption'>".ADLAN_SUR23."</td>";
		$text .= "<td class='fcaption'>".ADLAN_SUR34."</td>";
		$text .= "<td class='fcaption'>".ADLAN_SUR24."</td>";
		$text .= "<td class='fcaption'>".ADLAN_SUR25."</td>";
		$text .= "</tr>";
		
		$fields=unserialize($survey_parms);
		if($survey_parms){
			for($i=0;$i<count($fields);$i++){
				$text .= "<tr><td class='forumheader3' style='text-align:right;'>";
				if($i){
					$text .= "<input class='button' type='image'  name='up_{$i}' value='{$i}' src='images/up.png' style='border:0px; vertical-align:bottom;' />";
				}
				if($i && $i < count($fields)-1){
					$text .= "<input class='button' type='image'  name='down_{$i}' value='{$i}' src='images/down.png' style='border:0px; vertical-align:bottom;' />";
				}
//				$text .= "{".$fields[$i]['field_number']."}";
				$text .= "</td><td  class='forumheader3' style='white-space:nowrap;'>";
				$text .= $f -> form_hidden("field_number[{$fnum}]",$fields[$i]['field_number']);
				$text .= "[".$fields[$i]['field_number']."]";
				$text .= $f -> form_text("field_text[{$fnum}]",25,$fields[$i]['field_text']);
				$text .= "</td>";
				$text .= "<td class='forumheader3'>".$f -> form_checkbox("field_req[{$fnum}]","1",$fields[$i]['field_req'])."</td>";
				$text .= "<td class='forumheader3'>".$f -> form_checkbox("field_hidden[{$fnum}]","1",$fields[$i]['field_hidden'])."</td>";
				$text .= "<td class='forumheader3'>";
				$text .= $f -> form_select_open("field_type[{$fnum}]");
				foreach($fieldtypes as $ftnum => $ftval){
					$sel = ($ftnum == $fields[$i]['field_type']) ? 1 : 0;
					$text .= $f -> form_option($ftval,$sel,$ftnum);
				}
				$text .= "</td><td class='forumheader3'>";
				$text .= $f -> form_text("field_choices[{$fnum}]",40,$fields[$i]['field_choices']);
				$text .= "</td>";
				$text .= "</tr>";
				$fnum++;
			}
		}
		$text .= "<tr><td colspan='6' class='forumheader3' style='text-align:center;'>".ADLAN_SUR26."<br /></td></tr>";
		$text .= "<tr>";
		$text .= "<td colspan='2' class='forumheader3'>";
		$text .= $f -> form_text("field_text[{$fnum}]",25,"");
		$text .= $f -> form_hidden("field_number[{$fnum}]",$survey_lastfnum+1);
		$text .= $f -> form_hidden("newfield",$fnum);
		$text .= "</td>";
		$text .= "<td class='forumheader3'>".$f -> form_checkbox("field_req[{$fnum}]","1")."</td>";
		$text .= "<td class='forumheader3'>".$f -> form_checkbox("field_hidden[{$fnum}]","1")."</td>";
		$text .= "<td class='forumheader3'>";
		$text .= $f -> form_select_open("field_type[{$fnum}]");
		foreach($fieldtypes as $ftnum => $ftval){
			$text .= $f -> form_option($ftval,0,$ftnum);
		}
		$text .= "</td><td class='forumheader3'>";
		$text .= $f -> form_text("field_choices[{$fnum}]",40,"");
		$text .= "</td>";
		$text .= "</tr>";
		$submit_name="update";
		$submit_value=ADLAN_SUR27;
		$text .= "</table></td></tr>";
	}

	$text .= "<tr><td colspan='5'  class='forumheader' style='text-align:center;'>";
	$text .= $f -> form_button("submit",$submit_name,$submit_value);
	$text .= "</td></tr>";
	$text .= "</table>";
	$text .= $f -> form_close()." </div>";

	$ns -> tablerender($survey_name,$text);
	require_once(e_ADMIN."footer.php");
	exit;
}
require_once(e_ADMIN."footer.php");
