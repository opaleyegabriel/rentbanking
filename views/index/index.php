<title>Login | Rent Banking</title>
<body class="nk-body bg-white npc-general pg-auth">
        <div class="nk-app-root">
            <div class="nk-main ">
                <div class="nk-wrap nk-wrap-nosidebar">
                    <div class="nk-content ">
                        <div class="nk-split nk-split-page nk-split-lg">
                            <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                                <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                    <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo">
                                        <em class="icon ni ni-info"></em>
                                    </a>
                                </div>
                                <div class="nk-block nk-block-middle nk-auth-body">
                                    <div class="brand-logo pb-5">
                                        <a href="index.html" class="logo-link">
                                            <img class="logo-light logo-img logo-img-lg" src="<?php echo URL; ?>public/images/Rentbankingblue.png" alt="logo">
                                            <img class="logo-dark logo-img logo-img-lg" src="<?php echo URL; ?>public/images/Rentbankingblue.png"  alt="logo-dark">
                                        </a>
                                    </div>
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Sign-In</h5>
                                            <div class="nk-block-des">
                                                <p>Access the Rent Banking.</p>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="mobileno">Mobile Number</label>
                                                <a class="link link-primary link-sm" tabindex="-1" href="#">Need Help?</a>
                                            </div>
                                            <div class="form-control-wrap">
                                                <input autocomplete="off" type="Number" class="form-control form-control-lg" required id="mobileno" name="mobileno" placeholder="Enter your Mobile Number">
                                            </div>
                                        </div>
                                        <div class="example-alert" id="example-alert1" style="display:none;">
                                          <div class="alert alert-danger alert-icon" style="color:red;">
                                            <em class="icon ni ni-cross-circle" style="color:red;"></em>
                                            <strong style="color:red;">Mobile Number</strong> does not exist.
                                          </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="password">Password</label>
                                                <a class="link link-primary link-sm" tabindex="-1" href="<?php echo URL; ?>#">Forgot Code?</a>
                                            </div>
                                            <div class="form-control-wrap">
                                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                </a>
                                                <input autocomplete="new-password" type="password" class="form-control form-control-lg" required id="password" name="password" placeholder="Enter your Password">
                                            </div>
                                        </div>
                                        <div class="example-alert" id="example-alert2" style="display:none;">
                                          <div class="alert alert-danger alert-icon" style="color:red;">
                                            <em class="icon ni ni-cross-circle" style="color:red;"></em>
                                            <strong style="color:red;">Password </strong> does not match data.
                                          </div>
                                        </div><br>
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block" id="loginbtn">Sign in</button>
                                        </div>
                                    <div class="form-note-s2 pt-4">
                                        New on our platform? <a href="<?php echo URL; ?>register">Create an account</a>
                                    </div>
                                </div>
                                <div class="nk-block nk-auth-footer">
                                    <div class="nk-block-between">
                                        <ul class="nav nav-sm">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Terms &Condition</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Privacy Policy</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Help</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                    <div class="mt-3">
                                        <p>&copy;2022 DreamCity HES Ltd. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        
      
        <script src="<?php echo URL; ?>public/js/bundle.js"></script>
        <script src="<?php echo URL; ?>public/js/scripts.js"></script>
        <script src="<?php echo URL; ?>public/js/demo-settings.js"></script>
       