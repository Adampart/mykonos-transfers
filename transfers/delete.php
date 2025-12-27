<?php
include 'db_connect.php'; // Σύνδεση με τη βάση

// Ελέγχουμε αν μας ήρθε κάποιο ID από το Link
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Εντολή SQL για ΔΙΑΓΡΑΦΗ (Delete)
    $sql = "DELETE FROM bookings WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Αν πέτυχε, δεν κάνουμε τίποτα, απλά προχωράμε στην ανακατεύθυνση
    } else {
        echo "Σφάλμα κατά τη διαγραφή: " . $conn->error;
    }
}

// Μας γυρίζει πίσω στη σελίδα του Admin αμέσως
header("Location: admin.php");
exit;
?>