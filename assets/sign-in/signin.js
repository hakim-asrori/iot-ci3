function signin(email, password) {
  let timerInterval;

  $.ajax({
    url: '/auth/login',
    type: 'post',
    data: {email: email, password: password},
    success: function (response) {
      Swal.fire({
        title: 'Harap tunggu!',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()
        },
        willClose: () => {
          if (response == 1) {
            Swal.fire({
              title: 'Selamat!',
              text: 'Anda berhasil login.',
              icon: 'success',
            }).then((result) => {
              location.href = '/pages';
            });
          } else if (response == 2) {
            Swal.fire("Ooops!", "Password anda salah!", "error");
          } else {
            Swal.fire("Ooops!", "Username tidak terdaftar!", "error");
          }
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          if (response == 1) {
            Swal.fire({
              title: 'Selamat!',
              text: 'Anda berhasil login.',
              icon: 'success',
            }).then((result) => {
              location.href = '/admin';
            });
          } else if (response == 2) {
            Swal.fire("Ooops!", "Password anda salah!", "error");
          } else {
            Swal.fire("Ooops!", "Username tidak terdaftar!", "error");
          }
        }
      })
    }
  })
}

$(document).ready(function () {

  $("#signin").on('click', function () {

    let email = $('#inputEmail').val().trim();
    let password = $('#inputPassword').val().trim();

    if (email == "" && password == "") {
      Swal.fire("Ooops!", "Form signin harap diisi!", "error");
    } else if (email == "") {
      Swal.fire("Ooops!", "Username harap diisi!", "error");
    } else if (password == "") {
      Swal.fire("Ooops!", "Password harap diisi!", "error");
    } else {
      signin(email, password);
    }

  });

});

