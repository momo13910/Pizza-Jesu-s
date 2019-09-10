<?php
//index.php

$connect = new mysqli("localhost", "root", "", "pizzeria");
function display_pizza($connect) { 
 $output = '';
 $query = "SELECT * FROM pizza";
 $statement = $connect->prepare($query);
 $statement->execute();
 $resultSet = $statement->get_result();
 while ($row = $resultSet->fetch_assoc())
 {
  $output .= '<tr>
    <td>'.$row["nom"].'</td>
    <td>'.$row["description"].'</td>
    <td>'.$row["prix"].'</td>
    <td>'.$row["image"].'</td>
    <td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus">-</span></button></td>
    </tr>';
 }
 function remove() {

        
}
 $statement->close();
 $connect->close();
 return $output;
}
?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset=" UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Interface Admin</title>
</head>

<body>
    <div id="content">
        <a id="home" href="../index.html">
            <img class="home" src="http://homepizza-stmemmie.fr/wp-content/uploads/2017/05/logo-1.png" alt="" /></a>
        <br />
        <div class="container">
            <br />
            <form method="post" id="insert_form">
                <div class="table-repsonsive">
                    <span id="error"></span>
                    <table class="table table-bordered" id="item_table">
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Image</th>
                            <th>
                                <button type="button" name="add" class="btn btn-success btn-sm add"> <span
                                        class="glyphicon glyphicon-plus">+</span>
                                </button>
                            </th>
                            <?php echo display_pizza($connect) ?>
                        </tr>
                    </table>
                    <div align="center">
                        <input type="submit" name="submit" class="btn btn-info" value="Insérer" />
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
    $(document).ready(function() {

        $('.add').click(function() {


            let html = '';
            html += '<tr>';
            html +=
                '<td><input type="text" name="nom" class="form-control nom" /></td>';
            html +=
                '<td><input type="text" name="description" class="form-control description" /></td>';
            html +=
                '<td><input type="text" name="prix" class="form-control prix" /></td>';
            html +=
                '<td><input type="file" name="image" class="form-control image" /></td>';

            html +=
                '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus">-</span></button></td></tr>';
            $('#item_table').append(html);
        });

        $(document).on('click', '.remove', function() {
            $(this)
                .closest('tr')
                .remove();

            let pizza_name = $(this).closest('tr')[0].childNodes[1].innerHTML;
            
            $.ajax({
                url: '../php/delete.php',
                method: 'POST',
                data: {
                    nom: pizza_name
                },
                success: function(data) {
                    alert("Entrée supprimée");
                }
            });
        });

        $('#insert_form').on('submit', function(event) {
            event.preventDefault();
            var error = '';
            $('.nom').each(function() {
                var count = 1;
                if ($(this).val() == '') {
                    error += '<p>Entrer le nom à la ligne ' + count + '</p>';
                    return false;
                }
                count = count + 1;
            });

            $('.description').each(function() {
                var count = 1;
                if ($(this).val() == '') {
                    error += '<p>Entrer la description à la ligne ' + count + '</p>';
                    return false;
                }
                count = count + 1;
            });

            $('.prix').each(function() {
                var count = 1;
                if ($(this).val() == '') {
                    error += '<p>Entrer le prix à la ligne ' + count + '</p>';
                    return false;
                }
                count = count + 1;
            });

            $('.image').each(function() {
                var count = 1;
                if ($(this).val() == '') {
                    error += '<p>Ajouter une image à la ligne ' + count + '</p>';
                    return false;
                }
                count = count + 1;
            });
            
            if (error == '') {
                $.ajax({
                    url: '../php/insert.php',
                    method: 'POST',
                    data: {
                        nom: $('.nom').val(),
                        description: $('.description').val(),
                        prix: $('.prix').val(),
                        image: $('.image').val()
                    },
                    success: function(data) {
                        alert("Entrée ajouté");
                    }
                });
            }
        });

/*         $('.remove').click(()=>{
            $.ajax({
            url:'../'
            method:
            data:

            }); 
        });*/
    });
   

   
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>