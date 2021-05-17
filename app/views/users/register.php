<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<div class="container">
    <div class="pt-5 col-md-8 offset-md-2">
        <h1>Registration</h1>
        <hr>
        
        <div class="px-2 alert-success text-success align-items-center rounded"><p><?php echo $data['registrationComplete'];?></p></div>
        <div class="px-2 alert-danger text-danger align-items-center rounded"><p><?php echo $data['registrationError'];?></p></div>
        <form action="register" method="post">
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="fname">First Name</label>
                    <span style="color: red;">* <?php echo $data['firstNameError'];?></span>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $data['firstName'];?>">
                </div>
                <div class="form-group col-3">
                    <label for="mname">Middle Name</label>
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" value="<?php echo $data['middleName'];?>">
                </div>
                <div class="form-group col-3">
                    <label for="lname">Last Name</label>
                    <span style="color: red;">* <?php echo $data['lastNameError'];?></span>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $data['lastName'];?>">
                </div>
                <div class="form-group col-3">
                    <label for="suffix">Suffix</label>
                    <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Jr, Sr, II" value="<?php echo $data['suffix'];?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="mob">Mobile No.</label>
                    <span style="color: red;">* <?php echo $data['mobileNumberError'];?></span>
                    <input type="text" class="form-control" id="mob" name="mob" placeholder="[Area Code] + [Mobile No]" value="<?php echo $data['mobileNo'];?>">
                </div>
                <div class="form-group col-6">
                    <label for="bday">Birthday</label>
                    <span style="color: red;">* <?php echo $data['birthdayError'];?></span>
                    <input type="date" class="form-control" id="bday" name="bday" placeholder="" value="<?php echo $data['birthday'];?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                <label for="email">Email</label>
                <span style="color: red;">* <?php echo $data['emailError'];?></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?php echo $data['email'];?>">
                </div>
                <div class="form-group col-4">
                    <label for="pass">Password</label>
                    <span style="color: red;">* <?php echo $data['passwordError'];?></span>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="6-20 Alphanumeric Characters Only">
                </div>
                <div class="form-group col-4">
                    <label for="rep">Repeat Password</label>
                    <span style="color: red;">* <?php echo $data['repeatPasswordError'];?></span>
                    <input type="password" class="form-control" id="rep" name="rep" placeholder="Repeat Password">
                </div>
            </div>
            <input type="submit" value="REGISTER" class="btn btn-outline-primary w-100" name="register">
        </form>
    </div>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>