<?php ob_start(); ?>



<?php include('db.php');
include('session.php');
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $sql = "UPDATE `notification` SET `status`='seen' WHERE `postId` = '$pid'";
    $result = mysqli_query($conn, $sql);
}
include('server.php');


if (isset($_POST['ans'])) {
    $answer = $_POST['answer'];

    $pid = $_GET['pid'];
    $userId = $_SESSION['MEMBER_ID'];
    $name = $_SESSION['fullName'];
    $sql = "INSERT INTO `comment`(`userId`, `postId`, `comment`) VALUES ('$userId','$pid','$answer')";
    $sql = mysqli_query($conn, $sql);

    $msg = $name . '  add answer in your post';
    $notification = "INSERT INTO `notification`(`postId`, `username`, `message`) VALUES ('$pid','$name','$msg')";
    $noti = mysqli_query($conn, $notification);
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

    <link rel="stylesheet" href="home.css" />


    <!-- talwindcss links  -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />


    <!-- bootstrap links      -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="main1.css">

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
                                <?php
                                $name = $_SESSION['fullName'];
                                $id = $_SESSION['MEMBER_ID'];
                                $sql = "SELECT post.id ,userId ,notification.postId,message , status,username FROM post INNER JOIN user ON user.id = post.userId INNER JOIN notification ON post.id = notification.postId WHERE  userId = '$id' ORDER BY `notification`.`date` DESC LIMIT 5";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($result);
                                if ($count > 1) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $message = $row['message'];
                                        $username = $row['username'];
                                        $postId = $row['postId']; ?>


                                <a class="dropdown-item"
                                    href="index.php?pid=<?php echo $postId ?>"><?php echo $message; ?></a>


                                <?php
                                    }
                                } else
                                    echo "no notification";

                                ?>





                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ask.php">Ask</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
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
                        <!-- user like :🔎 or :🌒 dislike Question -->
                        <div class="posts-wrapperr">
                            <?php foreach ($posts as $post) : ?>


                            <div class="post-infoo">
                                <!-- if user likes post, style button differently -->
                                <i <?php if (userLiked($post['id'])) : ?> class="fa fa-thumbs-up like-btn"
                                    <?php else : ?> class="fa fa-thumbs-o-up like-btn" <?php endif ?>
                                    data-id="<?php echo $post['id'] ?>"></i>
                                <span class="likes"><?php echo getLikes($post['id']); ?></span>

                                &nbsp;&nbsp;&nbsp;&nbsp;

                                <!-- if user dislikes post, style button differently -->
                                <i <?php if (userDisliked($post['id'])) : ?> class="fa fa-thumbs-down dislike-btn"
                                    <?php else : ?> class="fa fa-thumbs-o-down dislike-btn" <?php endif ?>
                                    data-id="<?php echo $post['id'] ?>"></i>
                                <span class="dislikes"><?php echo getDislikes($post['id']); ?></span>
                            </div>

                            <?php endforeach ?>
                        </div>

                    </div>
                </div>

                <!-- sample post card ends here -->

            </div>
            <form action="" method="post">
                <div class="input-group mb-3 flexa">
                    <input type="text" class="form-control" placeholder="Do You Know The Answer ?"
                        aria-label="Recipient's username" name="answer" aria-describedby="button-addon2" required />
                    <div class="input-group-append  ">
                        <button class="px-6 py- cl bgc" type="submit" name="ans" id="button-addon2">
                            Answer
                        </button>
                    </div>
                </div>
            </form>

            <div class="post">

                <!-- this is the sample answer card  -->
                <?Php
                $query = "SELECT comment ,post.id , fullname FROM comment INNER JOIN post ON comment.postId = post.id INNER JOIN user ON comment.userId = user.id WHERE post.id = '$pid' ORDER BY `comment`.`date` DESC";

                $select_all_comment = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_all_comment)) {
                    // $id = $row['id'];
                    $comment = $row['comment'];
                    $fullname = $row['fullname'];




                ?>

                <div class="max-w-xl mb-10 rounded-xl bg-w overflow-hidden shadow-md w-100">
                    <div class="px-6 py-4">

                        <li class="  d-flex justify-content-between align-items-center text-decoration-none text-dark"
                            aria-disabled="true">
                            <a class="font-bold text-sm "><?php echo $fullname ?></a>
                            <span class="badge bag cl bgc badge-pill"> + 4 </span>
                        </li>


                        <p class="text-gray-700 mt-4 text-base">
                            <?php echo $comment ?>
                        </p>
                    </div>
                    <div class="answer-btn">
                        <button type="submit">Vote</button>

                    </div>
                </div>
                <?php

                } ?>

                <!-- sample answer card ends here -->

            </div>

















        </div>
    </div>
    <script src="scripts.js"></script>

    <!-- the form and post contener ends here  -->


</body>

</html>