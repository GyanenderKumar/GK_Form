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
    $cat_id = $_GET['categoryid'];

    $sql_query = "SELECT * FROM `categories` WHERE category_id=$cat_id";
    $result = mysqli_query($connection, $sql_query);

    while ($row = mysqli_fetch_assoc($result)) {
        $cat_name = $row['category_name'];
        $cat_desc = $row['category_description'];
    }
    ?>

    <?php
    $method = $_SERVER['REQUEST_METHOD'];

    $showAlert = false;

    if ($method == "POST") {
        $thread_title = $_POST['title'];
        $thread_desc = $_POST['desc'];

        $thread_title=str_replace("<","&lt;",$thread_title);
        $thread_title=str_replace(">","&gt;",$thread_title);

        $thread_desc=str_replace("<","&lt;",$thread_desc);
        $thread_desc=str_replace(">","&gt;",$thread_desc);

        $sno=$_POST['sno'];

        $sql_query = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$thread_title', '$thread_desc', '$cat_id', '$sno')";
        $result = mysqli_query($connection, $sql_query);

        $showAlert = true;

        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread has been added! Plese wait for community will response.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }
    ?>

    <div class="container my-3">
        <div class="jumbotron py-3">
            <h1 class="display-4">Welcome to <?php echo $cat_name; ?> Form</h1>
            <p class="lead"><?php echo $cat_desc; ?></p>
            <hr class="my-4">
            <p>Rules of this form.</p>
            <a class="btn btn-primary bg-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <div class="container my-3">
        <h1 class="mb-2">Ask your questions --></h1>
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            echo '<div class="jumbotron py-3">
                    <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                        <div class="form-group">
                            <label for="title">Problem Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp">
                            <small id="titleHelp" class="form-text text-muted">Keep your title as short and crisp as possible.</small>
                        </div>
                        <div class="form-group">
                            <label for="desc">Ellaborate Your Concern</label>
                            <textarea class="form-control" id="desc" name="desc" rows="5"></textarea>
                            <input type="hidden" name="sno" value="' .$_SESSION['sno']. '">
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>';
        } else {
            echo '<div class="jumbotron py-3">
                        <h4>Please login for the start a disscussion --></h4>
                    </div>';
        }
        ?>
    </div>



    <div class="container my-3">

        <h1 class="mb-2">All questions --></h1>

        <div class="jumbotron py-3">
            <?php
            $id = $_GET['categoryid'];

            $sql_query = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($connection, $sql_query);

            $noresult = true;

            while ($row = mysqli_fetch_assoc($result)) {

                $noresult = false;

                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $comment_datetime = $row['date_time'];

                $thread_user_id=$row['thread_user_id'];

                $_sql_query="SELECT user_name FROM `users` WHERE s_no='$thread_user_id'";
                $_result=mysqli_query($connection,$_sql_query);
                $_row=mysqli_fetch_assoc($_result);


                echo '<div class="media py-2">
                        <img src="images/userimage.jpg" width="50dp" height="50dp" class="mr-3 rounded-circle" alt="...">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0"><spam style="font-weight: bold">Question : </spam><a href="thread.php?threadid=' . $thread_id . '" class="text-success">' . $title . '</a></h5>
                                <spam style="font-weight: bold; font-size:1.1rem">Description : </spam>' . $desc . '
                        </div>
                        <h6>Asked by <spam style="font-weight: bold; font-size:1.1rem">'. $_row['user_name'].' </spam>at ' . $comment_datetime . '</h6>
                    </div>';
            }

            if ($noresult) {
                echo '<p class="display-4">No Questions found</p>
                    <p class="lead">Be the first person to ask a question.</p>';
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