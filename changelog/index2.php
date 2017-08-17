<DOCTYPE html>
<header>
    <title>Carbon Changelog</title>
</header>
<body>
<?php
// Get JSON Data
$jsonraw = file_get_contents("https://review.carbonrom.org/changes/?q=status:merged");
$json = json_decode(preg_replace('/^.+\n/', '', $jsonraw));

// Set date
$date = 0;

// Info for users
echo "<h3>CarbonROM Changelog</h3>";
echo "<h5>*Changes do not indicate successful weekly compilation*</h5>";

foreach ($json as $item) {
    // Get date of change from JSON
    $changeDate = substr($item->updated, 0, -18);

    // Create date header to make reading easier if one doesn't exist
    if ($date != $changeDate) {
        echo "<p><b>--- Changed on $changeDate ---</b></p>";
        $date = $changeDate;
    }

    // Show the change
    echo '<p>' . substr($item->project,10) . ': <a href="https://review.carbonrom.org/#/c/' . $item->_number . '">' . $item->subject . '</a>';
}
?>
</body>
</html>

