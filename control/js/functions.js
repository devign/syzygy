
function setParentCategory(setVal, frm) {
    if (setVal == 1) {
        $('#parent_category_id').hide();
        frm.parent_category_id.value = 0;    
    } else if (setVal == 0) {
        $('#parent_category_id').show();
    }
}

function autoSEOInput(val, frm) {
    var new_url;
    myRegEx = new RegExp("\\s", "g");
    
    frm.page_title.value = val;
    
    val = val.toLowerCase();
    new_url = val.replace(myRegEx, '-');
    
    frm.page_url.value = new_url;
}

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

