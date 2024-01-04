$(document).ready(function(){
  $("#mobileno").focusout(function(){
    var mobileno=$('#mobileno').val();
      $.post("index/mobileno",
      {mobileno:mobileno},
      function(data)
      {
        var myresponse=(data.found_status);
        if (mobileno=="") {}
        else if(myresponse=="No")
        {
           $('#mobileno').val("");
           setTimeout(function(){
                $("#example-alert1").css("display","block" ).delay(9000).fadeOut('1000');
               },);
        }
  },'json');

  });
  $("#loginbtn").click(function()
  {
    var mobileno=$('#mobileno').val();
    var password=$('#password').val();
      $.post("index/login",
      {mobileno:mobileno, password:password},
      function(data)
      {
        var myresponse=(data.found_status);
        if (mobileno=="", password=="") {}
        else if(myresponse=="Yes")
        {
          window.location.href = "https://dreamcityhes.com/rentbanking/dashboard";
        }else {
          $('#mobileno').val("");
          $('#password').val("");
          setTimeout(function(){
               $("#example-alert2").css("display","block" ).delay(2000).fadeOut('1000');
          }, );
        }
      },'json');
    });

});
