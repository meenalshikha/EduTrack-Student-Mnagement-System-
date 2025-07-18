$(document).ready(function() {
    $('form').on('submit', function(e) {
        let name = $('input[name="new_name"]').val().trim();
        let email = $('input[name="new_email"]').val().trim();
        let password = $('input[name="new_password"]').val().trim();

        if (name === '' || email === '' || password === '') {
            alert("All fields are required!");
            e.preventDefault();
        }
    });
});
