// uploadSlip.js
function uploadSlip() {
    Swal.fire({
      title: 'Select image',
      input: 'file',
      inputAttributes: {
        accept: 'image/*',
        'aria-label': 'Upload your profile picture'
      }
    }).then((result) => {
      if (result.isConfirmed && result.value) {
        const file = result.value;
        const reader = new FileReader();
        reader.onload = (e) => {
          Swal.fire({
            title: 'Your uploaded picture',
            imageUrl: e.target.result,
            imageAlt: 'The uploaded picture'
          });
        };
        reader.readAsDataURL(file);
      }
    });
  }
  