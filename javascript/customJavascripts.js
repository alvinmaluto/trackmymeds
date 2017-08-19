/*Ensure password & confirmation matches, input is confirmation field*/
function check(input) {
    if (input.value != document.getElementById('password').value) {
        input.setCustomValidity('Password Must be Matching.');
    } else {
        // input is valid -- reset the error message
        input.setCustomValidity('');
    }
}

//Insert into form input specified by function argument the address of the logged in user.
function getAddress(inputID){
	$.ajax({
		url:'php/getAddress.php',
		complete: function (response) {
			$('#' + inputID).val(response.responseText);
		},
		error: function () {
			$('#' + inputID).html('Bummer: there was an error!');
		}
	});
	return false;
}

//code from https://www.sanwebe.com/2013/03/addremove-input-fields-dynamically-with-jquery
//Allow users to add more than one package
$(document).ready(
	function() {
		var max_fields      = 5; //maximum input boxes allowed
		var wrapper         = $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append(
					'<div>'
						+ '<div class="form-group">'
							+ '<label for="comment">Package Description:</label>'
							+ '<input type="text" class="form-control" id="package-description" maxlength="50" name="packageDescription[]"></textarea>*max 50 characters'
						+ '</div>'
						+ '<div class="form-group">'
							+ '<label for="weight">Package Weight:</label>'
							+ '<input type="text" class="form-control" id="package-description" maxlength="50" name="weight[]"></textarea>*max 50 characters'
						+ '</div>'
						+ '<a href="#" class="remove_field">Remove Package</a></div>'
					+ '</div>'
				); //add input box
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	}
);