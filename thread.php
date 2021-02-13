<!doctype html>
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

    <?php
    $id = $_GET['threadid'];

    $sql_query = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($connection, $sql_query);

    while ($row = mysqli_fetch_assoc($result)) {
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];
    }
    ?>

    <?php
        $_sql_query="SELECT user_name FROM `users` WHERE s_no='$thread_user_id'";
        $_result=mysqli_query($connection,$_sql_query);
        $_row=mysqli_fetch_assoc($_result);

        $user_name=$_row['user_name'];
    ?>

    <?php
    $method = $_SERVER['REQUEST_METHOD'];

    $showAlert = false;

    if ($method == "POST") {
        $comment = $_POST['comment'];

        $comment=str_replace("<","&lt;",$comment);
        $comment=str_replace(">","&gt;",$comment);
        
        $sno=$_POST['sno'];

        $sql_query = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`) VALUES ('$comment', '$id', '$sno')";
        $result = mysqli_query($connection, $sql_query);

        $showAlert = true;

        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added! Thanks for the your greatfull suggestion.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }
    ?>

    <div class="container my-3">
        <div class="jumbotron py-3">
            <h1 class="display-4"><?php echo $thread_title; ?></h1>
            <p class="lead"><?php echo $thread_desc; ?></p>
            <hr class="my-4">
            <p>Rules of this form.</p>
            <h5>Posted by : <spam style="font-style: italic; font-weight:bold"><?php echo $user_name; ?></spam></h5>
        </div>
    </div>

    <div class="container my-3">
        <h1 class="mb-2">Post your comment --></h1>
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            echo '<div class="jumbotron py-3">
                        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                            <div class="form-group">
                                <label for="comment">Type your comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
                                <input type="hidden" name="sno" value="' .$_SESSION['sno']. '">
                            </div>
                            <button type="submit" class="btn btn-success">Post Comment</button>
                        </form>
                    </div>';
        } else {
            echo '<div class="jumbotron py-3">
                            <h4>Please login for post the comment --></h4>
                        </div>';
        }
        ?>
    </div>


    <div class="container my-3">

        <h1 class="mb-2">All comments --></h1>

        <div class="jumbotron py-3">

            <?php
            $id = $_GET['threadid'];

            $sql_query = "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($connection, $sql_query);

            $noresult = true;

            while ($row = mysqli_fetch_assoc($result)) {

                $noresult = false;

                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_datetime = $row['comment_datetime'];
                $comment_by=$row['comment_by'];

                $_sql_query="SELECT user_name FROM `users` WHERE s_no='$comment_by'";
                $_result=mysqli_query($connection,$_sql_query);
                $_row=mysqli_fetch_assoc($_result);
                

                echo '<div class="media py-2">
                        <img src="images/userimage.jpg" width="50px" height="50px" class="mr-3 rounded-circle" alt="...">
                        <div class="media-body">
                            <p><spam class="font-weight-bold my-0">Solution :<br></spam>' . $content . '</p>
                        </div>
                        <h6><spam style="font-weight: bold; font-size:1.1rem">'. $_row['user_name'].' </spam>at ' . $comment_datetime . '</h6>
                    </div>';
            }

            if ($noresult) {
                echo '<p class="display-4">No Comments found</p>
                    <p class="lead">Be the first person to give your solution for this problem.</p>';
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