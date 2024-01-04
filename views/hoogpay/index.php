
    <?php

    session::init();

    //print_r($this->myorders);
                        //exit();


    //if the order is empty
    /*
    if(empty($this->myorders)){
        session::set('adon',true);      
        header('location: '. URL . 'hoogpay2');
    }else{


                        foreach ($this->myorders as $key => $value) {
                            $price=$value["price"];
                            $pqty=$value["pqty"];
                            $pname=$value["pname"];
                            $orderno=$value["orderno"];
                            $deposit=$value["deposit"];
                            $debit=($price * $pqty);
                            $pid=$value["pid"];
                            $trndate=date("d-m-Y");
                            $temurl="";
                            $temurl="hoogpay/index"; 
                        }
                        if(session::get("fresh")){
                            $fresh="YES";
                        }

                        else{
                            $fresh="NO";
                        }
                           
    }
*/
    ?>
                        

<div class="pay_body">
        <div class="pay_header">
            <div class="pay_logo"><img src="<?php echo URL ?>public/images/paylogo.png"></div>
            <div class="pay_amount"><p class="pay_actualamt">NGN</p><p class="pay_email"></p></div>  
                
        </div>
        

            
        <div class="pay_section" id ="pay_section">
        <div id="daccounttext"><Input type="text" id="sentfrom" name="sentfrom" placeholder="sender account name only" class="with-border"></div>
                <div class="pay_section_worker1" id="pay_section_worker1" >
                    <p class="pay_section_text" > Transfer to account details below:</p>
                    <p class="pay_section_acctno"> 9359678015 </p>
                    <p class="pay_section_bank">(Hoog ENTSOL Ltd) FCMB Bank </p> 
                    <?php
                        echo ' <div class="card">';
                          echo '<div class="card-body">';



                          echo '

                            <input type="hidden" id="mobile" name="mobile" value='' required />
                            <input type="hidden" id="debit" name="debit" value='' required />                          
                             type="hidden" id="fresh" value='' />             
                         
                          
                            
                          
                          <div class="form-submit">                            
                            <input type="button" id="hoogpay" class="hoogpay" name="sent" value= "I have sent the money" style="background-color":red;>
                          </div>

                          <div id="checkchen"><input type="checkbox" class="with-border" id="daccount" name="daccount" value="Different Account" s/>
                                        <label for="daccount"> Allow transaction reference</label>
                                        </div>';

                           echo '</div></div>';
                         
                     ?> 

                </div>
                    <div class="pay_section_worker2" id="pay_section_worker2" style="display: none;"><p class="Unconfirmed">Payment not yet verified. This may be as a result of sender's or reciever's bank delay. Please, check back in 2 to 4 hour time!</p> <input type="Button" id="btn_retry" value="Try Again" style="display: none" /></div>
                    
                

                

                <div class="pay_section_worker3" id="pay_section_worker3" style="display: none;">
                    <div class="pay_section_worker3_container">              
                      
                      <div class="pay_section_worker3_bar">

                        <!--  $  Graphic section start -->
                        <svg>
                          <circle cx="50%" cy="50%" r="50%"></circle>
                        </svg>
                        <!--  $  Graphic section End-->

                        <!--  %  content section start -->
                        <h1 class="pay_section_worker3_number">0%</h1>
                        <h4 class="pay_section_worker3_config">Verifying Payment</h4>
                        <!-- %   content section End -->
                      </div>
                      <!--  @  body section End-->
                    </div>
                </div>
        </div>


        <div class="pay_footer">
            <div class="pay_footer_info">We Accept Transfer Only</div>
            <div class="pay_footer_logos">
            <div class="ussd"><img src="<?php echo URL ?>public/images/ussd.png"><p> USSD</p></div>
            <div class="transfer"><img src="<?php echo URL ?>public/images/transfer.png"></div>
            </div>          
        </div>

</div>
