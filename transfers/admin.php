<?php
include 'db_connect.php'; // Σύνδεση με τη βάση

// Εντολή SQL για να πάρουμε ΟΛΕΣ τις κρατήσεις (Read)
// Το ORDER BY pickup_date DESC σημαίνει να δείχνει πρώτα τις πιο πρόσφατες ημερομηνίες
$sql = "SELECT * FROM bookings ORDER BY pickup_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Διαχείριση Κρατήσεων</title>
    <style>
        body { font-family: 'Arial', sans-serif; padding: 20px; background-color: #f4f4f4; }
        h1 { text-align: center; color: #333; }
        
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #333; color: white; }
        tr:hover { background-color: #f5f5f5; }
        
        .btn-delete { background-color: red; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px; font-size: 14px; }
        .btn-edit { background-color: orange; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px; font-size: 14px; margin-right: 5px; }
    </style>
</head>
<body>

    <h1>📋 Λίστα Κρατήσεων (Admin Panel)</h1>
    <a href="index.php" style="display:block; text-align:center; margin-bottom:20px;">+ Νέα Κράτηση</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Όνομα Πελάτη</th>
                <th>Τηλέφωνο</th>
                <th>Από</th>
                <th>Προς</th>
                <th>Ημ/νία & Ώρα</th>
                <th>Αυτοκίνητο</th>
                <th>Ενέργειες</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ελέγχουμε αν υπάρχουν αποτελέσματα
            if ($result->num_rows > 0) {
                // Εδώ γίνεται η επανάληψη (Loop) για κάθε γραμμή στη βάση
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["customer_name"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["pickup_loc"] . "</td>";
                    echo "<td>" . $row["dropoff_loc"] . "</td>";
                    echo "<td>" . $row["pickup_date"] . "</td>";
                    echo "<td>" . $row["car_type"] . "</td>";
                    echo "<td>";
                    // Αυτά τα κουμπιά θα τα φτιάξουμε στα επόμενα βήματα (U και D)
                    echo "<a href='edit.php?id=" . $row["id"] . "' class='btn-edit'>Επεξεργασία</a>";
                    echo "<a href='delete.php?id=" . $row["id"] . "' class='btn-delete' onclick='return confirm(\"Είστε σίγουρος ότι θέλετε να διαγράψετε αυτή την κράτηση;\")'>Διαγραφή</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' style='text-align:center;'>Δεν υπάρχουν κρατήσεις ακόμα.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>