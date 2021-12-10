function signOut() {
  Swal.fire({
    title: 'Apakah anda yakin?',
    text: "Anda akan keluar dari halaman!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sign Out'
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = '/?module=signout';
    }
  })
}

(function () {
  'use strict'

  feather.replace()

  
})()