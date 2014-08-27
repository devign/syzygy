
function overlayWindow(loadFile, width, height) {
	overWindow = window.open("", "_blank", "left=300px, innerwidth=" + width + ",innerheight=" + height + ",scrollbars,dependent,location=no,menubar=no,screenX=300,status=1");
    overWindow.location = loadFile;
    return false;

}

function validateFormData(form) {
	var valid = true;
	$('.required').each(function() {
		if ((this).value == '') {
			alert("Please enter " + (this).title);
			valid = false;
		}
	})
	
	if (valid) {
		return true;	
	} else {
		return false;
	}

}

