<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(isLoggedIn()){
        header("location: " . URLROOT );
    }
?>

    <div class="container" >
    <!-- <div style='background-color: red; height: 100%; width: 100%'> -->
        <div class="container" >
            <div class="mt-5 p-4 col-md-4 offset-md-4 rounded text-white" style="background-color: #001e60;">
                <h1 class=" text-center ">Login As Employee</h1>
                <hr style="background-color:white">
                <?php if(isset($data['passwordError'])): ?>
                    <div class="px-2 alert-danger text-danger align-items-center rounded"><p><?php echo $data['passwordError']; ?></p></div>
                <?php endif; ?>
                <form method="post" action="<?php echo URLROOT; ?>/employees/login">
                    <div class="form-group">
                        <label for="username">Email address</label>
                        <input type="email" class="form-control"  id="username" name="username" aria-describedby="emailHelp" placeholder="Enter email" value=<?php echo isset($_GET['username'])?$_GET['username']:"";?>>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <a href="#">Forgot your password?</a>
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
                </form>
                <div class="">
                    <p>Not yet registered? <a href="register">Create an account here.</a></p>
                </div>
            </div>
        </div>
    </div>
