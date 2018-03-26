
<header class="header white-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="" class="logo">City<small><span>Flower</span></small></a>
    <!--logo end-->

    <div class="top-nav ">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">

            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="images/<?php echo $_SESSION['poto']; ?>" height="35" width="30">
                    <span class="username"><?php echo $_SESSION['user']; ?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>

                    <li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!--search & user info end-->
    </div>
</header>
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="form.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-file-text-o"></i>
                    <span>Invoice</span>
                </a>
                <ul class="sub">
                    <li><a href="form.php">ADD</a></li>
                    <li><a href="advanced_form_components.html">LIST</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="fa fa-list-alt"></i>
                    <span>Agreement</span>
                </a>
                <ul class="sub">
                    <li class=""><a href="agreement.php">ADD</a></li>
                    <li><a href="advanced_form_components.html">LIST</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-tasks"></i>
                    <span>Item</span>
                </a>
                <ul class="sub">
                    <li>
                        <a href="item.php">
                            
                            <span>ADD</span>
                        </a>
                    </li>
                    <li><a href="advanced_form_components.html">LIST</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="profile.php">
                    <i class="fa fa-user"></i>
                    <span>Profile</span>
                </a>

            </li>
            <li class="sub-menu">
                <a href="company.php">
                    <i class="fa fa-home"></i>
                    <span>Company Profile</span>
                </a>

            </li>


            <!--multi level menu end-->


        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>