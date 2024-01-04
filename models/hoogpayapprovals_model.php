<?php
class Hoogpayapprovals_model extends Model {
    function __construct()
    {
        parent::__construct();
        Session::init();
    }



     public function getpayments(){

        $sth=$this->db->prepare("SELECT * FROM tbl_rentbanking_paymenttracks WHERE pstatus='' order by created_at");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function approve($data)
    {
        $sth=$this->db->prepare("UPDATE tbl_rentbanking_paymenttracks SET pstatus=:p WHERE orderno=:orderno AND pstatus=:a");        
        $sth->execute(array(
            ':p'=> 'Y',
            ':orderno'=>$data['orderno'],
            ':a'=> ''
            ));        
            $message="Payment Approved";
             $s_status="Yes";
             $d=array('message'=>$message,'s_status'=>$s_status);
             echo json_encode($d);    
        
    }
    public function delete($data)
    {
        $sth=$this->db->prepare("DELETE FROM tbl_rentbanking_paymenttracks WHERE orderno=:orderno AND pstatus=:a");        
        $sth->execute(array(            
            ':orderno'=>$data['ordernod'],
            ':a'=> ''
            ));        
            $message="Payment Removed Successfully";
             $s_status="Yes";
             $d=array('message'=>$message,'s_status'=>$s_status);
             echo json_encode($d);    
        
    }
}