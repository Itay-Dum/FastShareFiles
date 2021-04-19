function AlertMsg(text, messageStatus="success", boldText = "") {
    let alerts = document.getElementById("alert-area");
    
    let str = `
    <div class="alert alert-${messageStatus} fade show" role="alert">
    <strong>${boldText}</strong> ${text}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
        </div>
    `;

    alerts.innerHTML += str;
}


function DownloadFile(fileId) {
    let queryString = window.location.search;
    let urlParmas = new URLSearchParams(queryString);
    let id = urlParmas.get("id");
    window.location.href = `../php/uploads?id=${id}&fileId=${fileId}`; 
}


function copyToClipboard(text) {
    if (window.clipboardData && window.clipboardData.setData) {
        // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
        return window.clipboardData.setData("Text", text);

    }
    else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
        var textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in Microsoft Edge.
        document.body.appendChild(textarea);
        textarea.select();
        try {
            return document.execCommand("copy");  // Security exception may be thrown by some browsers.
        }
        catch (ex) {
            console.warn("Copy to clipboard failed.", ex);
            return false;
        }
        finally {
            document.body.removeChild(textarea);
        }
    }
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
    var filesArea = document.getElementById("files-uploaded-area");
    var manualUpload = document.getElementById("browse-files");
    var tarshCanSVG = `<svg class="trash-can" xmlns="http://www.w3.org/2000/svg"><path d="m232.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m114.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m28.398438 127.121094v246.378906c0 14.5625 5.339843 28.238281 14.667968 38.050781 9.285156 9.839844 22.207032 15.425781 35.730469 15.449219h189.203125c13.527344-.023438 26.449219-5.609375 35.730469-15.449219 9.328125-9.8125 14.667969-23.488281 14.667969-38.050781v-246.378906c18.542968-4.921875 30.558593-22.835938 28.078124-41.863282-2.484374-19.023437-18.691406-33.253906-37.878906-33.257812h-51.199218v-12.5c.058593-10.511719-4.097657-20.605469-11.539063-28.03125-7.441406-7.421875-17.550781-11.5546875-28.0625-11.46875h-88.796875c-10.511719-.0859375-20.621094 4.046875-28.0625 11.46875-7.441406 7.425781-11.597656 17.519531-11.539062 28.03125v12.5h-51.199219c-19.1875.003906-35.394531 14.234375-37.878907 33.257812-2.480468 19.027344 9.535157 36.941407 28.078126 41.863282zm239.601562 279.878906h-189.203125c-17.097656 0-30.398437-14.6875-30.398437-33.5v-245.5h250v245.5c0 18.8125-13.300782 33.5-30.398438 33.5zm-158.601562-367.5c-.066407-5.207031 1.980468-10.21875 5.675781-13.894531 3.691406-3.675781 8.714843-5.695313 13.925781-5.605469h88.796875c5.210937-.089844 10.234375 1.929688 13.925781 5.605469 3.695313 3.671875 5.742188 8.6875 5.675782 13.894531v12.5h-128zm-71.199219 32.5h270.398437c9.941406 0 18 8.058594 18 18s-8.058594 18-18 18h-270.398437c-9.941407 0-18-8.058594-18-18s8.058593-18 18-18zm0 0"/><path d="m173.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/></svg>`
    var copyBtn = document.getElementById("copy-btn");
    var checkMarkSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
  </svg>`;


    if (manualUpload) {
        manualUpload.onclick = function() {
            let input = document.createElement('input');
            input.type = 'file';
            input.onchange = _ => {
                // you can use this method to get file and perform respective operations
                let files = Array.from(input.files);   
                upload(files);
            };
            input.click();
        }
    }

    uploadBtn.onclick = function(e) {
        submitFiles();
        return false;
    };

    if (copyBtn) {
        copyBtn.onclick = function() {
            let currentLink = window.location.href;
            copyToClipboard(currentLink);
            copyBtn.innerHTML = checkMarkSVG;
            AlertMsg("The websites link address was copied to your clipboard!", "success", "Copied succefully! ")
        }
        copyBtn.onmouseover = function() {
            copyBtn.setAttribute("fill", "blue");
    
        }

        copyBtn.onmouseleave = function() {
            copyBtn.setAttribute("fill", "black");
        }
    }

    var filesAreaDeleteDefaultText = function() {
        let defaultText = document.getElementById("default-text");
        if (defaultText) {
            defaultText.remove();
        }
    }

    var upload = function(files) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            FormData.append('file[]', file);
            var newFileUpload = document.createElement("span");
            newFileUpload.className += "file-item-row"
            filesAreaDeleteDefaultText();
            newFileUpload.innerHTML = `<h3 class="file-name">${file.name}</h3>`;
            filesArea.appendChild(newFileUpload);
            fileAreaScrollBottom();
        }
        return false;
    }

    var fileAreaScrollBottom = function() {
        filesArea.scroll({
            top: filesArea.scrollHeight,
            behavior: "smooth"
        });
        return false;
    }

    var submitFiles = function() {
        var xhr = new XMLHttpRequest();

        xhr.onload = function() {
            let data = this.responseText;
            let status = xhr.status;
            if (status == 200) {
                AlertMsg("Your files have been uploaded", "success", "Succefully uploaded files!")
            }
            window.location.href = `uploads?id=${data}`;
        }
        xhr.open('post', 'php/upload.php');
        xhr.send(FormData);
        

        return false;
    }

    if (dropzone) {
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
            
            
            return false;
        }
    }

}());

