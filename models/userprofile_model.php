<?php
class Userprofile_Model extends Model {
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
      $sql=$this->db->prepare("SELECT * FROM tbl_rentbanking_period INNER JOIN tbl_rentbanking_clientTransactions ON tbl_rentbanking_period.month = tbl_rentbanking_clientTransactions.month WHERE tbl_rentbanking_period.nstatus='OPEN' AND tbl_rentbanking_period.mobileno=:mobileno AND tbl_rentbanking_clientTransactions.paid='Y' ");
      $sql->setFetchMode(PDO:: FETCH_ASSOC);
      $sql->execute(array(
        ':mobileno'=> Session::get('currentnumber')
      ));
      return $sql->fetchAll();
    }
    //--ENDING to get of all the transactions accumulations --

    //STARTING this month paid transaction --

    public function monthtrn(){
      $sql=$this->db->prepare("SELECT SUM(cr)  AS totalmonthpay FROM tbl_rentbanking_period INNER JOIN tbl_rentbanking_clientTransactions ON tbl_rentbanking_period.month = tbl_rentbanking_clientTransactions.month WHERE tbl_rentbanking_period.paid='Y' AND tbl_rentbanking_period.nstatus='OPEN' AND tbl_rentbanking_clientTransactions.paid='Y' AND tbl_rentbanking_period.mobileno=:mobileno   ");
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

    public function allcredittrn(){
      $sql=$this->db->prepare("SELECT  * FROM  tbl_rentbanking_clientTransactions WHERE mobileno=:mobileno  ");
      $sql->setFetchMode(PDO:: FETCH_ASSOC);
      $sql->execute(array(
        ':mobileno'=> Session::get('currentnumber')
      ));
      return $sql->fetchAll();
    }
    public function getuserprofile(){
      $checkplan=$this->db->prepare("SELECT * FROM tbl_rentbanking_profile WHERE mobileno=:mobileno ");
      $checkplan->execute(array(
        ':mobileno'=> Session::get('currentnumber')
    ));
    return $checkplan->fetchAll();
    }
  }