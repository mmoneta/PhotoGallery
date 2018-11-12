'use strict';

function send(action) {
  var formData = null,
      xhr = new XMLHttpRequest();

  switch (action) {
    case 'login':
      formData = new FormData(document.getElementById('login-form'));
      break;
    case 'register':
      formData = new FormData(document.getElementById('register-form'));
      break;
    case 'change_password':
      var password = document.getElementById('changePasswordForm-pass').value,
          repeat_password = document.getElementById('changePasswordForm-repeat-pass').value;

      if (password.length >= 8) {
        if (password === repeat_password) {
          formData = new FormData();
          formData.append('new_password', document.getElementById('changePasswordForm-pass').value);
        } else alert("Passwords are different.");
      } else {
        alert('Password must be length.');
      }
      break;
    case 'create_category':
      formData = new FormData(document.getElementById('category-form'));
      break;
    case 'upload_photo':
      formData = new FormData(document.getElementById('upload-form'));
      break;
    case 'recovery':
      formData = new FormData(document.getElementById('recovery-form'));
      break;
    case 'change_language':
      formData = new FormData();
      var select = document.getElementById("select-language");
      var option_name = select[select.selectedIndex].getAttribute('name');
      formData.append('language', option_name);
      break;
  }

  xhr.open('POST', '//' + window.location.hostname + '/PhotoGallery/API/' + action);
  if (document.querySelectorAll('meta[name="csrf-token"]').length > 0) xhr.setRequestHeader('CSRF-Token', document.querySelectorAll('meta[name="csrf-token"]')[0].getAttribute('content'));
  xhr.onload = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = xhr.responseText;
      switch (action) {
        case 'login':
          if (response) alert(response);else window.location.href = '//' + window.location.hostname + '/PhotoGallery/dashboard';
          break;
        case 'register':
          if (response) alert(response);else {
            Array.from(document.querySelectorAll("#register-form input")).forEach(function (element) {
              return element.value = null;
            });
            alert('User has been registered.');
          }
          break;
        case 'change_password':
          if (response) alert(response);else {
            Array.from(document.querySelectorAll("#modalChangePasswordForm input")).forEach(function (element) {
              return element.value = null;
            });
            $(function () {
              return $('#modalChangePasswordForm').modal('toggle');
            });
          }
          break;
        case 'create_category':
          if (response) {
            alert(response);
            document.getElementById('category').value = null;
          }
          break;
        case 'upload_photo':
          alert(response);
          document.getElementById('file').value = null;
          if (response !== 'Invalid file') document.getElementById('description').value = null;
          break;
        case 'recovery':
          if (response) alert(response);
          break;
        case 'change_language':
          if (response) alert(response);else location.reload();
          break;
      }
    } else if (xhr.status !== 200) {
      alert('Request failed.  Returned status of ' + xhr.status);
    }
  };
  xhr.send(formData);

  return false;
}