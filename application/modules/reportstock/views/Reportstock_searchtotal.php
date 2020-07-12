<?php
  
    $pco  = "";
    $pcod = "";
    $str  = "<div class='report list-report'>";
    $str .= "<div class='header-report'>";
    $str .= "<div class='wrap-cap'>";
    $str .= "<div class='cap'>";
     $str.= "<a href='".base_url()."reportstock/viewReportStock/print/".urlencode(serialize($keys))."?StartDate=".$StartDate."&EndDate=".$EndDate."&RptType=".$RptType."' target='/_blank' class='btn btn-warning' style='margin-left:10px;'><i class='fa fa-print'></i> print</a>";
    $str.= "<a href='".base_url()."reportstock/viewReportStock/export/".urlencode(serialize($keys))."?StartDate=".$StartDate."&EndDate=".$EndDate."&RptType=".$RptType."' target='/_blank' class='btn btn-success' style='margin-left:10px;'><i class='fa fa-file-excel-o'></i> export</a>";
    $str.= "<div class='cap' style='text-align: center; font-weight: bold;'> Report Purchase Order<br/ >Effective Date : ".date_format(date_create($StartDate),"d F Y");
    $str .= "</div>";
    $str .= "</div>";
    $str .= "</div>";
    $str .= "<div id='grid' class='gridvie'>";
    $str .= "<div class='gridview'>";
    if(!empty($keys)){
      $date = "";
      $tot  = 0;
      $tbl  = "<table id='pure-table'>";
      $tbl .= "<thead>";
      $tbl .= "<tr class='total'>";
      $tbl .= "<td>Stock</td>";
      $tbl .= "<td>StockIN</td>";
      $tbl .= "<td>StockOut</td>";
      $tbl .= "<td>Total Stock</td>";
      $tbl .= "</tr>";
      $tbl .= "</thead>";
      $tbl .= "<tbody>";
      $x = 0;
      $str .= $tbl;
      foreach($keys as $value){ 
        $evenOdd = ($x % 2 == 0) ? "even" : "odd";        
        if ($pco != trim($value->ItemID)) {
          if ($pco != "") {
            $str .= "<tr class='total'>";
            $str .= "<td colspan='3'>Total Stock Available</td>";
            $str .= "<td style=\"text-align: right;\">". number_format($tot) ."</td>";
            $str .= "</tr>";
            $str .= "</tbody>";
            $str .= "</table><br>";
            $str .= $tbl;
            $tot  = 0;
          }
          
          $str .= "<div class='cap-table'>". $value->ItemID . " - " . $value->ItemName . "</div>";
          
          $pco      = $value->ItemID;
        }  
        else {
          $pco      = $value->ItemID;
        }      
        
        $tot += $value->Stock;
        $str .= "<tr class='". $evenOdd ."'>";
        $str .= "<td nowrap title=\"Stock\" style=\"text-align: right;\">". number_format($value->Stock)."</td>";
        $str .= "<td nowrap title=\"StockIn\" style=\"text-align: right;\">". number_format($value->StockIn) ."</td>";
        $str .= "<td nowrap title=\"StockOut\" style=\"text-align: right;\">". number_format($value->StockOut) ."</td>";
        $str .= "<td nowrap title=\"StockOut\" style=\"text-align: right;\">". number_format($value->StockOut) ."</td>";
        $str .= "</tr>";
        $x++;
      }
      $str .= "<tr class='total'>";
      $str .= "<td colspan='3'>Total Stock Available</td>";
      $str .= "<td style=\"text-align: right;\">". number_format($tot) ."</td>";
      $str .= "</tr>";
      $str .= "</tbody>";
      $str .= "</table><br>";
    }
    else {
      $str .= "<div class=\"info\">No Data Report Item Stock/div>";
    }

    $str .= "</div>"; // end div gridview
    $str .= "</div>"; // end div gridvie
    $str .= "</div>"; // end div report

    echo $str;


?>


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




