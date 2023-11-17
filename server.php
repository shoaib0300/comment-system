<?php

if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents('comments.txt', "$timestamp: $comment" . PHP_EOL, FILE_APPEND);
}


if (isset($_POST['delete'])) {
    $comments = file('comments.txt');
    $indexToDelete = $_POST['id'];

    if(isset($comments[$indexToDelete])) {
        unset($comments[$indexToDelete]);
        file_put_contents('comments.txt', implode(PHP_EOL, $comments));
        header('Location: http://localhost/comment-system/');
    }
}

$comments = file_get_contents('comments.txt');

// Separate timestamps and comments
$commentLines = explode(PHP_EOL, $comments);

foreach ($commentLines as $index => $line) {
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

        // add the delete button here
        echo '<form action="server.php" class="delete-form" name="form" method="POST">';
        echo '<input type="hidden" name="id" value="' . $index . '">';
        echo '<button name="delete" value="aA" type="submit" class="delete-button">Delete</button>';
        echo '</form>';

        echo '</div>';

    }
}
?>
