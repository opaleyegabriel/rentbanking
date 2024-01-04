<?php
class Dashboard_Model extends Model {
    function __construct()
    {
        parent::__construct();
    }
    public function getplans(){
        $sth=$this->db->prepare("SELECT * FROM `tbl_rentbanking_rentplans` ");
        $sth->setFetchMode(PDO:: FETCH_ASSOC);
        $sth->execute(array(
      ));
        return $sth->fetchAll();
    }
    public function sumtransactionnotpaid(){
      $sth=$this->db->prepare("SELECT sum(cr) as creditbalance FROM tbl_rentbanking_clientTransactions WHERE mobileno=:mobileno AND paid='N'");
      $sth->execute(array(
          ':mobileno'=> Session::get('currentnumber')
      ));
        return $sth->fetch();
    }
    public function checkforpayments(){
      $checkpayment=$this->db->prepare("SELECT * FROM tbl_rentbanking_paymenttracks WHERE mobileno=:mobileno AND accessed='N'");
      $checkpayment->execute(array(
          ':mobileno'=> Session::get('currentnumber')
      ));
        return $checkpayment->fetch();
    }
      public function checkclientplan(){
        $checkplan=$this->db->prepare("SELECT * FROM tbl_rentbanking_clientplans WHERE mobileno=:mobileno");
        $checkplan->execute(array(
          ':mobileno'=> Session::get('currentnumber')
      ));
        return $checkplan->fetch();
    }
    //start here
    public function saveclientrent($data){
      $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_clientplans(mobileno,tp,ta,ma,initialdeposit,planstatus,withdrawaldate,paid) VALUES(:mobileno,:tp,:ta,:ma,:initd,:planstatus,:wthdate,:p)");
      $sth->execute(array(
            ':mobileno'=>$data['mobileno'],
            ':tp'=>$data['targetmonths'],
            ':ta'=>$data['targetamount'],
            ':ma'=>$data['monthlypayment'],
            ':initd'=>$data['deposit'],
            ':planstatus'=>'OPEN',
            ':wthdate'=>"0000-00-00",
            ':p'=>'N'
            ));
        //update the withdrawaldate
          $geteffectivedate=$this->db->prepare("SELECT * FROM tbl_rentbanking_clientplans INNER JOIN tbl_rentbanking_rentplans ON tbl_rentbanking_clientplans.TP=tbl_rentbanking_rentplans.targetmonths WHERE mobileno=:mobileno");
          $geteffectivedate->execute(array(
            ':mobileno'=> Session::get('currentnumber')
          ));
           $result=$geteffectivedate->fetch();
           $rows=$geteffectivedate->rowCount();
           if($rows > 0){
             $effectivedate=$result['effectivedate'];
             $TP=$result['TP'];
            }
           $nmonth=1;
           $wdate= $nmonth * $TP;
           $wfdate= $wdate * 31;
           $wfinaldate= $wfdate . " days";
          //do the month
           $withdrawaldate=date_create($effectivedate);
           $newwithdrawaldate=date_add($withdrawaldate,date_interval_create_from_date_string($wfinaldate));
           $newwithdrawaldate=date_format($withdrawaldate,"Y-m-d H:i:s");
           echo "$newwithdrawaldate";
           $updatedate=$this->db->prepare("UPDATE tbl_rentbanking_clientplans SET withdrawaldate=:withdrawaldate WHERE mobileno=:mobileno");
           $updatedate->execute(array(
             ':withdrawaldate'=>$newwithdrawaldate,
             ':mobileno'=>$data['mobileno']
           ));
        //end date update here
      //first general condition where people contribute less than the initial contributions
    if ($data['deposit'] <= $data['monthlypayment']) 
    {
          $mynewdata=$this->db->prepare("SELECT * FROM tbl_rentbanking_clientplans WHERE mobileno=:mobileno");
          $mynewdata->execute(array(
            ':mobileno'=> Session::get('currentnumber')
          ));
          $mynewdata->setFetchMode(PDO:: FETCH_ASSOC);
         $result=$mynewdata->fetch();
          $rows=$mynewdata->rowCount();
          if($rows > 0){
            $planid=$result['id'];
            $targetmonths=$result['TP'];
            $effectivedate=$result['effectivedate'];
          }
          $date=date_create($effectivedate);
          $mydate=date_add($date,date_interval_create_from_date_string("31 days"));
          $endmonth=date_format($date,"Y-m-d H:i:s");
          //echo "<pre>";
          //print_r($result);
          //exit();
          if($data['deposit'] < $data['monthlypayment']){
            $nstatus="OPEN";
          }
          else{
            $nstatus="CLOSED";
          }
          $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:p)");
          $sth->execute(array(
            ':clientplan_id'=>$planid,
            ':month'=>1,
            ':endmonth'=>$endmonth,
            ':mobileno'=>$data['mobileno'],
            ':targetmonths'=>$data['targetmonths'],
            ':nstatus'=>$nstatus,
            ':p'=>'N'
            ));

          $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:p)");
          $sthTran->execute(array(
            ':cid'=>$planid,
            ':mobileno'=>$data['mobileno'],
            ':dr'=>0,
            ':cr'=>$data['deposit'],
            ':month'=>1,
            ':p'=>'N'
            ));

          
          

    }
    //second condition where people contribute greater than the first amount
    $month = 2;
    if ($data['deposit'] > $data['monthlypayment']) 
    {
      // code...
          $myseconddata=$this->db->prepare("SELECT * FROM tbl_rentbanking_clientplans WHERE mobileno=:mobileno");
          $myseconddata->execute(array(
            ':mobileno'=> Session::get('currentnumber')
          ));
          $myseconddata->setFetchMode(PDO:: FETCH_ASSOC);
         $myresult=$myseconddata->fetch();
        // echo "<pre>";
         //print_r($myresult);
         //exit();
          $rows=$myseconddata->rowCount();
          if($rows > 0)
          {
            $planid=$myresult['id'];
            $targetmonths=$myresult['TP'];
            $monthlypayment=$myresult['monthlypayment'];
            $effectivedate=$myresult['effectivedate'];
            $date=date_create($effectivedate);
            date_add($date,date_interval_create_from_date_string("30 days"));
            $endmonth=date_format($date,"Y-m-d H:i:s");
          }
          //echo $targetmonths;
          //exit();
      
          $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:p)");
          $sth->execute(array(
            ':clientplan_id'=>$planid,
            ':month'=>1,
            ':endmonth'=>$endmonth,
            ':mobileno'=>Session::get('currentnumber'),
            ':targetmonths'=>$targetmonths,
            ':nstatus'=>'CLOSED',
            ':p'=>'N'
            ));

            $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:p)");
          $sthTran->execute(array(
            ':cid'=>$planid,
            ':mobileno'=>$data['mobileno'],
            ':dr'=>0,
            ':cr'=>$data['monthlypayment'],
            ':month'=>1,
            ':p'=>'N'
            ));





            
            $depositbal= $data['deposit'] - $data['monthlypayment'];
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
                              if ($depositbal < $data['monthlypayment']) 
                              {
                                // code...
                                $nn= $x *31;
                                $nnn= $nn . " days";
                                //do the month
                                    $date=date_create($endmonth);
                                    $newendmonth=date_add($date,date_interval_create_from_date_string($nnn));
                                    $newendmonth=date_format($date,"Y-m-d H:i:s");

                                //
                                    $m=$month++;
                                $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:p)");
                                $sth->execute(array(
                                  ':clientplan_id'=>$planid,
                                  ':month'=>$m,
                                  ':endmonth'=>$newendmonth,
                                  ':mobileno'=>Session::get('currentnumber'),
                                  ':targetmonths'=>$targetmonths,
                                  ':nstatus'=>'OPEN',
                                  ':p'=>'N'
                                  ));

                                $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:p)");
                              $sthTran->execute(array(
                                ':cid'=>$planid,
                                ':mobileno'=>$data['mobileno'],
                                ':dr'=>0,
                                ':cr'=>$depositbal,
                                ':month'=>$m,
                                ':p'=>'N'
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
                                 $my=$month++;
                                $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_period(clientplan_id,month,endmonth,mobileno,tp,nstatus,paid) VALUES(:clientplan_id,:month,:endmonth,:mobileno,:targetmonths,:nstatus,:p)");
                                $sth->execute(array(
                                  ':clientplan_id'=>$planid,
                                  ':month'=>$my,
                                  ':endmonth'=>$newendmonth,
                                  ':mobileno'=>Session::get('currentnumber'),
                                  ':targetmonths'=>$targetmonths,
                                  ':nstatus'=>'CLOSED',
                                  ':p'=>'N'
                                  ));

                                $sthTran=$this->db->prepare("INSERT INTO tbl_rentbanking_clientTransactions(clientplan_id,mobileno,dr,cr,month,paid) VALUES(:cid,:mobileno,:dr,:cr,:month,:p)");
                              $sthTran->execute(array(
                                ':cid'=>$planid,
                                ':mobileno'=>$data['mobileno'],
                                ':dr'=>0,
                                ':cr'=>$data['monthlypayment'],
                                ':month'=>$my,
                                ':p'=>'N'
                                ));
                                    $depositbal=$depositbal-$data['monthlypayment'];
                                  
                              }                 
                }
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
    //ends here


}
