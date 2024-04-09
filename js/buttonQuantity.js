function decreaseQuantity() {
  var currentQuantity = parseInt(
    document.getElementById('currentQuantity').textContent
  )
  if (currentQuantity > 1) {
    document.getElementById('currentQuantity').textContent = currentQuantity - 1
  }
}

function increaseQuantity() {
  var currentQuantity = parseInt(
    document.getElementById('currentQuantity').textContent
  )
  var maxQuantity = parseInt(document.getElementById('quantity').textContent)
  if (currentQuantity < maxQuantity) {
    document.getElementById('currentQuantity').textContent = currentQuantity + 1
  }
}
