
<div class="approval_body">
	<table>
	<thead>
		<tr>
			<TD>SN</TD> <TD>Amount</TD> <TD>Email</TD><TD></TD>
		</tr>
	</thead>
	<tbody>
		<?php 
		$nn=1;
			foreach ($this->getpayments as $key => $value) {
                $sn= $nn++;
                $amount=$value["amount"];
                $mobileno=$value["mobileno"];
                $sentfrom=$value["sentfrom"];
                $orderno=$value["orderno"];
                $id=$value["id"];
                $mylink='hoogpayapprovals/apr';

                echo'
                	<tr style="color:red;">
                	<td>'. $sentfrom .'</td> <td>'. $amount .'</td><td>'. $mobileno .'</td><td>
                	<form>
                		<input type="hidden" value="'. $amount .'"/>
                        
                		<input type="hidden" name="orderno" id="orderno" value="'. $orderno .'"/>
                		<input type="button" id="do_it_right" value="'. $orderno .'"/></td>
                        
                	


                	</tr>




                ';


            }


		?>
	</tbody>
	</table>


</div>