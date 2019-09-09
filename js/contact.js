let name = $('#name');
let email = $('#email');
let message = $('#message');
let valider = $('#valider');


valider.click(() => {

    $.ajax({
        url: 'localhost/Pizza-Jesu-s/php/mail.php',
        type: 'POST',
        data: {

            name: name.val(),
            email: email.val(),
            messag: message.val()


        },
        success: 
        function marche(result) {

            alert(result);
        },
        error:
         function error(erreur) {

            console.log(erreur);
        }

    })

});