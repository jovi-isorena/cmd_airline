<nav class="navbar navbar-expand-md navbar-dark justify-content-between w-100 navi sticky-top"  >
    <!-- <a class="navbar-brand m-auto brand-sm " href="./index.php"> <img src="../resources/PAL LOGO_8.png" alt="PAL LOGO" class="img-fluid" style="height:40px;"></a> -->
    <a class="navbar-brand  brand-sm " href="<?php echo URLROOT;?>"> <img src="<?php echo URLROOT;?>/public/img/cmdairlineswhite.png" alt="PAL LOGO" class="img-fluid" style="height:40px;" >CMD Airlines</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown"> <!--justify-content-end -->
        <ul class="navbar-nav" style="font-size:small;">
            <?php if(isLoggedIn()=="employee"):?>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo URLROOT . "/flights"?>">Flight Maintenance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo URLROOT . "/schedules"?>">Flight Scheduler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo URLROOT?>/aircrafts">Aircrafts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo URLROOT?>/airports">Airports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo URLROOT?>/extras">Extras</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link  active" href="<?php echo URLROOT?>/fares">Fares</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT;?>/employees/logout" class="ml-2 nav-link btn btn-warning" style="font-size:small;">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link  active" href="about.html">Promo Fares<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link  active dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Explore
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Menu1</a>
                        <a class="dropdown-item" href="#">Menu1</a>
                        <a class="dropdown-item" href="#">Menu1</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link  active dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Travel Information
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Menu1</a>
                        <a class="dropdown-item" href="#">Menu1</a>
                        <a class="dropdown-item" href="#">Menu1</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link  active" href="about.html">Promo Fares<span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" href="about.html">Mabuhay Miles<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="about.html">Contact Us<span class="sr-only">(current)</span></a>
                </li>
                
                <?php if(isLoggedIn() == 'user') : ?>
                    <li class="nav-item">
                        <a class="nav-link  active" href="<?php echo URLROOT;?>/users/mybookings">My Bookings<span class="sr-only">(current)</span></a>
                    </li>   
                    <!-- <li class="nav-item">
                        <a href="<?php //echo URLROOT;?>/users/logout" class="nav-link btn btn-outline-danger text-light" style="font-size:small;">Logout</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <div class="ml-3 btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hi, <span class="text-capitalize"><?php echo $_SESSION['firstname'];?></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right frosted">
                                
                                <a class="dropdown-item" href="#"><i class="fas fa-user text-dark mr-3"></i>Profile</a>
                                <a class="dropdown-item" href="<?php echo URLROOT;?>/users/mybookings"><i class="fas fa-plane-departure text-dark mr-3"></i>My Booking</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo URLROOT;?>/users/logout"><i class="fas fa-sign-out-alt text-danger mr-3"></i>Logout</a>
                            </div>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <div class="ml-3 btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Login
                            </button>
                            <div class="dropdown-menu dropdown-menu-right frosted">
                                
                                <a href="<?php echo URLROOT;?>/users/login" class="dropdown-item ">As Traveller</a>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo URLROOT;?>/employees/login" class="dropdown-item">As Employee</a>
                                
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            
        </ul>
        
    
    </div>
</nav>
<script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous">

</script>
<script>
    $(document).ready(function(){
  $(window).scroll(function(){
  	var scroll = $(window).scrollTop();
	  if (scroll > 20) {
	    $(".navbar").css("background" , "#001e60");
	  }
 
	  else{
		  $(".navbar").css("background" , "transparent");  	
	  }
  })
})
</script>
  
    
