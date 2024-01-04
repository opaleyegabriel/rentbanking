<?php
class Newhoogpay_model extends Model {
    function __construct()
    {
        parent::__construct();
        Session::init();
    }



    public function updatepayment($data)
    {
        $sthpaytracks=$this->db->prepare("SELECT * FROM tbl_rentbanking_paymenttracks WHERE orderno=:o AND accessed=:n AND pstatus=:y");
            $sthpaytracks->execute(array(                           
                ':o'=>Session::get("orderno"),
                ':n'=>'N',
                ':y'=>'Y'
                ));
            $ok=$sthpaytracks->fetch();
            if($ok){

                //start here
         //update tbl_rentbanking_period
           $sthperiod=$this->db->prepare("UPDATE tbl_rentbanking_period SET paid=:y WHERE mobileno=:mobile AND paid=:n");
           $sthperiod->execute(array(
           	':y'=>'Y',
           	':mobile'=>$data['mobileno'],
           	':n'=>'N'
           	));
         //update tbl_rentbanking_transactions
            $sthtrans=$this->db->prepare("UPDATE tbl_rentbanking_clientTransactions SET paid=:y WHERE mobileno=:mobile AND paid=:n");
           $sthtrans->execute(array(
           	':y'=>'Y',
           	':mobile'=>$data['mobileno'],
           	':n'=>'N'
           	));
         //update tbl_rentbanking_clientplans
            $sthclientplans=$this->db->prepare("UPDATE tbl_rentbanking_clientplans SET paid=:y WHERE mobileno=:mobile AND paid=:n");
           $sthclientplans->execute(array(
           	':y'=>'Y',
           	':mobile'=>$data['mobileno'],
           	':n'=>'N'
           	));

            

            //mark as access in tbl_paymenttracks
            $sthpaytrack=$this->db->prepare("UPDATE tbl_rentbanking_paymenttracks SET accessed=:accessed WHERE orderno=:o AND accessed=:n AND pstatus=:y");
            $sthpaytrack->execute(array(
                ':accessed'=>'Y',               
                ':o'=>Session::get("orderno"),
                ':n'=>'N',
                ':y'=>'Y'
                ));        
            $message="Your startup Payment is succefully";
             $s_status="Yes";
             $data=array('message'=>$message,'s_status'=>$s_status);
             echo json_encode($data);        //
        	}
                //end here
    }



        
   



public function check4approval($data){
        $sth=$this->db->prepare("SELECT * FROM tbl_rentbanking_paymenttracks WHERE mobileno=:e and orderno=:o AND pstatus=:y");
        $sth->execute(array(
            ':e'=> $data['mobileno'],
            ':o'=>Session::get("orderno"),
            ':y'=> 'Y'
            ));
        $rec= $sth->fetch();
        if($rec){
            $message="Payment Approved";
             $s_status="Yes";
             $d=array('message'=>$message,'s_status'=>$s_status);
             echo json_encode($d);    
        }
 }

 public function paymenttrack($data){
        $sths1=$this->db->prepare("SELECT * FROM tbl_rentbanking_paymenttracks WHERE mobileno=:mobile AND accessed=:ps");
        $sths1->execute(array(
            ':mobile'=>$data['mobileno'],
            ':ps'=>'N'
            ));
        $rec_exit=$sths1->fetch();
        if($rec_exit){
            $message="unconfirmed Payment Exist";
             $unconfirmed="Yes";
             $d=array('message'=>$message,'unconfirmed'=>$s_status);
             echo json_encode($d);   
        }else{            

    	$sth1=$this->db->prepare("INSERT INTO tbl_rentbanking_paymenttracks (mobileno,amount,orderno,forwho,sentfrom,accessed,pstatus) VALUES (:mobile,:amount,:orderno,:forwho,:sentfrom,:accessed,:pstatus)");
        $sth1->execute(array(
            ':mobile'=>$data['mobileno'],
            ':amount'=>$data['amount'],
            ':orderno'=>Session::get("orderno"),            
            ':forwho'=>Session::get("currentuser"),
            ':sentfrom'=>$data['sentfrom'],
            ':accessed'=>'N',
            ':pstatus'=>''            
            ));

		       

		        
		        $sth=$this->db->prepare("SELECT * FROM tbl_rentbanking_paymenttracks WHERE mobileno=:e AND orderno=:orderno and pstatus=:p ");        
		        $sth->execute(array(
		            ':e'=> $data['mobileno'],
		            ':orderno'=>Session::get("orderno"),
		            ':p'=> ''
		            ));
		        $rec= $sth->fetch();
		        if($rec){
		        	$message="Waiting for payment auto approval";
		             $s_status="Yes";
		             $d=array('message'=>$message,'s_status'=>$s_status);
		             echo json_encode($d);    
		        }else
		        {
		        	$message="Payment notification not sent due to bad network";
		             $s_status="No";
		             $d=array('message'=>$message,'s_status'=>$s_status);
		             echo json_encode($d); 
		        }
        }

    }

 }



