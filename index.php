<!-- index.php -->
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Book Scraper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">📚 Scrape Βιβλία από Κατηγορία</h2>
        <form action="scrape.php" method="post">
            <div class="mb-3">
                <label for="category" class="form-label">Κατηγορία:</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="travel_2">Travel</option>
                    <option value="science_22">Science</option>
                    <option value="fiction_10">Fiction</option>
                    <option value="mystery_3">Mystery</option>
                    <option value="romance_8">Romance</option>
                    <option value="historical-fiction_4">Historical Fiction</option>
                    <!-- μπορείς να προσθέσεις περισσότερες -->
                </select>
            </div>
            <button type="submit" class="btn btn-success">Ξεκίνησε Scraping</button>
        </form>
    </div>
</body>
</html>

