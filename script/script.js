

// Permet de vérifier que l'acheteur a taper 2 fois le meme mot de passe

$(document).ready(function () {

    $("#submit").attr('disabled', "");
    $("#submit").css('background-color', 'red');
    $("#submit").css('color', 'white');


    $("#mdpConfirmeAcheteur").on('keyup', function(){
     var password = $("#mdpPremierAcheteur").val();
     var confirmPassword = $("#mdpConfirmeAcheteur").val();
     if (password != confirmPassword){
         $("#CheckPasswordMatch").html("Password does not match !").css("color","red");

         $("#submit").attr('disabled', "");
        $("#submit").css('background-color', 'red');
        $("#submit").css('color', 'white');
     }
     else{
         $("#CheckPasswordMatch").html("Password match !").css("color","green");

        $("#submit").removeAttr('disabled');
        $("#submit").css('background-color', 'green');
        $("#submit").css('color', 'white');
     }
    });

     $("#mdpPremierAcheteur").on('keyup', function(){
        var password = $("#mdpConfirmeAcheteur").val();
        var confirmPassword = $("#mdpPremierAcheteur").val();
        if (password != confirmPassword){
            $("#CheckPasswordMatch").html("Password does not match !").css("color","red");
   
            $("#submit").attr('disabled', "");
           $("#submit").css('background-color', 'red');
           $("#submit").css('color', 'white');
        }
        else{
            $("#CheckPasswordMatch").html("Password match !").css("color","green");
   
           $("#submit").removeAttr('disabled');
           $("#submit").css('background-color', 'green');
           $("#submit").css('color', 'white');
        }

       
    });
 });




 