<?php

if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents('comments.txt', "$timestamp: $comment" . PHP_EOL, FILE_APPEND);
}

$comments = file_get_contents('comments.txt');

// Separate timestamps and comments
$commentLines = explode(PHP_EOL, $comments);

foreach ($commentLines as $line) {
    // Split each line into timestamp and comment
    $parts = explode(': ', $line, 2);
    if(empty($line)){
        continue;
    }

    // Check if the array key 1 exists before accessing it
    $timestamp = isset($parts[0]) ? $parts[0] : ''; // Use index 0 for timestamp
    $comment = isset($parts[1]) ? $parts[1] : '';

    if (!empty($comment)) {
        echo '<div class="comment">';
        echo '<span class="timestamp">' . $timestamp . '</span>';
        echo '<span class="comment-text">' . $comment . '</span>';
        echo '</div>';

    }
}
?>
