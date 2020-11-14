<?php include('db.php');
include('session.php'); ?>
<?php
//login confirmation
confirm_logged_in();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Profile</title>

    <!-- local css links  -->
    <link rel="stylesheet" href="profile.css" />


    <!-- talwindcss links  -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />

    <!-- bootstrap links      -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>


    <!-- Google links  -->


    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

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

        <!-- this is  the post card container -->

        <div class="main">

            <div class="post">

                <div class="max-w-xl side  rounded-xl bg-w  shadow-md">
                    <div class="pp ">
                        <?php
            $id = $_SESSION['MEMBER_ID'];
            $sql = "SELECT * FROM user WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>

                        <img class="shadow-lg"
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80"
                            alt="" srcset="">
                        <a class="p2 text-white btn btn-success btn-sm"
                            href="change-profile.php?id=<?php echo $id ?>">change photo</a>
                    </div>

                    <div class="px-6 py-4">

                        <h3>Name: <?php echo $row['fullName']; ?></h3>
                        <h6> Email: <?php echo $row['email']; ?></h6>
                        <?php
            } ?>
                    </div>
                </div>
            </div>



            <br>
            <br>
            <br>

            <div class="card mb-3">
                <div class="card-title">
                    <h2 class="text-center">Topics</h2>
                </div>
                <div class="card-body ">

                    <div class="row sider">

                        <h6 class="space">Choose Topics you like to see on your feed. this will help you get
                            personalized feed on your home page.</h6>
                        <div class="sider">

                            <div class="btn-group-toggle sides  cont" data-toggle="buttons">
                                <label class="btn btn-secondary ">
                                    <input type="checkbox"> Fashion
                                </label>
                                <label class="btn btn-secondary ">
                                    <input type="checkbox"> Food
                                </label>
                                <label class="btn btn-secondary ">
                                    <input type="checkbox"> Travle
                                </label>
                                <label class="btn btn-secondary ">
                                    <input type="checkbox"> Music
                                </label>
                                <label class="btn btn-secondary ">
                                    <input type="checkbox"> Lifestyle
                                </label>
                                <label class="btn btn-secondary ">
                                    <input type="checkbox"> Fitness
                                </label>
                                <label class="btn btn-secondary ">
                                    <input type="checkbox"> DIY
                                </label>
                                <label class="btn btn-secondary ">
                                    <input type="checkbox"> Sport
                                </label>
                            </div>

                            <button class="btn btn-outline-primary" type="submit" name="update">Update</button>
                        </div>

                    </div>
                </div>

            </div>




            <!-- the post contener ends here  -->

        </div>
</body>

</html>