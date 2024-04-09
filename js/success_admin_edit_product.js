document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: 'Success!',
      text: 'แก้ไขสินค้าเรียบร้อย.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to login.php
        window.location.href = 'admin_product.php'
      }
    })
  })
  