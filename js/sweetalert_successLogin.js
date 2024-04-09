document.addEventListener('DOMContentLoaded', function () {
  Swal.fire({
    title: 'Success!',
    text: 'สมัครสมาชิกเรียบร้อยแล้ว.',
    icon: 'success',
    confirmButtonText: 'OK'
  }).then((result) => {
    if (result.isConfirmed) {
      // Redirect to login.php
      window.location.href = 'login.php'
    }
  })
})
