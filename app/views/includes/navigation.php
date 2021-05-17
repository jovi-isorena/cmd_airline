<nav class=" justify-content-between navbar navbar-expand-md navbar-dark" style="background-color: #001e60;position:sticky;top:0px;z-index:1020;">
    <!-- <a class="navbar-brand m-auto brand-sm " href="./index.php"> <img src="../resources/PAL LOGO_8.png" alt="PAL LOGO" class="img-fluid" style="height:40px;"></a> -->
    <a class="navbar-brand  brand-sm " href="<?php echo URLROOT;?>"> <img src="<?php echo URLROOT;?>/public/img/PAL LOGO_8.png" alt="PAL LOGO" class="img-fluid" style="height:40px;" ></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  justify-content-around" id="navbarNavDropdown">
        <ul class="navbar-nav w-100 ml-auto" style="font-size:small;">
            <?php if(isLoggedIn()=="employee"):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT . "/flights"?>">Flight Maintenance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT . "/schedules"?>">Flight Scheduler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT?>/airports">Airports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT?>/extras">Extras</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT;?>/employees/logout" class="ml-2 nav-link btn btn-outline-primary" style="font-size:small;">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">Promo Fares<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Explore
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Menu1</a>
                        <a class="dropdown-item" href="#">Menu1</a>
                        <a class="dropdown-item" href="#">Menu1</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Travel Information
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Menu1</a>
                        <a class="dropdown-item" href="#">Menu1</a>
                        <a class="dropdown-item" href="#">Menu1</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">Promo Fares<span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="about.html">Mabuhay Miles<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">Contact Us<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <?php if(isLoggedIn() != false) : ?>
                            <a href="<?php echo URLROOT;?>/users/logout" class="ml-2 nav-link btn btn-outline-primary" style="font-size:small;">Logout</a>
                    <?php else: ?>
                        <a href="<?php echo URLROOT;?>/users/login" class="ml-2 nav-link btn btn-outline-primary" style="font-size:small;">Login</a>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
            
        </ul>
        
    
    </div>
</nav>
    
