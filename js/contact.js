let name = $('#name');
let email = $('#email');
let message = $('#message');
let valider = $('#valider');
let selection = $('#select');



valider.click(() => {

    $.ajax({
        url: 'http://localhost/Pizza-Jesu-s/php/mail.php',
        url: 'localhost/Pizza-Jesu-s/php/mail.php',
        type: 'POST',
        data: {

            name: name.val(),
            email: email.val(),
            message: message.val(),
            selection:selection.val(),

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
});

