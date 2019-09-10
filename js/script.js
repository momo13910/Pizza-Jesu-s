


$( "#valider" ).click(function() {
    
    let pseudo = $("#name").val();
    let pass = $("#pass").val();


    $.ajax ({

        url : "http://localhost/Pizza-Jesu-s/php/admin.php",
        type : "POST",
        data : {
            name : pseudo,
            pass : pass

        },

        success : function success(result) {
            if(result && result.match(/http/)) {
                location.href = result;
            } else {
                alert(result);
            }
        },

        error : function error(erreur) {
            alert(erreur);
        }

    });

  });