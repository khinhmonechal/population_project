<?php

include "db.php";

// Check if file is uploaded
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
    $filename = $_FILES["file"]["tmp_name"];
    // Check if file is CSV
    if (
        mime_content_type($filename) !== "text/plain" &&
        pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION) !== "csv"
    ) {
        header(
            "Location: index.php?error=Invalid file type. Please upload a CSV file."
        );
        exit();
    }
    // Open CSV file
    if (($handle = fopen($filename, "r")) !== false) {
        $headers = fgetcsv($handle); // Skip the header row
        // Read CSV file and insert data into MySQL
        while (($row = fgetcsv($handle)) !== false) {
            $key = array_shift($row); // Get first column as the key
            $data[$key] = array_combine(array_slice($headers, 1), $row); // Map years to values
        }

        // Insert data into the database
        foreach ($data as $prefecture => $years) {
            foreach ($years as $year => $population) {
                $col1 = $conn->real_escape_string(
                    mb_convert_encoding($prefecture, "UTF-8", "SJIS")
                );
                $col2 = $conn->real_escape_string($year);
                $col3 = (int) $population;
                $sql = "INSERT INTO prefecture_population4 (prefecture, year, population) VALUES ('$col1', '$col2', '$col3')";
                $conn->query($sql);
            }
        }
        // Close connections
        $conn->close();
        echo "Data inserted successfully!";

        fclose($handle);
        header(
            "Location: index.php?msg=File successfully uploaded and data imported!"
        );
        exit();
    } else {
        header("Location: index.php?error=Could not open the CSV file.");
        exit();
    }
} else {
    header("Location: index.php?error=File upload failed.");
    exit();
}

$conn->close();
?>
