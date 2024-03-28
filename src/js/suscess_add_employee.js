document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: 'Success!',
      text: 'เพิ่มข้อมูลเรียบร้อย.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to login.php
        window.location.href = 'admin_employee.php'
      }
    })
  })
  