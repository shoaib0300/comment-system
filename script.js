// script.js

// Function to fetch comments from the server


function getComments() {
    $.ajax({
        url: 'server.php',
        type: 'GET',
        success: function (data) {
            $('#comments-container').html(data);
        },
        error: function () {
            alert('Error fetching comments');
        }
    });
}



// Function to add a new comment

function addComment() {
    var commentText = $('#comment-input').val();

    // Check if the comment is not empty
    if (commentText.trim() !== '') {
        $.ajax({
            url: 'server.php',
            type: 'POST',
            data: { comment: commentText },
            success: function () {
                // Clear the input field
                $('#comment-input').val('');
                // Fetch and display updated comments
                getComments();
            },
            error: function () {
                alert('Error adding comment');
            }
        });
    }
}



// Fetch comments when the page loads

$(document).ready(function() {
    getComments();
});
