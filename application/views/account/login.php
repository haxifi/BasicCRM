<title>Accesso al Pannello</title>
<link rel="stylesheet" href="<?php echo $homepage;?>assets/css/loginForm.css">
<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="<?php echo $homepage;?>assets/img/default-user.png" class="brand_logo" alt="Logo">
                </div>
            </div>

            <?php if(isset($error_message)): ?>
                <div class="message"><?php echo $error_message; ?></div>
            <?php  endif; ?>

            <div class="d-flex justify-content-center">

                <?php echo form_open('account/login'); ?>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>

                        <input type="text" name="username" class="form-control input_user" value="" placeholder="Username">
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control input_pass" value="" placeholder="Password">
                    </div>

                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" name="button" class="btn btn-primary">Accedi</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <?php if (isset($this->session->userdata['logged_in'])) header("location: dashboard/"); ?>

</div>

