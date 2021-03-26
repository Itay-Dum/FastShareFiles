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



(function() {
    var dropzone = document.getElementById("dropzone");


    var upload = function(files) {
        var formData = new FormData();
        var xhr = new XMLHttpRequest();


        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            formData.append('file[]', file);
        }

        xhr.onload = function() {
            let data = this.responseText;
            console.log(data);
        }

        xhr.open('post', 'php/upload.php');
        console.log(formData);
        xhr.send(formData);
        
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
        // var formData = new FormData();
        // var xhr = new XMLHttpRequest();
        
        // xhr.onload = function() {
        //     let data = this.responseText;
        //     console.log(data);
        // }

        // var length = e.dataTransfer.items.length;
        // for (var i = 0; i < length; i++) {
        //     var entry = e.dataTransfer.items[i].webkitGetAsEntry();
        //     if (entry.isFile) {
        //         console.log(entry.name);
        //         formData.append("file[]", entry);
        //     }  else if (entry.isDirectory) {
        //         console.log(entry.name);
        //         formData.append("directory[]", entry);
        //     }
        // }
        // xhr.open('post', 'php/upload.php');
        // console.log(formData)
        // xhr.send(formData);
        
    }


}());

