// JavaScript code with URL updated
Swal.fire({
  title: 'Select a bank',
  input: 'select',
  inputOptions: {
    1: 'SCB',
    2: 'KTB'
    // Add more options as needed
  },
  showCancelButton: true,
  confirmButtonText: 'Look up',
  showLoaderOnConfirm: true,
  preConfirm: async (selectedBankId) => {
    try {
      const response = await fetch(
        `../php/selectBank.php?bankId=${selectedBankId}`
      )
      if (!response.ok) {
        throw new Error(response.statusText)
      }
      const responseData = await response.text() // Get the response body as text
      if (!responseData) {
        throw new Error('Empty response')
      }
      return JSON.parse(responseData) // Parse the response data as JSON
    } catch (error) {
      Swal.showValidationMessage(`Request failed: ${error}`)
    }
  },
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      imageUrl: result.value.image,
      title: result.value.Name
    })
  }
})
