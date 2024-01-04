<title>Register | Rent Banking</title>
<body class="nk-body bg-white npc-general pg-auth">
        <div class="nk-app-root">
            <div class="nk-main ">
                <div class="nk-wrap nk-wrap-nosidebar">
                    <div class="nk-content ">
                        <div class="nk-split nk-split-page nk-split-lg">
                            <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                                <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                    <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo">
                                        <em class="icon ni ni-info"></em>
                                    </a>
                                </div>
                                <div class="nk-block nk-block-middle nk-auth-body">
                                    <div class="brand-logo pb-5">
                                          <a href="index.html" class="logo-link">
                                            <img class="logo-light logo-img logo-img-lg" src="<?php echo URL; ?>public/images/Rentbankingblue.png"  alt="logo">
                                            <img class="logo-dark logo-img logo-img-lg" src="<?php echo URL; ?>public/images/Rentbankingblue.png"  alt="logo-dark">
                                        </a>
                                    </div>
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Register</h5>
                                            <div class="nk-block-des">
                                                <p>Create New Rent Banking Account</p>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="<?php URL ;?> register/register" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control form-control-lg" name="clientname" id="clientname" placeholder="Enter your Full name" required>
                                            </div>
                                        </div>
                                        <div class="example-alert" style="display:none;">
                                          <div class="alert alert-danger alert-icon" style="color:red;">
                                            <em class="icon ni ni-cross-circle" style="color:red;"></em>
                                            <strong style="color:red;">Mobile Number</strong> Already exists.
                                          </div>
                                        </div>
                                        <div class="form-group">                                            
                                            <div class="form-control-wrap">
                                                <input autocomplete="off" type="Number" class="form-control form-control-lg" name="mobileno" id="mobileno" placeholder="Enter your Mobile Number" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                           
                                            <div class="form-control-wrap">
                                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                </a>
                                                <input autocomplete="off" type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your password" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="form-control-wrap">
                                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="confirmpassword">
                                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                </a>
                                                <input autocomplete="off" type="password" class="form-control form-control-lg" id="confirmpassword" name="confirmpassword" placeholder="Confirm your password" required>
                                            </div>
                                        </div>
                                        <div class="example-alert" style="display:none;" id="example-alert1">
                                          <div class="alert alert-danger alert-icon" style="color:red;">
                                            <em class="icon ni ni-cross-circle" style="color:red;"></em>
                                            <strong style="color:red;"> Password</strong> does not match.
                                          </div>
                                        </div>
                                        <div class="form-group">                                            
                                            <div class="form-control-wrap">
                                                <input autocomplete="off" type="Number" class="form-control form-control-lg" name="agentmobileno" id="agentmobileno" placeholder="Enter agent Mobile Number(optional)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-control-xs custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkbox" required>
                                                <label class="custom-control-label" for="checkbox">
                                                    I agree to Rent Banking <a tabindex="-1" href="#">Privacy Policy</a>
                                                    &amp;<a tabindex="-1" href="#">Terms.</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block">Register</button>
                                        </div>
                                    </form>
                                    <div class="form-note-s2 pt-4">
                                        Already have an account ?
                                        <a href="<?php echo URL; ?>index">
                                            <strong>Sign in instead</strong>
                                        </a>
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
                                        <p>&copy;2022 Dreamcity HES Ltd. All Rights Reserved.</p>
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
        
