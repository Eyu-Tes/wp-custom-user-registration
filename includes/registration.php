<?php

function registration_form($username='', $password='', $email='', $website='', $first_name='', $last_name='', $bio='')
{ ?>
	<div class="d-flex flex-column justify-content-center align-items-center" id="registration-container">
        <h1 class="my-4">User Registration Form</h1>
        <form method="post">
            <div class="row m-0">
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <label for="username">Username <strong>*</strong></label>
                        <input type="text" name="username" value="<?php echo $_POST['username'] ?? $username; ?>" class="form-control" autofocus>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <label for="password">Password <strong>*</strong></label>
                        <input type="password" name="password" value="<?php echo $_POST['password'] ?? $password; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <label for="email">Email <strong>*</strong></label>
                        <input type="text" name="email" value="<?php echo $_POST['email'] ?? $email; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <label for="website">Website</label>
                        <input type="text" name="website" value="<?php echo $_POST['website'] ?? $website; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <label for="firstname">First Name</label>
                        <input type="text" name="fname" value="<?php echo $_POST['fname'] ?? $first_name; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <label for="website">Last Name</label>
                        <input type="text" name="lname" value="<?php echo $_POST['lname'] ?? $last_name; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="bio">About / Bio</label>
                    <textarea name="bio" cols="5" class="form-control"><?php echo $_POST['bio'] ?? $bio; ?></textarea>
                </div>
                <div class="d-grid mt-3">
                    <input type="submit" name="submit" value="Register" class="btn btn-outline-secondary"/>
                </div>
            </div>
        </form>
    </div>
<?php } ?>
