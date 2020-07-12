  <?php

  $hedaer = "-----";
  $foter  = "-----";
  $imgurl = "";

  $res    = $this->db->query("
                          SELECT  SettupprintID, SetupHeader, SetupFooter, SetupImage, SetupImageShow
                          FROM    M_Setupprint
                          ");
  if ($res->num_rows() > 0) {
    $settl  = $res->row();
    $hedaer = $settl->SetupHeader;
    $foter  = $settl->SetupFooter;
    $cekimg = (trim($settl->SetupImage) != "") ? $settl->SetupImage : "default.jpeg";

    if($settl->SetupImageShow == "N"){
      $imgurl = "";
    }
    else{
      if(file_exists("./upload/print/".$cekimg)){
        $imgurl = '<img src="'.base_url()."upload/print/".$cekimg.'" class="img-convert img-center" alt="Logo">';
      }
      else{
        $imgurl = '<img src="'.base_url().'"upload/print/default.jpeg" class="img-convert img-center" alt="Logo">';
        
      }
    }
  } 

$tot = 0;
$str = '<div class="billprint">';
$str.= $imgurl;
$str.= '<p class="centered">'.$hedaer.'</p>';

$str.= '<table class="headerbill">';
$str.= '<tr>';
$str.= '<td>Date</td>';
$str.= '<td>: '.date('Y-m-d').'</td>';
$str.= '</tr>';
$str.= '<tr>';
$str.= '<td>No Invoice</td>';
$str.= '<td>: SAL-2006-******</td>';
$str.= '</tr>';
$str.= '</table>';
$str.= '<br>';

$str.= '<table class="contentbill">';
$str.= '<thead>';
$str.= '<tr class="contentbil">';
$str.= '<th class="description">Item</th>';
$str.= '<th class="quantity">Qty</th>';
$str.= '<th class="price">Price (Rp)</th>';
$str.= '<th class="total">Total </th>';
$str.= '</tr>';
$str.= '</thead>';
$str.= '<tbody>';
                   
         
$str.= '<tr class="contentbil">';
$str.= '<td class="description">Item 1</td>';
$str.= '<td class="quantity" style="text-align: center;">1</td>';
$str.= '<td class="price" style="text-align: right;">5,000</td>';
$str.= '<td class="total" style="text-align: right;">5,000</td>';
$str.= '</tr>';

$str.= '<tr class="contentbil">';
$str.= '<td class="description">Item 2</td>';
$str.= '<td class="quantity" style="text-align: center;">2</td>';
$str.= '<td class="price" style="text-align: right;">3,000</td>';
$str.= '<td class="total" style="text-align: right;">6,000</td>';
$str.= '</tr>';

$str.= '<tr class="contentbil">';
$str.= '<td class="description">Item 3</td>';
$str.= '<td class="quantity" style="text-align: center;">3</td>';
$str.= '<td class="price" style="text-align: right;">4,000</td>';
$str.= '<td class="total" style="text-align: right;">12,000</td>';
$str.= '</tr>';
                    


$str.= '<tr class="contentbil">';
$str.= '<td class="description">&nbsp;</td>';
$str.= '<td class="quantity">&nbsp;</td>';
$str.= '<td class="price">Total</td>';
$str.= '<td class="total" style="text-align: right;">23,000</td>';
$str.= '</tr>';

$str.= '</tbody>';
$str.= '</table>';
$str.= '<p class="listbill">Print By : '.$this->session->userdata('nama').'</p>';

$str.= '<p class="centered">'.$foter.'</p>';
$str.= '</div>';


echo $str;
?>

<style type="text/css">
    
    * {
    font-size: 12px;
    font-family: 'Times New Roman';
}

.img-convert{
  width: 80px;
  height: 80px;
  margin-left: 40%;
}

.img-center{
  display: block;
  margin-left: 32%;

}

td.contentbil,
th.contentbil,
tr.contentbil,
table.contentbill {
    border-top: 1px solid black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 100px;
    max-width: 100px;
}

td.quantity,
th.quantity {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.price,
th.price {
    width: 65px;
    max-width: 65px;
    word-break: break-all;
}

td.total,
th.total {
    width: 65px;
    max-width: 65px;
    word-break: break-all;
}

table.headerbill {
    border-top: 0px solid black;
    border-collapse: collapse;
}

.centered {
    width: 270px;
    max-width: 270px;
    text-align: center;
    align-content: center;
}

.listbill{
    text-align: left;
}


.billprint {
    width: 300px;
    max-width: 300px;
}

img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}

</style>



<script>window.print();</script>