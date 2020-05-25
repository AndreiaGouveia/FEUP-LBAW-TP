let imageContainer = document.querySelector(".avatar-zone");
let theImageField = document.querySelector(".upload_btn");

theImageField.onchange = function (e) {
    var theFile = e.target.files[0];

    if(checkFileProperties(theFile)) {
        handleUploadedFile(theFile);
    }

}

function checkFileProperties(theFile) {

    if (theFile.type !== "image/png" && theFile.type !== "image/jpeg") {
        console.log('File type mismatch');
        return false;
    }

    return true;

}

function handleUploadedFile(file) {
    fileName = file.name;
    //clearImage();
    var img = document.getElementById("profilePic");
    img.file = file;
    
    var reader = new FileReader();
    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
    reader.readAsDataURL(file);
}
