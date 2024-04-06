document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: 'Erorr!',
      text: 'กรุณาเลือกไฟล์รูปภาพ!!.',
      icon: 'error',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to login.php
        window.location.href = 'add_bank.php'
      }
    })
  })
  