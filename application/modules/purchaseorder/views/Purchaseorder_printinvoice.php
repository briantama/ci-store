<?php

$tot = 0;
if($datainv){
  foreach ($datainv as $value) {
    $head[] = $value->PurchaseOrderID."**".$value->PurchaseDate."**".$value->SupplierID."**".$value->SupplierName;
  }

  $sort = array_unique($head);
    foreach ($sort as $value) {
        $expl = explode("**", $value);
        $inv  = $expl[0];
        $dte  = $expl[1];
        $sup  = $expl[2];
        $snm  = $expl[3];
    }

}


?>

<div class='report list-report'>
<div class='header-report'>
<div class='wrap-cap'>
<div class='cap' style='text-align: center; font-weight: bold;'>Purchase Order<br/ >Effective Date : <?php echo date_format(date_create($dte),"d F Y"); ?>
</div>
</div>
</div>

<div id='grid' class='gridvie'>
<div class='gridview'>
    <div class='cap-table'>&nbsp;</div>

        <table >
         <thead>
                  <tr>
                      <th style="text-align: left;">PurchaseOrderID</th>
                      <th colspan="4" style="text-align: left;">: <?php echo $inv; ?> </th>
                    </tr>

                    <tr>
                      <th style="text-align: left;">PurchaseDate</th>
                      <th colspan="4" style="text-align: left;">: <?php echo $dte; ?></th>
                    </tr>

                    <tr>
                      <th style="text-align: left;">SupplierID</th>
                      <th colspan="4" style="text-align: left;">: <?php echo $sup; ?></th>
                    </tr>

                    <tr>
                      <th style="text-align: left;">SupplierName</th>
                      <th colspan="4" style="text-align: left;">: <?php echo $snm; ?></th>
                    </tr>

                     <tr>
                      <th colspan="5">&nbsp;</th>
                    </tr>

                  
                    <tr bgcolor="#f1f1f1">
                      <th>ItemID</th>
                      <th>ItemName</th>
                      <th>Purchase Price</th>
                      <th>Qty</th>
                      <th>Total </th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php   
                    if($datainv){            
                      foreach($datainv as $value){ 

                       $tot += $value->Total;
                    ?>
                    
                    <tr>
                      <td><?php echo $value->ItemID;?></td>
                      <td><?php echo $value->ItemName;?></td>
                      <td style='text-align:right;'><?php echo number_format($value->PurchasePrice); ?></td>
                      <td style='text-align:right;'><?php echo $value->Amount; ?></td>
                      <td style='text-align:right;'><?php echo number_format($value->Total); ?></td>
                    </tr>
                    
                    <?php
                      }
                    }
                    else{
                    ?>

                    <tr>
                      <td colspan="10" style="text-align: center;">No Record Data</td>
                    </tr>

                    <?php
                    }
                    ?>
                    

                    <tr>
                      <td colspan="4">Total Price</td>
                      <td style="text-align: right;"><?php echo number_format($tot); ?></td>
                    </tr>

                     <tr>
                      <td colspan="5">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="5">&nbsp;</td>
                    </tr>

                     <tr>
                      <td >Print By : <?php echo $this->session->userdata('nama'). " - ". date('Y-m-d H:i:s'); ?></td>
                      <td colspan="4">&nbsp;</td>
                    </tr>
                  </tbody>
        </table>
  </div>
</div>
</div>

<style>
      .gridvie {
        font-family: Times New Roman, Times, serif;
        height: 92%;
        overflow: auto; 
      }
      .gridview table { border: 1px solid #00557F; }
      .gridview table .total td {
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ff66b8), color-stop(1,#ff66b8));
        background:-moz-linear-gradient( center top, #ff66b8 5%, #ff66b8 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff66b8', endColorstr='#ff66b8');
        border: 1px solid #00557F;
        color: #000;
        
      }
      .gridview table .total td:first-child { text-align: center; border-right: 1px solid #FFF; }
      .gridview table .total td:last-child { text-align: right; }
      .cap-table, .gridview table { width: 98%; margin: 0 auto; }
      .cap-table { color: #000; padding: 5px 0 5px 0; }
  </style>

<script>window.print();</script>