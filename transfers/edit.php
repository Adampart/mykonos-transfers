<?php
include 'db_connect.php';

$id = $_GET['id']; // Παίρνουμε το ID από το κουμπί που πατήσαμε
$message = "";

// 1. Τραβάμε τα ΠΑΛΙΑ δεδομένα από τη βάση για να τα δείξουμε στη φόρμα
$sql_get = "SELECT * FROM bookings WHERE id = $id";
$result = $conn->query($sql_get);
$row = $result->fetch_assoc();

// 2. Αν πατήθηκε το κουμπί "Ενημέρωση" (Update Logic)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $pickup = $_POST['pickup_loc'];
    $dropoff = $_POST['dropoff_loc'];
    $date = $_POST['pickup_date'];
    $car = $_POST['car_type'];

    // Η εντολή SQL για ΑΝΑΒΑΘΜΙΣΗ (Update)
    $sql_update = "UPDATE bookings SET 
                   customer_name='$name', 
                   phone='$phone', 
                   pickup_loc='$pickup', 
                   dropoff_loc='$dropoff', 
                   pickup_date='$date', 
                   car_type='$car' 
                   WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        // Αν πέτυχε, γυρίζουμε πίσω στο Admin Panel
        header("Location: admin.php");
        exit;
    } else {
        $message = "Σφάλμα: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Επεξεργασία Κράτησης</title>
    <style>
        /* Το ίδιο στυλ με την αρχική σελίδα */
        body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; padding-top: 50px; }
        .booking-form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.2); width: 400px; }
        h2 { text-align: center; color: #333; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: orange; color: white; border: none; margin-top: 20px; cursor: pointer; font-size: 16px; border-radius: 5px; font-weight:bold;}
        button:hover { background-color: darkorange; }
        .back-link { display:block; text-align:center; margin-top:10px; color:#666; text-decoration:none; }
    </style>
</head>
<body>

    <div class="booking-form">
        <h2>✏️ Επεξεργασία Κράτησης</h2>
        
        <form method="post">
            <label>Ονοματεπώνυμο:</label>
            <input type="text" name="customer_name" value="<?php echo $row['customer_name']; ?>" required>

            <label>Τηλέφωνο:</label>
            <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

            <label>Από Πού:</label>
            <input type="text" name="pickup_loc" value="<?php echo $row['pickup_loc']; ?>" required>

            <label>Προς Πού:</label>
            <input type="text" name="dropoff_loc" value="<?php echo $row['dropoff_loc']; ?>" required>

            <label>Ημερομηνία & Ώρα:</label>
            <input type="datetime-local" name="pickup_date" value="<?php echo $row['pickup_date']; ?>" required>

            <label>Επιλογή Οχήματος:</label>
            <select name="car_type">
                <option value="Mercedes V-Class" <?php if($row['car_type']=="Mercedes V-Class") echo 'selected'; ?>>Mercedes V-Class (Van)</option>
                <option value="Mercedes S-Class" <?php if($row['car_type']=="Mercedes S-Class") echo 'selected'; ?>>Mercedes S-Class (Limo)</option>
                <option value="Range Rover" <?php if($row['car_type']=="Range Rover") echo 'selected'; ?>>Range Rover (SUV)</option>
            </select>

            <button type="submit">ΕΝΗΜΕΡΩΣΗ ΚΡΑΤΗΣΗΣ</button>
            <a href="admin.php" class="back-link">Ακύρωση / Πίσω</a>
        </form>
    </div>

</body>
</html>