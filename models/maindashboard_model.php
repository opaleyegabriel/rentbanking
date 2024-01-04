<?php
class Maindashboard_Model extends Model {
    function __construct()
    {
        parent::__construct();
    }
    //check payment status
    public function checkpaymentstatus(){
      $sth=$this->db->prepare("SELECT * FROM tbl_rentbanking_clientTransactions WHERE mobileno=:mobile and paid='N'");
      $sth->execute(array(
        ':mobile'=>Session::get('currentnumber')
        ));
      return $sth->fetchAll();
    }

    public function sumthcheckedpaymentpending(){
      $sth=$this->db->prepare("SELECT sum(cr) as pendingcreditbalance FROM tbl_rentbanking_clientTransactions WHERE mobileno=:mobile AND paid='N'");
      $sth->execute(array(
        ':mobile'=>Session::get('currentnumber')
        ));
      return $sth->fetch();
    }
    //check if already inserted for approval 
    public function checkpendingapproval(){
      $sth=$this->db->prepare("SELECT * FROM tbl_rentbanking_paymenttracks WHERE mobileno=:mobile and accessed='N'");
      $sth->execute(array(
        ':mobile'=>Session::get('currentnumber')
        ));
      return $sth->fetch();
    }
    //STARTING to get details of clients rent plan --
    public function getrentinfo(){
        $sth=$this->db->prepare("SELECT * FROM tbl_rentbanking_clientplans INNER JOIN tbl_rentbanking_rentplans ON tbl_rentbanking_clientplans.TP = tbl_rentbanking_rentplans.targetmonths  WHERE mobileno=:mobileno");
        $sth->setFetchMode(PDO:: FETCH_ASSOC);
        $sth->execute(array(
          ':mobileno'=> Session::get('currentnumber')
      ));
    return $sth->fetchAll();
    }

    public function getperiod(){
        $planperiod=$this->db->prepare("SELECT MAX(month) AS lastmonth FROM tbl_rentbanking_period WHERE paid='Y' AND mobileno=:mobileno");
        $planperiod->execute(array(
          ':mobileno'=> Session::get('currentnumber')
      ));
      return $planperiod->fetchAll();
    }
    //--ENDING to get details of clients rent plan --
    public function checkclientplan(){
        $checkplan=$this->db->prepare("SELECT * FROM tbl_rentbanking_clientplans WHERE mobileno=:mobileno");
        $checkplan->execute(array(
          ':mobileno'=> Session::get('currentnumber')
      ));
        return $checkplan->fetchAll();
    }
    //STARTING to get sum of all transactions --
    public function alldeposit(){
      $sql=$this->db->prepare("SELECT  SUM(initialdeposit) AS newdeposit FROM `tbl_rentbanking_clientplans` WHERE mobileno=:mobileno ");
      $sql->setFetchMode(PDO:: FETCH_ASSOC);
      $sql->execute(array(
        ':mobileno'=> Session::get('currentnumber')
      ));
      return $sql->fetchAll();
    }
    //--ENDING to get sum of all transactions --

    //STARTING to get of all the transactions accumulations --

    public function transactionaccumulation(){
      $sql=$this->db->prepare("SELECT * FROM tbl_rentbanking_clientTransactions INNER JOIN tbl_rentbanking_period ON tbl_rentbanking_period.mobileno = tbl_rentbanking_clientTransactions.mobileno WHERE tbl_rentbanking_period.nstatus='OPEN' AND tbl_rentbanking_period.mobileno=:mobileno AND tbl_rentbanking_clientTransactions.paid='Y' ");
      $sql->setFetchMode(PDO:: FETCH_ASSOC);
      $sql->execute(array(
        ':mobileno'=> Session::get('currentnumber')
      ));
      return $sql->fetchAll();
    }
    //--ENDING to get of all the transactions accumulations --

    //STARTING this month paid transaction --

    public function monthtrn(){
      $sql=$this->db->prepare("SELECT sum(cr) as totalmonthpay FROM `tbl_rentbanking_clientTransactions` INNER JOIN tbl_rentbanking_period ON
tbl_rentbanking_period.mobileno=tbl_rentbanking_clientTransactions.mobileno
WHERE tbl_rentbanking_clientTransactions.mobileno=:mobileno AND tbl_rentbanking_period.nstatus='OPEN' AND tbl_rentbanking_clientTransactions.paid='Y';");
      $sql->setFetchMode(PDO:: FETCH_ASSOC);
      $sql->execute(array(
        ':mobileno'=> Session::get('currentnumber')
      ));
      return $sql->fetchAll();
    }
    //--ENDING this month paid transaction --

    //STARTING all payment client made--

    public function alltransactions(){
      $sql=$this->db->prepare("SELECT SUM(cr)  AS allpayments FROM  tbl_rentbanking_clientTransactions WHERE mobileno=:mobileno AND paid='Y'");
      $sql->setFetchMode(PDO:: FETCH_ASSOC);
      $sql->execute(array(
        ':mobileno'=> Session::get('currentnumber')
      ));
      return $sql->fetchAll();
    }
    //--ENDING all payment client made --
    //STARTING the payment code --
    public function savepayment($data){
      $MAA = $data['MA'] - $data['activeamount'];
      //--test MAA--//
      //echo $MAA;//
      //first check if there is open period
      $sthopen=$this->db->prepare("SELECT * FROM  tbl_rentbanking_period WHERE mobileno=:mobile AND nstatus=:nstatus");
      $sthopen->execute(array(
        ':mobile'=>$data['mobileno'],
        ':nstatus'=>'OPEN'
        ));
      $operesult= $sthopen->fetchAll();
      $x=0;
      foreach ($operesult as $key => $value) {
        # code...
        $x=$x+1;
      }     
     
     // $roll=$operesult->rowCount();
      if($x > 0){
          //OPEN PERIOD
                echo "i want to work here";
               // exit();
               if ($data['deposit']==$MAA) {
                
                  //--STARTING close open period on tbl_rentbanking_period --//
                  $sthupdate=$this->db->prepare("UPDATE tbl_rentbanking_period SET nstatus=:nstatus WHERE mobileno=:mobileno");
                  $sthupdate->execute(array(
                    ':nstatus'=>'CLOSED',
                    ':mobileno'=>$data['mobileno']
                  ));
                  //--ENDING close open period on tbl_rentbanking_period --//
                  //STARTING get value from tbl_rentbanking_period//
                  $mynewdata=$this->db->prepare("SELECT MAX(month) AS 'lastmonth' FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $mynewdata->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result=$mynewdata->fetch();
                  $rows=$mynewdata->rowCount();
                  if($rows > 0){         
                    $lastmonth=$result['lastmonth'];
                  }

                  $mynewdata1=$this->db->prepare("SELECT * FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $mynewdata1->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result1=$mynewdata1->fetch();
                  $rows1=$mynewdata1->rowCount();
                  if($rows1 > 0){
                    $clientplan_id=$result1['clientplan_id'];          
                  }
                  //ENDING get value from tbl_rentbanking_period//
                  //--STARTING add $MAA to tbl_rentbanking_clientTransactions --//
                  $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:clientplan_id,:mobileno,:dr,:cr,:month,:paid)");
                  $sth->execute(array(
                    ':clientplan_id'=>$clientplan_id,
                    ':mobileno'=>$data['mobileno'],
                    ':dr'=>0,
                    ':cr'=>$MAA,
                    ':month'=>$lastmonth,
                    ':paid'=>'N'

                  ));
                  echo "save1";

                  //--ENDING add $MAA to tbl_rentbanking_clientTransactions --//
                }
                if ($data['deposit'] < $MAA) {
                  //STARTING get value from tbl_rentbanking_period//
                   echo "i am try to work on deposit less than MA";
                   //exit();
                  $mynewdata=$this->db->prepare("SELECT MAX(month) AS 'lastmonth' FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $mynewdata->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result=$mynewdata->fetch();
                  $rows=$mynewdata->rowCount();
                  if($rows > 0){         
                    $lastmonth=$result['lastmonth'];
                  }

                  $mynewdata1=$this->db->prepare("SELECT * FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $mynewdata1->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result1=$mynewdata1->fetch();
                  $rows1=$mynewdata1->rowCount();
                  if($rows1 > 0){
                    $clientplan_id=$result1['clientplan_id'];          
                  }

                  
                  //ENDING get value from tbl_rentbanking_period//
                  //--STARTING add $MAA to tbl_rentbanking_clientTransactions --//
                  $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:clientplan_id,:mobileno,:dr,:cr,:month,:paid)");
                  $sth->execute(array(
                    ':clientplan_id'=>$clientplan_id,
                    ':mobileno'=>$data['mobileno'],
                    ':dr'=>0,
                    ':cr'=>$data['deposit'],
                    ':month'=>$lastmonth,
                    ':paid'=>'N'

                  ));
                  echo "save";
                  //--ENDING add $MAA to tbl_rentbanking_clientTransactions --//
                }
                if ($data['deposit'] > $MAA) {
                  // code...
                  //--STARTING close open period on tbl_rentbanking_period --//
                 
                  $sthupdateperiod=$this->db->prepare("UPDATE tbl_rentbanking_period SET nstatus=:nstatus WHERE mobileno=:mobileno");
                  $sthupdateperiod->execute(array(
                    ':nstatus'=>'CLOSED',
                    ':mobileno'=>$data['mobileno']
                  ));
                  //--ENDING close open period on tbl_rentbanking_period --//
                  //STARTING get value from tbl_rentbanking_period//
                  $thirddata=$this->db->prepare("SELECT * FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $thirddata->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result3=$thirddata->fetch();
                  $rows3=$thirddata->rowCount();
                  if($rows3 > 0){
                    $clientplan_id=$result3['clientplan_id'];         
                    $targetmonths=$result3['TP'];
                  }

                  $forthdata=$this->db->prepare("SELECT  MAX(month) AS 'lastmonth' FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $forthdata->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result4=$forthdata->fetch();
                  $rows4=$forthdata->rowCount();
                  if($rows4 > 0){          
                    $lastmonth=$result4['lastmonth'];         

                  }
                  $fiftdata=$this->db->prepare("SELECT MAX(endmonth) AS 'lastendmonth' FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $fiftdata->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result5=$fiftdata->fetch();
                  $rows5=$fiftdata->rowCount();
                  if($rows5 > 0){         
                    $endmonth=$result5['lastendmonth'];
                  }
                  //ENDING get value from tbl_rentbanking_period//
                  //--STARTING add $MAA to tbl_rentbanking_clientTransactions --//
                  $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:clientplan_id,:mobileno,:dr,:cr,:month,:paid)");
                  $sth->execute(array(
                    ':clientplan_id'=>$clientplan_id,
                    ':mobileno'=>$data['mobileno'],
                    ':dr'=>0,
                    ':cr'=>$MAA,
                    ':month'=>$lastmonth,
                    ':paid'=>'N'
                  ));
                  //--ENDING add $MAA to tbl_rentbanking_clientTransactions --//
                  //get deposit balance
                  $depositbal= $data['deposit'] - $MAA;
                  $x=1;

                  //echo $depositbal;
                  //echo $data['deposit'];
                  //echo $MAA;
                  while ($depositbal > 0) {
                    //check if deposit balance is less than monthlypayment
                    //if its true
                    //insert and stop
                    //if its false
                    //insert and continue
                    if ($depositbal < $data['MA']){
                      // code...
                      $nn= $x *31;
                      $nnn= $nn . " days";
                      //do the month
                      $date=date_create($endmonth);
                      $newendmonth=date_add($date,date_interval_create_from_date_string($nnn));
                      $newendmonth=date_format($date,"Y-m-d H:i:s");
                      $lastmonth=$lastmonth + 1;
                      $m=$lastmonth;
                      $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:paid)");
                      $sth->execute(array(
                        ':clientplan_id'=>$clientplan_id,
                        ':month'=>$m,
                        ':endmonth'=>$newendmonth,
                        ':mobileno'=>Session::get('currentnumber'),
                        ':targetmonths'=>$targetmonths,
                        ':nstatus'=>'OPEN',
                        ':paid'=>'N'
                      ));
                      $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:paid)");
                      $sthTran->execute(array(
                        ':cid'=>$clientplan_id,
                        ':mobileno'=>$data['mobileno'],
                        ':dr'=>0,
                        ':cr'=>$depositbal,
                        ':month'=>$m,
                        ':paid'=>'N'
                      ));
                      $depositbal=0;
                      echo "Savelast";
                    }
                    else{
                      $nn= $x *31;
                      $nnn= $nn . " days";
                      $x++;
                      //do the month
                      $date=date_create($endmonth);
                      $newendmonth=date_add($date,date_interval_create_from_date_string($nnn));
                      $newendmonth=date_format($date,"Y-m-d H:i:s");
                      $lastmonth=$lastmonth + 1;
                      $my=$lastmonth;
                      //echo $my;
                      $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:paid)");
                      $sth->execute(array(
                        ':clientplan_id'=>$clientplan_id,
                        ':month'=>$my,
                        ':endmonth'=>$newendmonth,
                        ':mobileno'=>Session::get('currentnumber'),
                        ':targetmonths'=>$targetmonths,
                        ':nstatus'=>'CLOSED',
                        ':paid'=>'N'
                      ));
                      $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:paid)");
                      $sthTran->execute(array(
                        ':cid'=>$clientplan_id,
                        ':mobileno'=>$data['mobileno'],
                        ':dr'=>0,
                        ':cr'=>$data['MA'],
                        ':month'=>$my,
                        ':paid'=>'N'
                      ));
                      $depositbal=$depositbal-$data['MA'];
                      echo "Save2";
                    }
                    // code...
                  }
                }
        //END OPEN PERIOD
      }else{
        //CLOSED PERIOD
        //GET ALL NEEDED VALUE from tbl_rentbanking_period
        

                  $thirddata=$this->db->prepare("SELECT * FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $thirddata->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result3=$thirddata->fetch();
                  $rows3=$thirddata->rowCount();
                  if($rows3 > 0){
                    $clientplan_id=$result3['clientplan_id'];         
                    $targetmonths=$result3['TP'];
                  }

                  $forthdata=$this->db->prepare("SELECT  MAX(month) AS 'lastmonth' FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $forthdata->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result4=$forthdata->fetch();
                  $rows4=$forthdata->rowCount();
                  if($rows4 > 0){          
                    $lastmonth=$result4['lastmonth'];         

                  }
                  $fiftdata=$this->db->prepare("SELECT MAX(endmonth) AS 'lastendmonth' FROM tbl_rentbanking_period WHERE mobileno=:mobileno");
                  $fiftdata->execute(array(
                    ':mobileno'=> $data['mobileno']
                  ));
                  $result5=$fiftdata->fetch();
                  $rows5=$fiftdata->rowCount();
                  if($rows5 > 0){         
                    $endmonth=$result5['lastendmonth'];
                  }

                  //start code just like dashboard own
                  if ($data['deposit'] <= $data['MA']) 
                    {
                          $lastmonth=$lastmonth+1;
                          $date=date_create($endmonth);
                          $mydate=date_add($date,date_interval_create_from_date_string("31 days"));
                          $endmonth=date_format($date,"Y-m-d H:i:s");
                          //echo "<pre>";
                          //print_r($result);
                          //exit();
                          if($data['deposit'] < $data['MA']){
                            $nstatus="OPEN";
                          }
                          else{
                            $nstatus="CLOSED";
                          }
                          $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:paid)");
                          $sth->execute(array(
                            ':clientplan_id'=>$clientplan_id,
                            ':month'=>$lastmonth,
                            ':endmonth'=>$endmonth,
                            ':mobileno'=>$data['mobileno'],
                            ':targetmonths'=>$targetmonths,
                            ':nstatus'=>$nstatus,
                            ':paid'=>'N'
                            ));

                          $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:paid)");
                          $sthTran->execute(array(
                            ':cid'=>$clientplan_id,
                            ':mobileno'=>$data['mobileno'],
                            ':dr'=>0,
                            ':cr'=>$data['deposit'],
                            ':month'=>$lastmonth,
                            ':paid'=>'N'
                            ));
                            echo "save ne new";
                          
                          

                    }
                    //second condition where people contribute greater than the first amount
    
                if ($data['deposit'] > $data['MA']) 
                {
                  // code...
                      $lastmonth=$lastmonth+1;
                        $date=date_create($endmonth);
                        date_add($date,date_interval_create_from_date_string("30 days"));
                        $endmonth=date_format($date,"Y-m-d H:i:s");
                     
                      //exit();
                  
                      $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:paid)");
                      $sth->execute(array(
                        ':clientplan_id'=>$clientplan_id,
                        ':month'=>$lastmonth,
                        ':endmonth'=>$endmonth,
                        ':mobileno'=>$data['mobileno'],
                        ':targetmonths'=>$targetmonths,
                        ':nstatus'=>'CLOSED',
                        ':paid'=>'N'
                        ));

                        $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:paid)");
                      $sthTran->execute(array(
                        ':cid'=>$clientplan_id,
                        ':mobileno'=>$data['mobileno'],
                        ':dr'=>0,
                        ':cr'=>$data['MA'],
                        ':month'=>$lastmonth,
                        ':paid'=>'N'
                        ));





                        
                        $depositbal= $data['deposit'] - $data['MA'];
                       // $date=date_create($endmonth);
                        //$newendmonth=date_add($date,date_interval_create_from_date_string("30 days"));
                        //$newendmonth=date_format($date,"Y-m-d H:i:s");
                            $x=1;
                            while ($depositbal > 0) 
                            {
                              // code...
                              //check if deposit balance is less than monthlypayment
                              //if its true
                              //insert and stop
                              //if its false
                              //insert and continue
                                          if ($depositbal < $data['MA']) 
                                          {
                                            // code...
                                            $nn= $x *31;
                                            $nnn= $nn . " days";
                                            //do the month
                                                $date=date_create($endmonth);
                                                $newendmonth=date_add($date,date_interval_create_from_date_string($nnn));
                                                $newendmonth=date_format($date,"Y-m-d H:i:s");

                                            //
                                                $m=$lastmonth++;
                                            $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:paid)");
                                            $sth->execute(array(
                                              ':clientplan_id'=>$clientplan_id,
                                              ':month'=>$m,
                                              ':endmonth'=>$newendmonth,
                                              ':mobileno'=>Session::get('currentnumber'),
                                              ':targetmonths'=>$targetmonths,
                                              ':nstatus'=>'OPEN',
                                              ':paid'=>'N'
                                              ));

                                            $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:paid)");
                                          $sthTran->execute(array(
                                            ':cid'=>$clientplan_id,
                                            ':mobileno'=>$data['mobileno'],
                                            ':dr'=>0,
                                            ':cr'=>$depositbal,
                                            ':month'=>$m,
                                            ':paid'=>'N'
                                            ));
                                              $depositbal=0;
                                              
                                          }
                                          else 
                                          {

                                            
                                            
                                            $nn= $x *31;
                                            $nnn= $nn . " days";
                                            $x++;
                                            //do the month
                                                $date=date_create($endmonth);
                                                $newendmonth=date_add($date,date_interval_create_from_date_string($nnn));
                                                $newendmonth=date_format($date,"Y-m-d H:i:s");

                                            // code...
                                             $my=$lastmonth++;
                                            $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:paid)");
                                            $sth->execute(array(
                                              ':clientplan_id'=>$clientplan_id,
                                              ':month'=>$my,
                                              ':endmonth'=>$newendmonth,
                                              ':mobileno'=>Session::get('currentnumber'),
                                              ':targetmonths'=>$targetmonths,
                                              ':nstatus'=>'CLOSED',
                                              ':paid'=>'N'
                                              ));

                                            $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:paid)");
                                          $sthTran->execute(array(
                                            ':cid'=>$clientplan_id,
                                            ':mobileno'=>$data['mobileno'],
                                            ':dr'=>0,
                                            ':cr'=>$data['MA'],
                                            ':month'=>$my,
                                            ':paid'=>'N'
                                            ));
                                                $depositbal=$depositbal-$data['MA'];
                                              
                                          }                 
                            }
                        }
                  //end code just like dashboard own


        //END CLOSED PERIOD
      }
               
        //create session to hold some values
            Session::set("amount",$data['deposit']);
            for ($randomNumber = mt_rand(1, 10), $i = 1; $i < 10; $i++) {
                $randomNumber .= mt_rand(0, 10);
              }
              Session::set("orderno",$randomNumber);
              Session::set("fresh",'NO');

      echo '<script type="text/javascript">';
      echo 'window.location.href = "https://dreamcityhes.com/rentbanking/newhoogpay";';
      echo "</script>";
      
      
    }


    //--ENDING the payment code --



}
