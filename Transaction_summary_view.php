<?php
//echo "<pre>";print_r($owneraddress);
?>

<style type="text/css">


.tg  {    border: black;}
 .tg td{font-family:Arial, sans-serif;padding:0px 5px;overflow:hidden;word-break:normal;font-size: small;text-align: center;}
.tg th{color: #099C9A;font-family:sans-serif;font-size:10px;padding:0px 5px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}

.info-hint
{
    font-size: 11px;
        
    line-height: 15px !important;
}


td { width: 25%;     padding: 10px;}

#d1
    {
      height: 100px;
      width: 100px;
      font-size: 11px;
    }
    button
    {
      text-align: center;
    }
    
    .modal_button1
    {
  
      margin-left: 160px;
      width: 283px;
    }
    .modal_button3
    {
      width: 460px;
     /* //font-size: 15px;*/
      white-space: initial;
      margin-top: 10px;
    }
    #modal_button2
    {
  
     /*// margin-left: 160px;
      //width: 283px;
      //height: 50px;*/
      font-size: 11px;
      white-space: initial;
      padding: 3px;
     justify-content: center;    /* center items vertically, in this case */
    align-items: center;   
    vertical-align: middle;   
    }

    .close
    {
      color: black;
    }
  input {
  border: 0;
  outline: 0;
  background: transparent;
  border-bottom: 1px solid black;
 
  margin-top: 10px;
  width:  416px;
  margin-left:-23px;
 
}
.modal-body
{
  float: left;
  margin-left: 8px;
}
#modc1
{
  width: 500px;
  height: 163px;
}
#modc2
{
  width: 533px;
  height: 220px;
}
#modc3
{
  width: 500px;
  height: 160px;
  margin-left: 4px;
}
.modal-title
{
  margin-left:-170px;
word-wrap: break-word;
 white-space: initial;
font-size:18px; 
margin-bottom: 17px;

}
</style>


<script src="<?php echo ADMIN_JAVASCRIPT; ?>multifile.js"></script> 
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var printContents = $("#divToPrint").html();
          // var printContents = document.getElementById('divToPrint').innerHTML;
             var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
    <?php if($this->uri->segment(5) == 'term') { ?>
     document.title = "SBTA - Semi-Final Transaction Summary";
    <?php } else { ?>      
      document.title = "SBTA Final Transaction Summary";
     <?php } ?>      
      // var originalContents = document.body.innerHTML;

     //document.body.innerHTML = printContents;
     window.print();

     document.body.innerHTML = originalContents;
        });
    </script>

<script>
  
  
function goBack() {
    window.history.go(-1);
}
</script>


<div class="xs" >
  
<div class="tab-content print-landscape-A3 " id="divToPrint" size="A3">

<!--table class="tg" border="0">
  <tr>
    <th class="tg-yw4l" colspan="6" style="text-align: center;vertical-align: middle;    width: 1000px;"><h4 style="font-size: 14px;font-weight: bold;margin-left: -40px;">STANDARD BIOMASS TRADING AGREEMENT</h4></th>
  </tr>
  </table-->
 <!--table--> 
 <?php
    $ngtid=$this->uri->segment(3);
    $this->db->select('*');
    $this->db->where('id',$ngtid);
    $query = $this->db->get('negotiations');
         
      $negoResult = $query->result_array();
    	
?>
 
 <table class="" border="1" style="
    border: black;
">
<tbody>
<tr>
<td style="" colspan="4">
<p style="text-align: center;color: #099c9a;"><strong>CONTRACT</strong></p></td>
</tr>
<tr>
<td style="" colspan="4">
<p style="text-align: center;">This transaction (hereinafter referred to as &ldquo;Contract&rdquo;) has been executed by the following BUYER and SELLER on the Contract Date herein mentioned in the Transaction Summary</p>
</td>
</tr>
 <?php if($this->uri->segment(5) != 'term') {  
   if($negoResult[0]['is_confirm']==1 && $negoResult[0]['ngt_accept_seller'] == 1 && $negoResult[0]['ngt_accept_buyer'] == 1) {?>
<tr>
<td style="" colspan="2">
<p style="text-align: center;color: #099c9a;"><strong>BUYER</strong></p>
</td>
<td style="" colspan="2">
<p style="text-align: center;color: #099c9a;"><strong>SELLER</strong></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><strong>Company Name</p>
</td>
<td style="">
<p style="text-align: center;"><?php echo $buyerinfo[0]['company_name']; ?></p>
</td>
<td style="">
<p style="text-align: center;"><strong>Company Name</p>
</td>
<td style="">
<p style="text-align: center;"><?php echo $sellerinfo[0]['company_name']; ?></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><strong>Registration Number</p>
</td>
<td style="">
<p style="text-align: center;"><?php echo $buyerinfo[0]['reg_no']; ?></p>
</td>
<td style="">
<p style="text-align: center;"><strong>Registration Number</p>
</td>
<td style="">
<p style="text-align: center;"><?php echo $sellerinfo[0]['reg_no']; ?></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><strong>Registration Address</p>
</td>
<td style="">
<p style="text-align: center;"><?php echo $buyerinfo[0]['address']; ?></p>
</td>
<td style="">
<p style="text-align: center;"><strong>Registration Address</p>
</td>
<td style="">
<p style="text-align: center;"><?php echo $sellerinfo[0]['address']; ?></p>
</td>
</tr>
<?php } } ?>
<tr>
<td style="" colspan="4">
<p style="    padding: 20px;
    text-align: justify;line-height: 18px;">By this Contract the above referred BUYER and the SELLER has agreed to conclude the transaction of buy and sell detailed in the Transaction Summary below in accordance with the terms and conditions contained in the Standard Biomass Trading Agreement 
    (Ver 6.0 effective from 18th Mar&rsquo;2019)And the said Standard Biomass Trading Agreement shall constitutes and interpreted as an integral part of this Contract. The Standard Biomass Trading Agreement 
    (Ver 6.0 effective from 18th Mar&rsquo;2019) is published on the Provider&rsquo;s ETS accessible from website at www.tradersbiomass.com</p>
</td>
</tr>
<tr>
<td style="color: #099c9a;" colspan="4">
<p style="text-align: center;"><strong>TRANSACTION SUMMARY</strong></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><strong>Contract Date<strong></p>
</td>
<td style="">
<p style="text-align: center;"><?php if($oderdetails[0]['order_date']) { echo date($this->config->item('date_format_short'), strtotime($oderdetails[0]['order_date'])); } else { echo "-";}?></p>
</td>
<td style="">
<p style="text-align: center;"><strong>Contract No.<strong></p>
</td>
<td style="">
<p style="text-align: center;"><?php if($oderdetails[0]['id']) { echo "TB".date('mdY', strtotime($oderdetails[0]['order_date'])).$oderdetails[0]['id']; } else { echo "-";}?></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><strong>Biomass Type</p>
</td>
<td style="">
<p style="text-align: center;"><strong>Origin of Biomass</p>
</td>
<td style="">
<p style="text-align: center;"><strong>Quantity (in MT)</strong><br> <font class="info-hint">(Dry Basis) +/-&nbsp; % <br>(Buy / Sell per Delivery Period)</font></p>
</td>
<td style="">
<p style="text-align: center;"><strong>Net Calorific Value</strong><br> <font class="info-hint">(&ldquo;Baseline Price&rdquo;) (GJ/MT)</font></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><?php echo $catname[0]['value'];?></p>
</td>
<td style="">
<p style="text-align: center;"><?php
   if($dealrecord[0]['locname']) { 
       echo $dealrecord[0]['locname'];}
       else{
     echo $location[0]['name'];}
     ?></p>
</td>
<td style="">
<p style="text-align: center;"><?php echo number_format($records[0]['volume']);?>&nbsp;<?php if($qty_mt[0]['value']) { echo '('.$qty_mt[0]['value'].')';} else { echo '( 0% )'; }?></p>
</td>
<td style="">
<p style="text-align: center;"><?php if($records[0]['ncv']) { echo $records[0]['ncv'];} else { echo 'NA'; }?></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><strong>Product Standard</p>
</td>
<td style="">
<p style="text-align: center;"><strong>Currency</p>
</td>
<td style="">
<p style="text-align: center;"><strong>Baseline Price</strong> P<sub>B</sub> <font class="info-hint">(Dry Basis) <br>(Excluding Taxes)</font></p>
</td>
<td style="">
<p style="text-align: center;"><strong>Approx. Total Contract Amount</strong> <br><font class="info-hint">(Excluding Taxes)</font></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><?php echo $dealrecord[0]['prdname'];?></p>
</td>
<td style="">
<p style="text-align: center;"><?php echo $currency[0]['name'];?></p>
</td>
<td style="">
<p style="text-align: center;"><?php echo  $records[0]['price'];?></p>
</td>
<td style="">
<p style="text-align: center;"><?php echo number_format ($records[0]['price'] * $records[0]['volume']);?></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><strong>INCOTERM</p>
</td>
<td style=""><p style="text-align: center;"><?php echo $inco[0]['name'];?></p></td>
<td style="">
<p style="text-align: center;"><strong>Delivery Place (Port)</p>
</td>
<td style=""><p style="text-align: center;"><?php
   if($dealrecord[0]['locnamebid']) { 
       echo $dealrecord[0]['locnamebid'];}
       else{
     echo $location[0]['name'];}
     ?></p></td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><strong>Yearly Baseline Price Escalation (in %, Max 2%), Preferred Index </strong></p> 
</td>
<td style="">
<p style="text-align: center;"><?php echo $records[0]['price_web'] ? $records[0]['price_web'] :'-' ;   ?> </p>
<!-- <p style="text-align: center;"><?php if($records[0]['biomass_weighing_site']) { echo $records[0]['biomass_weighing_site'];} else { echo 'NA'; }?> % <?php if($records[0]['price_web']) { echo ','.$records[0]['price_web'];} ?> </p> -->
</td>
<td style="">
<p style="text-align: center;"><strong>Delivery Period</p>
</td>
<td style="">
<p style="text-align: center;">From : <?php echo date($this->config->item('date_format_short'), strtotime($dealrecord[0]['delivery_time'])); ?>
        &nbsp;To : <?php echo date($this->config->item('date_format_short'), strtotime($dealrecord[0]['delivery_time_to'])); ?></p>
</td>
</tr>
<tr>
<td style="">
<p style="text-align: center;"><strong>Type of Packing</p>
</td>
<td style="">
<p style="text-align: center;"><?php echo $packing[0]['name'];?></p>
</td>
<td style="">
<p style="text-align: center;"><strong>Payment Method</p>
</td>
<td style="">
<p style="text-align: center;"><?php echo $paymethod[0]['value'];?></p>
</td>
</tr>
<tr>
<td style=""><p style="text-align: center;"><strong>Non-Standard Conditions</p></td>
<td style="" colspan="3"><p style="text-align: center;"><?php if($records[0]['non_standard_cnd']) { echo $records[0]['non_standard_cnd'];} else { echo 'NA'; }?></p></td>
</tr>
<tr>
<td style="" colspan="2">
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;color: #099c9a;">Signed, Sealed and Delivered by BUYER&nbsp;</p>
</td>
<td style="" colspan="2">
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;color: #099c9a;">Signed, Sealed and Delivered by SELLER&nbsp;</p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: center;">&nbsp;</p>
<!-- <table class="tg" border="1">
  <tr>
    <th class="tg-yw4l" colspan="6" style="text-align: center;vertical-align: middle;"><h4 style="font-size: 14px;font-weight: bold;margin-left: -40px;">CONTRACT</h4></th>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="6" style="font-size: x-small;text-align: center;vertical-align: middle;">This transaction (hereinafter referred to as “Contract”) has been executed by the following BUYER and SELLER on the Contract Date herein mentioned in <br>the Transaction Summary </td>
  </tr>
  <?php if($this->uri->segment(4) != 'term') { ?>
  <tr>
    <td class="tg-yw4l" colspan="3" style="text-align: center;   vertical-align: middle; color: #099C9A;    font-family: sans-serif;
    "><h4 style="font-size: 12px;font-weight: bold;">BUYER</h4></td>
    <td class="tg-yw4l" colspan="3" style="text-align: center; vertical-align: middle;   color: #099C9A;    font-family: sans-serif;
    font-size: 13px;
    font-weight: bold;"><h4 style="font-size: 12px;font-weight: bold;">SELLER</h4></td>
  </tr>
  <tr>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;background-color: lightgray;"><font style="font-size: 12px;">Company Name</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $buyerinfo[0]['company_name']; ?></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;     background-color: lightgray;"><font style="font-size: 12px;">Company Name</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $sellerinfo[0]['company_name']; ?></td>
  </tr>
  <tr>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Registration Number</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $buyerinfo[0]['reg_no']; ?></td>
    <td class="tg-yw4l" style="
    text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Registration Number</td>
    <td class="tg-yw4l" colspan="2"  style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $sellerinfo[0]['reg_no']; ?></td>
  </tr>
  <tr>
    <td class="tg-yw4l"  style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Registration Address</font></td>
    <td class="tg-yw4l" colspan="2"  style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $buyerinfo[0]['address']; ?></td>
    <td class="tg-yw4l"  style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Registration Address</font></td>
    <td class="tg-yw4l" colspan="2"  style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><font style="font-size: 12px;"><?php echo $sellerinfo[0]['address']; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td class="tg-yw4l" colspan="6" style="font-size: x-small;text-align: center;vertical-align: middle;    width: auto;">By this Contract the above referred BUYER and the SELLER has agreed to conclude the transaction of buy and sell detailed in the Transaction Summary<br> below in accordance with the terms and conditions contained  in the Standard Biomass Trading Agreement ( Ver 4.2 effective from 31st May’2018) <br>And the said Standard Biomass Trading Agreement shall constitutes and interpreted as an integral part of this Contract. The Standard Biomass<br> Trading Agreement ( Ver 4.2 effective from 31st May’2018) is published on the Provider’s ETS accessible from website at www.tradersbiomass.com</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="6" style="text-align: center; vertical-align: middle;   color: #099C9A;    font-family: sans-serif;"><h4 style="font-size: 12px;font-weight: bold;    margin-left: -35px;">TRANSACTION SUMMARY</h4></td>
  </tr>
  <tr>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Contract Date</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php if($oderdetails[0]['order_date']) { echo date($this->config->item('date_format_short'), strtotime($oderdetails[0]['order_date'])); } else { echo "-";}?></font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Contract No.</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php if($oderdetails[0]['id']) { echo "TB".date('mdY', strtotime($oderdetails[0]['order_date'])).$oderdetails[0]['id']; } else { echo "-";}?></font></td>
  </tr>
  <tr>
    <td class="tg-yw4l" style="width: 180px;text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Biomass Type</font></td>
    <td class="tg-yw4l" style="width: 150px;   vertical-align: middle; text-align: center;    background-color: lightgray;"><font style="font-size: 12px;">Product Standard</font></td>
    <td class="tg-yw4l" style="width: 150px;  vertical-align: middle;  text-align: center;    background-color: lightgray;"><font style="font-size: 12px;">Quantity (in MT) +/- %</font><br><font style="font-size: 9px;    vertical-align: top;"> (Buy / Sell per Delivery Period)</font></td>
    <td class="tg-yw4l" style="width: 170px;  vertical-align: middle;  text-align: center;    background-color: lightgray;"><font style="font-size: 12px;">Baseline / MT 
</font><br><font style="font-size: 9px;    vertical-align: top;">(Excluding Taxes)</font></td>
    <td class="tg-yw4l" style="width: 175px; vertical-align: middle;   text-align: center;    background-color: lightgray;"><font style="font-size: 12px;">Approx.Total Contract Amount</font><br><font style="font-size: 9px;    vertical-align: top;"> (Excluding Taxes)</font></td>
    <td class="tg-yw4l" style="width: 175px;  vertical-align: middle;  text-align: center;    background-color: lightgray;"><font style="font-size: 12px;">Currency</font></td>
  </tr>
  <tr>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $catname[0]['value'];?></font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $dealrecord[0]['prdname'];?></font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo number_format($records[0]['volume']);?></font>&nbsp;<font style="font-size: 12px;">

      <?php if($qty_mt[0]['value']) { echo '('.$qty_mt[0]['value'].')';} else { echo '( 0% )'; }?>
    </font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo  $records[0]['price'];?></font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo number_format ($records[0]['price'] * $records[0]['volume']);?></font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $currency[0]['name'];?></font></td>
  </tr>
    <tr>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Origin of Biomass Product</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;">
        <?php
   if($dealrecord[0]['locname']) { 
       echo $dealrecord[0]['locname'];}
       else{
     echo $location[0]['name'];}
     ?>
        
        
        
        </font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Net Calorific Value (“QBaseline”)(GJ/MT)
</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php if($records[0]['ncv']) { echo $records[0]['ncv'];} else { echo 'NA'; }?></font></td>
  </tr>
  <tr>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Buyer’s Site</font> <br><font style="font-size: 9px;    vertical-align: top;">(Delivery Place of Biomass)</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php
   if($dealrecord[0]['locnamebid']) { 
       echo $dealrecord[0]['locnamebid'];}
       else{
     echo $location[0]['name'];}
     ?></font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Delivery Period</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;">From : <?php echo date($this->config->item('date_format_short'), strtotime($dealrecord[0]['delivery_time'])); ?></font>
        &nbsp;<font style="font-size: 12px;">To : <?php echo date($this->config->item('date_format_short'), strtotime($dealrecord[0]['delivery_time_to'])); ?></font></td>
  </tr>
  <tr>
     <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Yearly Price Escalation</font> <br><font style="font-size: 9px;    vertical-align: top;"></font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php if($records[0]['biomass_weighing_site']) { echo $records[0]['biomass_weighing_site'];} else { echo 'NA'; }?></font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">INCOTERM</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $inco[0]['name'];?></font></td>
  </tr>
  <tr>
   <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Type of Packing</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php echo $packing[0]['name'];?></font></td>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;"><font style="font-size: 12px;">Payment Method</font></td>
    <td class="tg-yw4l" colspan="2" style="text-align: center;vertical-align: middle;width: 350px;"><font style="font-size: 12px;"><?php echo $paymethod[0]['value'];?></font></td>
  </tr>
  
  <tr>
    <td class="tg-yw4l" style="text-align: center;vertical-align: middle;    background-color: lightgray;" ><font style="font-size: 12px;"> Non-Standard Conditions</font></td>
    <td class="tg-yw4l" colspan="5" style="text-align: center;vertical-align: middle;"><font style="font-size: 12px;"><?php if($records[0]['non_standard_cnd']) { echo $records[0]['non_standard_cnd'];} else { echo 'NA'; }?></font></td>
  </tr>
   <tr>
    <td class="" colspan="3" style="height: 75px;text-align: center;    color: #099C9A;vertical-align: bottom;" ><h4 style="font-size: 10px;">Signed, Sealed and Delivered by BUYER</h4></td>
    <td class="" colspan="3" style="text-align: center;    color: #099C9A;vertical-align: bottom;"><h4 style="font-size: 10px;">Signed, Sealed and Delivered by SELLER</h4></td>
  </tr> 
  
</table>
  --><br>
 
 <br><br>
 <br><br><br>
 <br>
 <p style="
    text-align: -webkit-right;
">Annexure No.1</p>
<p style="
    text-align: center;
    font-size: 18px;
">Product Standard<br>
Shipments must conform entirely to the quality parameter / specification shown below:<br>
</p>
        
        <?php 

         $userdata=$this->session->userdata;
         $userid = $userdata['user_id'];
        $prdid=$this->uri->segment(4);

        /* $this->db->select('*');
        $this->db->where('product_id',$prdid);
        $this->db->where('created_by',$userid);
        $query21 = $this->db->get('company_products');
        $comp_prd = $query21->result_array(); */

      //  $comp_prd[0]['potassium_sodium'];

        $this->db->select('*');
        $this->db->where('id',$prdid);
        //$this->db->where('created_by',$userid);
        $query211 = $this->db->get('products');
        $category_id1 = $query211->result_array();


      // echo "<pre>";print_r($category_id1[0]);
      $negoId = $this->uri->segment(3);
      $this->db->select('*');
      $this->db->where('id',$negoId);
      $created_by_rec= $this->db->get('negotiations');
      $created_by = $created_by_rec->result_array();
      $refid = $created_by[0]['ref_id'];
      if($created_by[0]['ask_id'] > 0)
      {
        $this->db->select('*');
        $this->db->where('ask_id',$refid);
        $asks_rec= $this->db->get('asks');
        $ask_arr = $asks_rec->result_array();
        $posted_by = $ask_arr[0]['created_by'];

        $this->db->select('*');
        $this->db->where('product_id',$prdid);
        $this->db->where('created_by',$posted_by);
        $query21 = $this->db->get('company_products');
        $comp_prd = $query21->result_array();
      }
      else
      {
        $this->db->select('*');
        $this->db->where('bid_id',$refid);
        $bid_rec= $this->db->get('bids');
        $bid_arr = $bid_rec->result_array();
        $posted_by = $bid_arr[0]['created_by'];

        $this->db->select('*');
        $this->db->where('product_id', $prdid);
        $this->db->where('created_by', $posted_by);
        $query21 = $this->db->get('company_products');
        $comp_prd = $query21->result_array();
      }

        if($comp_prd[0]['potassium_sodium']!='0')
        {
        $this->db->select('value');
        $this->db->where('id',$comp_prd[0]['potassium_sodium']);
        $queryFC = $this->db->get('drop_downs');
        $potassium_sodium = $queryFC->result_array();
        //echo $ana_report[0]['value']; 

        }


if($comp_prd[0]['raw_material_type']!='0')
{
  $this->db->select('cat_name');
  $this->db->where('id',$comp_prd[0]['raw_material_type']);
  $query24 = $this->db->get('raw_materials');
  $sts_row = $query24->result_array();
  $rowname = $sts_row[0]['cat_name'];
}
if($comp_prd[0]['raw_material_type2']!='0')
{
  $this->db->select('cat_name');
  $this->db->where('id',$comp_prd[0]['raw_material_type2']);
  $query242 = $this->db->get('raw_materials');
  $sts_row2 = $query242->result_array();
  $rowname2 = $sts_row2[0]['cat_name'];
}

if($comp_prd[0]['raw_material_type3']!='0')
{
  $this->db->select('cat_name');
  $this->db->where('id',$comp_prd[0]['raw_material_type3']);
  $query243 = $this->db->get('raw_materials');
  $sts_row3 = $query243->result_array();
  $rowname3 = $sts_row3[0]['cat_name'];
}
if($comp_prd[0]['row_sub_type']!='0')
{
  $this->db->select('cat_name');
  $this->db->where('id',$comp_prd[0]['row_sub_type']);
  $query25 = $this->db->get('raw_materials');
  $sts_subrow = $query25->result_array();
  $subrowname = $sts_subrow[0]['cat_name'];
}

if($comp_prd[0]['row_sub_type2']!='0')
{
  $this->db->select('cat_name');
  $this->db->where('id',$comp_prd[0]['row_sub_type2']);
  $query252 = $this->db->get('raw_materials');
  $sts_subrow2 = $query252->result_array();
  $subrowname2 = $sts_subrow2[0]['cat_name'];
}


if($comp_prd[0]['row_sub_type3']!='0')
{
  $this->db->select('cat_name');
  $this->db->where('id',$comp_prd[0]['row_sub_type3']);
  $query253 = $this->db->get('raw_materials');
  $sts_subrow3 = $query253->result_array();
  $subrowname3 = $sts_subrow3[0]['cat_name'];
}
if($comp_prd[0]['forestry_certification']!='0')
{
  $this->db->select('value');
  $this->db->where('id',$comp_prd[0]['forestry_certification']);
  $queryFC = $this->db->get('drop_downs');
  $frc_val = $queryFC->result_array();
  //echo $frc_val[0]['value'];  
}
if($comp_prd[0]['component_analysis_report']!='0')
{
  $this->db->select('value');
  $this->db->where('id',$comp_prd[0]['component_analysis_report']);
  $queryFC = $this->db->get('drop_downs');
  $ana_report = $queryFC->result_array();
  //echo $ana_report[0]['value']; 
}


        ?>
        <?php 
      
        if($category_id1[0]['category_id']=='42') { ?> 
        <div class="tooltipnew"> <?php if($category_id1[0]['product_type_id']=='12') {  ?> <h4 class="modal-title">Standard - <?php echo ucfirst($catname[0]['value']." - ".$dealrecord[0]['prdname']); ?></h4><?php } else { ?><h4 class="modal-title">Non Standard - <?php echo ucfirst($catname[0]['value']." - ".$dealrecord[0]['prdname']); ?></h4> <?php } ?>
          
        </div>
      <?php }   if($result['category_id']=='43') { ?> 
      <div class="tooltipnew"> <?php if($result['product_type_id']=='12') {  ?> <h4 class="modal-title">Standard - <?php echo ucfirst($sts_cat[0]['value']." - ".$result['prdname']." - ".strtok($location_arr[0]['name'], '-')); ?></h4><?php } else { ?><h4 class="modal-title">Non Standard - <?php echo ucfirst($sts_cat[0]['value']." - ".$result['prdname']." - ".strtok($location_arr[0]['name'], '-')); ?></h4> <?php } ?>
          
        </div>
      <?php }  if($result['category_id']=='44') { ?>  
      <div class="tooltipnew"> <?php if($result['product_type_id']=='12') {  ?> <h4 class="modal-title">Standard - <?php echo ucfirst($sts_cat[0]['value']." - ".$result['prdname']." - ".strtok($location_arr[0]['name'], '-')); ?></h4><?php } else { ?><h4 class="modal-title">Non Standard - <?php echo ucfirst($sts_cat[0]['value']." - ".$result['prdname']." - ".strtok($location_arr[0]['name'], '-')); ?></h4> <?php } ?>
          
        </div>
        <?php }  if($result['category_id']=='89') { ?>  
      <div class="tooltipnew"> <?php if($result['product_type_id']=='12') {  ?> <h4 class="modal-title">Standard - <?php echo ucfirst($sts_cat[0]['value']." - ".$result['prdname']." - ".strtok($location_arr[0]['name'], '-')); ?></h4><?php } else { ?><h4 class="modal-title">Non Standard - <?php echo ucfirst($sts_cat[0]['value']." - ".$result['prdname']." - ".strtok($location_arr[0]['name'], '-')); ?></h4> <?php } ?>
          
        </div>
      <?php } ?>      
    
        
   <table class="" border="1" style="
    border: black;
" width="100%"  cellpadding="15" >
    <tr>
      <td style="">Biomass Type</td>
      <td style=""><?php echo ucfirst($catname[0]['value']); ?></td>
    </tr>
    <tr>
      <td style="">Description</td>
      <td style=""><?php echo ucfirst($dealrecord[0]['prdname']); ?></td>
    </tr>
    <tr>
      <td style="">Attributes<br> (As per Independent 3rd Party <br> Component Analysis Certificate)</td>
      <td style=""><?php 
      if(count($records1) > 0){
        echo '-';
      }
      foreach ($records1 as $attri) { 
      $this->db->select('value');
      $this->db->where('id', $attri['unit_id']);
      $queryU = $this->db->get('drop_downs');
      $unitnm =  $queryU->result_array();
      //echo $this->db->last_query(); 
      echo  ucwords($attri['attribute_name'])." (".$attri['value'].$unitnm[0]['value'].")"; echo ", <br/>";   
      ?>
      <?php }
      //echo implode(", ",$resultstr);
      ?>
    </td>
    </tr>
      <tr>
      <td style="">Total Potassium and Sodium</td>
      <td style=""><?php   echo  $potassium_sodium[0]['value'] ? $potassium_sodium[0]['value'] : '-';?></td>
    </tr>

    <tr>
      <td style="">Category of Raw Materials 1</td>
      <td style=""><?php if(!empty($rowname)) { echo $rowname; } else { echo "-"; } ?> <?php if(!empty($subrowname)) { ?> (<?php echo $subrowname;?>) <?php } ?></td>
    </tr>
    <tr>
      <td style="">Category of Raw Materials 2 </td>
      <td style=""><?php if(!empty($rowname2)) { echo $rowname2; } else { echo "-"; } ?> <?php if(!empty($subrowname2)) { ?> (<?php echo $subrowname2;?>) <?php } ?></td>
    </tr>
    <tr>
      <td style="">Category of Raw Materials 3</td>
      <td style=""><?php if(!empty($rowname3)) { echo $rowname3; } else { echo "-"; } ?> <?php if(!empty($subrowname3)) { ?> (<?php echo $subrowname3;?>) <?php } ?></td>
    </tr><tr>
    <tr>
      <td style="">Bark Content</td>
      <td style=""><?php echo $comp_prd[0]['bar_content'] ? $comp_prd[0]['bar_content'] : '-';?></td>
    </tr>
    <tr>
      <td style="">Net Calorific Value (GJ/MT)</td>
      <td style=""><?php echo $records[0]['ncv'] ? $records[0]['ncv'] : '-';?></td>
    </tr>
      <td style="">Name of Feedstock Wood Species</td>
      <td style=""><?php echo $comp_prd[0]['feedstock_wood_species'] ? $comp_prd[0]['feedstock_wood_species'] : '-'; ?></td>
    </tr>   
    <tr>
      <td style="">Forestry Certification</td>
      <td style=""><?php echo $frc_val[0]['value'] ? $frc_val[0]['value'] : '-' ; ?></td>
    </tr>   
  <!--   <tr>
      <td style="">3rd Party Biomass Component Analysis Report</td>
      <td style=""><?php echo $ana_report[0]['value']; ?></td>
    </tr> -->
    <tr>
      <td style="">Biomass Product Sample Photo</td>
      <td style=""><img src="<?php echo base_url(); ?>admin_data/product_documents/<?php echo $comp_prd[0]['product_sample_photo']; ?>" width="300px" ></td>
    </tr>
        
    </table>     
       
 
  </div>
</div>
  <div class="col-md-12 text-center prtbtn">
    <div class="row">
      <button class="btn btn-info btn-back" onclick="goBack()" data-toggle="tooltip" title="Go To Back">Back</button>

      <button style="margin-left: 365px;" class="btn btn-info btn-close data-btn-approve-modal" data-toggle="modal" data-target="#declineModal" title="Decline deal" value="decline" id="data-btn-approve-modal" style="margin-right: 12px;margin-top: 2px;height: 35px;" data-id="<?php echo $recordarray['id']; ?>" onclick="getcomment_data(<?php echo $recordarray['id']; ?>)" data-content="<?php echo $recordarray['comment']; ?>" >Decline</button>

    <input type="hidden" name="hiddenSellerId" id="hiddenSellerId" value="<?php if($recordarray['seller_id'] == $recordarray['created_by']){ echo $recordarray['seller_id']; } ?>" >
    
    <input type="hidden" name="hiddenBuyerId" id="hiddenBuyerId" value="<?php if($recordarray['buyer_id'] == $recordarray['created_by']){ echo $recordarray['buyer_id']; } ?>" >

 <div class="modal fade" id="declineModal">
          <div class="modal-dialog">
            <div class="modal-content" id="modc1">
               <!--  <div class="modal-header">
                  <h4 class="modal-title">comment to counter party:</h4>

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> -->
                
                <!-- Modal body -->
                <div class="modal-body">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">Comments to Counter-party:</h6>

                    <input type="text"  style="resize:none;" name="admincomments" id="admincomments" placeholder="Please provide a specific reason to decline this deal">
                     <input type="hidden" value="nego_id" id="ngtid" name="ngtid">
            <p id="demo" style="color:#FF5454;"></p>
                    <br>

                 <div class="modal_button1">
                   
                    <button type="button" id="cnlbtn" class="btn btn-info btn-close" data-dismiss="modal" data-toggle="tooltip" title="go to back">Back</button>
                   
                  
                  <button type="button" name="submit" class="btn btn-info btn-reject " onclick="dealdecline()" data-toggle="tooltip" title="close deal">Submit</button>
           
                  <!-- <a href="" name="submit" class="btn btn-info btn-reject declinbtn" id="declinbtn" data-toggle="tooltip" title="close deal" onclick="msgdecline()">Submit</a> -->

           
                 <!-- onclick="declinedeal()" -->

                  <!-- <button type="submit" value="Submit" class="btn btn-info btn-submit"><?php if($this->uri->segment(2) == 'edit') { ?>Update Offer<?php } else { ?>send<?php } ?> </button>
 -->
                </div>
                  
                </div>
                
                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                  <a href="<?php echo base_url().'Login/dashboard_customer_admin'?>" class="btn btn-info btn-submit" data-toggle="tooltip" title="close deal" style="margin-right: 12px;margin-top: 2px;height: 35px;" data-dismiss="modal">submit</a>

                  <button type="submit" value="Submit" class="btn btn-info btn-submit"><?php if($this->uri->segment(2) == 'edit') { ?>Update Offer<?php } else { ?>send<?php } ?> </button>

                
                  <a href="#" class="btn btn-info  btn-back" data-toggle="tooltip" title="go to back" style="margin-right: 12px;margin-top: 2px;height: 35px;" onclick="goBack()">back</a>
                </div> -->
                
              </div>
            </div>
          </div>
          <?php
//$query = $this->db->get('usercomments');
//$recordarray = $query->result_array();
?>
          <script type="text/javascript">
  
  function getcomment_data(
    ) {
    //alert(ngtid);
    var nego_id = ngtid;
    //var counterparty_comment = comment;
    var counterparty_comment = $('#data-btn-approve-modal').attr('data-content');
   
    //alert("data-btn-approve-modal");
    // var nego_id = $(this).attr('data-id');
    // var counterparty_comment = $(this).attr('data-content');
   
    console.log(nego_id);
    console.log("-");
    console.log(counterparty_comment);
   
    $("#counterparty_comment").html(counterparty_comment);
    $("#ngtid").val(nego_id);
    // $(".aprbtn").attr("onclick", "msgapprovenew("+nego_id+")");
    // $(".rejetcbtn").attr("onclick", "msgrejectnew("+nego_id+")");
   }
   //});
   //});
</script>
<!-- <script>
   function msgdecline() {
    //alert(ngtid);
    var ngtid = $("#ngtid").val();;
    var comment = $("#admincomments").val();
    var hiddenSellerId =  $("#hiddenSellerId").val();
    var hiddenBuyerId =  $("#hiddenBuyerId").val();
   
    console.log("msgdecline data");
    console.log(ngtid);
    console.log(comment);
   
    if (!comment) {
      document.getElementById("demo").innerHTML = "Please enter comment";
      document.getElementById("admincomments").focus();
      return true;
   

   
    } else {
   
      if (confirm("Are you sure you want to decline deal?") == true) {
        $.ajax({
          url: '<?php echo base_url(); ?>Manageasks/declinebidmsg',
          type: 'GET',
          data: {
            ngtid: ngtid,
            comment: comment,
            hiddenSellerId :hiddenSellerId,
            hiddenBuyerId: hiddenBuyerId
          },
          contentType: 'application/json; charset=utf-8',
          success: function(response) {
            // alert('Message has been approved');
            location.reload();
          },
          error: function() {
            //your error code
          }
        });
        if (comment) {
          $('#declinbtn').attr('disabled', true);
          // $('#rejetcbtn').attr('disabled', true);
          // $('#cnlbtn').attr('disabled', true);
        }
      }
   
    }
   }
</script> -->
<script>
   
   
   function dealdecline() {
    //alert(ngtid);
    var ngtid = $("#ngtid").val();;
    var decline_buyer_cmt = $("#admincomments").val();
   
    console.log("dealdecline data");
    console.log(ngtid);
    console.log(decline_buyer_cmt);
   
    //alert(comment);
    if (!decline_buyer_cmt) {
      document.getElementById("demo").innerHTML = "Please enter comment";
      document.getElementById("admincomments").focus();
      return true;
   
    } else
     {
   
      if (confirm("Are you sure you want to Reject?") == true) {
        $.ajax({
          url: '<?php echo base_url(); ?>Managebids/declinemsg',
          type: 'GET',
          data: {
            ngtid: ngtid,
            decline_buyer_cmt: decline_buyer_cmt
          },
          contentType: 'application/json; charset=utf-8',
          success: function(response) {
            //alert('Message has been rejected');
            location.reload();
          },
          error: function() { //alert('err');
            //your error code
          }
        });
        // if (comment) {
        //   $('#aprbtn').attr('disabled', true);
          // $('#rejetcbtn').attr('disabled', true);
        //   $('#cnlbtn').attr('disabled', true);
        // }
   
      }
    }
   }
</script>
        
      <button style="margin-left: 365px;" class="btn btn-info btn-print" data-toggle="tooltip" title="Print Contract" value="print" id="btnPrint" >Print</button>
  </div>
  <div class="row">
    <button style="margin-left: 365px;margin-right: 12px;margin-top: 2px;height: 35px;" data-toggle="modal" title="More Options" data-target="#myModal1" class="btn btn-info btn-back" value="morebtn" id="btnMore" >More Options</button>
    <div class="modal fade" id="myModal1">
          <div class="modal-dialog">
            <div class="modal-content" id="modc2">
                
                

                <!-- Modal body -->
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h6 class="modal-title">More options for requesting seller :</h6>

                <div id="modal_button2" style="margin-bottom: 12px; " class="text-center">
                <a href="<?php echo base_url().'Asks/placeask'?>" class="btn btn-info" data-toggle="tooltip" title="send mail"  style="margin: 10px;height: 75px;width: 150px; font-size: 12px;white-space: initial;text-align: center; justify-content: center; "> Request for providing 
Sample Product</a>

                
                  <a href="#" class="btn btn-info " data-toggle="tooltip" title="go to back"  onclick="goBack()" style="height: 75px; width: 150px; white-space: initial; font-size: 12px; text-align: center;"><span style="margin-top:20px !important">Request for
Site Visit </span></a>

<a href="<?php echo base_url().'Asks/placeask'?>" class="btn btn-info text-justify" data-toggle="tooltip" title="close deal" data-dismiss="modal" style="height: 75px;width: 150px;white-space: initial;font-size: 12px;">Request for
Due Diligence</a>
</div>
<p style="margin-top: 5px;">*You could select one or more options and explore them one by one.</p>

                </div>
                
                <!-- Modal footer -->
                
              </div>
            </div>
          </div>

<button style="margin-left: 365px;" class="btn btn-info btn-print" value="renegotiate" id="btnRenegotiate" data-toggle="tooltip" title="go to renegotiate">Renegotiate</button>

    <button style="margin-left: 365px;" class="btn btn-info btn-Agree" value="agree" id="btnAgree" data-toggle="modal" data-target="#myModal" title="Agree For Deal" >Agree</button>
  
          <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content" id="modc3">
               <!--  <div class="modal-header">
                  <h4 class="modal-title">comment to counter party:</h4>

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> -->
                
                <!-- Modal body -->
                <div class="modal-body">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title" style="margin-left: -25px; font-size: 17px;">do you agree to generate Final Term-sheet with SBTA (Printable) for your final check ?</h6>
                    
                 <div class="modal_button3">
                    <a href="#" class="btn btn-info" data-toggle="tooltip" title="go to back"data-dismiss="modal" style="margin-right:0px;margin-top: 2px;height: 35px;">Back</a>

                    <a href="#" class="btn btn-info" data-toggle="tooltip" title="Renegotiate Deal"  onclick="goBack()" style="margin-right:0px;margin-top: 2px;height: 35px;">Renegotiate</a>
                  

                  <a href="<?php echo base_url().'Login/dashboard_customer_admin'?>" class="btn btn-info" data-toggle="tooltip" title="close deal" style="margin-right:0px;margin-top: 2px;height: 35px;">Yes</a>

                  <!-- <button type="submit" value="Submit" class="btn btn-info btn-submit"><?php if($this->uri->segment(2) == 'edit') { ?>Update Offer<?php } else { ?>send<?php } ?> </button>
 -->
                </div>
                
                </div>
                
                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                  <a href="<?php echo base_url().'Login/dashboard_customer_admin'?>" class="btn btn-info btn-submit" data-toggle="tooltip" title="close deal" style="margin-right: 12px;margin-top: 2px;height: 35px;" data-dismiss="modal">submit</a>

                  <button type="submit" value="Submit" class="btn btn-info btn-submit"><?php if($this->uri->segment(2) == 'edit') { ?>Update Offer<?php } else { ?>send<?php } ?> </button>

                
                  <a href="#" class="btn btn-info  btn-back" data-toggle="tooltip" title="go to back" style="margin-right: 12px;margin-top: 2px;height: 35px;" onclick="goBack()">back</a>
                </div> -->
                
              </div>
            </div>
          </div>

        
  </div>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<!-- for users comment of decline reason -->
<script type="text/javascript">

// function declinedeal() {
//     //alert(ngtid);
//     var ngtid = $("#ngtid").val();;
//     var comment = $("#admincomments").val();
  
//     console.log("declinedeal data");
//     console.log(ngtid);
//     console.log(comment);
//     //alert(comment);
//     if (!comment) {
//       document.getElementById("demo").innerHTML = "Please enter reason for decline the deal";
//       document.getElementById("admincomments").focus();
//       return true;
//     } else
//      {
//       if (confirm("Are you sure you want to decline deal?") == true) {
//         $.ajax({
//           url: '<?php echo base_url(); ?>Managemsgboard/declincomment',
//           type: 'GET',
//           data: {
//             ngtid: ngtid,
//             comment: comment
//           },
//           contentType: 'application/json; charset=utf-8',
//           success: function(response) {
//             //alert('Message has been rejected');
//             location.reload();
//           },
//           error: function() { //alert('err');
//             //your error code
//           }
//         });
//         if (comment) {
//           $('#aprbtn').attr('disabled', true);
//           $('#rejetcbtn').attr('disabled', true);
//           $('#cnlbtn').attr('disabled', true);
//         }
   
//       }
//     }
//    }
</script>
<script>
   function askconfirm(ngtid, askid) {
    //alert(ngtid);
    //alert(askid);
    var ngtid = ngtid;
    var comment = $("#admincomments" + ngtid).val();
    //alert(comment);
   
    if (!comment) {
      document.getElementById("demo" + ngtid).innerHTML = "Please enter comment";
      document.getElementById("admincomments" + ngtid).focus();
      return true;
   
    } else {
      if (confirm("Are you sure you want to approve deal?") == true) {
        $.ajax({
          url: '<?php echo base_url(); ?>Manageasks/confirmdeal',
          type: 'GET',
          data: {
            ngtid: ngtid,
            comment: comment,
            askid: askid
          },
          contentType: 'application/json; charset=utf-8',
          success: function(response) {
            // alert('Deal has been confirmed');
            location.reload();
          },
          error: function() {
            //your error code
          }
        });
      }
    }
   }
</script>

