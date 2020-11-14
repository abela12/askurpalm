<?php ob_start();
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
} ?><?php include('db.php');
    include('session.php');


    if (isset($_POST['ans'])) {
        $answer = $_POST['answer'];

        $pid = $_GET['pid'];
        $userId = $_SESSION['MEMBER_ID'];
        $sql = "INSERT INTO `comment`(`userId`, `postId`, `comment`) VALUES ('$userId','$pid','$answer')";
        $sql = mysqli_query($conn, $sql);
    }
    ?>
<!DOCTYPE html>


<html lang="en">


<?php
//login confirmation
confirm_logged_in();

?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Home</title>

    <!-- local css links  -->
    <link rel="stylesheet" href="home.css" />


    <!-- talwindcss links  -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />

    <!-- bootstrap links      -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">

    </script>
    <style>
    .user-panel .info {
        overflow: hidden;
        white-space: nowrap;
    }

    .user-panel .image {
        display: inline-block;
        padding-left: .8rem;
    }

    .user-panel .info {
        display: inline-block;
        padding: 5px 5px 5px 10px;
    }
    </style>
</head>


<body class="body">

    <!-- nav starts here  -->

    <nav class="navbar navbar-expand-lg navbar-dark bgc">
        <div class="container">
            <a class="navbar-brand" href="#">Ask Ur Palm</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Explore</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-white text-white dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Notification
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ask.php">Ask</a>
                    </li>

                </ul>

            </div>
            <form class="form-inline my-2 my-lg-0 ml-2" action="search.php" method="post">
                <input class="py-2 px-4 mr-2 rounded" type="search" name="search" placeholder="Search"
                    aria-label="Search" />
                <button type="submit"
                    class="bg-transparent font-semibold text-white py-2 px-3 border border-white rounded" type="submit"
                    name="submit">
                    Search
                </button>
            </form>
            <a class="ml-2" href="logout.php"><i class="fas fa-power-off fa-2x text-danger"></i></a>


        </div>
    </nav>
    <!-- nav end's here  -->

    <br />

    <div class="home">

        <!-- this is the catagory navigation inn the left side  -->
        <!-- 🤒 Fetch Category From Database 🤕  -->

        <div class="category max-w-sm rounded overflow-hidden ml-6">
            <h3 class="px-6 py-4">Category</h3>

            <ul class="">
                <?Php
                $query = "SELECT * FROM `category` ORDER BY `category`.`categoryName` ASC";

                $select_all_category = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_all_category)) {
                    $id = $row['id'];
                    $categoryName = $row['categoryName'];

                    $query1 = "SELECT * FROM `post` WHERE `categoryId` = $id";
                    $select_all_categoryId = mysqli_query($conn, $query1);
                    $count = mysqli_num_rows($select_all_categoryId);


                ?>
                <!-- <li class="px-6 py-3 d-flex justify-content-between align-items-center text-decoration-none text-dark">
                    <a href="post.php?category=<?php echo htmlentities($row['categoryName']); ?>"><?php echo htmlentities($categoryName); ?>
                        <span class="badge cl bgc badge-pill mr-auto">(<?php echo htmlentities($count); ?>)</span></a>
                </li>-->
                <a href="post.php?category=<?php echo htmlentities($row['categoryName']); ?>">
                    <li
                        class="px-6 py-3 d-flex justify-content-between align-items-center text-decoration-none text-dark">
                        <?php echo htmlentities($categoryName); ?>
                        <span class="badge cl bgc badge-pill"><?php echo htmlentities($count); ?></span>
                    </li>
                </a>

                <!-- content -->



                <?php

                } ?>
                <!-- <li class="px-6 py-3 d-flex justify-content-between align-items-center text-decoration-none text-dark">
                    Fashion
                    <span class="badge cl bgc badge-pill">14</span>
                </li> -->


            </ul>
        </div>

        <!-- the catagory navigation end's here -->

        <!-- this is the form and the post card container -->


        <div class="main">
            <div class="post">

                <!-- this is the sample post card  -->

                <div class="max-w-xl mb-10 rounded-xl bg-w overflow-hidden shadow-md w-100">
                    <div class="px-6 py-4">
                        <?Php

                        if (isset($_GET['pid'])) {
                            $id = $_GET['pid'];
                            $query = "SELECT post.id, fullName, title,content FROM post INNER JOIN user ON post.userId = user.id WHERE post.id = '$id'";
                            $search_query = mysqli_query($conn, $query);



                            while ($row = mysqli_fetch_assoc($search_query)) {
                                $id = $row['id'];
                                $fullName = $row['fullName'];
                                $content = $row['content'];
                                $title = $row['title'];


                        ?>


                        <!-- content -->

                        <a class="font-bold text-sm"><?php echo $fullName ?></a>
                        <p class="text-gray-700 mt-4 text-base">
                            <?php echo $content ?>
                        </p>



                        <?php

                            }
                        } ?>

                    </div>
                </div>

                <!-- sample post card ends here -->

            </div>

            <div class="userComments mx-5 card">
                <div class="card-body">
                    <div class="card-title">answers </div>
                </div>

                <div class="roww">
                    <?Php
                    $query = "SELECT comment ,post.id , fullname FROM comment INNER JOIN post ON comment.postId = post.id INNER JOIN user ON comment.userId = user.id WHERE post.id = '$pid'";

                    $select_all_comment = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($select_all_comment)) {
                        // $id = $row['id'];
                        $comment = $row['comment'];
                        $fullname = $row['fullname'];




                    ?>
                    <div class="d-flex justify-content-between mb-3">
                        <a class="font-bold text-sm "><?php echo $fullname ?></a>
                        <span class="badge bag cl bgc badge-pill text-right"> + 4 </span>
                        <!-- <div class="user mr-auto">abel <span class="time">2020-11-09</span></div> -->
                    </div>
                    <div class="userComment ml4">
                        <?php echo $comment ?>
                    </div>
                    <br>
                    <hr>

                    <!-- content -->



                    <?php

                    } ?>



                </div>

                <!-- <div class="reply"><a href="javascript:void(0)" data-commentid="26" onclick="reply(this)">REPLY</a>
                    </div> -->



            </div>









            <!-- here is the form  -->

            <form action="" method="post">
                <div class="input-group mb-3 flexa">
                    <input type="text" name="answer" class="form-control" placeholder="Do You Know The Answer ?"
                        aria-label="Recipient's username" aria-describedby="button-addon2" />
                    <div class="input-group-append  ">
                        <button class="px-6 py- cl bgc" type="submit" name="ans" id="button-addon2">
                            Answer
                        </button>
                    </div>
                </div>
            </form>

            <!-- the form end's here  -->







        </div>
    </div>


    <!-- the form and post contener ends here  -->


</body>

</html>