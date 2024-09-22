function saveProduct() {
    const productName = document.getElementById('productName').value;
    const productPrice = document.getElementById('productPrice').value;
    const productColors = document.getElementById('productColors').value.split(',');
    const productSizes = document.getElementById('productSizes').value;
    const uploadedImageContainer = document.getElementById('uploadedImageContainer');
    const productImageUrl = uploadedImageContainer.querySelector('img') ? uploadedImageContainer.querySelector('img').src : '';

    if (productName && productPrice && productColors && productSizes && productImageUrl) {
        const newProduct = {
            name: productName,
            price: productPrice,
            colors: productColors,
            size: productSizes,
            imageUrl: productImageUrl
        };

        const products = JSON.parse(localStorage.getItem('products')) || [];
        products.push(newProduct);
        localStorage.setItem('products', JSON.stringify(products));

        // Redirect back to sellershop.html
        window.location.href = 'sellershop.php';
    } else {
        alert('Please fill in all fields and upload an image.');
    }
}

let containerToUpdate = null;

// Function to handle image preview
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const uploadedImageContainer = document.getElementById('uploadedImageContainer');
            uploadedImageContainer.innerHTML = `<img src="${e.target.result}" alt="T-Shirt Image" style="width:100%; height:100%; object-fit:cover;">`;
        }
        reader.readAsDataURL(file);
    }
}

document.getElementById('file-input').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageContainer = containerToUpdate.querySelector('.image-container');
            imageContainer.innerHTML = `<img src="${e.target.result}" alt="T-Shirt Image" style="width:100%; height:100%; object-fit:cover;">`;
        }
        reader.readAsDataURL(file);
    }
});
