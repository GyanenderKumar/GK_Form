<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Welcome to GK_Form - coding form</title>
</head>

<body>
    <?php include "partials/_header.php" ?>

    <?php include "partials/_dbconnect.php" ?>

    <div class="container my-3">
        <div class="jumbotron py-3 mb-0">
            <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                echo '<div class="card">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="images/userimage.jpg" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h1 class="card-title" style="font-size:4.5rem">User Name : <spam class="text-success" style="font-size:3.0rem">'. strtoupper($_SESSION['username']) .'</spam></h1>
                      <h1 class="card-title" style="font-size:4.5rem">Email : <spam class="text-success" style="font-size:3.0rem">'. strtoupper($_SESSION['useremail']) .'</spam></h1>
                    </div>
                  </div>
                </div>
              </div>';
            }
            ?>
        </div>
    </div>

    <?php include "partials/_footer.php" ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>