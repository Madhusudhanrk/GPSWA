<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms/admin/index.php">Admin</a>
            </div>
            <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <!-- <li style="font-weight:bold;"><a href="">Users Online:<?php //echo users_online();?></a></li> -->
     <li><a href="../index"><i class='fas fa-home'></i> Home</a></li>
   <li style="font-weight:bold;"><a href="">Users Online:<span class='usersonline'></span></a></li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user-circle" style="font-size:18px"></i><span> </span><?php echo $_SESSION['username'];?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
	
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fas fa-chart-line"></i>My data</a>
                    </li>
                    <?php if(is_admin()){ ?>
                        <li>
                            <a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#post_dropdown"><i class="   fas fa-clone"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="post_dropdown" class="collapse">
                            <li>
                                <a href="posts.php">View all posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add posts</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="categories.php"><i class="fas fa-boxes"></i> Categories</a>
                    </li>
                   
                    <li class="">
                        <a href="comments.php"><i class="fas fa-comment-alt"></i> Comments</a>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fas fa-users"></i> Users <i class='fa fa-caret-down'></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="users.php?source=view_users">View Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_users">Add Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="profile.php"><i class="fas fa-user-cog"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
