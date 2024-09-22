document.addEventListener("DOMContentLoaded", function() {
    const gridContainer = document.getElementById('grid-container');

    fetch('fetch_products.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                data.products.forEach(product => {
                    const card = createCard(product);
                    gridContainer.appendChild(card);
                });
            } else {
                console.error('Error fetching products:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function createCard(product) {
    const card = document.createElement('div');
    card.className = 'card';

    card.innerHTML = `
        <div class="image-container">
            <img src="${product.image_path}" alt="T-Shirt Image" style="width:100%; height:100%; object-fit: contain;">
        </div>
        <div class="details">
            <p>Available Colors: <span class="size">${product.colors}</span></p>
            <p>Size: <span class="size">${product.sizes}</span></p>
            <p>Price: <span class="price">${product.price} BDT</span></p>
            <p>Name: <span class="name">${product.name}</span></p>
            <a href="#" class="toggle-cart" style="text-decoration:none; width:20px;" data-id="${product.id}" data-action="add">
                <i class="plus-icon" style="display: block; text-align: center; font-size: 24px; color: #333; text-decoration: none; 
                background-color: #ffcc11; border-radius: 100%; width: 40px; height: 40px; line-height: 40px; margin: 0px auto 0;
                cursor: pointer;">+</i>
            </a>
        </div>
    `;

    // Add event listener for the '+' or '-' icon
    const toggleCartBtn = card.querySelector('.toggle-cart');
    const icon = toggleCartBtn.querySelector('i');

    // Add event listeners for click
    toggleCartBtn.addEventListener('click', function(event) {
        event.preventDefault();
        const action = toggleCartBtn.getAttribute('data-action');
        if (action === 'add') {
            addToCart(product, toggleCartBtn);
        } else {
            removeFromCart(product, toggleCartBtn);
        }
    });

    // Add hover effect
    icon.addEventListener('mouseenter', function() {
        onIconHover(icon);
    });

    icon.addEventListener('mouseleave', function() {
        onIconHoverLeave(icon);
    });

    return card;
}

function addToCart(product, toggleCartBtn) {
    const formData = new FormData();
    formData.append('name', product.name);
    formData.append('price', product.price);
    formData.append('size', product.sizes);
    formData.append('productid', product.id);

    fetch('addToCart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Product added to cart!');
            toggleCartIcon(toggleCartBtn, 'remove');
        } else {
            console.error('Error adding to cart:', data.message);
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to add product to cart.');
    });
}

function removeFromCart(product, toggleCartBtn) {
    const formData = new FormData();
    formData.append('productid', product.id);

    fetch('removeFromCart.php', { 
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Product removed from cart!');
            toggleCartIcon(toggleCartBtn, 'add');
        } else {
            console.error('Error removing from cart:', data.message);
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to remove product from cart.');
    });
}

function toggleCartIcon(toggleCartBtn, action) {
    const icon = toggleCartBtn.querySelector('i');
    if (action === 'add') {
        toggleCartBtn.setAttribute('data-action', 'add');
        icon.textContent = '+';
        icon.style.backgroundColor = '#ffcc11';
        icon.style.color = '#333';
    } else {
        toggleCartBtn.setAttribute('data-action', 'remove');
        icon.textContent = '-';
        icon.style.backgroundColor = 'red';
        icon.style.color = '#fff';
    }
}

// New function to handle hover effect
function onIconHover(icon) {
    //icon.style.backgroundColor = '#00cc44'; 
    icon.style.transform = 'scale(1.2)'; 
    icon.style.transition = 'all 0.2s ease-in-out'; 
}

function onIconHoverLeave(icon) {
    const action = icon.closest('.toggle-cart').getAttribute('data-action');
    if (action === 'add') {
        icon.style.backgroundColor = '#ffcc11'; 
    } else {
        icon.style.backgroundColor = 'red';
    }
    icon.style.transform = 'scale(1)';
}
