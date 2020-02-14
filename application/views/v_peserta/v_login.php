<!-- Body Section -->
   <div id="body-alert-danger" class="row mx-1 my-3">
            <div class="col-md-12 py-2">
                <div class="alert small alert-danger alert-dismissible fade show" role="alert">
                    <span id="text-alert-danger"></span>
                </div>
            </div>
        </div>
    <div class="container-fluid">
        
        <!-- Body Section -->
        <div class="container ">
            <div class="row justify-content-center text-center my-3">
                <div class="col-md-4 pt-3">
                    <a class="navbar-brand ml-2" href="<?= base_url(); ?>">
                        <img src="<?= base_url('assets/img/logo/logo-smk-2.png'); ?>"  height="42">
                    </a>
                </div>
            </div>
            <div class="row mt-3 mb-5 p-3 justify-content-center text-center">
                <div class="col-md-4 bg-white border-danger border rounded-lg p-3 m-1">
                    <!-- Login Form -->
                    <form id="form-login" class="form needs-validation">
                        <div class="form-group mt-3 mb-4">
                            <label for="staticUsername" class="sr-only">Email</label>
                            <input name="email" type="email" class="form-control"
                                   id="staticUsername" placeholder="Email Peserta" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input name="password" type="password" class="form-control"
                                   id="inputPassword" placeholder="Password" required>
                        </div>
                        <div style="width: 100%" class="g-recaptcha mt-3" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
                        <button id="btnForm" type="submit" class="btn btn-danger btn-lg border btn-block mt-2">
                            Login
                        </button>
                    </form>
                    <!-- End Login Form -->

                    <!-- Login Options Link -->
                    <div class="row mt-3 small font-italic">
                        <div class="col text-center">
                            <a class="text-decoration-none text-dark" href="<?= base_url('registrasi'); ?>">Mendaftar</a>
                        </div>
                    </div>
                    <!-- End Login Options Link -->

                </div>
            </div>
        </div>
    </div>

    <!-- Page JS  -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        $("#body-alert-danger").hide();
        /* Get from elements values */
        $("#form-login").submit(function(event){
            if ($('#form-login')[0].checkValidity()){
                // Prevent default posting of form - put here to work in case of errors
                event.preventDefault();
                var values = $(this).serialize();

                console.log(values);

                $.ajax({
                    url: "<?= site_url('c_home/login/auth') ?>",
                    type: "post",
                    data: values,
                    beforeSend: function() {
                        var image = '<img class="loading-button" src="' +
                            '<?= base_url("assets/img/loading/loading-button.gif"); ?>' +
                            '" />';
                        $("#btnForm").html(image);
                    },
                    success: function (response) {
                        console.log(response);
                        var data_json = JSON.parse(response);
                        $("#btnForm").html("Login");
                        if (data_json.tipe == 'error'){
                            $("#text-alert-danger").html(data_json.msg);
                            $("#body-alert-danger").show();
                        }else{
                            window.location.href = "<?= base_url('peserta'); ?>";
                        }
                    },
                    error: function() {
                        $("#text-alert-danger").html("Server Error");
                        $("#body-alert-danger").show();
                    }
                });
            }

        });
    </script>