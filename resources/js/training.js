$(document).ready(function() {
    $('#answer-form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var answer = $('#answer').val();
        var wordId = $('#word-id').val(); // Assuming you have a hidden input with the word ID

        $.ajax({
            url: '/training/check-answer', // Replace with your route
            type: 'POST',
            data: {
                answer: answer,
                word_id: wordId,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
            },
            success: function(response) {
                if (response.correct) {
                    // Update the score, display a success message, load the next word
                    $('#score').text('Score: ' + response.newScore);
                    $('#message').text('Correct!');
                    loadNextWord(); // Function to load the next word via AJAX
                } else {
                    // Display an error message
                    $('#message').text('Incorrect. Try again.');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                $('#message').text('An error occurred.');
            }
        });
    });

    function loadNextWord() {
        $.ajax({
            url: '/training/next-word', // Replace with your route
            type: 'GET',
            success: function(response) {
                $('#word').text(response.word.deutsch); // Update the word on the page
                $('#word-id').val(response.word.id); // Update the hidden word ID
                $('#answer').val(''); // Clear the answer input
                $('#message').text(''); // Clear any previous messages
            },
            error: function(xhr, status, error) {
                console.error(error);
                $('#message').text('An error occurred loading the next word.');
            }
        });
    }

    // Initial load of the first word
    loadNextWord();
});