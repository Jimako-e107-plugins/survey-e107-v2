<?php
 
$sql = e107::getDb();
$ns = e107::getRender();
$tp = e107::getParser();

//e107::library('load', 'jquery-ui');  - it is there by default 

require_once(e_HANDLER . "form_handler.php");  //fix me
$rs = new form;

e107::lan('survey',true, true);
  
//// Form Builder ///////////////////////////////////////////////

if ($id)
{

	//// FIELD TYPES ////
	for ($i = 1; $i <= 20; $i++)
	{
		$x = "ADLAN_SURTYPE_" . $i;
		if (defined($x))
		{
			$fieldtypes[$i] = constant($x);
		}
	}

	//// USERIALIZE FIELDS ////
	//$fields = unserialize($survey_parms);
	$fields = $survey_parms;
	$totfnum = is_array($fields) ? count($fields) : 0;

	//// SORT FIELDS ////
	foreach ($fields as $key => $row)
	{
		$forder[$key]  = $row["field_order"];
	}
	if(is_array($forder)) {
		array_multisort($forder, SORT_ASC, $fields);

		//// NEW FIELD ID ////
		foreach ($fields as $key => $row)
		{
			$fmax[]  = $row["field_number"];
		}
		$new_fnumber = max($fmax) + 1;

	}
	else {
		$fields = array();
		$new_fnumber =  1;
	}
	


 
	$fb .= "<table class='table survey_fields'>";
	$fb .= "<thead>";
	$fb .= "<tr>";
	$fb .= "<th>" . ADLAN_SUR_FORDER . "</th>";
	$fb .= "<th><div class='text-center'>#</div></th>";
	$fb .= "<th>" . ADLAN_SUR22 . "</th>";
	$fb .= "<th><div class='text-center'>" . ADLAN_SUR23 . "</div></th>";
	$fb .= "<th><div class='text-center'>" . ADLAN_SUR73 . "</div></th>";
	$fb .= "<th>" . ADLAN_SUR_FTYPE . "</th>";
	$fb .= "<th>" . ADLAN_SUR_FPARMS . "</th>";
	$fb .= "<th>" . ADLAN_SUR_FHELP_USERCLASS . "</th>";
	$fb .= "<th>" . ADLAN_SUR_FHELP_TEXT . "</th>";
	$fb .= "</tr>";
	$fb .= "</thead>";
	if ($fields)
	{

		$options['class'] = "form-control";
		$options['size'] = "xlarge";

		$fb .= "<tbody id='survey_ordercontainer' data-form_id='" . $editf["survey_id"] . "'>";
		foreach ($fields as $key => $row)
		{
			$fb .= "<tr class='js-survey-order-item' id='sort_" . $row['field_number'] . "'>";
			$fb .= $this->hidden("field_number[{$key}]", $row['field_number']);
			$fb .= $this->hidden("field_order[{$key}]", $row['field_order']);
			$fb .= "<td><div class='text-center'><i class='fa fa-bars survey-order-handle js-survey-order-handle'></i></div></td>";
			$fb .= "<td><div class='text-center'>" . $row['field_number'] . "</div></td>";
			$fb .= "<td>" . $this->text("field_text[{$key}]", $row['field_text'], 254, $options) . "</td>";
			$fb .= "<td><div class='text-center'>" . $rs->form_checkbox("field_req[{$key}]", 1, $row['field_req']) . "</div></td>";
			$fb .= "<td><div class='text-center'>" . $rs->form_checkbox("field_hidden[{$key}]", 1, $row['field_hidden']) . "</div></td>";
			$fb .= "<td><select id='field_type[{$key}]' name='field_type[{$key}]' class='form-control'>";

			//public function option($option_title, $value, $selected = false, $options = '')
			foreach ($fieldtypes as $ftnum => $ftval)
			{
				$fb .= $this->option($ftval, $ftnum, (($ftnum == $row['field_type']) ? 1 : 0) );
			}
			$fb .= $this->select_close() . "</td>";
			$fb .= "<td>" . $rs->form_text("field_choices[{$key}]", 40, $row['field_choices'], FALSE, "form-control") . "</td>";
			$fb .= "<td>" . r_userclass("field_userclass[" . $key . "]", $row["field_userclass"], "off" ) . "</td>";
			$fb .= '<td><button class="btn btn-default js-fb-help-text-edit" type="button" data-id="' . $key . '"><span class="fa fa-pencil"></span> Help text</button><textarea class="form-control hide" id="fbHelpTextHidden' . $key . '" name="field_help_text[' . $key . ']">' . $row['field_help_text'] . '</textarea></td>';
			$fb .= "</tr>";
		}
		$fb .= "</tbody>";
	}
	$fb .= "<tfoot>";
	$fb .= "<tr>";
	$fb .= $this->hidden("field_number[{$totfnum}]", $new_fnumber);
	$fb .= $this->hidden("field_order[{$totfnum}]", ($totfnum + 1));
	$fb .= "<td><div class='text-center'><strong>" . ADLAN_SUR_FNEW . "</strong></div></td>";
	$fb .= "<td><div class='text-center'>" . $new_fnumber . "</div></td>";
	$fb .= "<td>" . $this->text("field_text[{$totfnum}]", "",  254, $options) . "</td>";
	$fb .= "<td><div class='text-center'>" . $rs->form_checkbox("field_req[{$totfnum}]", 1) . "</div></td>";
	$fb .= "<td><div class='text-center'>" . $rs->form_checkbox("field_hidden[{$totfnum}]", 1) . "</div></td>";
	$fb .= "<td><select id='field_type[{$totfnum}]' name='field_type[{$totfnum}]' class='form-control'>";
	foreach ($fieldtypes as $ftnum => $ftval)
	{
		$fb .= $this->option($ftval, $ftnum, 0 );
	}
	$fb .= $this->select_close() . "</td>";
	$fb .= "<td>" . $this->text("field_choices[{$totfnum}]", "",  FALSE, "size=40") . "</td>";
	$fb .= "<td>" . r_userclass("field_userclass[" . $totfnum . "]", "") . "</td>";
	$fb .= '<td><button class="btn btn-default js-fb-help-text-edit" type="button" data-id="' . $totfnum . '"><span class="fa fa-pencil"></span> Help text</button><textarea class="form-control hide" id="fbHelpTextHidden' . $totfnum . '" name="field_help_text[' . $totfnum . ']"></textarea></td>';
	$fb .= "</tr>";
	$fb .= "</tfoot>";
	$fb .= "</table>";
 
	$fb .= $this->close();

	$fb .= '
		<div class="modal fade" id="fbHelpTextModal">
			<div class="modal-dialog">
				<div class="modal-content">

				<div class="modal-body">
					<textarea class="form-control" id="fbHelpText"></textarea>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary" id="fbHelpTextSave" type="button">Update</button>
				</div>
				</div>
			</div>
		</div>
	';
}
else
{
	$fb = "<div class='alert alert-block alert-danger'>" . ADLAN_SUR_SAVEFIRST . "</div>";
}


$text = $fb;