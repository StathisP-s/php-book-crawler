<?php
require_once 'scraper/BookScraper.php';

$category = $_POST['category'] ?? '';
$scraper = new BookScraper();
$books = $scraper->crawlCategory($category);
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Αποτελέσματα Scraping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

<?php
if (!empty($books)) {
    // Αποθήκευση σε CSV
    if (!file_exists("exports")) mkdir("exports");
    $file = fopen("exports/books.csv", "w");
    fputcsv($file, ["Τίτλος", "Τιμή", "Διαθεσιμότητα", "Link"]);
    foreach ($books as $book) {
        fputcsv($file, $book);
    }
    fclose($file);

    echo "<h3 class='mb-4'>✅ Βρέθηκαν " . count($books) . " βιβλία.</h3>";

    // Εμφάνιση πίνακα
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-bordered'>";
    echo "<thead class='table-dark'><tr>
            <th>Τίτλος</th>
            <th>Τιμή</th>
            <th>Διαθεσιμότητα</th>
            <th>Link</th>
          </tr></thead><tbody>";

    foreach ($books as $book) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($book[0]) . "</td>";
        echo "<td>" . htmlspecialchars($book[1]) . "</td>";
        echo "<td>" . htmlspecialchars($book[2]) . "</td>";
        echo "<td><a href='" . htmlspecialchars($book[3]) . "' target='_blank'>Προβολή</a></td>";
        echo "</tr>";
    }

    echo "</tbody></table></div>";

    echo "<a href='exports/books.csv' class='btn btn-primary mt-3'>⬇ Κατέβασε CSV</a>";
    echo " <a href='index.php' class='btn btn-secondary mt-3'>🔙 Πίσω</a>";
} else {
    echo "<div class='alert alert-danger'>❌ Δεν βρέθηκαν βιβλία.</div>";
    echo "<a href='index.php' class='btn btn-secondary'>🔙 Πίσω</a>";
}
?>

</div>
</body>
</html>
