/*
 * 
 * this script enque js code in wordpress admin area 
 */
 
jQuery(document).ready(function(){
	
	// primary services js
	
	if(jQuery('#primary-servicechecklist li label input:checked').length >= 1){
		jQuery('#primary-servicechecklist li label input[type="checkbox"]:not(:checked)').attr('disabled', 'disabled');
		jQuery('#primary-servicechecklist li label input[type="checkbox"]:not(:checked)').closest('label').css("color", "#c5c5c5");
	}	
	
	jQuery('#primary-servicechecklist li label input[type="checkbox"]').click(function(event) {
		var checked_name = jQuery(this).closest('label').clone().children().remove().end().text().trim();
		
		jQuery('#core-servicechecklist li label input[type="checkbox"]:checked').each(function(){
			if(this.checked && checked_name == jQuery(this).closest('label').clone().children().remove().end().text().trim()){
				event.preventDefault();
				alert('You canncot select same name service from other service types!');
			}
		});
		jQuery('#aspirational-servicechecklist li label input[type="checkbox"]:checked').each(function(){
			if(this.checked && checked_name == jQuery(this).closest('label').clone().children().remove().end().text().trim()){
				event.preventDefault();
				alert('You canncot select same name service from other service types!');
			}
		});
	});
	
	jQuery('#primary-servicechecklist li label input[type="checkbox"]').change(function(event) {
		if(jQuery('#primary-servicechecklist li label input:checked').length < 1){
			jQuery('#primary-servicechecklist li label input[type="checkbox"]:not(:checked)').removeAttr('disabled');
			jQuery('#primary-servicechecklist li label input[type="checkbox"]:not(:checked)').closest('label').css("color", "");
		}
		if(jQuery('#primary-servicechecklist li label input:checked').length == 1){
			jQuery('#primary-servicechecklist li label input[type="checkbox"]:not(:checked)').attr('disabled', 'disabled');
			jQuery('#primary-servicechecklist li label input[type="checkbox"]:not(:checked)').closest('label').css("color", "#c5c5c5");
		}
	});
	
	
	// core services js
	
	if(jQuery('#core-servicechecklist li label input:checked').length >= 10){
		jQuery('#core-servicechecklist li label input[type="checkbox"]:not(:checked)').attr('disabled', 'disabled');
		jQuery('#core-servicechecklist li label input[type="checkbox"]:not(:checked)').closest('label').css("color", "#c5c5c5");
	}	
	
	jQuery('#core-servicechecklist li label input[type="checkbox"]').click(function(event) {
		var checked_name = jQuery(this).closest('label').clone().children().remove().end().text().trim();
		
		jQuery('#primary-servicechecklist li label input[type="checkbox"]:checked').each(function(){
			if(this.checked && checked_name == jQuery(this).closest('label').clone().children().remove().end().text().trim()){
				event.preventDefault();
				alert('You canncot select same name service from other service types!');
			}
		});
		jQuery('#aspirational-servicechecklist li label input[type="checkbox"]:checked').each(function(){
			if(this.checked && checked_name == jQuery(this).closest('label').clone().children().remove().end().text().trim()){
				event.preventDefault();
				alert('You canncot select same name service from other service types!');
			}
		});
	});
	
	jQuery('#core-servicechecklist li label input[type="checkbox"]').change(function(event) {
		if(jQuery('#core-servicechecklist li label input:checked').length < 10){
			jQuery('#core-servicechecklist li label input[type="checkbox"]:not(:checked)').removeAttr('disabled');
			jQuery('#core-servicechecklist li label input[type="checkbox"]:not(:checked)').closest('label').css("color", "");
		}
		if(jQuery('#core-servicechecklist li label input:checked').length == 10){
			jQuery('#core-servicechecklist li label input[type="checkbox"]:not(:checked)').attr('disabled', 'disabled');
			jQuery('#core-servicechecklist li label input[type="checkbox"]:not(:checked)').closest('label').css("color", "#c5c5c5");
		}
	});
	
	// aspirational services js
	
	if(jQuery('#aspirational-servicechecklist li label input:checked').length >= 10){
		jQuery('#aspirational-servicechecklist li label input[type="checkbox"]:not(:checked)').attr('disabled', 'disabled');
		jQuery('#aspirational-servicechecklist li label input[type="checkbox"]:not(:checked)').closest('label').css("color", "#c5c5c5");
	}	
	
	jQuery('#aspirational-servicechecklist li label input[type="checkbox"]').click(function(event) {
		var checked_name = jQuery(this).closest('label').clone().children().remove().end().text().trim();
		
		jQuery('#primary-servicechecklist li label input[type="checkbox"]:checked').each(function(){
			if(this.checked && checked_name == jQuery(this).closest('label').clone().children().remove().end().text().trim()){
				event.preventDefault();
				alert('You canncot select same name service from other service types!');
			}
		});
		jQuery('#core-servicechecklist li label input[type="checkbox"]:checked').each(function(){
			if(this.checked && checked_name == jQuery(this).closest('label').clone().children().remove().end().text().trim()){
				event.preventDefault();
				alert('You canncot select same name service from other service types!');
			}
		});
	});
	
	jQuery('#aspirational-servicechecklist li label input[type="checkbox"]').change(function(event) {
		if(jQuery('#aspirational-servicechecklist li label input:checked').length < 10){
			jQuery('#aspirational-servicechecklist li label input[type="checkbox"]:not(:checked)').removeAttr('disabled');
			jQuery('#aspirational-servicechecklist li label input[type="checkbox"]:not(:checked)').closest('label').css("color", "");
		}
		if(jQuery('#aspirational-servicechecklist li label input:checked').length == 10){
			jQuery('#aspirational-servicechecklist li label input[type="checkbox"]:not(:checked)').attr('disabled', 'disabled');
			jQuery('#aspirational-servicechecklist li label input[type="checkbox"]:not(:checked)').closest('label').css("color", "#c5c5c5");
		}
	});
		
});
