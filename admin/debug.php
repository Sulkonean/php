<?php
$jsonFile = "admin/json_files/products.json";

// Check if file exists
if (!file_exists($jsonFile)) {
    die("<p>❌ Error: Product file not found.</p>");
}

// Read and decode JSON
$jsonData = file_get_contents($jsonFile);
$products = json_decode($jsonData, true);

// Debugging output
echo "<h3>🔍 Debug: JSON Content</h3><pre>";
print_r($products);
echo "</pre>";
?>
