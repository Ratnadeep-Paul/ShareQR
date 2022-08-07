// Choose File Button's Function For Openign File Selection Window (By Clicking The Label For File Input)
function chooseFile() {
    $('#uploading-file-label').click();
}

// Validating The Selected Files
$('#uploading-file').bind('change', function () {

    // Getting The Number Of Total File Selected
    var total = this.files.length;

    // Total Item Validation
    if (total > 5) {
        alert("You Can't Select More Than 5 Items")
        photo_up = document.getElementById('uploading-file')
        photo_up.value = '';
        $("#upload-filename").html("");
    } else {
        // Lopping Through The Selected Files And Validating
        for (let i = 0; i < total; i++) {

            if (this.files[i].size > 25000001) {

                photo_up = document.getElementById('uploading-file')
                photo_up.value = '';
                alert("Please Select File Under 25MB")

            } else {

                // Getting The File Name
                var filename = this.files[i].name;

                // Get The Extentions Of The Selected Files
                var extantion = filename.split('.').pop();
                var ext = extantion.toLowerCase();

                // Validation Of The File Extentions
                if (ext == "php" || ext == "html" || ext == "script" || ext == "htm" || ext == "css") {

                    photo_up = document.getElementById('uploading-file')
                    photo_up.value = '';
                    alert("You Can't Select This Type Of File....." + filename + " Is Not Selected")

                } else {

                    $("#upload-filename").append(filename + " <br> ");
                    $("#hidden-upload").modal('show');
                }

            }

        }
    }

});


// Modal Close Button's Click Function
function closeUpload() {
    $("#hidden-upload").modal('hide');
    photo_up = document.getElementById('uploading-file')
    photo_up.value = '';
    $("#upload-filename").html("");
}

// Submit Upload Button's Click Function
function submitUpload() {
    $('#submit-upload').html('Uploading... <div class="spinner-border" role="status"> <span class="sr-only" > Loading...</span></div > ')
}