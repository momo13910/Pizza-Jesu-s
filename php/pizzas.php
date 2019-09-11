<?php
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
    <td> <img class="img_pizza" id='.$row["id"].' src="../img/'.$row["image"].'"/></td>
    <td>
    <div class="button-group">
      <button style="width: 15%;" type="button" name="up" class="btn btn-success btn-sm up'.$row["id"].'"></button>
      <input id="input'.$row["id"].'" style="width: 15%; text-align: center;" type="text" disabled >
      <button style="width: 15%;" type="button" name="less" class="btn btn-danger btn-sm less'.$row["id"].'"></button>
    </div>
    </td>
    </tr>

    <script>
    $("#'.$row["id"].'").mouseenter(() => {
      $("#'.$row["id"].'").addClass("img_zoom");
    });
    $("#'.$row["id"].'").mouseleave(() => {
      $("#'.$row["id"].'").removeClass("img_zoom");
    });
    
    let nb_pizza'.$row["id"].' = 0;

    $(".up'.$row["id"].'").click((e) => {
      nb_pizza'.$row["id"].'++;
      console.log(nb_pizza'.$row["id"].');
      $("#input'.$row["id"].'").attr("value", nb_pizza'.$row["id"].');
    });
      
    $(".less'.$row["id"].'").click((e) => {
    nb_pizza'.$row["id"].'--;
    console.log(nb_pizza'.$row["id"].');
    $("#input'.$row["id"].'").attr("value", nb_pizza'.$row["id"].');
    
    if(nb_pizza'.$row["id"].' <= 0) {
      nb_pizza'.$row["id"].' = 0;
      $("#input'.$row["id"].'").attr("value", nb_pizza'.$row["id"].');
    }
    
    });


    </script>';
 }

 $statement->close();
 $connect->close();
 return $output;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/interface.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <title>Pizzas</title>
</head>
<body>
  <div id="content">
    <div class="container">
      <a id="home" href="../index.html">
          <img class="home" src="http://homepizza-stmemmie.fr/wp-content/uploads/2017/05/logo-1.png" alt="" />
      </a>

      <form method="POST" id="insert_form" enctype="multipart/form-data">
        <div class="table-repsonsive">
          <span id="error"></span>
          <table class="table table-bordered" id="item_table">
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th>Prix</th>
              <th>Image</th>
              <?php echo display_pizza($connect) ?>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</body>
</html>
