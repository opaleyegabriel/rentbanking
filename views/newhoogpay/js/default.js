$(document).ready(function(){

	//const paymentForm = document.getElementById('paymentForm');
	//const paymentForm=$('#paymentForm');
	//paymentForm.addEventListener("submit", payWithPaystack, false);

fresh=$('#fresh').val();
$("#daccounttext").hide();

$("#daccount").click(function(){

	if($('#daccount').is(":checked")){
		$("#daccounttext").show();
	}else{
		$("#daccounttext").hide();
	}
	
});

if(fresh=="YES"){
	    	                          	
	    $("#daccounttext").hide(300); 

		mobileno=$('#mobileno').val();		
		orderno=$('#orderno').val();		
		forwho=$('#forwho').val();
		sentfrom=$('#sentfrom').val();		
		amount= $('#amount').val();	

		
		 $.post("newhoogpay/check4approval",
	                        // {staffid(in database):sid(variable here)etc},
	                        {mobileno:mobileno},
	                        function (data) {	                        
	                       if(data.s_status=="No"){
	                       	alert(data.message);
	                       	exit();
	                       }
	                       if(data.s_status=="Yes"){
	                       	alert(data.message);


	                       	

			                       		$.post("newhoogpay/updatepayment",
							                        // {staffid(in database):sid(variable here)etc},
							                        {mobileno:mobileno},
							                        function (data) {
							                          alert(data.message);
							                          
							       						 window.location.href = "https://dreamcityhes.com/rentbanking/maindashboard";
							       						//window.location.href = "http://localhost:8080/land/dashboard";
							            			

							                      },'json'
							                    );

	                       }
	                   },'json'
	            );






}
$("#btn_retry").click(function(){
		
		orderno=$('#orderno').val();
		email= $('#email').val();
		

						$("#pay_section_worker3").show(120);
					    $("#pay_section_worker1").hide(180);
					    $("#pay_section_worker2").hide(300);	                          	
	                    $("#daccounttext").hide(170);
					const num = document.querySelector(".pay_section_worker3_number");
					let counter = 0;
					setInterval(() => {
					  if (counter == 100) {
					    counter=0;
					    clearInterval();					     
					    $("#pay_section_worker3").hide(120);
					    $("#pay_section_worker1").hide(180);
					    $("#pay_section_worker2").show(300);	                          	
	                    $("#daccounttext").hide(170);
	                   
	                    
					  } else {
					    counter += 1;
					    num.textContent = counter + "%";
					    	//Now check if payment is approved

					    	$.post("hoogpay/check4approval",
	                        // {staffid(in database):sid(variable here)etc},
	                        {email:email,orderno:orderno},
	                        function (data) {
	                        	//alert(data.message);   
	                        	let nnnn= data.s_status;
	                        	if(nnnn=='Yes')  {
	                        		//
	                        			clearInterval();
	                        			$.post("hoogpay/savepayment",
					                        // {staffid(in database):sid(variable here)etc},
					                        {mobile:mobile,orderno:orderno,refid:refid,product:product,qty:qty,price:price,debit:debit,credit:credit},
					                        function (data) {
					                          //alert(data.message);
					                          var delay=2000;
					                          setTimeout(function(){
					       						 window.location.href = "https://dreamcityhes.com/rentbanking/dashboard";
					       						//window.location.href = "http://localhost:8080/land/dashboard";
					            			},delay)

					                      },'json'
					                      );


	                        		//
	                        	}                   

						     	},'json'
						    );



						    





					  }
					}, 10000);
});





$("#newhoogpaynow").click(function(e){
		e.preventDefault();	

//save the payment for approval

//get other variables
		mobileno=$('#mobileno').val();		
		orderno=$('#orderno').val();		
		forwho=$('#forwho').val();
		sentfrom=$('#sentfrom').val();		
		amount= $('#amount').val();

			if (sentfrom==""){
				alert("Please enter sender Account name used for payment");
				exit();
			}
			
		
		//alert(sentfrom);
		
		 $.post("newhoogpay/paymenttrack",
	                        // {staffid(in database):sid(variable here)etc},
	                        {mobileno:mobileno,amount:amount,orderno:orderno,sentfrom:sentfrom},
	                        function (data) {
	                        	alert(data.message);
	                         //alert(data);
	                          var delay=200;
	                          setTimeout(function(){
	                          	$("#label-outlined").hide(300);
	                          	$(".pay_section_worker3_number").css("display","block" ).delay(300);	
	                          	$("#pinfo").css("display","block" ).delay(300);	
	                          	$("#newhoogpaynow").hide(300);	                          	
	                          	$("#sentfrom").hide(300);                   		       						 

								 
	            			},delay)

	     	},'json'
	    );







					const num = document.querySelector(".pay_section_worker3_number");
					let counter = 0;
					setInterval(() => {
					  if (counter == 100) {
					    counter=0;
					    clearInterval();					     
					    $("#pay_section_worker3").hide(120);
					    $("#label-outlined").hide(180);
					    $("#waitinginfo").hide(300);	                          	
	                    $("#daccounttext").hide(170);
	                    $(".inforaftertime").css("display","block" ).delay(300);

	                   
	                    
					  } else {
					    counter += 1;
					    num.textContent = counter + "%";
					    	//Now check if payment is approved

					    	$.post("newhoogpay/check4approval",
	                        // {staffid(in database):sid(variable here)etc},
	                        {mobileno:mobileno},
	                        function (data) {
	                        	alert(data.message);   
	                        	let nnnn= data.s_status;
	                        	if(nnnn=='Yes')  {
	                        		//
	                        			clearInterval();
	                        			$.post("newhoogpay/updatepayment",
					                        // {staffid(in database):sid(variable here)etc},
					                        {mobileno:mobileno},
					                        function (data) {
					                          //alert(data.message);
					                          var delay=2000;
					                          setTimeout(function(){
					       						 window.location.href = "https://dreamcityhes.com/rentbanking/maindashboard";
					       						//window.location.href = "http://localhost:8080/land/dashboard";
					            			},delay)

					                      },'json'
					                      );


	                        		//
	                        	}                   

						     	},'json'
						    );



						    





					  }
					}, 10000);

});
	
	








});