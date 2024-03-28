document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: 'Wrong!',
      text: 'รหัสผ่านไม่ตรงกัน.',
      icon: 'error',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to login.php
        window.location.href = 'admin_employee.php'
      }
    })
  })
  