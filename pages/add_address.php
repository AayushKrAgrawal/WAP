<?php
session_start();
include('../includes/header.php');
include('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all addresses of the user
$userId = $_SESSION['user_id'];
try {
    $sql = "SELECT * FROM user_addresses WHERE user_id = :user_id ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Processing the address form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $province = $_POST['province'] ?? '';
    $postalCode = $_POST['postal_code'] ?? '';
    $latitude = $_POST['latitude'] ?? '';
    $longitude = $_POST['longitude'] ?? '';

    // Validate if the address is in Nepal
    $validProvinces = ['Bagmati', 'Lumbini', 'Karnali', 'Gandaki', 'Sudurpashchim', 'Province No. 1', 'Province No. 2', 'Province No. 5'];
    if ($province && in_array($province, $validProvinces)) {
        try {
            // Insert the address into the database
            $sql = "INSERT INTO user_addresses (user_id, address, city, province, postal_code, latitude, longitude) 
                    VALUES (:user_id, :address, :city, :province, :postal_code, :latitude, :longitude)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':province', $province, PDO::PARAM_STR);
            $stmt->bindParam(':postal_code', $postalCode, PDO::PARAM_STR);
            $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
            $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "<script>window.location.href = 'cart.php';</script>";
            } else {
                echo "<script>alert('Error adding address.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error adding address: " . $e->getMessage() . "');</script>";
        }
    }
}

// Handle the "Use this address" button click
if (isset($_GET['use_address'])) {
    $addressId = $_GET['use_address'];

    try {
        // Set the selected address as default
        $sql = "UPDATE user_addresses SET is_default = 1 WHERE id = :address_id AND user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':address_id', $addressId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "<script>alert('Address set as default!');</script>";
            echo "<script>window.location.href = 'checkout.php';</script>";
        } else {
            echo "<script>alert('Error setting default address.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shipping Address</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK7SQhhB-4_zgt83SSflHmW0SX5bqOo9U&libraries=places"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-12 px-4">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Add Shipping Address</h1>

            <!-- Show Existing Addresses if Available -->
            <?php if (!empty($addresses)): ?>
                <?php foreach ($addresses as $address): ?>
                    <div class="bg-gray-100 p-4 mb-6 rounded-md">
                        <h2 class="text-xl font-semibold text-gray-800">Address #<?php echo $address['id']; ?></h2>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($address['address']); ?></p>
                        <p><strong>City:</strong> <?php echo htmlspecialchars($address['city']); ?></p>
                        <p><strong>Province:</strong> <?php echo htmlspecialchars($address['province']); ?></p>
                        <p><strong>Postal Code:</strong> <?php echo htmlspecialchars($address['postal_code']); ?></p>
                        <p><strong>Location:</strong> Latitude: <?php echo htmlspecialchars($address['latitude']); ?>, Longitude: <?php echo htmlspecialchars($address['longitude']); ?></p>

                        <!-- Use this address button -->
                        <a href="add_address.php?use_address=<?php echo $address['id']; ?>" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md mt-4 inline-block">Use this address</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500">No addresses found. Add a new one below.</p>
            <?php endif; ?>

            <!-- Display Total Price -->
            <?php if (isset($_SESSION['total_cost'])): ?>
                <div class="bg-gray-100 p-4 mb-6 rounded-md">
                    <h2 class="text-xl font-semibold text-gray-800">Total: Rs. <?php echo number_format($_SESSION['total_cost'], 2); ?></h2>
                </div>
            <?php endif; ?>

            <!-- Address Form -->
            <form method="post" id="addressForm">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="address" class="block text-gray-700 font-semibold">Address</label>
                        <input type="text" id="address" name="address" class="mt-2 p-3 w-full border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label for="city" class="block text-gray-700 font-semibold">City</label>
                        <input type="text" id="city" name="city" class="mt-2 p-3 w-full border border-gray-300 rounded-md" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="province" class="block text-gray-700 font-semibold">Province</label>
                        <select id="province" name="province" class="mt-2 p-3 w-full border border-gray-300 rounded-md" required>
                            <option value="">Select Province</option>
                            <option value="Bagmati">Bagmati</option>
                            <option value="Lumbini">Lumbini</option>
                            <option value="Karnali">Karnali</option>
                            <option value="Gandaki">Gandaki</option>
                            <option value="Sudurpashchim">Sudurpashchim</option>
                            <option value="Province No. 1">Province No. 1</option>
                            <option value="Province No. 2">Province No. 2</option>
                            <option value="Province No. 5">Province No. 5</option>
                        </select>
                    </div>
                    <div>
                        <label for="postal_code" class="block text-gray-700 font-semibold">Postal Code</label>
                        <input type="text" id="postal_code" name="postal_code" class="mt-2 p-3 w-full border border-gray-300 rounded-md" required>
                    </div>
                </div>

                <!-- Map Integration Section -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold">Select Location on Map</label>
                    <div id="map" class="w-full h-64 rounded-md mt-2"></div>
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition">Add Address</button>
            </form>
        </div>
    </div>

    <script>
        // Initialize Google Maps API
        let map;
        let marker;
        function initMap() {
            // Set the map options (centered around Kathmandu)
            const nepal = { lat: 27.7172, lng: 85.3240 };

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: nepal,
            });

            // Add a marker to the map
            marker = new google.maps.Marker({
                position: nepal,
                map: map,
                draggable: true,
            });

            // Update hidden latitude and longitude when marker is dragged
            google.maps.event.addListener(marker, "dragend", function () {
                const position = marker.getPosition();
                document.getElementById("latitude").value = position.lat();
                document.getElementById("longitude").value = position.lng();
            });
        }

        // Load map when the page loads
        window.onload = initMap;
    </script>
</body>
</html>
