document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: 'Success!',
      text: 'ลบข้อมูลสำเร็จ.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to login.php
        window.location.href = 'admin_employee_payment.php'
      }
    })
  })
  