'use strict';

var Nseconds_delay = 5;

//$(document).ready(function(){
document.addEventListener('DOMContentLoaded', function() {

    $('#phone-number').on('keyup change', () => validateMessage()); 
    $('#message-body').on('keyup change', () => validateMessage()); 


    function validateMessage() {
        const mobileNumberIsValid = validateMobileNumber();
        const messageBodyIsValid = validateMessageBody();
        const userIsLoggedIn = checkUserLoggedIn();
        const validationResult = mobileNumberIsValid && messageBodyIsValid && userIsLoggedIn && !window.isCountingDown;
        //console.log('mobileNumberIsValid', mobileNumberIsValid);
        //console.log('messageBodyIsValid', messageBodyIsValid);
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
        $('#send-button').attr("disabled", true);      
        //console.log('submit button pressed');
        function displayCountdown() {
            $('#send-button').html(Nseconds_delay);
            console.log(Nseconds_delay);
            Nseconds_delay -= 1;
            if (Nseconds_delay < 0) {       
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

    // $('#contactForm').on('submit',function(event){
    //     event.preventDefault();
    //     const phone_number = $('#phone-number').val();
    //     const message_body = $('#message-body').val();

    //     error_log('in contactForm JQuery fn');

    //     $.ajax({
    //         url: "/send",
    //         type:"POST",
    //         data:{
    //             "_token": "{{ csrf_token() }}",
    //             phone_number: phone_number,
    //             message_body: message_body,
    //         },
    //         success:function(response){
    //             console.log(response);
    //         },
    //     });
    // });

});

