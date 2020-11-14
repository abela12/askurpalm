<!DOCTYPE html>
<?php include('db.php');
include('session.php');

if (isset($_POST['addPost'])) {
    $content = $_POST['content'];
    $categoryId = $_POST['categoryId'];
    $title = $_POST['title'];
    $userId = $_SESSION['MEMBER_ID'];
    $sql = "INSERT INTO `post`(`userId`, `categoryId`, `title`, `content`) VALUES ('$userId','$categoryId','$title','$content')";
    $sql = mysqli_query($conn, $sql);
}
?>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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

            <!-- here is the form  -->



            <!-- the form end's here  -->

            <!-- this is the post container  -->

            <div class="post">

                <!-- this is the sample post card  -->
                <?php


                $query = "SELECT post.id, fullName, title,content ,DATE_FORMAT(post.date, '%Y-%m-%d') AS date FROM post INNER JOIN user ON post.userId = user.id ORDER BY `post`.`date` DESC LIMIT 5";
                $search_query = mysqli_query($conn, $query);



                while ($row = mysqli_fetch_assoc($search_query)) {
                    $id = $row['id'];
                    $fullName = $row['fullName'];
                    $content = $row['content'];
                    $title = $row['title'];
                    $date = $row['date'];


                ?>

                <div class="max-w-xl mb-10 rounded-xl bg-w overflow-hidden shadow-md w-100">
                    <div class="px-6 py-4">

                        <a class="font-bold text-sm"><?php echo $fullName; ?> <span class="badge cl bgc badge-pill"
                                style="margin-left: 80%;"><?php echo $date ?></span></a>
                        <h6 class="text-info">
                            <?php echo $title; ?>
                        </h6>

                        <p class="text-gray-700 mt-4 text-base">
                            <?php echo $content ?>
                        </p>
                    </div>
                    <div class="answer-btn">
                        <a class="btn btn-primary display-inline"
                            href="index.php?pid=<?php echo htmlentities($row['id']); ?>">
                            Answer
                        </a>
                    </div>
                </div>


                <!-- sample post card ends here -->


                <?php }


                ?>
            </div>
            <!-- post container end's here -->

        </div>

        <!-- the form and post contener ends here  -->

    </div>
</body>

</html>