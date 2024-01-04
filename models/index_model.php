<?php
class Index_Model extends Model
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
        //  Session::set('cooperative',$_POST['cooperative']);
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
    public function login($data)
    {
     $sql=$this->db->prepare("SELECT * FROM tbl_rentbanking_users WHERE  mobileno=:mobileno AND password=:password AND nstatus='Active' ");
     $sql->execute(array(
       ':mobileno'=>$data['mobileno'],
       ':password'=>$data['password']
       ));
       $result=$sql->fetch();
       $rows=$sql->rowCount();
       if($rows > 0){
         Session::set('loggedIn',true);
         Session::set('currentuser',$result['clientname']);
         Session::set('currentnumber',$data['mobileno']);
         Session::set('id',$result['id']);
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
}
