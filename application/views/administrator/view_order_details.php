<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Print View</title>
      <style>
         body {
         }
         page[size="A4"] { 
         -webkit-background-size: cover;
         -moz-background-size: cover;
         -o-background-size: cover;
         background-size: cover;
         width: 21cm;
         height: 29.7cm;
         display: block;
         margin: 0 auto;
         margin-bottom: 0.5cm;
         }
         @media print {
         body, page[size="A4"] {
         margin: 0;
         box-shadow: 0;
         }
         }
      </style>
      <style type="text/css">
         #customers
         {
         font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
         width:100%;
         border-collapse:collapse;
         }
         #customers td, #customers th 
         {
         font-size:14px;
         /*border:1px solid #046998;*/
         padding:3px 5px;
         }
         #customers th 
         {
         font-size:14px;
         text-align:left;
         color:#000000;
         background-color:#D7D7D7;
         font-weight:bold;
         }
         #customers tr.alt td 
         {
         color:#000000;
         background-color:#c9dce5;
         }
      </style>
   </head>
   <body>
      <page size="A4">
         <div style="margin-bottom:10px;padding:10px;">
          <?php //echo "<pre>"; print_r($OrderData); exit; ?>
            <table align="center" cellpadding="10" cellspacing="0" border="0" width="100%" id="customers" style="line-height:32px;padding:3px;" frame="box" rules="all">
               <tr>
                  <td colspan="7" style="background-color:#D7D7D7;padding:20px;">
                     <div style="font-family:Verdana, Arial, Helvetica, sans-serif;text-align:center;font-weight:bold;font-size:36px;">KD Bhindi Jewellers</div>
                  </td>
               </tr>
               <tr>
                  <td colspan="7" style="text-align:center;line-height:18px;font-size:12px;">Zanzarda Road, opp. Saibaba Temple, Junagadh, Gujarat 362001 India
                  </td>
               </tr>
               <tr>
                  <td colspan="7" style="text-align:center;font-weight:bold;padding:0px;font-weight:bold;font-size:14px;line-height:20px;font-family:Verdana, Arial, Helvetica, sans-serif;">            
                     Online Order inquiry
                  </td>
               </tr>
               <tr>
                  <td colspan="7" style="padding:5px;vertical-align:top">
                     <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" id="customers" style="line-height:12px;width:100%;padding:0px;" frame="void" rules="none">
                        <tr>
                           <td>
                              <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" id="customers" style="line-height:12px;width:100%;padding:0px;" frame="void" rules="none">
                                 <tr>
                                    <td colspan="2"><b><?php echo strtoupper($OrderData['BillingName']);?></b></td>
                                 </tr>
                                 <tr>
                                    <td colspan="2" align="left" style="font-size:12px;line-height:16px;"> 
                                      <?php echo ucwords($OrderData['ShippingAddress']);?>
                                      <br>
                                      <?php echo ucwords($OrderData['ShippingCity']);?> - <?php echo ucwords($OrderData['ShippingZipCode']);?>
                                      <br>
                                      <?php echo ucwords($OrderData['Shippingstatename']);?> - <?php echo ucwords($OrderData['ShippingcountryName']);?> <br>
                                      Contact : <?php echo ucwords($OrderData['ShippingMobileNo']);?><br>
                                      Email : <?php echo $OrderData['BillingEmail'];?>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td style="width:200px;">
                              <table align="right" cellpadding="0" cellspacing="0" border="0" width="100%" id="customers" style="line-height:16px;width:98%;padding:0px;font-size:12px;"  frame="void" rules="none">
                                 <tr>
                                    <td style="border-right:none"><b>Order No.</b></td>
                                    <td style="width:2px;padding:0px;border-left:none;border-right:none;">:</td>
                                    <td align="left" style="border-left:none"><?php echo "ORD".$OrderData['OrderNo'];?></td>
                                 </tr>
                                 <tr>
                                    <td style="border-right:none;width:80px;"><b>Order Date.</b></td>
                                    <td  style="width:2px;padding:0px;border-left:none;border-right:none;">:</td>
                                    <td align="left" style="border-left:none;width:90px;"><?php echo date('d-M-Y',strtotime($OrderData['OrderDate']));?></td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
               <tr>
                  <th style="width:65px;padding:10px;">Sr No</th>
                  <th colspan="4" style="width:430px;">Product Description </th>
                  <th style="text-align:center">Qty</th>
                  <th style="text-align:center">Rate</th>
               </tr>
                <?php  
                  if(!empty($OrderProductDetails)){
                    $i=1;
                    foreach ($OrderProductDetails as $key => $value) {
                      
                ?>
                   <tr class="item <?php echo ($i==count($OrderProductDetails))?"last":''; ?>">
                      <td style="text-align:center;border-bottom:none;border-top:none;"><?php echo ($key+1);?></td>
                      <td  colspan="4" style="border-bottom:none;border-top:none;vertical-align:middle;">
                        <img src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $value['image_name'];?>" height="60" width="auto" /> 
                        <span style="vertical-align:top"><?php echo $value['products_code'];?> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo ucwords($value['collectionshortname']);?> / <?php echo ucwords($value['categoryname']);?></span>
                      </td>
                      <td style="font-weight:bold;text-align:right;border-bottom:none;border-top:none;">
                        <?php echo ucwords($value['products_qty']);?>
                      </td>
                      <td style="font-weight:bold;text-align:right;border-bottom:none;border-top:none;">
                        <?php echo ucwords($value['products_price']);?>
                      </td>
                   </tr>
                <?php 
                    }
                  }
                  for($j=1;$j<=12-$i;$j++){
                ?>
                    <tr class=''>
                      <td style='border-bottom:none;border-top:none;'>&nbsp;</td>
                      <td colspan="4" style='border-bottom:none;border-top:none;'>&nbsp;</td>
                      <td style='border-bottom:none;border-top:none;'>&nbsp;</td>
                    </tr>
                <?php
                  }
                ?>
                <tr>
                  <td colspan="2" style="background-color:#D7D7D7;font-weight:bold;border-right:none;">Total</td>
                  <td colspan="5"  style="text-align:right;padding-right:10px;font-weight:bold;background-color:#D7D7D7;border-left:none;">
                    <?php 
                      if($OrderData['TotalValue']!='' && $OrderData['TotalValue']!='0'){
                        echo '₹ '.number_format($OrderData['TotalValue'],'2','.',',');
                      }else{
                         echo ' - ';
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="line-height:18px;font-size:12px;border-right:none;">
                     <b>Terms &amp; Condition : </b><br />
                     (1) Goods once sold will not be taken back.<br />
                     (2) Interest @18% p.a. will be charged if payment is not made within due date.<br />
                     (3) Our risk and responsibility ceases as soon as the goods leave our premises<br />
                     (4) Subject to Junagadh Jurisdiction Only.
                  </td>
                  <td colspan="3" align="right" style="border-left:none;padding-right:10px;">
                     <span>For, KD Bhindi Jewellers</span><br /><br />
                     <span style="font-size:12px;"><i>(Authorised Signatory)</i></span>
                  </td>
                </tr>
            </table>
            <div style="text-align:center;font-size:12px;font-family:Arial, Helvetica, sans-serif;padding:10px;">This is computer generated Invoice. No Need of Signature. </div>
         </div>
      </page>
   </body>
</html>