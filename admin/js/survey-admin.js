$(document).ready(function() {
 

 
	if (typeof $.fn.sortable === "function") {
        
		$("#survey_ordercontainer").sortable({
             
			containment: "#survey_ordercontainer",
			handle: ".js-survey-order-handle",
			items: "> .js-survey-order-item",
			axis: "y",
            opacity: 0.9,
			cursor: "move",
			placeholder: "tr td",
			update: function(event, ui) {
				var Sorted = $(this).sortable("serialize");
				$(".survey_orderitem").each(function(i, v) {	$(v).find(" input[name^='field_order']").val(i); });		
           /*
				$.ajax({ type: "POST", cache: false, dataType: "json", url: "js/ajax.php?ajax=orderform", data: $(this).sortable("serialize") + "&form_id=" + $(this).data("form_id") }).done(function(event) {
					$.bootstrapGrowl(event.message, {type: event.status});
				});
			*/
            }

             
		});
	}

    // Add/Edit Help Text  at least one field at main config has to be bbarea!
    if (typeof tinymce !== "undefined") {
        tinymce.execCommand("mceAddEditor", false, "fbHelpText");
        var helpTextId = false;

        $(document).on("click", ".js-fb-help-text-edit", function (e) {
            helpTextId = $(e.target).data("id");
            var editContent = $("#fbHelpTextHidden" + helpTextId).val();

            tinymce.get("fbHelpText").setContent(editContent);
            tinymce.execCommand("mceFocus", false, "fbHelpText");
            $("#fbHelpTextModal").modal("show");
        });

        $(document).on("click", "#fbHelpTextSave", function () {
            var saveContent = tinymce.get("fbHelpText").getContent();
            $("#fbHelpTextHidden" + helpTextId).val(saveContent);
            $("#fbHelpTextModal").modal("hide");
        });

        $("#myModal").on("hidden.bs.modal", function (e) {
            tinymce.get("fbHelpText").setContent("");
        })
    }
 	
});