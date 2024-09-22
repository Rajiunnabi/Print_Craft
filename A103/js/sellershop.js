document.addEventListener("DOMContentLoaded", function () {
    const gridContainer = document.getElementById('grid-container');

    fetch('fetch_products.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                data.products.forEach(product => {
                    const card = document.createElement('div');
                    card.className = 'card';
                    card.id = `product-${product.id}`;
                    card.innerHTML = `
                        <div class="image-container">
                            <img src="${product.image_path}" alt="T-Shirt Image" style="width:100%; height:100%; object-fit:contain;">
                        </div>
                        <div class="details">
                            <p>Available Colors: <span class="color">${product.colors}</span></p>
                            <p>Size: <span class="size">${product.sizes}</span></p>
                            <p>Price: <span class="price">${product.price}</span></p>
                            <p>Name: <span class="name">${product.name}</span></p>
                            <button class="delete" data-id="${product.id}" style="color:white; background-color:red;">Remove</button>
                        </div>
                    `;
                    gridContainer.appendChild(card);
                });

                // Add event listeners for all delete buttons
                document.querySelectorAll('.delete').forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        const productId = button.getAttribute('data-id');
                        removeProduct(productId);
                    });
                });
            } else {
                console.error('Error fetching products:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function removeProduct(productId) {
    fetch('remove_product.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: productId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const card = document.getElementById(`product-${productId}`);
                if (card) {
                    card.remove();
                }
            } else {
                console.error('Error removing product:', data.message);
                alert('Failed to remove product.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to remove product.');
        });
}