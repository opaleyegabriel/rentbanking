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
	    $("#pay_section_worker3").show(300);
	    $("#pay_section_worker1").hide(300);	                          	
	    $("#daccounttext").hide(300); 

		mobile=$('#mobile').val();
		orderno=$('#orderno').val();
		refid=$('#refid').val();
		product=$('#product').val();
		qty=$('#qty').val();
		price=$('#price').val();
		debit=$('#debit').val();
		credit=$('#credit').val();
		

		email= $('#email').val();
		amount= $('#amount').val();


		

		
		 $.post("hoogpay/paymenttrackcheck",
	                        // {staffid(in database):sid(variable here)etc},
	                        {email:email},
	                        function (data) {	                        
	                       if(data.s_status=="No"){
	                       	alert(data.message);
	                       	exit();
	                       }
	                       if(data.s_status=="Yes"){
	                       	alert(data.message);


	                       	

			                       		$.post("hoogpay/savepayment_new",
							                        // {staffid(in database):sid(variable here)etc},
							                        {email:email,mobile:mobile,orderno:orderno,refid:refid,product:product,qty:qty,price:price,debit:debit,credit:credit},
							                        function (data) {
							                          alert(data.message);
							                          
							       						 window.location.href = "https://dreamcityhes.com/rentbanking/dashboard";
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
					                          alert(data.message);
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





$("#hoogpay").click(function(e){
		e.preventDefault();	

//save the payment for approval

//get other variables
		mobile=$('#mobile').val();
		orderno=$('#orderno').val();
		refid=$('#refid').val();
		product=$('#product').val();
		qty=$('#qty').val();
		price=$('#price').val();
		debit=$('#debit').val();
		credit=$('#credit').val();
		sentfrom=$('#sentfrom').val();


		email= $('#email').val();
		amount= $('#amount').val();



		if($('#daccount').is(":checked")){
			//dont allow  empty sendfrom 
			
			if (sentfrom==""){
				alert("Please enter payment reference or Account name used for payment");
				exit();
			}
			
		}else{
			alert("Please Click Allow transaction reference and enter reference no or sender's name");
			exit();
		}
		
		//alert(sentfrom);
		
		 $.post("hoogpay/paymenttrack",
	                        // {staffid(in database):sid(variable here)etc},
	                        {email:email,amount:amount,orderno:orderno,sentfrom:sentfrom},
	                        function (data) {
	                        	alert(data.message);
	                         //alert(data);
	                          var delay=200;
	                          setTimeout(function(){
	                          	$("#pay_section_worker3").show(300);
	                          	$("#pay_section_worker1").hide(300);	                          	
	                          	$("#daccounttext").hide(300);                   		       						 

								 
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
					                          alert(data.message);
					                          var delay=2000;
					                          setTimeout(function(){
					       						 window.location.href = "https://dreamcityhes.com.ng/land/dashboard";
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