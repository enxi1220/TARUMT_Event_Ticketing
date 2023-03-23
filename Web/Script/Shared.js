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

function post(url, dataArr, successHandler, errorHandler) {
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
    success: successHandler,
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