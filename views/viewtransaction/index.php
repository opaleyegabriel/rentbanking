<?php
Session::init();
  foreach ($this->getrentinfo as $key => $value){
    $benefitno=$value["benefitno"];
    $monthtopay=$value['monthtopay'];
    $monthlypayment=$value['MA'];
    $totalrentplan=$value['TA'];
    $calculatetcontribute1=$monthlypayment*$benefitno;
    $total2contribute=$monthtopay*$monthlypayment;

  }
  ?>
  <?php
  foreach ($this->alldeposit as $key => $value){
    $newdeposit=$value["newdeposit"];
  }
  ?>
  <?php
  foreach ($this->monthtrn as $key => $value){
    $totalmonthpay=$value["totalmonthpay"];
  }
  ?>
  <?php
  foreach ($this->alltransactions as $key => $value){
    $allpayments=$value["allpayments"];
  }
  ?>
  <?php
  foreach ($this->checkclientplan as $key => $value){
    $planstatus=$value["planstatus"];
    $withdrawaldate=$value["withdrawaldate"];
    $paid=$value['paid'];
  }
  ?>
  <?php
  foreach ($this->getperiod as $key => $value){
    $lastmonth=$value["lastmonth"];

  }

  //payment check
  //1. check if there is any transactions in transaction table with N
  
  if(empty($this->checkpaymentstatus)){

    //since it is empty, no existing payment to approve found
    
  }
  else
  {
                //2. Sum the value and bring it onbaord(create session for it as appropriate)
                $amount=$this->sumthcheckedpaymentpending['pendingcreditbalance'];
                //
                //echo $amount;
                //exit();


                //3. check if the value aready inserted in the paymentapproval table
                //4. if not exit
                if(empty($this->checkpendingapproval)){
                    //5 bring out the normal approval request for exact amount
                        Session::set("amount",$this->sumthcheckedpaymentpending['pendingcreditbalance']);
                        for ($randomNumber = mt_rand(1, 10), $i = 1; $i < 10; $i++) {
                            $randomNumber .= mt_rand(0, 10);
                          }
                          Session::set("orderno",$randomNumber);
                          Session::set("fresh",'NO');
                          header('location: '. URL . 'newhoogpay');
                }
                //6 if exist
                else
                {
                    //7 check the approval status
                   
                    //8 if approved (run the payment auto approved)
                        $amount=$this->checkpendingapproval['amount'];
                      $orderno=$this->checkpendingapproval['orderno'];
                      $pstatus=$this->checkpendingapproval['pstatus'];
                      if($pstatus=='Y'){
                        //check if the payment is approved at paymenttrack
                        //move to payment auto approved area
                        //autopay
                        Session::set("amount",$amount);            
                          Session::set("orderno",$orderno);
                          Session::set("fresh",'YES');
                          header('location: '. URL . 'newhoogpay');
                      }else
                      {
                                  //if not approved
                      //move to payment for approval
                        Session::set("amount",$amount);            
                          Session::set("orderno",$orderno);
                          Session::set("fresh",'NO');
                          header('location: '. URL . 'newhoogpay');
                      }
                      
                }

            
  }
  

  
   
  
  
  
  
  //9. if not approved  bring out the normal approval request for exact amount




  
  ?>
  <title>Main Dashboard | Rent Banking</title>
    }
<body class="nk-body npc-invest bg-lighter ">
        <div class="nk-app-root">
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fluid nk-header-fixed is-theme  nk-header-fixed">
                    <div class="container-xl wide-lg">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger me-sm-2 d-lg-none">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav">
                                    <em class="icon ni ni-menu"></em>
                                </a>
                            </div>
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
                                    <div class="nk-menu-trigger me-n2">
                                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav">
                                            <em class="icon ni ni-arrow-left"></em>
                                        </a>
                                    </div>
                                </div>
                                <ul class="nk-menu nk-menu-main">
                                    <li class="nk-menu-item">
                                        <a href="<?php echo URL; ?>maindashboard" class="nk-menu-link">
                                            <span class="nk-menu-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="<?php echo URL ;?>viewtransaction" class="nk-menu-link">
                                            <span class="nk-menu-text">Payment List</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="<?php echo URL; ?>userprofile" class="nk-menu-link">
                                            <span class="nk-menu-text">Profile</span>
                                        </a>
                                    </li>
                                    
                                   
                                </ul>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    
                                   
                                    <li class="hide-mb-sm">
                                        <a href="#" class="nk-quick-nav-icon">
                                            <em class="icon ni ni-signout"></em>
                                        </a>
                                    </li>
                                    <li class="dropdown user-dropdown order-sm-first">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-xl-block">
                                                    <div class="user-status user-status-verified">Active</div>
                                                    <div class="user-name dropdown-indicator"><?php echo Session::get("currentuser");?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span style=" font-variant:small-caps ;"><?php $clientname=Session::get("currentuser"); echo $clientname[0] ;?></span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?php echo Session::get("currentuser");?></span>
                                                        <span class="sub-text"><?php echo Session::get("currentnumber");?></span>
                                                    </div>
                                                    <div class="user-action">
                                                        <a class="btn btn-icon me-n2" href="/demo6/invest/profile-setting.html">
                                                            <em class="icon ni ni-setting"></em>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner user-account-info">
                                                <h6 class="overline-title-alt">Account Balance</h6>
                                                <div class="user-balance">
                                                    <?php echo '<small class="currency currency-usd">₦</small>'.number_format( $totalrentplan, 2).'<small class="currency currency-usd">k</small>' ?>
                                                </div>
                                                <div class="user-balance-sub">
                                                    Locked Till
                                                    <span>
                                                        <?php 



                                                        echo $withdrawaldate; ?>
                                                    </span>
                                                </div>                                                
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>
                                                        <a href="/demo6/invest/profile.html">
                                                            <em class="icon ni ni-user-alt"></em>
                                                            <span>View Profile</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="/demo6/invest/profile-setting.html">
                                                            <em class="icon ni ni-setting-alt"></em>
                                                            <span>Account Setting</span>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>
                                                        <a href="<?php echo URL ;?>maindashboard/logout">
                                                            <em class="icon ni ni-signout"></em>
                                                            <span>Sign out</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
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
                                            <div class="nk-block-head-sub">
                                                <span>Welcome!</span>
                                            </div>
                                            <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                                <div>
                                                    <h2 class="nk-block-title fw-normal"><?php echo Session::get("currentuser");?></h2>
                                                </div>
                                                <div>
                                                    <a href="schemes.html" class="btn btn-white btn-light">
                                                        My Plans <em class="icon ni ni-arrow-long-right ms-2"></em>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="nk-block-des">
                                                <p>At a glance summary of your rent contributions!</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                               
                                
                                 <div class="nk-block" id="payarea">
                                  <div class="row gy-gs">
                                      <div class="col-md-6 col-lg-4">
                                          <div class="nk-wg-card card card-bordered h-100">
                                              <div class="card-inner h-100">
                                                  <div class="nk-iv-wg2">
                                                      <div class="nk-iv-wg2-title">
                                                          <h6 class="title">Account Details</h6>
                                                      </div>
                                                      <div class="nk-iv-wg2-text">
                                                          <ul class="nk-iv-wg2-list">
                                                            <?php
                                                            foreach ($this->allcredittrn as $key => $value) {
                                                              // code...
                                                              $cr=$value["cr"];
                                                              $trndate=$value["trndate"];
                                                              echo "<li>";
                                                                  echo "<span class='item-label'>$trndate</span>";
                                                                  echo "<span class='item-value'>" ."₦".number_format( $cr, 2)."k"."</span>";
                                                                  echo "</li>";

                                                            }
                                                             ?>
                                                              <li class="total">
                                                                  <span class="item-label">Total</span>
                                                                  <span class="item-value"><?php  echo "" ."₦".number_format( $allpayments)."k".""; ?></span>
                                                              </li>
                                                          </ul>
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
