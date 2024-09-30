<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM cars");
$cars = $stmt->fetchAll();

foreach ($cars as $car) {
    echo "<div>";
    echo "<h3>" . $car['model'] . " (" . $car['year'] . ")</h3>";
    echo "<p>Price: $" . $car['price'] . "/month</p>";
    echo "<p>Description: " . $car['description'] . "</p>";
    echo "</div>";
}
?>
