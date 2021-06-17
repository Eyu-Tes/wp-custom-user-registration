<?php

function custom_user_registration() {
    $username = $password = $email = $website = $first_name = $last_name = $bio = '';
    if ( isset($_POST['submit'] ) ) {
        $reg_errors = registration_validation(
            $_POST['username'], $_POST['password'], $_POST['email'], $_POST['website']
        );

        // sanitize user form input
        $username   =   sanitize_user( $_POST['username'] );
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );
        $website    =   esc_url( $_POST['website'] );
        $first_name =   sanitize_text_field( $_POST['fname'] );
        $last_name  =   sanitize_text_field( $_POST['lname'] );
        $bio        =   esc_textarea( $_POST['bio'] );

        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration(
            $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $bio
        );

        global $submitted;
        if ($submitted) {
            unset($_POST);
            $username = $password = $email = $website = $first_name = $last_name = $bio = '';
        }
    }

    registration_form(
        $username, $password, $email, $website, $first_name, $last_name, $bio
    );
}

function complete_registration($reg_errors, $username, $password, $email, $website, $first_name, $last_name, $bio)
{
    global $submitted;
    $submitted = false;
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
            'user_login'    =>   $username,
            'user_email'    =>   $email,
            'user_pass'     =>   $password,
            'user_url'      =>   $website,
            'first_name'    =>   $first_name,
            'last_name'     =>   $last_name,
            'description'   =>   $bio,
        );
        wp_insert_user( $userdata );
        $submitted = true;
    }
}

function registration_validation( $username, $password, $email, $website): ?WP_Error {
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    if ( 4 > strlen( $username ) ) {
        $reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', 'Sorry, that username already exists!');

    if ( ! validate_username( $username ) ) {
        $reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
    }

    if ( 5 > strlen( $password ) ) {
        $reg_errors->add( 'password', 'Password length must be greater than 5' );
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add( 'email_invalid', 'Email is not valid' );
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add( 'email', 'Email Already in use' );
    }

    if ( ! empty( $website ) ) {
        if ( ! filter_var( $website, FILTER_VALIDATE_URL ) ) {
            $reg_errors->add( 'website', 'Website is not a valid URL' );
        }
    }

    global $errors;
    if (is_wp_error($reg_errors)) {
        $errors = $reg_errors->get_error_messages();
    }

    return $reg_errors;
}

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
