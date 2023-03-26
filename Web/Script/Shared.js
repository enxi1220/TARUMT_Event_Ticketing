//author: Lim En Xi

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();

function submitData(name, value) {
  return {
    name: name,
    value: value
  }
}

// successHandler & errorHandler optional
function post(url, dataArr, successHandler, afterSuccess, errorHandler) {
  var form = new FormData();
  for (let item of dataArr) {
    form.append(item.name, item.value);
  }

  $.ajax({
    type: 'POST',
    url: url,
    data: form,
    enctype: 'multipart/form-data',
    cache: false,
    contentType: false,
    processData: false,
    success: function (success) {
      if (successHandler) {
        successHandler(success);
      } else {
        //default success version
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: success,
          timer: 1900,
          showConfirmButton: false
        }).then(function () {
          if (afterSuccess) {
            afterSuccess();
          }
        });
      }
    },
    error: function (error) {
      if (errorHandler) {
        //user-defined error version
        errorHandler(error);
      } else {
        //default error version
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: error.responseText
        })
      }
    }
  });
}

function get(url, data, successHandler, errorHandler) {
  $.ajax({
    type: "GET",
    url: url,
    data: data,
    success: function (success) {
      if (successHandler) {
        //user-defined success version
        successHandler(success);
      } else {
        //default success version
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: success.responseText
        })
      }
    },
    error: function (error) {
      if (errorHandler) {
        //user-defined error version
        errorHandler(error);
      } else {
        //default error version
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: error.responseText
        })
      }
    }
  });
}