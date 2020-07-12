<?php

    $pco  = "";
    $pcod = "";
    $str  = "<div class='report list-report'>";
    $str .= "<div class='header-report'>";
    $str .= "<div class='wrap-cap'>";
    $str .= "<div class='cap'>";
    $str.= "<div class='cap' style='text-align: center; font-weight: bold;'> Report Sale<br/ >Effective Date : ".date_format(date_create($StartDate),"d F Y")." - ".date_format(date_create($EndDate),"d F Y");
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
      $tbl .= "<td>SaleDate</td>";
      $tbl .= "<td>ItemID</td>";
      $tbl .= "<td>ItemName</td>";
      $tbl .= "<td>SellingPrice</td>";
      $tbl .= "<td>Amount</td>";
      $tbl .= "<td>Total</td>";
      $tbl .= "</tr>";
      $tbl .= "</thead>";
      $tbl .= "<tbody>";
      $x = 0;
      $str .= $tbl;
      foreach($keys as $value){ 
        $evenOdd = ($x % 2 == 0) ? "even" : "odd";        
        if ($pco != $value->SaleID) {
          if ($pco != "") {
            $str .= "<tr class='total'>";
            $str .= "<td colspan='5'>Total Sale</td>";
            $str .= "<td style=\"text-align: right;\">". number_format($tot) ."</td>";
            $str .= "</tr>";
            $str .= "</tbody>";
            $str .= "</table><br>";
            $str .= $tbl;
            $tot  = 0;
          }
          
          $str .= "<div class='cap-table'>". $value->SaleID . "</div>";
          
          $pco      = $value->SaleID;
        }  
        else {
          $pco      = $value->SaleID;
        }      
        
        $tot += $value->Total;
        $str .= "<tr class='". $evenOdd ."'>";
        $str .= "<td nowrap title=\"SaleDate\">". date_format(date_create($value->SaleDate),"d F Y")  ."</td>";
        $str .= "<td nowrap title=\"ItemID\">". $value->ItemID ."</td>";
        $str .= "<td nowrap title=\"ItemName\">".  $value->ItemName ."</td>";
        $str .= "<td nowrap title=\"SellingPrice\" style=\"text-align: right;\">". number_format($value->SellingPrice)."</td>";
        $str .= "<td nowrap title=\"Amount\" style=\"text-align: right;\">". number_format($value->Amount) ."</td>";
        $str .= "<td nowrap title=\"Total\" style=\"text-align: right;\">". number_format($value->Total) ."</td>";
        $str .= "</tr>";
        $x++;
      }
      $str .= "<tr class='total'>";
      $str .= "<td colspan='5'>Total Sale</td>";
      $str .= "<td style=\"text-align: right;\">". number_format($tot) ."</td>";
      $str .= "</tr>";
      $str .= "</tbody>";
      $str .= "</table><br>";
    }
    else {
      $str .= "<div class=\"info\">No Data Report Sale/div>";
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

<script>window.print();</script>
