<div class="splash-container bg-white photography-form">
    <div class="card-header text-center">
        <a href="/" class="mb-3 d-block"><img class="logo-img" src="<?= DIRECTORY_SEPARATOR . MEDIA_PATH ?>/LOGO.png" alt="logo"></a>
        <span class="splash-description">Please enter your user information.</span>
    </div>
    <!-- Pills navs -->
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
        </li>
    </ul>
    <!-- Pills navs -->

    <!-- Pills content -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form action="/user/login" method="POST">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" name="email" id="loginEmail" class="form-control" />
                    <label class="form-label" for="loginEmail">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="password" id="loginPassword" class="form-control" />
                    <label class="form-label" for="loginPassword">Password</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
            <form action="/user/store" method="POST">
                <div class="form-outline mb-4">
                    <input type="text" name="username" id="registerName" class="form-control" />
                    <label class="form-label" for="registerName">Name</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" name="email" id="registerEmail" class="form-control" />
                    <label class="form-label" for="registerEmail">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="password" id="registerPassword" class="form-control" />
                    <label class="form-label" for="registerPassword">Password</label>
                </div>

                <!-- Repeat Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="repeat_password" id="registerRepeatPassword" class="form-control" />
                    <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>
            </form>
        </div>
    </div>
    <?php flash('login') ?>
    <?php flash('customer_store'); ?>
    <!-- Pills content -->
</div>