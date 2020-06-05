<?php
foreach(@$last_data as $row)
{
	$master_item_id=@explode(",",$row['utility_entry']['master_item_id']);
	$no_of_person=@explode(",",$row['utility_entry']['no_of_person']);
	$amount=@explode(",",$row['utility_entry']['amount']);
	$tot_amnt=$row['utility_entry']['tot_amnt'];
	$grand_amnt=$row['utility_entry']['grand_amnt'];
	$security_amnt=$row['utility_entry']['security_amnt'];
	$paid_amnt=$row['utility_entry']['paid_amnt'];
	$time=$row['utility_entry']['time'];
	$date=$row['utility_entry']['date'];
	$id=$row['utility_entry']['id'];
	$discount=$row['utility_entry']['discount'];
    $locker_no=$row['utility_entry']['locker_no'];
    $name_person=$row['utility_entry']['name_person'];
    $mobile=$row['utility_entry']['mobile'];
    $ticket_no=$row['utility_entry']['ticket_no'];
    
}
$fetch_company_name=$this->requestAction(array('controller' => 'Handler', 'action' => 'fetch_company_name'), array());
foreach($fetch_company_name as $company)
{
 $name=$company['company']['company_name'];
 $address=$company['company']['address'];
 $mobile_company=$company['company']['mobile'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $name; ?></title>
<style>
    body {
        margin: 0 !important;
        padding: 0 !important;
    }
	
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
		-webkit-box-sizing: border-box; 
      }
	
	.page{
	width:100%;
	height:100%;
	margin:0 auto !important;
	}
	
	.left {
	float: left;
	width: 270px !important;;
	margin:0 auto;
	padding-left:5px;
	padding-top:5px;
	padding-bottom:10px;
	}
	
	.inner{
/*	font-family:Verdana, Geneva, sans-serif;  */
	font-family:Century Gothic;
	font-size:14px; 	
	text-transform:uppercase;
	}
	
    @page {
        size: A4;
        margin: 0 !important;
    }
	
    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
        }
    }
	td{
		width:auto;
	}
	text[text-anchor=middle]{
        display: none;  
    }
</style>
<style media="print">
.displaynone
{
	display:none;
}
</style>
</head>
<body>
    <input type="hidden" value="<?=$ticket_no?>" id="getTicket">
    <div class="left">
        <table width="100%" class="inner" border="0" >
            <tr>
                <td colspan="4" style="text-align:center;font-size:20px;"><b><span><?php echo $name; ?></span></b></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:center;line-height:5px;"><span><?php echo $address; ?></span></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:center;font-size:14px !important;"><span>MOBILE NO : <?php echo $mobile_company; ?></span></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:center;font-size:20px;"><b><span>Utility TICKET</span></b></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:center;font-size:12px;"><span>(This ticket is required to take refund)</span></td>
            </tr>
            <tr>
                <td colspan="4" align="center" style="font-size:25px"><b># <?php echo $ticket_no; ?></b></td>
            </tr>
            <!-- <tr>
                <td colspan="4" align="center"><svg id="demo"></svg></td>
            </tr> -->
            <tr>
                <td colspan="4" align="center"><b>Date <?php echo  date("d-M-Y",strtotime($date)); ?></b>
                </td>
            </tr>
            <?php
            if(!empty($name_person)) {
            ?>
            <tr>
                <td><b>Name</b></td>
                <td colspan="3" align="left"><b><?php  echo $name_person;   ?></b></td>
            </tr>
            <?php }
            if(!empty($mobile)) { ?>
            <tr>
                <td><b>Mobile No.</b></td>
                <td colspan="3" align="left"><b><?php  echo $mobile;   ?></b></td>
            </tr>
            <?php } ?>
            <tr>
                <td><b>CATEGORY</b></td>
                <td><b>PRICE</b></td>
                <td><b>NCS</b></td>
                <td align="right"><b>TOTAL</b></td>
            </tr>
            <?php
            for($i=0;$i<sizeof($master_item_id);$i++)
            {
            if(!empty($master_item_id))
            {
            $category=$this->requestAction(array('controller' => 'Handler', 'action' => 'fetchmasteritemname',$master_item_id[$i]), array());
            ?>
            <tr>
                <td><?php if($category=='Locker'){ echo $category.'&nbsp; ('.$locker_no.')';} else{ echo $category; }?></td>
                <td><?php echo $plan_name=$this->requestAction(array('controller' => 'Handler', 'action' => 'fetchmasterrate',$master_item_id[$i]), array()); ?></td>
                <td><?php echo $no_of_person[$i]; ?></td>
                <td align="right"><?php echo $amount[$i]; ?></td>
            </tr>
            <?php
            }
            }

            ?>
            <tr>
                <td colspan="2" style="font-style:italic;font-size:11px;">Inclusive of all taxes</td>
                <td style="text-align:right;"><b>TOTAL:</b></td>
                <td align="right"><?php echo $tot_amnt; ?></td>
            </tr>
            <?php 
            if($discount>0) { ?>
            <tr>
                <td align="right"colspan="3" style="text-align:right;"><b>Discount:</b></td>
                <td align="right"><?php echo $discount; ?></td>
            </tr> <?php } ?>
            <tr>
                <td colspan="3" style="text-align:right;"><b>GRAND TOTAL:</b></td>
                <td align="right"><?php echo $grand_amnt; ?></td>
            </tr>
            <?php
            if($security_amnt>0)
            {?>
            <tr>
                <td colspan="3" style="text-align:right;"><b>RUFUNDABLE AMOUNT:</b></td>
                <td align="right"><?php echo $security_amnt; ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3" align="right" style="text-align:right;border-top:dashed 1px; "><b>AMOUNT TO BE PAID:</b></td>
                <td align="right" style="border-top:dashed 1px;padding-right:1px"><strong><?php echo $paid_amnt; ?></strong></td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="col-md-1">
                        <svg id="demo"></svg>
                    </div>
                </td>
            </tr>
        </table>
    </div>
	             
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.0/JsBarcode.all.min.js" integrity="sha256-BjqnfACYltVzhRtGNR2C4jB9NAN0WxxzECeje7/XpwE=" crossorigin="anonymous"></script>
<script type="text/javascript">
    let tickt = document.getElementById('getTicket').value;;
    //alert(tickt);
    JsBarcode("#demo", tickt,{
        width: 3,
        height: 40,
    });
</script>
<script>
	window.print();
	
</script>
<?php
if($print!=2){
?>
<script>
	location='view_utility_ticket?id=<?php echo $id; ?>&print=2';
</script>
<?php } ?>
<?php

if($print==2){
    if($discount>0){
    ?>
		<script>
        location='view_discount?id=<?php echo $id; ?>&auto_id=2';
        </script>
        <?php
     } 
    else
    {?>
    <script>
	   window.opener.location.reload();
        location='close_view_ticket';
	</script>
        <?php
    }
} ?>
