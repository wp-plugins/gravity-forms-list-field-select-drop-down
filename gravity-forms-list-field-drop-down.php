<?php
/*
Plugin Name: Gravity Forms - List Field Drop Down
Description: Gives the option of adding a drop down (select) list to a list field column
Version: 1.0
Author: Adrian Gordon
Author URI: http://www.itsupportguides.com 
License: GPL2
Text Domain: itsg_field_dropdown
*/

if (!class_exists('ITSG_GF_List_Field_Drop_Down')) {
    class ITSG_GF_List_Field_Drop_Down
    {
		
		/**
         * Construct the plugin object
         */
		 public function __construct()
        {
            // register actions
            if ((self::is_gravityforms_installed())) {
				// start the plugin
				add_filter('gform_column_input', array(&$this,'change_column_content'), 10, 5);
				add_action('gform_editor_js', array(&$this,'editor_js'));
			}
		}

		/*
         * Changes column field if 'date field' option is ticked. Adds 'datepicker' class.
         */
		public static function change_column_content($input_info, $field, $column, $value, $form_id){
			foreach($field["choices"] as $choice){
				if ($column == $choice["text"]  &&  $choice["isDropDown"] == true) {
					$isDropDownChoices = $choice["isDropDownChoices"];
					$options = explode(",", $isDropDownChoices);
					array_unshift($options,'');  // add default blank option
					$options = array_map('trim', $options); // remove blank spaces at start or end of each option
					return array("type" => "select", "choices" => $options);
				}
			}
		}
				
		/*
         * JavaScript used by form editor - Functions taken from Gravity Forms source and extended to handle the 'Date field' option
         */
		public static function editor_js() {
		?>
		<script type='text/javascript'>
		// ADD drop down options to list field in form editor - hooks into existing GetFieldChoices function.
	(function (w){
			var GetFieldChoicesOld = w.GetFieldChoices;
			
			w.GetFieldChoices = function (){

				str = GetFieldChoicesOld.apply(this, [field]);
				
				if(field.choices == undefined)
				return "";
				
				for(var i=0; i<field.choices.length; i++){
				var inputType = GetInputType(field);
				var isDropDown = field.choices[i].isDropDown ? "checked" : "";
				var value = field.enableChoiceValue ? String(field.choices[i].value) : field.choices[i].text;
				var isDropDownChoices = isDropDown ? field.choices[i].isDropDownChoices : "";
				if (inputType == 'list' ){
				if (i == 0 ){
				str += "<p><strong>Drop Down fields</strong><br>Place a tick next to the field to make it a drop down field. Enter the drop down options into the box as comma-separated-values, e.g. 'Mr,Mrs,Miss,Ms'.</p>";
				}
				str += "<div>";
				 str += "<input type='checkbox' name='choice_dropdown' id='" + inputType + "_choice_dropdown_" + i + "' " + isDropDown + " onclick=\"SetFieldChoice2('" + inputType + "', " + i + ");itsg_gf_list_drop_down_function();\" /> ";
				 str += "	<label class='inline' for='"+ inputType + "_choice_dropdown_" + i + "'>"+value+" - Make Drop Down</label>";
				 str += "<div style='display:none' class='itsg_dropdown'>";
				 str += "<label style='display: inline; margin-right: 10px; font-weight: 800;' for='" + inputType + "_choice_dropdownoptions_" + i + "'>";
				 str += "Options:</label>";
				 str += "<input type='text' value=\"" + isDropDownChoices.replace(/"/g, "&quot;") + "\" class='choice_dropdown' id='" + inputType + "_choice_dropdownoptions_" + i + "' onblur=\"SetFieldChoice2('" + inputType + "', " + i + ");\">";
				 str += "</div>";
				 str += "</div>";
				 }
				 }
				return str;
			}
		})(window || {});		
		
		// handles the 'make drop down' checkbox and option fields
		function SetFieldChoice2(inputType, index){
			
			var element = jQuery("#" + inputType + "_choice_selected_" + index);
			
			if ('list' == inputType) {
			var element = jQuery("#" + inputType + "_choice_dropdown_" + index);
			isDropDown = element.is(":checked");
			isDropDownChoices = jQuery("#" + inputType + "_choice_dropdownoptions_" + index).val();
			}
			field = GetSelectedField();

			if ('list' == inputType) {
			field.choices[index].isDropDownChoices = isDropDownChoices;
			}

			//set field selections
			jQuery("#field_columns :checkbox").each(function(index){
				field.choices[index].isDropDown = this.checked;
			});

			LoadBulkChoices(field);

			UpdateFieldChoices(GetInputType(field));
		}

		</script>
		
		<script type="text/javascript">
		function itsg_gf_list_drop_down_function(){
			jQuery('#field_columns input[name=choice_dropdown]').each(function() {
				if (jQuery(this).is(":checked")) {
						jQuery(this).parent("div").find(".itsg_dropdown").show();
					}
					else {
						jQuery(this).parent("div").find(".itsg_dropdown").hide();
					}
			});
		}
		
		// trigger for when field is opened
		jQuery(document).on('click', 'ul.gform_fields', function(){
			itsg_gf_list_drop_down_function();  
		});
		
		// trigger for when column titles are updated
		jQuery(document).on('change','#gfield_settings_columns_container #field_columns li',function() {
			InsertFieldChoice(0);
			DeleteFieldChoice(0);
			itsg_gf_list_drop_down_function();
		});
		
		</script>
		
		
		<?php
		} // END editor_js
		
		/*
         * Check if GF is installed
         */
        private static function is_gravityforms_installed()
        {
            return class_exists('GFAPI');
        } // END is_gravityforms_installed
	}
    $ITSG_GF_List_Field_Drop_Down = new ITSG_GF_List_Field_Drop_Down();
}