document.addEventListener('DOMContentLoaded', function () {
  Swal.fire({
    title: 'Success!',
    text: 'แก้ไขข้อมูลเรียบร้อย.',
    icon: 'success',
    confirmButtonText: 'OK'
  }).then((result) => {
    if (result.isConfirmed) {
      // Redirect to login.php
      window.location.href = 'user_profile.php'
    }
  })
})
