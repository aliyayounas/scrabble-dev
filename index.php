<?php
// Include necessary classes and files
use Src\Boot;
use Src\Engine\Dictionary\Dictionary;
use Src\Engine\Scrabble;

require_once 'Src/Boot.php';

// Initialize Boot and Dictionary objects
$boot = new Boot();
$dictionary = new Dictionary($boot);

// Create a Scrabble object with the dictionary
$scrabble = new Scrabble($dictionary);

// Initialize the rack variable
$rack = "";

// Check if the form is submitted
if (isset($_POST['searchButton'])) {
    // Get the rack of tiles from user input
    $rack = strtoupper($_POST['rack']); // Convert to uppercase for consistency

    /**
     * Engine = $scrabble
     *
     * To run a match, use the method matchInDictionary.
     * This will return an array of words and scores.
     */
    $results = $scrabble->matchInDictionary($rack);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrabble Word Finder</title>
    <link rel="stylesheet" href="Src/style.css">

</head>
<body>
    <h1>Scrabble Word Finder</h1>
    <form method="POST" action="" class="scr_form">
        <label for="rack">Enter your rack of tiles:</label>
        <input type="text" id="rack" name="rack" value="<?php echo $rack; ?>" required>
        <button type="submit" name="searchButton">Search</button>
    </form>

    <?php
    // Display the results if available
    if (isset($results)) {
        echo "<h2>Results:</h2>";

        if (empty($results)) {
            echo "<p>No valid words found.</p>";
        } else {
            foreach ($results as $word => $score) {
                echo "<p><strong>$word:</strong> Score: $score</p>";
            }
        }
    }
    ?>
</body>
</html>
