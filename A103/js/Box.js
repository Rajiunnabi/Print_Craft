document.getElementById('toggleButton').addEventListener('click', function() {
    var gridContainer = document.querySelector('.grid-container');
    gridContainer.classList.toggle('hidden');
});

document.getElementById('clr-btn').addEventListener('click', function() {
    var gridContainer = document.querySelector('.COLORS');
    gridContainer.classList.toggle('hidden');
});

document.getElementById('toggleButton2').addEventListener('click', function() {
    var gridContainer2 = document.querySelector('.grid-container2');
    gridContainer2.classList.toggle('hidden');
});

//COLOR
const color = document.querySelector('.color');
const colorInput = document.querySelector('.color-input');

        colorInput.addEventListener('input', () => {
            color.style.backgroundColor = colorInput.value;
        });

        
/*const clr=document.querySelector('.clr');
clr.addEventListener('click', function() {
    console.log('COLOR IS ');
    color.style.backgroundColor = clr.value;
});*/

let hex="#ffffff";

const clr = document.querySelectorAll('.clr');
        clr.forEach(item => {
        item.addEventListener('click', function() {
        color.style.backgroundColor = item.value;
        console.log('Item color clicked :', item.value);
        hex=item.value;
        console.log('Send code: ',hex);
        updatePrice2(hex);
    });
});


const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
const imageLoader = document.getElementById('upload-icon');
const images = [];
const quantityInput = document.getElementById('quantityInput');
const priceInput = document.getElementById('priceInput');
const basePrices = {
    "#ffffff": 100, // white
    "#000000": 100, // black
    "default": 200  // other colors
};
const imagePrice = 150;

const imageURLS=[];


function adjustCanvasSize() {
    const container = document.querySelector('.product'); // Adjusted to match your container
    canvas.width = container.offsetWidth * 0.27; // 27% of container width
    canvas.height = container.offsetHeight * 0.5; // 50% of container height
}

adjustCanvasSize(); 
window.addEventListener('resize', adjustCanvasSize); // Adjust on window resize


let selectedImage = null;

class DraggableImage {
    constructor(img, x, y, width, height) {
        this.img = img;
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.aspectRatio = img.width / img.height; // Store the aspect ratio
        this.dragging = false;
        this.offsetX = 0;
        this.offsetY = 0;
        this.rotation = 0; // Initial rotation angle in radians
    }
    draw() {
        ctx.save();
        ctx.translate(this.x + this.width / 2, this.y + this.height / 2); // Move to center of the image
        ctx.rotate(this.rotation); // Rotate the image
        ctx.drawImage(this.img, -this.width / 2, -this.height / 2, this.width, this.height);
        ctx.restore();
        if (this === selectedImage) {
            ctx.strokeStyle = 'black';
            ctx.lineWidth = 2;
            ctx.strokeRect(this.x, this.y, this.width, this.height);
        }
    }

    contains(mx, my) {
        // Account for rotation when checking if point is inside image
        ctx.save();
        ctx.translate(this.x + this.width / 2, this.y + this.height / 2);
        ctx.rotate(this.rotation);
        ctx.translate(-this.width / 2, -this.height / 2);
        const isContained = (mx >= this.x && mx <= this.x + this.width && my >= this.y && my <= this.y + this.height);
        ctx.restore();
        return isContained;
    }

    startDragging(mx, my) {
        if (this.contains(mx, my)) {
            this.dragging = true;
            this.offsetX = mx - this.x;
            this.offsetY = my - this.y;
            return true;
        }
        return false;
    }

    drag(mx, my) {
        if (this.dragging) {
            this.x = mx - this.offsetX;
            this.y = my - this.offsetY;
        }
    }

    stopDragging() {
        this.dragging = false;
    }

    resize(delta) {
        const newWidth = this.width + delta;
        const newHeight = newWidth / this.aspectRatio;
        if (newWidth > 0 && newHeight > 0) {
            this.width = newWidth;
            this.height = newHeight;
        }
    }

    rotate(delta) {
        this.rotation += delta;
    }
}


imageLoader.addEventListener('change', handleImage, false);

function handleImage(e) {
    const reader = new FileReader();
    reader.onload = function(event) {
        const img = new Image();
        img.onload = function() {
            // Calculate scaled dimensions to fit within canvas
            const scaleFactor = Math.min(canvas.width / img.width, canvas.height / img.height);
            const width = img.width * scaleFactor;
            const height = img.height * scaleFactor;
            const draggableImage = new DraggableImage(img, 50, 50, width, height);
            images.push(draggableImage);
            updatePrice2(hex);
            console.log('Number of images:', images.length);
            draw();
            // Save uploaded image path for later use
            const uploadedImagePath = event.target.result;
            imageURLS.push(event.target.result);
            console.log('URL ISSS: ', imageURLS);
            document.getElementById('confirmButton').dataset.uploadedImagePath = uploadedImagePath;
            // Update price display after image upload
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(e.target.files[0]);
}

const gridItems = document.querySelectorAll('.grid-item img');
gridItems.forEach(item => {
    item.addEventListener('click', function() {
        const imgSrc = this.src;
        console.log('Grid item clicked, imgSrc:', imgSrc);
        const img = new Image();
        img.onload = function() {
            console.log('Image loaded from grid item.');
            const scaleFactor = Math.min(canvas.width / img.width, canvas.height / img.height);
            const width = img.width * scaleFactor;
            const height = img.height * scaleFactor;
            const draggableImage = new DraggableImage(img, 50, 50, width, height);
            images.push(draggableImage);
            draw(); 
            updatePrice2(hex); 
            confirmButton.dataset.uploadedImagePath = imgSrc;
            const subs=imgSrc.substring(22);
            imageURLS.push(subs);
            console.log('GRID INSERT: ',subs);
        };
        img.onerror = function() {
            console.error('Failed to load image from grid item:', imgSrc);
        };
        img.src = imgSrc; 
    });
});




const gridItems2 = document.querySelectorAll('.grid-item2 img');
gridItems2.forEach(item => {
    item.addEventListener('click', function() {
        const imgSrc = this.src;
        console.log('Grid item clicked, imgSrc:', imgSrc);
        const img = new Image();
        img.onload = function() {
            console.log('Image loaded from grid item.');
            const scaleFactor = Math.min(canvas.width / img.width, canvas.height / img.height);
            const width = img.width * scaleFactor;
            const height = img.height * scaleFactor;
            const draggableImage = new DraggableImage(img, 50, 50, width, height);
            images.push(draggableImage);
            draw(); 
            updatePrice2(hex); 
            confirmButton.dataset.uploadedImagePath = imgSrc;
            const subs=imgSrc.substring(22);
            imageURLS.push(subs);
            console.log('GRID INSERT: ',subs);
        };
        img.onerror = function() {
            console.error('Failed to load image from grid item:', imgSrc);
        };
        img.src = imgSrc; 
    });
});




function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    images.forEach(img => img.draw());
}

canvas.addEventListener('mousedown', (e) => {
    const mx = e.offsetX;
    const my = e.offsetY;
    selectedImage = null;
    images.forEach(img => {
        if (img.startDragging(mx, my)) {
            selectedImage = img;
            canvas.addEventListener('mousemove', onMouseMove, false);
            canvas.addEventListener('mouseup', onMouseUp, false);
        }
    });
    draw();
});

function onMouseMove(e) {
    const mx = e.offsetX;
    const my = e.offsetY;
    images.forEach(img => img.drag(mx, my));
    draw();
}

function onMouseUp() {
    images.forEach(img => img.stopDragging());
    canvas.removeEventListener('mousemove', onMouseMove, false);
    canvas.removeEventListener('mouseup', onMouseUp, false);
}

canvas.addEventListener('wheel', (e) => {
    const mx = e.offsetX;
    const my = e.offsetY;
    images.forEach(img => {
        if (img.contains(mx, my)) {
            const delta = e.deltaY > 0 ? -10 : 10;
            img.resize(delta);
            draw();
        }
    });
});

document.addEventListener('keydown', (e) => {
    if (selectedImage) {
        if (e.key === 'Delete') {
            const index = images.indexOf(selectedImage);
            if (index > -1) {
                images.splice(index, 1);
                selectedImage = null;
                imageURLS.splice(index, 1);
                console.log('URL DELETED: ', imageURLS);
                updatePrice2(hex);
                draw();
            }
        } else if (e.key === 'ArrowLeft') {
            selectedImage.rotate(-0.02); // Rotate left
            draw();
        } else if (e.key === 'ArrowRight') {
            selectedImage.rotate(0.02); // Rotate right
            draw();
        }
    }
});


function updatePrice2(hex) {
    const selectedColor = hex;
    const basePrice = basePrices[selectedColor] || basePrices["default"];
    const totalImagePrice = images.length * imagePrice;
    const quantity = quantityInput.valueAsNumber || 1;
    const totalPrice = (basePrice + totalImagePrice) * quantity;

    priceInput.value = totalPrice + " Tk"; // Display total price
}


document.getElementById('quantityInput').addEventListener('input', function () {
    updatePrice2(hex); // Update price when quantity changes
});



document.getElementById('confirmButton').addEventListener('click', function () {
    const paymentMethod = prompt('Please select a payment method:\n1. Cash on Delivery');

    if (paymentMethod === '1') {
        const color = hex;
        const size = document.querySelector('select[name="size"]').value;
        const image_data = JSON.stringify(images.map(img => ({
            x: img.x,
            y: img.y,
            width: img.width,
            height: img.height,
            rotation: img.rotation
        })));

        const uploadedImagePath = document.getElementById('confirmButton').dataset.uploadedImagePath;
        console.log('Uploaded Image path: ', uploadedImagePath);
        const quantity = document.getElementById('quantityInput').value;
        const totalPrice = document.getElementById('priceInput').value;

        const formData = new FormData();
        formData.append('color', color);
        formData.append('size', size);
        formData.append('image_data', image_data);
        /*if (uploadedImagePath.includes("localhost")) {
            const substring = uploadedImagePath.substring(22);
            formData.append('grid', substring);
        }
        else {
            formData.append('uploaded_image', imageLoader.files[0]);
        }*/
        formData.append('uploaded_image',JSON.stringify(imageURLS));
        formData.append('quantity', quantity); 
        formData.append('totalPrice', totalPrice);

        fetch('savedesign.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data);
                if (data.success) {
                    alert('Data sent successfully!');
                    window.location.href = 'customer.php'; 
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while sending data to PHP.');
            });
    } else {
        alert('Please select a valid payment method.');
    }
});




