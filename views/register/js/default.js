$(document).ready(function(){
  $("#mobileno").focusout(function(){
    var mobileno=$('#mobileno').val();
      $.post("register/mobileno",
      {mobileno:mobileno},
      function(data)
      {
        var myresponse=(data.found_status);
        if (mobileno=="") {}
        else if(myresponse=="Yes")
        {
           $('#mobileno').val("");
           setTimeout(function(){
                $(".example-alert").css("display","block" ).delay(9000).fadeOut('1000');
               },);
        }
  },'json');

  });
  $('#confirmpassword').focusout(function(){
    var confirmpassword=$('#confirmpassword').val();
    if (confirmpassword=="") {}
    else if ($("#confirmpassword").val()!=$("#password").val() ) {
      $('#password').val("");
      $('#confirmpassword').val("");
      setTimeout(function(){
        $("#example-alert1").css("display","block" ).delay(9000).fadeOut('1000');
      }, );
    }
  });
  });
