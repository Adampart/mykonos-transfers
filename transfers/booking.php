<?php
include 'db_connect.php'; // Σύνδεση με τη βάση που φτιάξαμε πριν

$message = ""; // Εδώ θα αποθηκεύουμε το μήνυμα επιτυχίας

// Ελέγχουμε αν ο χρήστης πάτησε το κουμπί "Κράτηση"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Παίρνουμε τα δεδομένα από τη φόρμα
    $name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $pickup = $_POST['pickup_loc'];
    $dropoff = $_POST['dropoff_loc'];
    $date = $_POST['pickup_date'];
    $car = $_POST['car_type'];

    // Εντολή SQL για να τα βάλουμε στη βάση (Create)
    $sql = "INSERT INTO bookings (customer_name, phone, pickup_loc, dropoff_loc, pickup_date, car_type)
            VALUES ('$name', '$phone', '$pickup', '$dropoff', '$date', '$car')";

    // Εκτέλεση και έλεγχος
    if ($conn->query($sql) === TRUE) {
        $message = "✅ Η κράτησή σας καταχωρήθηκε επιτυχώς!";
    } else {
        $message = "❌ Σφάλμα: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mykonos Transfers | Κρατήσεις</title>
    <style>
        /* Ένα απλό στυλ για να βλέπουμε τι κάνουμε */
        body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; padding-top: 50px; }
        .booking-form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.2); width: 400px; }
        h2 { text-align: center; color: #333; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #000; color: white; border: none; margin-top: 20px; cursor: pointer; font-size: 16px; border-radius: 5px; }
        button:hover { background-color: #333; }
        .success-msg { color: green; text-align: center; font-weight: bold; margin-bottom: 15px; }
    </style>
</head>
<body>

    <div class="booking-form">
        <h2>Luxury Transfers</h2>
        <p style="text-align:center; color:#666;">Συμπληρώστε τη φόρμα για κράτηση</p>

        <?php if ($message != ""): ?>
            <div class="success-msg"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="post" action="booking.php">
            <label>Ονοματεπώνυμο:</label>
            <input type="text" name="customer_name" required placeholder="Γράψτε το όνομά σας">

            <label>Τηλέφωνο:</label>
            <input type="text" name="phone" required placeholder="+30...">

            <label>Από Πού (Παραλαβή):</label>
            <input type="text" name="pickup_loc" required placeholder="π.χ. Αεροδρόμιο">

            <label>Προς Πού (Προορισμός):</label>
            <input type="text" name="dropoff_loc" required placeholder="π.χ. Ξενοδοχείο Cavo Tagoo">

            <label>Ημερομηνία & Ώρα:</label>
            <input type="datetime-local" name="pickup_date" required>

            <label>Επιλογή Οχήματος:</label>
            <select name="car_type">
                <option value="Mercedes V-Class">Mercedes V-Class (Van)</option>
                <option value="Mercedes S-Class">Mercedes S-Class (Limo)</option>
                <option value="Range Rover">Range Rover (SUV)</option>
            </select>

            <button type="submit">ΚΑΝΤΕ ΚΡΑΤΗΣΗ</button>
        </form>
    </div>

</body>
</html>