<?php
class Register_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function mobileno($data){
      $sql=$this->db->prepare("SELECT mobileno FROM tbl_rentbanking_users WHERE mobileno=:mobileno");
      $sql->execute(array(
        ':mobileno'=>$data['mobileno'],
      ));
      $result=$sql->fetch();
      $rows=$sql->rowCount();
      if($rows > 0){
        $message="User successfully found";
        $found_status="Yes";
        $dat=array('message'=>$message,'found_status'=>$found_status);
        echo json_encode($dat);
      }
      else{
        $message="User not found";
        $found_status="No";
        $dat=array('message'=>$message,'found_status'=>$found_status);
        echo json_encode($dat);
      }
    }
    
    public function register($data){
     $sth=$this->db->prepare("INSERT INTO tbl_rentbanking_users(mobileno,password,clientname,agentmobileno,nstatus) VALUES (:mobileno,:password,:clientname,:agentmobileno,:nstatus)");
     $sth->execute(array(
        ':clientname'=>$data['clientname'],
        ':mobileno'=>$data['mobileno'],
        ':password'=>$data['password'],              
        ':agentmobileno'=>$data['agentmobileno'],
        ':nstatus'=>'Active'
      ));
              echo '<script type="text/javascript">';
                echo 'alert("registration Complete");
                window.location.href = "https://dreamcityhes.com/rentbanking/index";';
              echo "</script>";
      

      }
                
}
