<?php

session::init();

//print_r($this->checkclientplan);
//exit();
    
    if(empty($this->checkclientplan)){

    }else
    {
      $paidstatus=$this->checkclientplan['paid'];
      if($paidstatus=='N'){
        if(empty($this->checkforpayments)){
          //since its empty
          //check tbl_transactions for details of all payment withpout paid status Y
          $amount=$this->sumtransactionnotpaid['creditbalance'];

          Session::set("amount",$amount);
            for ($randomNumber = mt_rand(1, 10), $i = 1; $i < 10; $i++) {
                $randomNumber .= mt_rand(0, 10);
              }
              Session::set("orderno",$randomNumber);
              Session::set("fresh",'NO');
              header('location: '. URL . 'newhoogpay');
          //sum it and create orderno
          // then move to new payment
        }else
        {
          $amount=$this->checkforpayments['amount'];
          $orderno=$this->checkforpayments['orderno'];
          $pstatus=$this->checkforpayments['pstatus'];
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
          

      }else
      {
         header('location: '. URL . 'maindashboard');
      }
     
    }



 ?>

<title>Dashboard | Rent Banking</title>
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
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                   
                                   
                                   
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
                                                    
                                                </div>
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
                                                    <a href="#" class="btn btn-white btn-light">
                                                        Choose a Plan <em class="icon ni ni-arrow-long-right ms-2"></em>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="nk-block-des">
                                                <p>Start your contributory rent account.</p>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="nk-news card card-bordered">
                                        <div class="card-inner">
                                            <div class="nk-news-list">
                                                <a class="nk-news-item" href="#">
                                                    <div class="nk-news-icon">
                                                        <em class="icon ni ni-card-view"></em>
                                                    </div>
                                                    <div class="nk-news-text">
                                                        <p>
                                                            RentBanking saves you from Landlord!<span>Enjoy our service!</span>
                                                        </p>
                                                        <em class="icon ni ni-external"></em>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="card card-bordered card-preview">
                                       <div class="card-inner">
                                           <div class="preview-block">
                                               <span class="preview-title-lg overline-title">Choose A Rent Plan</span>
                                               <div class="row gy-4">
                                                 <div class="col-lg-4 col-sm-6">
                                                     <div class="form-group">
                                                         <div class="form-control-wrap">
                                                           <script type="text/javascript">
                                                            function getvalue(val){
                                                              document.getElementById("rentvalue").value = val;
                                                             var for12=document.getElementById('text1');
                                                             var for11=document.getElementById('text2');
                                                             var for10=document.getElementById('text3');
                                                             var for9=document.getElementById('text4');
                                                             var for8=document.getElementById('text5');
                                                             var for7=document.getElementById('text6');
                                                             var for6=document.getElementById('text7');
                                                             var for5=document.getElementById('text8');
                                                             var for4=document.getElementById('text9');


                                                             if(val==12){
                                                               document.getElementById("nmonthtopay").value = 9;
                                                               document.getElementById("nbenefitno").value = 3;
                                                               for12.style.display='block';
                                                               for11.style.display='none';
                                                               for10.style.display='none';
                                                               for9.style.display='none';
                                                               for8.style.display='none';
                                                               for7.style.display='none';
                                                               for6.style.display='none';
                                                               for5.style.display='none';
                                                               for4.style.display='none';
                                                             }
                                                             else if(val==11){
                                                               document.getElementById("nmonthtopay").value = 9;
                                                               document.getElementById("nbenefitno").value = 3;
                                                               for11.style.display='block';
                                                               for12.style.display='none';
                                                               for10.style.display='none';
                                                               for9.style.display='none';
                                                               for8.style.display='none';
                                                               for7.style.display='none';
                                                               for6.style.display='none';
                                                               for5.style.display='none';
                                                               for4.style.display='none';
                                                             }
                                                             else if(val==10){
                                                               document.getElementById("nmonthtopay").value = 8;
                                                               document.getElementById("nbenefitno").value = 2;
                                                               for10.style.display='block';
                                                               for11.style.display='none';
                                                               for12.style.display='none';
                                                               for9.style.display='none';
                                                               for8.style.display='none';
                                                               for7.style.display='none';
                                                               for6.style.display='none';
                                                               for5.style.display='none';
                                                               for4.style.display='none';

                                                             }
                                                             else if(val==9){
                                                               document.getElementById("nmonthtopay").value = 7;
                                                               document.getElementById("nbenefitno").value = 2;
                                                               for9.style.display='block';
                                                               for11.style.display='none';
                                                               for10.style.display='none';
                                                               for12.style.display='none';
                                                               for8.style.display='none';
                                                               for7.style.display='none';
                                                               for6.style.display='none';
                                                               for5.style.display='none';
                                                               for4.style.display='none';
                                                             }
                                                             else if(val==8){
                                                               document.getElementById("nmonthtopay").value = 6;
                                                               document.getElementById("nbenefitno").value = 2;
                                                               for8.style.display='block';
                                                               for11.style.display='none';
                                                               for10.style.display='none';
                                                               for9.style.display='none';
                                                               for12.style.display='none';
                                                               for7.style.display='none';
                                                               for6.style.display='none';
                                                               for5.style.display='none';
                                                               for4.style.display='none';
                                                             }
                                                             else if(val==7){
                                                               document.getElementById("nmonthtopay").value = 6;
                                                               document.getElementById("nbenefitno").value = 1;
                                                               for7.style.display='block';
                                                               for11.style.display='none';
                                                               for10.style.display='none';
                                                               for9.style.display='none';
                                                               for8.style.display='none';
                                                               for12.style.display='none';
                                                               for6.style.display='none';
                                                               for5.style.display='none';
                                                               for4.style.display='none';
                                                             }
                                                             else if(val==6){
                                                               document.getElementById("nmonthtopay").value = 5;
                                                               document.getElementById("nbenefitno").value = 1;
                                                               for6.style.display='block';
                                                               for11.style.display='none';
                                                               for10.style.display='none';
                                                               for9.style.display='none';
                                                               for8.style.display='none';
                                                               for7.style.display='none';
                                                               for12.style.display='none';
                                                               for5.style.display='none';
                                                               for4.style.display='none';
                                                             }
                                                             else if(val==5){
                                                               document.getElementById("nmonthtopay").value = 4;
                                                               document.getElementById("nbenefitno").value = 1;
                                                               for5.style.display='block';
                                                               for11.style.display='none';
                                                               for10.style.display='none';
                                                               for9.style.display='none';
                                                               for8.style.display='none';
                                                               for7.style.display='none';
                                                               for6.style.display='none';
                                                               for12.style.display='none';
                                                               for4.style.display='none';
                                                             }
                                                             else if(val==4){
                                                               document.getElementById("nmonthtopay").value = 3;
                                                               document.getElementById("nbenefitno").value = 1;
                                                               for4.style.display='block';
                                                               for11.style.display='none';
                                                               for10.style.display='none';
                                                               for9.style.display='none';
                                                               for8.style.display='none';
                                                               for7.style.display='none';
                                                               for6.style.display='none';
                                                               for5.style.display='none';
                                                               for12.style.display='none';
                                                             }
                                                            }
                                                            function divide(val){
                                                              var nrentvalue=document.getElementById("rentvalue").value
                                                            var total=  val / nrentvalue;
                                                            document.getElementById("outlined").placeholder = total;
                                                            document.getElementById("outlined").value = total;

                                                            }

                                                            </script>
                                                            <form class="" action="<?php echo URL; ?>dashboard/saveclientrent" method="post" enctype="multipart/form-data">
                                                           <?php
                                                           echo "<select class='form-select js-select2' data-ui='xl' id='outlined-select' onchange='getvalue(this.value)'; name='targetmonths'>";
                                                            foreach ($this->getplans as $key => $value) {
                                                              $benefitno=$value["benefitno"];
                                                              $monthtopay=$value['monthtopay'];

                                                              $targetmonths=$value['targetmonths'];
                                                              echo "<option value='$targetmonths'>$targetmonths</option>";


                                                              }
                                                            echo "</select>";

                                                            ?>

                                                             <label class="form-label-outlined" for="outlined-select">Rent Plan</label>
                                                         </div>
                                                         <p id="text1" style="display:none;">Pay <span style="color:red; ">9</span> months rent Save /  <span style="color:#1EE0AC">3</span> months rent </p>
                                                         <p id="text2" style="display:none;">Pay <span style="color:red; ">9</span> months rent Save /  <span style="color:#1EE0AC">3</span> months rent </p>
                                                         <p id="text3" style="display:none;">Pay <span style="color:red; ">8</span> months rent Save /  <span style="color:#1EE0AC">2</span> months rent </p>
                                                         <p id="text4" style="display:none;">Pay <span style="color:red; ">7</span> months rent Save /  <span style="color:#1EE0AC">2</span> months rent </p>
                                                         <p id="text5" style="display:none;">Pay <span style="color:red; ">6</span> months rent Save /  <span style="color:#1EE0AC">2</span> months rent </p>
                                                         <p id="text6" style="display:none;">Pay <span style="color:red; ">6</span> months rent Save /  <span style="color:#1EE0AC">2</span> months rent </p>
                                                         <p id="text7" style="display:none;">Pay <span style="color:red; ">5</span> months rent Save /  <span style="color:#1EE0AC">1</span> months rent </p>
                                                         <p id="text8" style="display:none;">Pay <span style="color:red; ">4</span> months rent Save /  <span style="color:#1EE0AC">1</span> months rent </p>
                                                         <p id="text9" style="display:none;">Pay <span style="color:red; ">3</span> months rent Save /  <span style="color:#1EE0AC">1</span> months rent </p>

                                                     </div>
                                                 </div>

                                                   <div class="col-lg-4 col-sm-6">
                                                       <div class="form-group">
                                                           <div class="form-control-wrap">
                                                             <input type="hidden" name="" id="rentvalue" value="12">
                                                               <input type="number" class="form-control form-control-xl form-control-outlined" id="outlined-normal" min="60000" name="targetamount" oninput="divide(this.value)" required>
                                                               <label class="form-label-outlined" for="outlined-normal">Target Amount</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="col-lg-4 col-sm-6">
                                                       <div class="form-group">
                                                           <div class="form-control-wrap">
                                                             <input type="hidden" name="monthtopay" id="nmonthtopay" value="9">
                                                             <input type="hidden" name="benefitno" id="nbenefitno" value="3">

                                                               <input type="number" class="form-control form-control-xl form-control-outlined" id="outlined" name="monthlypayment" readonly placeholder="Monthly payment" value="">
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="col-lg-4 col-sm-6">
                                                       <div class="form-group">
                                                           <div class="form-control-wrap">
                                                               <input type="number" class="form-control form-control-xl form-control-outlined" min="2000" name="deposit" id="outlined-normal" required>
                                                               <label class="form-label-outlined" for="outlined-normal">Intial Deposit</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="nk-kycfm-action pt-2">
                                                        <button type="submit" class="btn btn-lg btn-primary">Activate</button>
                                                    </div>
                                                  </form>
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
                                &copy;2022 DreamCity HES Ltd & Hoog ENSTOL Ltd. 
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
