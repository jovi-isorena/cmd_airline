<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation-sp.php';
?>
<div class="userLoginBg">

</div>
    <div class="container full-h" >
    <!-- <div style='background-color: red; height: 100%; width: 100%'> -->
        <div class="container" >
            <div class="row justify-content-center">
                    <?php if(isset($_SESSION['redirectMessage'])){
                        echo '<span class="alert-warning p-2 border border-warning rounded">';
                        echo $_SESSION['redirectMessage'];
                        echo "</span>";
                        unset($_SESSION['redirectMessage']);
                    }
                    
                    ?>
                
            </div>
            <div class="mt-5 p-4 col-md-4 offset-md-4 frosted" style="color: #001e60;border-radius:20px;">
                <h1 class=" text-center ">Login</h1>
                <hr style="background-color:#001e60">
                
                <?php if(isset($data['passwordError'])): ?>
                    <div class="px-2 alert-danger text-danger align-items-center rounded"><p><?php echo $data['passwordError']; ?></p></div>
                <?php endif; ?>
                <form method="post" action="<?php echo URLROOT; ?>/users/login">
                    <div class="form-group">
                        <label for="username">Email address</label>
                        <input type="email" class="form-control"  id="username" name="username" aria-describedby="emailHelp" placeholder="Enter email"  autocomplete="off">
                        <small id="emailHelp" class="form-text text-muted
                        ">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <a href="#">Forgot your password?</a>
                    <button type="submit" class="btn custom-primary btn-block" name="submit">Submit</button>
                </form>
                <div class="">
                    <p>Not yet registered? <a href="register">Create an account here.</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php require APPROOT . '/views/includes/foot.php'; ?>