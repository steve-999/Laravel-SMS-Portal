'use strict';

var Nseconds_delay = 15;

//$(document).ready(function(){
document.addEventListener('DOMContentLoaded', function() {

    $('#phone-number').on('keyup change', () => validateMessage()); 
    $('#message-body').on('keyup change', () => validateMessage()); 

    function validateMessage() {
        const mobileNumberIsValid = validateMobileNumber();
        const messageBodyIsValid = validateMessageBody();
        const userIsLoggedIn = checkUserLoggedIn();
        const validationResult = mobileNumberIsValid && messageBodyIsValid && userIsLoggedIn && !window.isCountingDown;
        if (validationResult)
            $('#send-button').attr("disabled", false);
        else 
            $('#send-button').attr("disabled", true);
    }

    function checkUserLoggedIn() {
        console.log('user-logged-in = ', $("#user-logged-in").val());
        if($("#user-logged-in").val() == 'true') {
            $('#not-logged-in-message').text('');
            return true;
        }
        else {
            $('#not-logged-in-message').text('You must be logged in to send messages');
            return false;            
        }
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
        $('#send-message-success').text('');   
        $('#send-message-success').css('visibility', 'hidden');        
        const msg_body = $('#message-body').val();
        const msg_body_length = msg_body.length;
        //console.log(msg_body);
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

    $('#message-form').submit(() => {

        window.isCountingDown = true;
        let countdown_val = Nseconds_delay;
        $('#send-button').attr("disabled", true);  
        $('#send-message-success').text('Message sent!');   
        $('#send-message-success').css('visibility', 'visible');
        //console.log('submit button pressed');
        function displayCountdown() {
            $('#send-button').html(countdown_val);
            console.log(countdown_val);
            countdown_val -= 1;
            if (countdown_val < 0) {       
                $('#send-button').html('Send');
                $('#message-body').val('');
                $('#num-chars').html(140);                           
                window.isCountingDown = false;
                validateMessage();
                clearInterval(countdownTimer);
            }              
        }
        const countdownTimer = setInterval(displayCountdown, 1000);  
    })

});

