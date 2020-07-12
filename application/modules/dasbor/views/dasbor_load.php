<?php 


$totitem = 0;
$totsupl = 0;
$totpurc = 0;
$totsale = 0;

//total item data
$qry = $this->db->query("SELECT ItemID
                         FROM   M_MasterItem
                         WHERE  IsActive = 'Y' ");
  if ($qry->num_rows() > 0) {
      $totitem = $qry->num_rows();
  }

//total supplier data
$qry = $this->db->query("SELECT SupplierID
                         FROM   M_MasterSupplier
                         WHERE  IsActive = 'Y' ");
  if ($qry->num_rows() > 0) {
      $totsupl = $qry->num_rows();
  }
  
// total purchase
$qry = $this->db->query("SELECT PurchaseOrderID
                         FROM   T_PurchaseOrder
                         WHERE  IsActive = 'Y'
                                AND Status ='5' ");
  if ($qry->num_rows() > 0) {
      $totpurc = $qry->num_rows();
  }

// total sale
$qry = $this->db->query("SELECT SaleID
                         FROM   T_Sale
                         WHERE  IsActive = 'Y'
                                AND Status ='5' ");
  if ($qry->num_rows() > 0) {
      $totsale = $qry->num_rows();
  }


//chart purchase
  function dateStrTime($totime="", $format="Y-m-d", $dt="") {
    $date = (isDate($dt)) ? $dt . " " : "";
    $temp = date($format, strtotime($date . $totime));
    return $temp;
  }


  function isDate($date="", $format="Y-m-d") {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }


  $chartpurc[] = array("PurchaseDate"=> date('Y-m-d'),"TotalPurchase"=>"0");
  $chartsale[] = array("SaleDate"=> date('Y-m-d'),"TotalSale"=>"0");
  $startdate   = dateStrTime("-10 days");
  $enddate     = date('Y-m-d');

  $qry = $this->db->query("SELECT    PurchaseDate, IFNULL(SUM(TotalPurchase),0) as TotalPurchase
                           FROM      T_PurchaseOrder
                           WHERE     IsActive = 'Y'
                                     AND Status ='5'
                                     AND PurchaseDate BETWEEN '".$startdate."' AND '".$enddate."'
                           GROUP BY  PurchaseDate
                           ORDER BY  PurchaseDate
                           ");
  if ($qry->num_rows() > 0) {
      $chartpurc = $qry->result();
      
  }

  //total sale
  $qry = $this->db->query("SELECT    SaleDate, IFNULL(SUM(TotalSale),0) as TotalSale
                           FROM      T_Sale
                           WHERE     IsActive = 'Y'
                                     AND Status ='5'
                                     AND SaleDate BETWEEN '".$startdate."' AND '".$enddate."'
                           GROUP BY  SaleDate
                           ORDER BY  SaleDate
                           ");
  if ($qry->num_rows() > 0) {
      $chartsale = $qry->result();
      
  }
  //echo json_encode($chartpurc);
  //echo $startdate." - ".$enddate;


?>



<div class="main-grid">
      
  <div class="social grid">
          <div class="grid-info">
            <div class="col-md-3 top-comment-grid">
              <div class="comments likes">
                <div class="comments-icon">
                  <i class="fa fa-archive fa-4x" style="color: #d8d8d8;"></i>
                </div>
                <div class="comments-info likes-info">
                  <h3><?php echo $totitem; ?></h3>
                  <a href="#">Item</a>
                </div>
                <div class="clearfix"> </div>
              </div>
            </div>
            <div class="col-md-3 top-comment-grid">
              <div class="comments">
                <div class="comments-icon">
                  <i class="fa fa-users fa-4x" style="color: #d8d8d8;"></i>
                </div>
                <div class="comments-info">
                  <h3><?php echo $totsupl; ?></h3>
                  <a href="#">Supplier</a>
                </div>
                <div class="clearfix"> </div>
              </div>
            </div>
            <div class="col-md-3 top-comment-grid">
              <div class="comments tweets">
                <div class="comments-icon">
                  <i class="fa fa-shopping-cart fa-4x" style="color: #d8d8d8;"></i>
                </div>
                <div class="comments-info tweets-info">
                  <h3><?php echo $totpurc; ?></h3>
                  <a href="#">Purcahse Order</a>
                </div>
                <div class="clearfix"> </div>
              </div>
            </div>
            <div class="col-md-3 top-comment-grid">
              <div class="comments views">
                <div class="comments-icon">
                  <i class="fa fa-list-alt fa-4x" style="color: #d8d8d8;"></i>
                </div>
                <div class="comments-info views-info">
                  <h3><?php echo $totsale; ?></h3>
                  <a href="#">Sale</a>
                </div>
                <div class="clearfix"> </div>
              </div>
            </div>
            <div class="clearfix"> </div>
          </div>
  </div>


  <div class="agile-last-grids">
        <div class="col-md-6 agile-last-left agile-last-middle">
          <div class="agile-last-grid">
            <div class="area-grids-heading">
              <h3><i class="fa fa-bar-chart"></i> Daily Chart Total Purchase</h3>
            </div>
            <div id="graph8"></div>
            <script>
            /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
            var day_data = <?php echo json_encode($chartpurc); ?>;
            Morris.Bar({
              element: 'graph8',
              data: day_data,
              xkey: 'PurchaseDate',
              ykeys: ['TotalPurchase'],
              labels: ['TotalPurchase'],
              xLabelAngle: 60
            });
            </script>
          </div>
        </div>
        </div>
       
        <div class="col-md-6 agile-last-left agile-last-right">
          <div class="agile-last-grid">
            <div class="area-grids-heading">
              <h3><i class="fa fa-line-chart"></i> Daily Chart Total Sale</h3>
            </div>
            <div id="graph9"></div>
            <script>
            var day_data2 = <?php echo json_encode($chartsale); ?>;
            Morris.Line({
              element: 'graph9',
              data: day_data2,
              xkey: 'SaleDate',
              ykeys: ['TotalSale'],
              labels: ['TotalSale'],
              xLabelAngle: 60
            });
            </script>

          </div>
        </div>
        <div class="clearfix"> </div>
      </div>      
      
</div>