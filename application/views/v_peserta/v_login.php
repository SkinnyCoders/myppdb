<!-- Body Section -->
    <div class="container-fluid">
        <!-- Body Section -->
        <div class="container ">
            <div class="row justify-content-center text-center my-3">
                <div class="col-md-4 pt-3">
                    <a class="navbar-brand ml-2" href="<?= base_url(); ?>">
                        <img src="<?= base_url('assets/img/logo/logo-name-ppdb.png'); ?>"  height="42">
                    </a>
                </div>
            </div>
            <div class="row my-5 p-3 justify-content-center text-center">
                <div class="col-md-4 bg-white border-danger border rounded-lg p-3 m-1">
                    <!-- Login Form -->
                    <form id="form-login" class="form needs-validation">
                        <div class="form-group mt-3 mb-4">
                            <label for="staticUsername" class="sr-only">Username</label>
                            <input name="username_peserta" type="text" class="form-control"
                                   id="staticUsername" placeholder="Username" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input name="password_peserta" type="password" class="form-control"
                                   id="inputPassword" placeholder="Password" required>
                        </div>
                        <button id="btnForm" type="submit" class="btn btn-danger btn-lg border btn-block mt-5">
                            Login
                        </button>
                    </form>
                    <!-- End Login Form -->

                    <!-- Login Options Link -->
              <!--       <div class="row mt-3 small font-italic">
                        <div class="col text-center">
                            <a class="text-decoration-none text-dark" href="<?= site_url(); ?>?page=c_yayasan/registrasi">Create account</a>
                        </div>
                    </div> -->
                    <!-- End Login Options Link -->

                </div>
            </div>
        </div>
    </div>