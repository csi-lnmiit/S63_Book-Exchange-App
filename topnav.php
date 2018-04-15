<div class="col-md-9"><!--col-md-9 start-->
    <div class="row">
        <div class="container-fluid" style="background-color: #3498DB;height: 100px">

            <div class="col-md-1" id="nav_image">
                <a href="#null" onclick="javascript:history.back();"><img src="Images/back.png" style="width:85%;"></img></a>
            </div>

            <div class="topnav col-md-9">
                <div class="search-container">
                    <form action="search.php" method="get">
                        <input type="text" placeholder=" Search book name or author name ..." name="search_input" size="55%">
                        <button type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="col-md-2" id="nav_image">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration: none">
                        <img src="Images/geek_pic.png" alt="My Pic" style="width:35%;">
                        <span class="caret" style="color: black;"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><p>Signed in as <br><b><?php echo $_SESSION['user'];?></b></p></li>
                        <li class="divider"></li>
                        <li><a href="profile.php">Your Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
