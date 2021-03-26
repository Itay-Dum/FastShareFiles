function getFile() {
    document.getElementById("upfile").click();
  }
  
  function sub(obj) {
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("browse-files").innerHTML = fileName[fileName.length - 1];
    document.myForm.submit();
    event.preventDefault();
  }


var FormData = new FormData();
(function() {
    var dropzone = document.getElementById("dropzone");
    var uploadBtn = document.getElementById("upload")
    

    uploadBtn.onclick = function(e) {
        submitFiles();
    };

    var upload = function(files) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            FormData.append('file[]', file);
        }
   
    }


    var submitFiles = function() {
        var xhr = new XMLHttpRequest();

        xhr.onload = function() {
            let data = this.responseText;
            console.log(data);
        }

        xhr.open('post', 'php/upload.php');
        console.log(FormData);
        xhr.send(FormData);
    }


    dropzone.ondragover = function() {
        this.className = "drop-box drop-box-hang";
        return false;
    }

    dropzone.ondragleave = function() {
        this.className = "drop-box active-animatioon";
        return false;
    }
    dropzone.ondrop = function(e) {
        e.preventDefault();
        this.className = "drop-box active-animatioon";
        upload(e.dataTransfer.files);
    }


}());

