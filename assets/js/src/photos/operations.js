function deleteClickHandler(event, parent) {
  event.stopPropagation();

  var category = parent.getAttribute('data-category'),
  file = parent.getAttribute('data-file'),
  formData = new FormData(),
  xhr = new XMLHttpRequest();

  if (category && !file) {
    var confirmation = confirm(`Are you sure you want to delete the ${category} folder`);

    if (confirmation == true) {
      formData.append('type', 'folder');
      formData.append('category', category);
      parent.remove();
    } 
  }
  else {
    var confirmation = confirm(`Are you sure you want to delete the ${file} file`);

    if (confirmation == true) {
      formData.append('type', 'file');
      formData.append('category', category);
      formData.append('name', file);
      parent.remove();
    }
  }
  xhr.open('POST', `//${window.location.hostname}/PhotoGallery/API/remove`);
  xhr.setRequestHeader('CSRF-Token', document.querySelectorAll('meta[name="csrf-token"]')[0].getAttribute('content'));
  xhr.send(formData);
}

function editClickHandler(event, parent) {
  event.stopPropagation();
  var description = parent.getElementsByClassName("photo-description")[0],
  old_name = description.innerHTML,
  new_name = prompt("Enter a new name:", old_name);
  if (new_name && old_name != new_name) {
    description.innerHTML = new_name;
    parent.setAttribute("data-category", new_name);
    parent.getElementsByTagName("a")[0].setAttribute("href", new_name);

    var formData = new FormData(),
    xhr = new XMLHttpRequest();

    formData.append('old_name', old_name);
    formData.append('new_name', new_name);
    xhr.open('POST', `//${window.location.hostname}/PhotoGallery/API/edit`);
    xhr.setRequestHeader('CSRF-Token', document.querySelectorAll('meta[name="csrf-token"]')[0].getAttribute('content'));
    xhr.send(formData);
  }
}

function rotateClickHandler(event, parent, direction) {
  event.stopPropagation();
  var angle = parseInt(parent.getElementsByTagName("img")[0].getAttribute("data-angle"));

  switch (direction) {
    case 'left':
      if (angle <= 0)
        angle = 360;
      angle -= 90;
      break;
    case 'right':
      if (angle >= 360)
        angle = 0;
      angle += 90;
      break;
  }
  
  parent.getElementsByTagName("img")[0].setAttribute("data-angle", angle);
  parent.getElementsByTagName("img")[0].style.cssText = "transform: rotate(${angle}deg)";
}

function saveClickHandler(event, parent) {
  event.stopPropagation();
  var formData = new FormData(),
  xhr = new XMLHttpRequest();

  var category = parent.getAttribute("data-category"),
  file = parent.getAttribute("data-file"),
  angle = parseInt(parent.getElementsByTagName("img")[0].getAttribute("data-angle"));

  formData.append('category', category);
  formData.append('file', file);
  formData.append('angle', angle);
  xhr.open('POST', `//${window.location.hostname}/PhotoGallery/API/rotate`);
  xhr.setRequestHeader('CSRF-Token', document.querySelectorAll('meta[name="csrf-token"]')[0].getAttribute('content'));
  xhr.send(formData);
}

function addClickHandlers() {
  var photoListElement = document.getElementById("body-content");
  
  if (photoListElement.getElementsByClassName("photo-item").length > 0) {
    var photoItems = photoListElement.getElementsByClassName("photo-item");

    photoItems.forEach(photoItem => {
      if (photoItem.getElementsByClassName("delete-button").length > 0) { 
        var deleteButton = photoItem.getElementsByClassName("delete-button")[0];

        deleteButton.onclick = (event) => deleteClickHandler(event, photoItem);
      }
      
      if (photoItem.getElementsByClassName("edit-button").length > 0) { 
        var editButton = photoItem.getElementsByClassName("edit-button")[0];
        
        editButton.onclick = (event) => editClickHandler(event, photoItem);
      }

      if (photoItem.getElementsByClassName("left-rotate-button").length > 0) { 
        var leftRotateButton = photoItem.getElementsByClassName("left-rotate-button")[0];
        
        leftRotateButton.onclick = (event) => rotateClickHandler(event, photoItem, 'left');
      }

      if (photoItem.getElementsByClassName("right-rotate-button").length > 0) { 
        var rightRotateButton = photoItem.getElementsByClassName("right-rotate-button")[0];
        
        rightRotateButton.onclick = (event) => rotateClickHandler(event, photoItem, 'right');
      }

      if (photoItem.getElementsByClassName("save-button").length > 0) { 
        var saveButton = photoItem.getElementsByClassName("save-button")[0];
        
        saveButton.onclick = (event) => saveClickHandler(event, photoItem);
      }
    })
  }
}
  
HTMLCollection.prototype.forEach = Array.prototype.forEach;

addClickHandlers();