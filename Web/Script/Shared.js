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

// successHandler & afterSuccess & errorHandler optional
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
          html: '<pre>' + success + '</pre>',
          // timer: 1900,
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
          html: '<pre>' + error.responseText + '</pre>'
          // text:  error.responseText
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
          icon: 'success',
          title: 'Success...',
          html: '<pre>' + success + '</pre>',
          showConfirmButton: false
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
          html: '<pre>' + error.responseText + '</pre>'
        })
      }
    }
  });
}

function checkDate(id, min, max) {
  // Attach a change event listener to the datetime input field
  $('#datetime').on('change', function () {
    // Get the value of the datetime input field
    var inputDate = new Date($(this).val());

    // Get the current date and time
    var currentDate = new Date();

    // Disable the submit button if the input date is in the past
    if (inputDate < currentDate) {
      $('button[type="submit"]').prop('disabled', true);
    } else {
      $('button[type="submit"]').prop('disabled', false);
    }
  });
}