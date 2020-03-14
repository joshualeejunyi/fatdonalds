$('document').ready(function(){
    var usernameState = true;
    var emailState = true;
    $('#username').on('blur', function(){
        var username = $('#username').val();
        if (username == '') {
            usernameState = false;
            return;
        }
        $.ajax({
            url: 'register.php',
            type: 'post',
            data: {
                'usernameCheck' : 1,
                'username' : username,
            }, 
            success: function(response){
                alert(response);
                if (response === 'taken') {
                    alert("ERM");
                    usernameState = false;
                    $('#username').addClass("is-invalid");
                    $('#username').siblings(".form-error").html('<div><small class="text-danger">Sorry, Username is taken.</small></div>');
                } else if (response === 'notTaken') {
                    alert("OOPS");
                    usernameState = true;
                    $('#username').removeClass("is-invalid");
                    $('#username').siblings(".form-error").html('');
                }
            }
        });
    });
    $('#email').on('blur', function(){
        var email = $('#email').val();
        if (email == '') {
            emailState = false;
            return;
        }
        $.ajax({
            url: 'register.php',
            type: 'post',
            data: {
                'emailCheck' : 1,
                'email' : email,
            },
            success: function(response){
                if (response == 'taken') {
                    emailState = false;
                    $('#email').addClass("is-invalid");
                    $('#email').siblings(".form-error").html('<div><small class="text-danger">Sorry, Email is already in use.</small></div>');
                } else if (response == 'notTaken') {
                    emailState = true;
                    $('#email').removeClass("is-invalid");
                    $('#email').siblings(".form-error").html('');
                }
            }
        });
    });

    $('#regbtn').on('click', function(){
        console.log(usernameState);
        console.log(emailState);
        if (usernameState === false || emailState === false) {
            $('#formerrors').text('Fix the errors in the form first');
            $('#formerrors').addClass("alert alert-danger");
            $("form").submit(function (e) {
                e.preventDefault(); 
            });
        }
        
    });

});