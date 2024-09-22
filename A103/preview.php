<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview T-Shirt Design</title>
    <link rel="stylesheet" href="./css/preview.css">
</head>
<body>

<div class="product">    
    <canvas id="previewCanvas"></canvas>
    <div class="color"></div>
    <img src="image/p1.png" class="img1" style="width:100%; z-index:0; height:100%;"/>
    <img src="image/p4.png" class="img2" style="position:absolute; top: 0; left:0; width:100%; z-index: 2; height:100%;"/>
</div>

<!-- New Fields for Price, Quantity, and Size -->
<div class="details">
    <label for="price">Price: </label>
    <input type="text" style="color:white; background-color:transparent; padding-left:2vw; width:auto; border-color:transparent;" id="price" disabled>
</div>
<div class="details2">
    <label for="quantity">Quantity: </label>
    <input type="text" style="color:white; background-color:transparent; padding-left:2vw; width:auto; border-color:transparent;" id="quantity" disabled>
</div>
<div class="details3">
    <label for="size">Size: </label>
    <input type="text" style="color:white; background-color:transparent; padding-left:2vw; width:auto; border-color:transparent;" id="size" disabled>
</div>

<script>
    const canvas = document.getElementById('previewCanvas');
    const ctx = canvas.getContext('2d');
    const images = [];

    function adjustCanvasSize() {
        const container = document.querySelector('.product');
        canvas.width = container.offsetWidth * 0.32;
        canvas.height = container.offsetHeight * 0.5;
    }

    adjustCanvasSize();
    window.addEventListener('resize', adjustCanvasSize);

    class DraggableImage {
        constructor(img, x, y, width, height, rotation) {
            this.img = img;
            this.x = x;
            this.y = y;
            this.width = width;
            this.height = height;
            this.rotation = rotation;
            this.aspectRatio = img.width / img.height;
        }

        draw() {
            ctx.save();
            ctx.translate(this.x + this.width / 2, this.y + this.height / 2);
            ctx.rotate(this.rotation);
            ctx.drawImage(this.img, -this.width / 2, -this.height / 2, this.width, this.height);
            ctx.restore();
        }
    }

    function fetchAndApplyData() {
        fetch("fetchdesign.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Apply color
                document.querySelector('.color').style.backgroundColor = data.data.color;

                // Apply price, quantity, and size
                document.getElementById('price').value = data.data.totalPrice;
                document.getElementById('quantity').value = data.data.quantity;
                document.getElementById('size').value = data.data.size; // Set size

                // Clear previous images
                images.length = 0;

                // Apply images to canvas
                data.data.imageData.forEach(imgData => {
                    const img = new Image();
                    img.onload = function() {
                        const draggableImage = new DraggableImage(img, imgData.x, imgData.y, imgData.width, imgData.height, imgData.rotation);
                        images.push(draggableImage);
                        draw();
                    };
                    img.onerror = function() {
                        console.error('Error loading image:', imgData.src);
                    };
                    img.src = imgData.src; // Ensure imgData.src is correctly set to the image path
                });
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert('An error occurred while fetching data.');
        });
    }

    window.onload = fetchAndApplyData; // Call fetchAndApplyData when the page loads

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        images.forEach(img => img.draw());
    }

</script>

</body>
</html>
