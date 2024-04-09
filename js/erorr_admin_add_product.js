document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: 'Erorr!',
      text: 'กรอกข้อมูลให้ครบ.',
      icon: 'error',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to login.php
        window.location.href = 'admin_add_product.php'
      }
    })
  })
  