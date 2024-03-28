document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: 'Success!',
      text: 'ลบสินค้าสำเร็จ.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to login.php
        window.location.href = 'admin_product.php'
      }
    })
  })
  