<?php
require 'connection.php';
session_start(); // Start the session to use session variables

// Function to check if a string is base64 encoded
function is_base64($string) {
    $decoded_data = base64_decode($string, true);
    return base64_encode($decoded_data) === $string;
}

// Function to extract the image format from a base64 encoded string
function get_image_format($base64_string) {
    $matches = [];
    preg_match('/^data:image\/(\w+);base64,/', $base64_string, $matches);
    return $matches[1] ?? 'jpg'; // Default to 'jpg' if format is not found
}

// Function to remove only the first backslash from a path
function remove_one_backslash($path) {
    $pos = strpos($path, '\\');
    if ($pos !== false) {
        $path = substr_replace($path, '', $pos, 1);
    }
    return $path;
}

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

$uploaded_image_path = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['uploaded_image'])) {
        $jsonString = $_POST['uploaded_image'];
        $imageURLS = json_decode($jsonString, true);

        if (is_array($imageURLS)) {
            $uploaded_image_path_array = [];

            foreach ($imageURLS as $element) {
                if (preg_match('/^data:image\/(\w+);base64,/', $element)) {
                    // Handle base64 encoded string
                    $image_format = get_image_format($element);
                    $base64_string = preg_replace('/^data:image\/\w+;base64,/', '', $element);
                    $decoded_data = base64_decode($base64_string);

                    if ($decoded_data !== false) {
                        $image_name = uniqid('image_', true) . '.' . $image_format;
                        $image_path = 'uploads/' . $image_name;

                        if (file_put_contents($image_path, $decoded_data)) {
                            $uploaded_image_path_array[] = $image_path;
                        } else {
                            echo json_encode(['success' => false, 'message' => 'Error saving image file.']);
                            exit();
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Invalid base64 encoding.']);
                        exit();
                    }
                } else {
                    // Handle non-base64 encoded string
                    $cleaned_path = remove_one_backslash($element);
                    $uploaded_image_path_array[] = $cleaned_path;
                }
            }

            $uploaded_image_path = json_encode($uploaded_image_path_array);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to decode JSON.']);
            exit();
        }
    }

    // Retrieve other form data
    $color = $_POST['color'] ?? '';
    $size = $_POST['size'] ?? '';
    $image_data = $_POST['image_data'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $totalPrice = $_POST['totalPrice'] ?? '';
    $current_date = date("Y-m-d");

    // Prepare and execute the first insert statement
    $stmt = $conn->prepare("INSERT INTO design2 (color, size, image_data, uploaded_image_path) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssss", $color, $size, $image_data, $uploaded_image_path);

        if ($stmt->execute()) {
            // Retrieve the last inserted record
            $last_id = $conn->insert_id;

            // Update the uploaded_image_path to remove backslashes
            $update_stmt = $conn->prepare("UPDATE design2 SET uploaded_image_path = REPLACE(uploaded_image_path, '\\\\', '') WHERE id = ?");
            if ($update_stmt) {
                $update_stmt->bind_param("i", $last_id);

                if ($update_stmt->execute()) {
                    // Prepare and execute the second insert statement
                    $stmt = $conn->prepare("INSERT INTO orders (id, tshirtid, orderplaced, deliverystatus, orderdate, quantity, totalPrice) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    if ($stmt) {
                        $orderplaced = "NO";
                        $deliverystatus = "NOT DELIVERED";
                        $stmt->bind_param("sisssss", $_SESSION['cid'], $last_id, $orderplaced, $deliverystatus, $current_date, $quantity, $totalPrice);

                        if ($stmt->execute()) {
                            echo json_encode(['success' => true, 'message' => 'Design saved successfully!']);
                        } else {
                            echo json_encode(['success' => false, 'message' => 'Error inserting order: ' . $stmt->error]);
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error preparing order statement: ' . $conn->error]);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error updating uploaded_image_path: ' . $update_stmt->error]);
                }
                $update_stmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Error preparing update statement: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error inserting design: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error preparing design statement: ' . $conn->error]);
    }
}

$conn->close();
?>
