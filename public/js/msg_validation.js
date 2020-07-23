'use strict';

$(document).ready(function(){

    $('#phone-number').on('keyup keydown change', function(e) {
        let value = e.target.value;
        //value = value.replace(/ /, '');
        const pattern = /^(\+447|07)\d{3}\s?\d{6}$/;
        const result = pattern.test(value);
        if (result === true) {
            $('#phone-number').css('background-color', '#ccffcc');
            $('#phone-number-error-message').html('Phone number is valid');
            $('#phone-number-error-message').css('color', 'green');
        }
        else {
            $('#phone-number').css('background-color', '#ffcccc');
            $('#phone-number-error-message').html('Please enter a valid UK mobile phone number');
            $('#phone-number-error-message').css('color', 'red');
        }
    });

    $('#message-body').on('keyup keydown', function(e) {
        const msg_body_length = e.target.value.length;
        if (msg_body_length > 0 && msg_body_length <= 140) {
            $('#message-body').css('background-color', '#ccffcc');
        }
        else {
            $('#message-body').css('background-color', '#ffcccc');
        }
        if (140 - msg_body_length >= 0) {
            $('#num-chars').html(140 - msg_body_length);
            $('#num-chars').css('color', 'black');
        }
        else {
            $('#num-chars').html((msg_body_length - 140) + ' too many characters');
            $('#num-chars').css('color', 'red');
        }
    });

});