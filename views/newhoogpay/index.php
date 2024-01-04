
<title>Main Dashboard | Rent Banking</title>
<body class="nk-body npc-invest bg-lighter ">
        <div class="nk-app-root">
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fluid nk-header-fixed is-theme  nk-header-fixed">
                    <div class="container-xl wide-lg">
                        <div class="nk-header-wrap">
                            
                            <div class="nk-header-brand">
                                <a href="/demo6/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="<?php echo URL; ?>public/images/Rentbankingwhite.png" alt="logo">
                                    <img class="logo-dark logo-img" src="<?php echo URL; ?>public/images/Rentbankingwhite.png"  alt="logo-dark">
                                    <span class="nio-version"></span>
                                </a>
                            </div>
                            <div class="nk-header-menu" data-content="headerNav">
                                <div class="nk-header-mobile">
                                    <div class="nk-header-brand">
                                        <a href="/demo6/index.html" class="logo-link">
                                            <img class="logo-light logo-img" src="<?php echo URL; ?>public/images/Rentbankingwhite.png"  alt="logo">
                                            <img class="logo-dark logo-img" src="<?php echo URL; ?>public/images/Rentbankingwhite.png" alt="logo-dark">
                                            <span class="nio-version"></span>
                                        </a>
                                    </div>
                                    
                                </div>
                               
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="nk-content nk-content-lg nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-between-md g-3">
                                        <div class="nk-block-head-content">
                                            
                                            <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                                <div>
                                                    <h4 class="nk-block-title fw-normal"><?php echo Session::get("currentuser");?></h4>
                                                </div>
                                               
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                               
                                <div class="nk-block">
                                    <div class="row gy-gs">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="nk-wg-card is-dark card card-bordered">
                                                <div class="card-inner">
                                                    <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                            <h6 class="title">
                                                                Amount to Pay <em class="icon ni ni-info"></em>
                                                            </h6>
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                            <div class="nk-iv-wg2-amount">
                                                                
                                                                <span class="change up">
                                                                    <span class="sign"><h2 style="color: white;">N<?php  echo number_format(Session::get("amount")) ;?></h2> </span>
                                                                    
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="nk-wg-card is-s1 card card-bordered">
                                                <div class="card-inner">
                                                    <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                            <h6 class="title">
                                                                TRANSFER TO ACCOUNT DETAILS BELOW <em class="icon ni ni-info"></em>
                                                            </h6>
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                            <div class="nk-iv-wg2-amount">
                                                              
                                                                <span class="change up">
                                                                    <span class="sign">9359678015</span><BR>
                                                                    <span class="sign">(Hoog ENTSOL Ltd) FCMB Bank </span>
                                                                    
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="row gy-gs">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="nk-wg-card card card-bordered h-100">
                                                <div class="card-inner h-100">
                                                    <div class="nk-iv-wg2">
                                                       
                                                        <div class="nk-iv-wg2-text">
                                                            <div class="nk-iv-wg2-amount ui-v2"></div>
                                                            <form class="" action="<?php echo URL; ?>maindashboard/savepayment" method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                <input type="hidden" id="fresh" value="<?php echo session::get("fresh"); ?>">
                                                                  <input type="hidden" id="amount" value="<?php echo session::get("amount"); ?>">
                                                                  <input type="hidden" id="forwho" value="<?php echo session::get("currentuser"); ?>">
                                                                  <input type="hidden" id="mobileno" value="<?php echo Session::get('currentnumber') ?>">
                                                                  <input type="hidden" id="orderno" value="<?php echo Session::get('orderno') ?>">
                                                                    <input type="text" class="form-control form-control-xl form-control-outlined" id="sentfrom" name="deposit" required>
                                                                    <label class="form-label-outlined" id="label-outlined" for="outlined-normal">sender's account name</label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-iv-wg2-cta">
                                                                <button  id="newhoogpaynow" class="btn btn-primary btn-lg btn-block">I've transfered the money</button>
                                                            </div>
                                                            <br>
                                                           
                                                          </form>
                                                           <h1  style="display: none;" class="pay_section_worker3_number">0%</h1>
                                                                                                                     
                                                        </div>
                                                        <div style="display: none;" class="nk-iv-wg2-title" id="pinfo">
                                                           
                                                            <h6 class="title" id="waitinginfo">
                                                                Please wait while we confirm your payment! <em class="icon ni ni-info"></em>
                                                            </h6>
                                                            <h6 style="display: none;" class="inforaftertime">
                                                                Transfer not received yet. kindly check back in 2 hours time or contact any of our agent or customer care.
                                                            </h6> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-footer nk-footer-fluid bg-lighter">
                    <div class="container-xl wide-lg">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright">
                                &copy;2022 Dreamcity HES Limited 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
       
       
       
       
       
        <script src="<?php echo URL; ?>public/js/bundle.js"></script>
        <script src="<?php echo URL; ?>public/js/scripts.js"></script>
        <script src="<?php echo URL; ?>public/js/demo-settings.js"></script>
        <script src="<?php echo URL; ?>public/js/charts/chart-invest.js"></script>
