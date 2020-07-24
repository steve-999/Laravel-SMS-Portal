'use strict';

$(document).ready(function(){

    $('#phone-number').on('keyup change', () => validateMessage()); 
    $('#message-body').on('keyup change', () => validateMessage()); 


    function validateMessage() {
        const mobileNumberIsValid = validateMobileNumber();
        const messageBodyIsValid = validateMessageBody();
        const validationResult = mobileNumberIsValid && messageBodyIsValid;
        if (validationResult)
            $('#send-button').attr("disabled", false);
        else 
            $('#send-button').attr("disabled", true);
    }

    function validateMobileNumber() {
        const value = $('#phone-number').val();
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
        return result;
    }

    function validateMessageBody() {
        const msg_body = $('#message-body').val();
        const msg_body_length = msg_body.length;
        console.log(msg_body);
        let result;
        if (msg_body_length === 0) {
            result = false;
            $('#message-body').css('background-color', '#ffcccc');
            $('#num-chars').html('140');
            $('#num-chars').css('color', 'black');             
        }
        else if (msg_body_length > 0 && msg_body_length <= 140) {
            result = true;
            $('#message-body').css('background-color', '#ccffcc');  
            $('#num-chars').html(140 - msg_body_length);
            $('#num-chars').css('color', 'black');                 
        }
        else {
            result = false;
            $('#message-body').css('background-color', '#ffcccc');
            $('#num-chars').html((msg_body_length - 140) + ' too many characters');
            $('#num-chars').css('color', 'red');
        }
        return result;
    }

});

