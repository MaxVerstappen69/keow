document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: 'Something Wrong!',
      text: 'รหัสผ่านที่ใช้ปัจจุบัน.',
      icon: 'error',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to login.php
        window.location.href = 'admin_employee.php'
      }
    })
  })
  