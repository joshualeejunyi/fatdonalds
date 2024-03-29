<!-- 
    Project : Fatdonald's
    File: nav.inc.php
    Authors: Joshua
 -->

<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
    <a class="navbar-brand" href="/">FatDonald's.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse flex-grow-0 ml-auto mr-1" id="navbarSupportedContent">
        <ul class="navbar-nav text-right">
            <li class="nav-item active">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="menu.php">Our Menu</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="news.php">News</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="locate.php">Locate Us</a>
            </li>
            
            <?php
                if (isLoggedIn()) {
            ?>
                <li class="nav-item active dropdown fdbtn">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/deliver.php">Order Now</a>
                    <a class="dropdown-item" href="/orders.php">My Orders</a>
                        <a class="dropdown-item" href="/auth/logout.php">Logout</a>
                    </div>
                    
                </li>

                <li class="nav-item active">
                    <a class="nav-link fdbtnmobile" href="/deliver.php">Order Now</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link fdbtnmobile" href="/orders.php">My Orders</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link fdbtnmobile" href="/auth/logout.php">Logout</a>
                </li>

            <?php
                } else {
            ?>
                <li class="nav-item active">
                    <a class="nav-link btn btn-primary fdbtn" href="/deliver.php">FatDelivery</a>
                    <a class="nav-link fdbtnmobile" href="/deliver.php">FatDelivery</a>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>
</nav>