<link href="<?php echo ADMIN_CSS; ?>bid_style.css" rel="stylesheet" />
<script type="text/javascript">
   $(document).ready(function() {
   
   	$('#basic_validate').validate();
   	$.validator.setDefaults({
   		ignore: ":hidden:not(.chosen-select)"
   	})
   
   });
</script>
<?php
   $this->db->select('*');
   $this->db->where('ask_id', $this->uri->segment(3));
   $this->db->order_by("id", "desc");
   $query31 = $this->db->get('negotiations');
   $ngt_arr = $query31->result_array();
   //echo "<pre>";
   //print_r($ngt_arr);
   ?>
<div class="xs" id="main_refresh_div">
   <div class="tab-content" id="tab-content">
      <div class="header"><?php echo $form_title; ?> <a href="<?php echo base_url(); ?>Manageasks" class="btn btn-info btn-back" style="float:right !important;">Back</a></div>
      <br>
      <!--start negotiations tracking-->
      <!-- <div class="col-md-12">
         <div class="row">
         <?php if (empty($ngt_arr)) { ?>
         <div class="col-md-1 tempp" id="first">
             <div class="gray">
             <div  class="truck_nonactive">
               <img src="<?php echo base_url(); ?>assets/images/truck_vehicle.png" class="truck_img" alt="truck">
             </div>
               <div class="tr_text">Negotiation on major terms</div>
               <div class="rect_gray">
                 <div class="tr_white"></div>
                 <div class="tr_gray"></div>
               </div>
             </div>
           </div>
         
         <div class="col-md-1 tempp" id="first">
             <div class="gray">
             <div  class="truck_nonactive">
               <img src="<?php echo base_url(); ?>assets/images/truck_vehicle.png" class="truck_img" alt="truck">
             </div>
               <div class="tr_text">Final Transaction Summary</div>
               <div class="rect_gray">
                 <div class="tr_white"></div>
                 <div class="tr_gray"></div>
               </div>
             </div>
           </div>
         <?php } ?> 
         <?php if (!empty($ngt_arr)) {
            if (($ngt_arr[0]['is_finalized'] == '0' && $ngt_arr[0]['is_confirm'] == '0') || ($ngt_arr[0]['is_finalized'] == '0' && $ngt_arr[0]['is_confirm'] == '1') || ($ngt_arr[0]['is_finalized'] == '1' && $ngt_arr[0]['is_confirm'] == '0')) {  ?>	
         <div class="col-md-1 tempp" id="first">
             <div class="green">
             <div class="truckactive_red">
               <img src="<?php echo base_url(); ?>assets/images/truck_vehicle.png" class="truck_img" alt="truck">
             </div>
               <div class="tr_text">Negotiation on major terms</div>
               <div class="rect_green">
                 <div class="tr_white"></div>
                 <div class="tr_green"></div>
               </div>
             </div>
           </div>
         <div class="col-md-1 tempp" id="first">
             <div class="gray">
             <div  class="truck_nonactive">
               <img src="<?php echo base_url(); ?>assets/images/truck_vehicle.png" class="truck_img" alt="truck">
             </div>
               <div class="tr_text">Final Transaction Summary</div>
               <div class="rect_gray">
                 <div class="tr_white"></div>
                 <div class="tr_gray"></div>
               </div>
             </div>
           </div>
         <?php }
            } ?> 
         <?php if (!empty($ngt_arr)) {
            if ($ngt_arr[0]['is_finalized'] == '1' && $ngt_arr[0]['is_confirm'] == '1') {  ?>	
         
         <div class="col-md-1 tempp" id="first">
             <div class="gray">
             <div  class="truck_nonactive">
               <img src="<?php echo base_url(); ?>assets/images/truck_vehicle.png" class="truck_img" alt="truck">
             </div>
               <div class="tr_text">Negotiation on major terms </div>
               <div class="rect_gray">
                 <div class="tr_white"></div>
                 <div class="tr_gray"></div>
               </div>
             </div>
           </div>
         <div class="col-md-1 tempp" id="first">
             <div class="green">
             <div class="truckactive_red">
               <img src="<?php echo base_url(); ?>assets/images/truck_vehicle.png" class="truck_img" alt="truck">
             </div>
               <div class="tr_text">Final Transaction Summary</div>
               <div class="rect_green">
                 <div class="tr_white"></div>
                 <div class="tr_green"></div>
               </div>
             </div>
           </div>
         <?php }
            } ?> 
         
         </div>
         </div>
         -->
      <!--end negotiations tracking-->
      <!-- <?php
         if (!empty($ngt_arr)) {
         	if ($ngt_arr[0]['ngt_accept_seller'] == '1' && $ngt_arr[0]['ngt_accept_buyer'] == '1') {
         		?>
         <a href="<?php echo base_url(); ?>Transaction_summary/details/<?php echo $ngt_arr[0]['id'] ?>"><button type="button" class="btn btn-info" style="float:right !important;">View Final Transaction Summary</button></a>
         <?php }
            } ?> -->
      <?php
         if ($this->session->flashdata('item')) {
         	$message = $this->session->flashdata('item');
         	echo '<div class="' . $message['class'] . '">
         <button class="close" data-dismiss="alert">×</button>' . $message['message'] . '</div>';
         }
         
         //print_r($askrecord);
         //print_r( $ngtrecord);
         $this->db->select('name');
         $this->db->where('id', $askrecord[0]['ask_status_id']);
         $query22 = $this->db->get('ask_bid_status');
         $sts_arr22 = $query22->result_array();
         
         $mktids = $askrecord[0]['market_id'];
         if ($mktids) {
         	$query1 = $this->db->query('SELECT name FROM markets where id IN (' . $mktids . ')');
         	$q = $query1->result_array();
         }
         
         $id = $this->uri->segment(3);
         $this->db->select('id');
         $this->db->where('ask_id', $id);
         $this->db->where('is_confirm', 1);
         $query32 = $this->db->get('negotiations');
         $ngt_arr1 = $query32->result_array();
         //echo count($ngt_arr);
         
         $this->db->select('value');
         $this->db->where('id', $askrecord[0]['category_id']);
         $query21 = $this->db->get('drop_downs');
         $cat_arr = $query21->result_array();
         
         
         $this->db->select('value');
         $this->db->where('id', $askrecord[0]['payment_method']);
         $query28 = $this->db->get('drop_downs');
         $pay_arr = $query28->result_array();
         
         $this->db->select('value');
         $this->db->where('id', $askrecord[0]['qty_mt']);
         $query255 = $this->db->get('drop_downs');
         $qty_mt_arr = $query255->result_array();
         ?>
      <!-- Add Fixed Offer Table -->
      <div class="">
         <h4 style="">Original offer details</h4>
         <table class="black-table-header table table-bordered data-table table-hovered dataTable no-footer" id="" role="" aria-describedby="datatable_info">
            <thead>
               <tr>
                  <th><strong>Offer Id:</strong><br><?php echo $askrecord[0]['ask_id']; ?></th>
                  <th><strong>Biomass Type:</strong><br> <?php echo ucfirst($cat_arr[0]['value']); ?></th>
                  <th><strong> Product:</strong><span data-toggle="modal" data-target="#myModal" style="cursor:pointer;">&nbsp; <i class="fa fa-info-circle"></i></span><br> <?php echo $askrecord[0]['prdname']; ?></th>
                  <th><strong>Net Calorific Value (GJ/MT):</strong><br> <?php echo $askrecord[0]['ncv']; ?></th>
                  <!--  <th style="
                     background-color: gray;
                     "><strong> Delivery Points:</strong><br> <?php echo $currentngtrec[0]['locnamed']; ?></th> -->
                  <th><strong>Origin:</strong><br> <?php echo $askrecord[0]['locname']; ?></th>
                  <th><strong>Market:</strong><br> <?php
                     foreach ($q as $marketnm) {
                     	$resultstrM[] = $marketnm['name'];
                     }
                     echo implode(", ", $resultstrM);
                     
                     ?></th>
               </tr>
            </thead>
         </table>
      </div>
      <div class="">
         <table class="black-table-header table table-bordered data-table table-hovered dataTable no-footer" id="" role="" aria-describedby="datatable_info">
            <thead>
               <tr>
                  <th><strong>Transaction Type:</strong><br> <?php echo ucfirst($askrecord[0]['transaction_type']); ?>
                     <?php if ($askrecord[0]['transaction_type'] == 'forward') { ?>
                     <span> - <?php echo $askrecord[0]['transaction_value']; ?></span>
                     <?php } ?> 
                  </th>
                  <th><strong>Incoterm:</strong><br> <?php echo $askrecord[0]['incoterm']; ?></th>
                  <th><strong>Price/MT:</strong><br> <?php echo $askrecord[0]['symbol']; ?><?php echo $askrecord[0]['price']; ?></th>
                  <th><strong>Volume (MT):</strong><br> <?php echo number_format($askrecord[0]['volume']); ?></th>
                  <th><strong>Payment Terms:</strong><br> <?php echo $pay_arr[0]['value']; ?></th>
                  <th><strong>Type of Packing:</strong><br> <?php echo $askrecord[0]['packname']; ?></th>
               </tr>
            </thead>
         </table>
      </div>
      <div class="">
         <table class="black-table-header table table-bordered data-table table-hovered dataTable no-footer" id="" role="" aria-describedby="datatable_info">
            <thead>
               <tr>
                  <th><strong>Delivery Period :</strong><br> From : <?php echo date($this->config->item('date_format_short'), strtotime($askrecord[0]['delivery_time'])); ?>&nbsp; - &nbsp; To : <?php echo date($this->config->item('date_format_short'), strtotime($askrecord[0]['delivery_time_to'])); ?> </th>
                  <th><strong>Volume Tolerance: </strong><br> <?php echo $qty_mt_arr[0]['value']; ?></th>
                  <th><strong>Created On :</strong><br> <?php echo date($this->config->item('date_format_short'), strtotime($askrecord[0]['created_on'])); ?></th>
                  <th><strong>Offer Status :</strong><br> <?php echo $sts_arr22[0]['name']; ?></th>
                  <th><strong>Expiry Date :</strong><br> <?php echo date($this->config->item('date_format_short'), strtotime($askrecord[0]['expiry_date'])); ?></th>
               </tr>
            </thead>
         </table>
      </div>
      <!-- END Fixed Bid Table -->
      <?php
         $siteUrl = $this->config->item('base_url_plain');
         $owner_detail_link = sprintf('%s/Users/view_user/%d', $siteUrl, $askrecord[0]['created_by']);
         ?>
      <p class="alert alert-info">
         <span>Owner: </span><strong><?php echo sprintf('%s %s', $askrecord[0]['first_name'], $askrecord[0]['last_name']); ?></strong>
         <br />
         <span>Company: </span><strong><?php echo $askrecord[0]['company_name']; ?></strong>
      </p>
      <p class="alert alert-warning">Deal validity is 90 days from the date of posting</p>
      <div class="tab-pane active" id="horizontal-form">
         <form class="form-horizontal" method="post" name="basic_validate" id="basic_validate">
            <div class="row">
               <div class="col-md-12" id="bord">
                  <!--  <div class="col-md-6">   
                     <div class="form-group">
                     		<label class="control-label">Offer Id </label>
                     		<div class="form-control1"><?php echo $askrecord[0]['ask_id']; ?></div>								
                     </div>				
                     <div class="form-group">
                     	<label class="control-label">Market</label>
                     	<textarea class="form-control1" rows="1" style="height: 29px;" disabled><?php
                        foreach ($q as $marketnm) {
                        	$resultstrM[] = $marketnm['name'];
                        }
                        echo implode(", ", $resultstrM); ?></textarea>
                     </div>
                     <div class="form-group">
                     	<label class="control-label">Biomass Type</label>
                     	<div class="form-control1"><?php echo ucfirst($cat_arr[0]['value']); ?></div>					 				
                     </div> -->
                  <!-- product info start -->
                  <?php
                     $this->db->select('value');
                     $this->db->where('id', $askrecord[0]['category_id']);
                     $query21 = $this->db->get('drop_downs');
                     $sts_cat = $query21->result_array();
                     
                     $this->db->select('*');
                     $this->db->where('id', $askrecord[0]['product_id']);
                     $query21 = $this->db->get('company_products');
                     $comp_prd = $query21->result_array();
                     //echo $this->db->last_query();	
                     //echo"<pre>";print_r($comp_prd);
                     
                     
                     if ($comp_prd[0]['raw_material_type'] != '0') {
                     	$this->db->select('cat_name');
                     	$this->db->where('id', $comp_prd[0]['raw_material_type']);
                     	$query24 = $this->db->get('raw_materials');
                     	$sts_row = $query24->result_array();
                     	$rowname = $sts_row[0]['cat_name'];
                     }
                     
                     if ($comp_prd[0]['raw_material_type2'] != '0') {
                     	$this->db->select('cat_name');
                     	$this->db->where('id', $comp_prd[0]['raw_material_type2']);
                     	$query242 = $this->db->get('raw_materials');
                     	$sts_row2 = $query242->result_array();
                     	$rowname2 = $sts_row2[0]['cat_name'];
                     }
                     
                     if ($comp_prd[0]['raw_material_type3'] != '0') {
                     	$this->db->select('cat_name');
                     	$this->db->where('id', $comp_prd[0]['raw_material_type3']);
                     	$query243 = $this->db->get('raw_materials');
                     	$sts_row3 = $query243->result_array();
                     	$rowname3 = $sts_row3[0]['cat_name'];
                     }
                     
                     if ($comp_prd[0]['row_sub_type'] != '0') {
                     	$this->db->select('cat_name');
                     	$this->db->where('id', $comp_prd[0]['row_sub_type']);
                     	$query25 = $this->db->get('raw_materials');
                     	$sts_subrow = $query25->result_array();
                     	$subrowname = $sts_subrow[0]['cat_name'];
                     }
                     
                     
                     if ($comp_prd[0]['row_sub_type2'] != '0') {
                     	$this->db->select('cat_name');
                     	$this->db->where('id', $comp_prd[0]['row_sub_type2']);
                     	$query252 = $this->db->get('raw_materials');
                     	$sts_subrow2 = $query252->result_array();
                     	$subrowname2 = $sts_subrow2[0]['cat_name'];
                     }
                     
                     
                     if ($comp_prd[0]['row_sub_type3'] != '0') {
                     	$this->db->select('cat_name');
                     	$this->db->where('id', $comp_prd[0]['row_sub_type3']);
                     	$query253 = $this->db->get('raw_materials');
                     	$sts_subrow3 = $query253->result_array();
                     	$subrowname3 = $sts_subrow3[0]['cat_name'];
                     }
                     
                     if ($comp_prd[0]['forestry_certification'] != '0') {
                     	$this->db->select('value');
                     	$this->db->where('id', $comp_prd[0]['forestry_certification']);
                     	$queryFC = $this->db->get('drop_downs');
                     	$frc_val = $queryFC->result_array();
                     	$Forestry = $frc_val[0]['value'];
                     }
                     if ($comp_prd[0]['component_analysis_report'] != '0') {
                     	$this->db->select('value');
                     	$this->db->where('id', $comp_prd[0]['component_analysis_report']);
                     	$queryFC = $this->db->get('drop_downs');
                     	$ana_rpt = $queryFC->result_array();
                     	$ana_report = $ana_rpt[0]['value'];
                     }
                     if ($comp_prd[0]['potassium_sodium'] != '0') {
                     	$this->db->select('value');
                     	$this->db->where('id', $comp_prd[0]['potassium_sodium']);
                     	$queryFC = $this->db->get('drop_downs');
                     	$potassium_sodium = $queryFC->result_array();
                     	//echo $ana_report[0]['value'];	
                     
                     }
                     $this->db->select('product_attributes.*,attributes.attribute_name,attributes.unit_id');
                     $this->db->join('attributes', 'product_attributes.attribute_id = attributes.id ');
                     $this->db->where('product_attributes.product_id ', $askrecord[0]['prdid']);
                     $queryA = $this->db->get('product_attributes');
                     $rec = $queryA->result_array();
                     //echo $this->db->last_query();	
                     
                     $this->db->select('woody');
                     $this->db->where('id', $comp_prd[0]['product_id']);
                     $query2 = $this->db->get('products');
                     $woody = $query2->result_array();
                     
                     $this->db->select('name');
                     $this->db->where('id', $askrecord[0]['countries_id']);
                     $query21 = $this->db->get('countries');
                     $countriesName = $query21->result_array();
                     
                     
                     ?>
                  <div id="myModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div id="printableArea">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"><?php echo ucfirst($askrecord[0]['prdname']).' - '.$countriesName[0]['name']; ?></h4>
                              </div>
                              <div class="modal-body">
                                 <table class="table table-bordered data-table table-hovered popup">
                                    <tr>
                                       <td>Biomass Type</td>
                                       <td><?php echo $sts_cat[0]['value'] ? ucfirst($sts_cat[0]['value']) : '-'; ?></td>
                                    </tr>
                                    <tr>
                                       <td>Description</td>
                                       <td><?php echo $askrecord[0]['description'] ? ucfirst($askrecord[0]['description']) : '-'; ?></td>
                                    </tr>
                                    <tr>
                                       <td>Attributes <br>(As per Independent 3rd Party Component Analysis Certificate)</td>
                                       <td><?php if(!empty($rec)){ foreach ($rec as $attri) {
                                          $this->db->select('value');
                                          $this->db->where('id', $attri['unit_id']);
                                          $queryU = $this->db->get('drop_downs');
                                          $unitnm =  $queryU->result_array();
                                          echo $attri['attribute_name'] . "(" . $attri['value'] . $unitnm[0]['value'] . "),<br/>";
                                          
                                          ?>
                                          <?php } }
                                             else { echo '-';}
                                             ?>
                                       </td>
                                    </tr>
                                    <?php if ($woody[0]['woody']) { ?>
                                    <tr>
                                       <td>Pellet Class</td>
                                       <td><?php echo  $woody[0]['woody']; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                       <td>Total Potassium and Sodium</td>
                                       <td><?php echo  $potassium_sodium[0]['value'] ? $potassium_sodium[0]['value'] : '-'; ?></td>
                                    </tr>
                                    <tr>
                                       <td>Category of Raw Materials 1</td>
                                       <td><?php if (!empty($rowname)) {
                                          echo $rowname;
                                          } else{ echo '-'; } ?> <?php if (!empty($subrowname)) { ?> (<?php echo $subrowname; ?>) <?php } ?></td>
                                    </tr>
                                    <tr>
                                       <td>Category of Raw Materials 2 </td>
                                       <td><?php if (!empty($rowname2)) {
                                          echo $rowname2;
                                          } else{ echo '-'; } ?> <?php if (!empty($subrowname2)) { ?> (<?php echo $subrowname2; ?>) <?php } ?></td>
                                    </tr>
                                    <tr>
                                       <td>Category of Raw Materials 3</td>
                                       <td><?php if (!empty($rowname3)) {
                                          echo $rowname3;
                                          } else{ echo '-'; } ?> <?php if (!empty($subrowname3)) { ?> (<?php echo $subrowname3; ?>) <?php } ?></td>
                                    </tr>
                                    <tr>
                                       <td>Bark Content</td>
                                       <td><?php echo $comp_prd[0]['bar_content'] ? $comp_prd[0]['bar_content'] : '-'; ?></td>
                                    </tr>
                                    <tr>
                                       <td>Net Calorific Value (GJ/MT)</td>
                                       <td><?php echo $comp_prd[0]['ncv'] ? $comp_prd[0]['ncv'] : '-'; ?></td>
                                    </tr>
                                    <!-- <tr>
                                       <td>Country of Origin</td>
                                       <td><?php // echo $countriesName[0]['name'] ? $countriesName[0]['name'] : '-'; ?></td>
                                       </tr> -->
                                    <tr>
                                       <td>Name of Feedstock Wood Species</td>
                                       <td><?php echo $comp_prd[0]['feedstock_wood_species'] ? $comp_prd[0]['feedstock_wood_species'] : '-'; ?></td>
                                    </tr>
                                    <tr>
                                       <td>Forestry Certification</td>
                                       <td><?php echo $Forestry ? $Forestry : '-'; ?></td>
                                    </tr>
                                    <!--tr>
                                       <td>3rd Party Biomass Component Analysis Report</td>
                                       <td><?php //echo $ana_report; ?></td>
                                       </tr-->
                                    <tr>
                                       <td>Biomass Product Sample Photo</td>
                                       <td> <span data-toggle="modal" data-target="#myModalimg" style="cursor:pointer;"> <img src="<?php echo base_url(); ?>admin_data/product_documents/<?php echo $comp_prd[0]['product_sample_photo']; ?>" width="200px"><span></td>
                                    </tr>
                                 </table>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-info btn-close" data-dismiss="modal">Close
                              <button type="button" onclick="printDiv('printableArea')" class="btn btn-info btn-print" value="Print">Print</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--product info End-->
                  <div id="myModalimg" class="modal fade" role="dialog">
                     <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Biomass Product Sample Photo</h4>
                           </div>
                           <div class="modal-body">
                              <img src="<?php echo base_url(); ?>admin_data/product_documents/<?php echo $comp_prd[0]['product_sample_photo']; ?>" width="500px">
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-info btn-back" data-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     <label class="control-label">Incoterm</label>
                     	<div class="form-control1"><?php echo $askrecord[0]['incoterm']; ?></div>
                     </div>
                     <div class="form-group">
                     <label class="control-label">Price/MT</label>
                     <div class="form-control1"><?php echo $askrecord[0]['symbol']; ?><?php echo $askrecord[0]['price']; ?></div>										
                     </div>
                     <div class="form-group">
                     <label class="control-label">Delivery Period</label>
                     	<div class="form-control1">From : <?php echo date($this->config->item('date_format_short'), strtotime($askrecord[0]['delivery_time'])); ?>&nbsp;  -   &nbsp; To : <?php echo date($this->config->item('date_format_short'), strtotime($askrecord[0]['delivery_time_to'])); ?></div>
                     </div>
                     <div class="form-group">
                     <label class="control-label">Created On</label>
                     	<div class="form-control1"><?php echo date($this->config->item('date_format_short'), strtotime($askrecord[0]['created_on'])); ?></div>
                     </div>
                     
                     <?php if ($askrecord[0]['modified_on'] != 0) { ?>
                     <div class="form-group">
                     <label class="control-label">Modified On</label>
                     	<div class="form-control1"><?php echo date($this->config->item('date_format_short'), strtotime($askrecord[0]['modified_on'])); ?></div>							
                     </div>
                     <?php } ?>						
                     
                     </div>		 -->
                  <!-- <div class="col-md-6"> 
                     <div class="table-responsive">
                     <div class="form-group">
                     		<label class="control-label">Transaction Type</label>
                     		<div class="form-control1"><?php echo ucfirst($askrecord[0]['transaction_type']); ?>			
                      <?php if ($askrecord[0]['transaction_type'] == 'forward') { ?>
                      <span>  -  <?php echo $askrecord[0]['transaction_value']; ?></span>	
                     
                       <?php } ?>
                     </div></div>
                     <div class="form-group">
                     		<label class="control-label">Product<span data-toggle="modal" data-target="#myModal" style="cursor:pointer;">&nbsp; <i class="fa fa-info-circle"></i></span>
                     		<?php if ($askrecord[0]['category_id'] == '42') { ?>		
                     	<div class="tooltipnew"> <?php if ($askrecord[0]['product_type_id'] == '12') {  ?> WPS <?php } else { ?> WPNS <?php } ?>
                     	<span class="tooltiptext"><?php if ($askrecord[0]['product_type_id'] == '12') {  ?> Wood Pallets Standard <?php } else { ?> Wood Pallets Non Standard <?php } ?></span>
                     </div>
                     <?php }
                        if ($askrecord[0]['category_id'] == '43') { ?>	
                     <div class="tooltipnew"> <?php if ($askrecord[0]['product_type_id'] == '12') {  ?> WCS <?php } else { ?> WCNS <?php } ?>
                     	<span class="tooltiptext"><?php if ($askrecord[0]['product_type_id'] == '12') {  ?> Wood Chips Standard <?php } else { ?> Wood Chips Non Standard <?php } ?></span>
                     </div>
                     <?php }
                        if ($askrecord[0]['category_id'] == '44') { ?>	
                     <div class="tooltipnew"> <?php if ($askrecord[0]['product_type_id'] == '12') {  ?> PKSS <?php } else { ?> PKSNS <?php } ?>
                     	<span class="tooltiptext"><?php if ($askrecord[0]['product_type_id'] == '12') {  ?> PKS Standard <?php } else { ?>PKS Non Standard <?php } ?></span>
                     </div>
                     <?php } ?>
                     		
                     		</label>
                     		<div class="form-control1"><?php echo $askrecord[0]['prdname']; ?></div>								
                     </div> -->
                  <!--<div class="form-group">
                     <label class="control-label">Total Potassium & Sodium</label>
                     <div class="form-control1"><? php // echo $sodP1;
                        ?></div>		
                     </div>-->
                  <!-- <div class="form-group">
                     <label class="control-label">Currency</label>
                     <div class="form-control1"><?php //echo $askrecord[0]['currname'];
                        ?></div>-->
                  <!-- </div> <div class="form-group">
                     <label class="control-label">Volume Available (MT)</label>
                     <div class="form-control1"><?php echo number_format($askrecord[0]['volume']); ?> </div>									
                     </div>
                     <div class="form-group">
                     <label class="control-label">Type of Packing</label>
                     <div class="form-control1"><?php echo $askrecord[0]['packname']; ?></div>										
                     </div>			
                     
                     <div class="form-group">
                     <label class="control-label">Origin</label>
                     <div class="form-control1"><?php echo $askrecord[0]['locname']; ?></div>	
                     </div>
                     <div class="form-group">
                     <label class="control-label">Offer Status</label>
                     	<div class="form-control1"><?php echo $sts_arr22[0]['name']; ?></div>	
                     </div>
                     <div class="form-group">
                     <label class="control-label">Expiry Date</label>
                     	<div class="form-control1"><?php echo date($this->config->item('date_format_short'), strtotime($askrecord[0]['expiry_date'])); ?></div>	
                     </div>
                     	
                           </div> -->
               </div>
               <div class="col-md-12">
                  <div class="card">
                     <div class="panel-group" id="accordion">
                        <?php if (!empty($ngtrecord)) { //print_r($ngtrecord);
                           ?>
                        <?php $i = 1;
                           foreach ($ngtrecord as $ngtrecord) {
                           	$this->db->select('companies.company_name,companies.id');
                           	$this->db->join('companies', 'users.company_id = companies.id');
                           	$this->db->where('users.id', $ngtrecord['buyer_id']);
                           	$queryC = $this->db->get('users');
                           	$compnm = $queryC->result_array();
                           
                           	$id = $this->uri->segment(3);
                           	$this->db->select('created_by');
                           	$this->db->where('id', $id);
                           	$query21 = $this->db->get('asks');
                           	$seller_rec = $query21->result_array();
                           	$sellerid = $seller_rec[0]['created_by'];
                           
                           	$this->db->select('companies.company_name');
                           	$this->db->join('companies', 'users.company_id = companies.id');
                           	$this->db->where('users.id', $sellerid);
                           	$query22 = $this->db->get('users');
                           	$sellercompnm = $query22->result_array();
                           
                           	?>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-target="#collapse<?php echo $i; ?>" data-toggle="collapse" onclick="msgread(<?php echo $this->uri->segment(3); ?>,<?php echo $ngtrecord['buyer_id']; ?>,<?php echo $sellerid; ?>)">
                                 Negotiation Between <?php echo $sellercompnm[0]['company_name']; ?> (Seller) And <?php echo $compnm[0]['company_name']; ?> (Buyer)
                                 <b class="caret"></b>
                                 </a>
                              </h4>
                           </div>
                           <div id="collapse<?php echo $i; ?>" class="panel-collapse">
                              <div class="panel-body" id="negotiation_refresh-<?php echo $compnm[0]['id']; ?>">
                                 <script>
                                    /* AJAX request to checker */
                                    function check() {
                                    	// $('#original_offer_data_reget').load(location.href + ' #original_offer_data_reget_div');
                                    	$('#negotiation_refresh-<?php echo $compnm[0]['id']; ?>').load(location.href + ' #negotiation_refresh_table-<?php echo $compnm[0]['id']; ?>');
                                    	//$('#main_refresh_div').load(location.href + ' #tab-content');
                                    
                                    	console.log("check table");
                                    }
                                    //Every 20 sec check if there is new update
                                    setInterval(check, 20000);
                                 </script>
                                 <?php
                                    $id = $this->uri->segment(3);
                                    $this->db->select('negotiations.*,packing.name as packname,currencies.name as currname,incoterm.name as incoterm');
                                    $this->db->join('packing', 'negotiations.type_of_packing = packing.id');
                                    $this->db->join('currencies', 'negotiations.currency_id = currencies.id');
                                    $this->db->join('incoterm', 'negotiations.incoterm_id = incoterm.id');
                                    $this->db->where('negotiations.buyer_id', $ngtrecord['buyer_id']);
                                    $this->db->where('negotiations.ask_id', $id);
                                    $this->db->order_by("negotiations.id", "desc");
                                    $query = $this->db->get('negotiations');
                                    //echo $this->db->last_query();		
                                    $recordarray = $query->result_array();
                                    
                                    ?>
                                 <div class="table-responsive" id="negotiation_refresh_table-<?php echo $compnm[0]['id']; ?>">
                                    <table class="table table-bordered data-table table-hovered dataTable no-footer" id="" role="grid" aria-describedby="datatable_info">
                                       <thead>
                                          <!--tr>
                                             <th>Company name</th>
                                             <th>Incoterm</th>																		
                                             <th>Currency</th>
                                             <th>Price/MT</th>
                                             <th>Volume (MT)</th>
                                             <th>Payment Terms</th>
                                             <th>Type of Packing</th>
                                             <th>Non-standard Conditions of Contract Implementation</th>
                                             <th>Comments</th>
                                             <th>Admin Comments</th>
                                             <th>Counter party comments to Admin</th>
                                             <th>Status</th>
                                             <th>Action</th>									
                                             </tr-->
                                       </thead>
                                       <tbody>
                                          <?php $j = 0;
                                             foreach ($recordarray as $recordarray) {
                                             	$this->db->select('value');
                                             	$this->db->where('id', $recordarray['payment_method']);
                                             	$query26 = $this->db->get('drop_downs');
                                             	$pay_nm = $query26->result_array();
                                             
                                             	//	print_r($recordarray);
                                             	?>
                                          <?php if ($recordarray['buyer_id'] == $ngtrecord['buyer_id'] && $recordarray['seller_id'] == $sellerid) { ?>
                                          <tr>
                                             <td style="background: #606060;color: #fff;"><strong>Negotiation:
                                                <?php if ($recordarray['buyer_id'] == $recordarray['created_by']) {
                                                   echo $compnm[0]['company_name'].' [Buyer]' ;
                                                   } else {
                                                   echo $sellercompnm[0]['company_name'].' [Seller]';
                                                   } ?>
                                                </strong>
                                             </td>
                                             <td style="background: #606060;color: #fff;"><strong>Date: <?php echo date('d-m-Y-H:i:s', strtotime($recordarray['created_on'])) ?> </strong></td>
                                             <td style="background: #606060;color: #fff;width:100px;"><strong>Action</strong></td>
                                          </tr>
                                          <tr style="<?php if ($recordarray['seller_id'] == $recordarray['created_by']) { ?> background-color:#f1f1f1; <?php } ?> padding:0px !important;">
                                             <td>
                                                <table style="width: 100%;" class="table table-bordered">
                                                   <tbody>
                                                      <tr>
                                                         <td><strong>Incoterm</strong></td>
                                                         <td><?php echo $recordarray['incoterm'] ?></td>
                                                      </tr>
                                                      <tr>
                                                         <td><strong>Currency-Price</strong></td>
                                                         <td><?php echo $recordarray['currname'] . " - " . $recordarray['price']; ?></td>
                                                      </tr>
                                                      <tr>
                                                         <td><strong>Volume (MT) </strong></td>
                                                         <td><?php echo number_format($recordarray['volume']) ?></td>
                                                      </tr>
                                                      <tr>
                                                         <td><strong>Payment Terms </strong></td>
                                                         <td><?php echo $pay_nm[0]['value'] ?></td>
                                                      </tr>
                                                      <tr>
                                                         <td><strong>Type Of Packing </strong></td>
                                                         <td><?php echo $recordarray['packname'] ?></td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                             <td style="">
                                                <table style="width: 100%;" class="table table-bordered">
                                                   <tbody>
                                                      <tr>
                                                         <td><strong>Non-Standard Conditions Of Contract Implementation </strong></td>
                                                         <td><?php echo $recordarray['non_standard_cnd'] ?></td>
                                                      </tr>
                                                      <tr>
                                                         <td><strong>User Comments</strong></td>
                                                         <td><?php echo $recordarray['comment'] ?></td>
                                                      </tr>
                                                      <tr>
                                                         <td><strong>User Comments To Broker</strong></td>
                                                         <td><?php echo $recordarray['commentstocb'];
                                                            ?></td>
                                                      </tr>
                                                      <tr>
                                                         <td><strong>Broker Comments </strong></td>
                                                         <td><?php echo $recordarray['Admin_comment'] ?></td>
                                                      </tr>
                                                      <tr>
                                                         <td><strong>Status</strong></td>
                                                         <td><?php if ($recordarray['is_msg_verified'] == '1' && $recordarray['is_reject'] != '1') {
                                                            echo "Approved";
                                                            }
                                                            if ($recordarray['is_reject'] == '1') {
                                                            echo "Rejected";
                                                            }
                                                            
                                                            ?></td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                             <td>
                                                <?php if ($j == '0') {
                                                   if ($recordarray['ngt_accept_seller'] == '1' && $recordarray['ngt_accept_buyer'] == '1') {
                                                   	?>
                                                <a href="<?php echo base_url(); ?>Transaction_summary/details/<?php echo $recordarray['id'] ?>/<?php echo $askrecord[0]['prdid']; ?>"><button type="button" class="btn btn-view" style="float:right !important;">View SBTA</button></a>
                                                <?php }
                                                   if ($recordarray['is_msg_verified'] == '0' && $recordarray['is_reject'] == '0') { ?>
                                                <!--button type="button" class="btn btn-info btn-back" data-toggle="modal" data-target="#myModal<?php echo $recordarray['id'] ?>" data-id="<?php echo $recordarray['id'] ?>">View1</button>
                                                   <button type="button" class="btn btn-info btn-back data-btn-approve-modal" id="data-btn-approve-modal" data-toggle="modal" data-target="#myModalapprove" data-id="<?php echo $recordarray['id']; ?>" data-content="<?php echo $recordarray['comment']; ?>">View2</button-->
                                                <button type="button" class="btn btn-info btn-view data-btn-approve-modal" id="data-btn-approve-modal" data-toggle="modal" data-target="#myModalapprove" data-id="<?php echo $recordarray['id']; ?>" onclick="getcomment_data(<?php echo $recordarray['id']; ?>)" data-content="<?php echo $recordarray['comment']; ?>">View</button>
                                                <input type="hidden" name="hiddenSellerId" id="hiddenSellerId" value="<?php if($recordarray['seller_id'] == $recordarray['created_by']){ echo $recordarray['seller_id']; } ?>" >
                                                <input type="hidden" name="hiddenBuyerId" id="hiddenBuyerId" value="<?php if($recordarray['buyer_id'] == $recordarray['created_by']){ echo $recordarray['buyer_id']; } ?>" >
                                                <?php }
                                                   $j++;
                                                   }
                                                   ?>
                                             </td>
                                          </tr>
                                          <?php } ?>
                                 </div>
                                 <div class="modal fade" id="myModal<?php echo $recordarray['id'] ?>" role="dialog">
                                 <div class="modal-dialog modal-lg">
                                 <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Approve Negotiation</h4>
                                 </div>
                                 <div class="modal-body">
                                 <div class="form-group">
                                 <label class="control-label"> Comment from User </label>
                                 <div class="form-control1"><?php echo $recordarray['comment'] ?></div>
                                 </div>
                                 <div class="form-group">
                                 <label class="control-label"> Admin Comments to <?php if ($recordarray['buyer_id'] == $recordarray['created_by']) {
                                    echo $compnm[0]['company_name'];
                                    } else {
                                    echo $sellercompnm[0]['company_name'];
                                    } ?> <span class="star"> *</span> </label>
                                 <textarea class="form-control1" style="resize:none;" name="admincomments" id="admincomments<?php echo $recordarray['id'] ?>" placeholder="Please leave your queries/comments, if any"></textarea>
                                 <p id="demo<?php echo $recordarray['id'] ?>" style="color:#FF5454;"></p>
                                 </div>
                                 </div>
                                 <div class="modal-footer">
                                 <?php if ($recordarray['is_reject'] == '0') { ?>
                                 <button type="button" id="aprbtn" class="btn btn-info btn-back" onclick="msgapprove(<?php echo $recordarray['id'] ?>)">Approve</button>
                                 <?php } ?>
                                 <?php if ($recordarray['is_admin_confirm'] == '0' && $recordarray['is_reject'] == '0') { ?>
                                 <button type="button" id="rejetcbtn" class="btn btn-info btn-back" onclick="msgreject(<?php echo $recordarray['id'] ?>)">Reject</button>
                                 <?php } ?>
                                 <?php  //if($recordarray['is_finalized']!=0 && $recordarray['is_admin_confirm']=='0') {
                                    ?>
                                 <!--<button type="button" class="btn btn-info btn-back" onclick="askconfirm(<? php //echo $recordarray['id']
                                    ?>,<? php // echo $recordarray['ask_id']
                                    ?>)">Confirm</button>-->
                                 <?php //} 
                                    ?>
                                 <button type="button" id="cnlbtn" class="btn btn-info btn-back" data-dismiss="modal">Cancel</button>
                                 </div>
                                 </div>
                                 </div>
                                 </div>
                                 <?php } ?>
                                 </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <?php $i++;
                           }
                           } else { ?>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">No Negotiation </h4>
                           </div>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
      </div>
      </form>
   </div>
</div>
</div>
<script>
   // $(document).ready(function() { 
   //$(".data-btn-approve-modal").click(function(){
   
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
<div class="modal fade" id="myModalapprove" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Approve Negotiation 2</h4>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label class="control-label"> Comment from User </label>
               <div class="form-control1" id="counterparty_comment">counterparty_comment</div>
            </div>
            <?php /* <div class="form-group">
               <label class="control-label"> Comment from <?php if($recordarray['buyer_id'] == $recordarray['created_by']) {
                  echo $compnm[0]['company_name'].'(Buyer)';
                  $byr = true;
                  } else {
                  echo $sellercompnm[0]['company_name'].'(Seller)';
                  } ?> </label>
            <div class="form-control1" id="counterparty_comment<?php if(!$recordarray['buyer_id'] == $recordarray['created_by']) { } else{ } ?> ">-</div>
         </div>
         <div class="form-group">
            <label class="control-label"> Comment from <?php if(!$recordarray['buyer_id'] == $recordarray['created_by']) {
               echo $compnm[0]['company_name'].'(Buyer...)';
               } else {
               echo $sellercompnm[0]['company_name'].'(Seller...)';
               $slr = true;
               } ?> </label>
            <div class="form-control1" id="counterparty_comment<?php if($recordarray['buyer_id'] == $recordarray['created_by']) { echo '1'; } else { } ?>">
               -
            </div>
         </div>
         */?>
         <div class="form-group">
            <label class="control-label">Admin Comments <span class="star"> *</span> </label>
            <textarea class="form-control1" style="resize:none;" name="admincomments" id="admincomments" placeholder="Please leave your queries/comments, if any"></textarea>
            <input type="hidden" value="nego_id" id="ngtid" name="ngtid">
            <p id="demo" style="color:#FF5454;"></p>
         </div>
      </div>
      <div class="modal-footer">
         <button type="button" id="cnlbtn" class="btn btn-info btn-close" data-dismiss="modal">Cancel</button>
         <?php if ($recordarray['is_admin_confirm'] == '0' && $recordarray['is_reject'] == '0') { ?>
         <button type="button" id="rejetcbtn" class="btn btn-info btn-reject rejetcbtn" onclick="msgrejectnew()">Reject</button>
         <?php } ?>
         <?php  //if($recordarray['is_finalized']!=0 && $recordarray['is_admin_confirm']=='0') {
            ?>
     <!--  <button type="button" class="btn btn-info btn-back" onclick="askconfirm(<? php //echo $recordarray['id']
            ?>,<? php // echo $recordarray['ask_id']
            ?>)">Confirm</button> -->
         <?php //} 
            ?>
         <?php if ($recordarray['is_reject'] == '0') { ?>
         <button type="button" id="aprbtn" class="btn btn-info btn-approve aprbtn" onclick="msgapprovenew()">Approve</button>
         <?php } ?>
      </div>
   </div>
</div>
</div>
<script>
   function msgread(ngtid, buyerid, sellerid) {
   	//alert(ngtid);
   	//alert(buyerid);
   
   	$.ajax({
   		url: '<?php echo base_url(); ?>Manageasks/msgreadbyadmin',
   		type: 'GET',
   		data: {
   			ngtid: ngtid,
   			buyerid: buyerid,
   			sellerid: sellerid
   		},
   		contentType: 'application/json; charset=utf-8',
   		success: function(response) {
   			//alert('Message has been approved');
   		},
   		error: function() {
   			//your error code
   		}
   	});
   }
</script>
<script>
   function msgapprove(ngtid) {
   	//alert(ngtid);
   	var ngtid = ngtid;
   	var comment = $("#admincomments" + ngtid).val();
   	if (!comment) {
   		document.getElementById("demo" + ngtid).innerHTML = "Please enter comment";
   		document.getElementById("admincomments").focus();
   		return true;
   
   	} else {
   
   		if (confirm("Are you sure you want to Approve?") == true) {
   			$.ajax({
   				url: '<?php echo base_url(); ?>Manageasks/approvebidmsg',
   				type: 'GET',
   				data: {
   					ngtid: ngtid,
   					comment: comment
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
   				$('#aprbtn').attr('disabled', true);
   				$('#rejetcbtn').attr('disabled', true);
   				$('#cnlbtn').attr('disabled', true);
   			}
   		}
   
   	}
   }
   
   
   function msgreject(ngtid) {
   	//alert(ngtid);
   	var ngtid = ngtid;
   	var comment = $("#admincomments" + ngtid).val();
   	//alert(comment);
   	if (!comment) {
   		document.getElementById("demo" + ngtid).innerHTML = "Please enter comment";
   		document.getElementById("admincomments" + ngtid).focus();
   		return true;
   
   	} else {
   
   		if (confirm("Are you sure you want to Reject?") == true) {
   			$.ajax({
   				url: '<?php echo base_url(); ?>Managebids/rejectmsg',
   				type: 'GET',
   				data: {
   					ngtid: ngtid,
   					comment: comment
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
   			if (comment) {
   				$('#aprbtn').attr('disabled', true);
   				$('#rejetcbtn').attr('disabled', true);
   				$('#cnlbtn').attr('disabled', true);
   			}
   
   		}
   	}
   }
</script>
<script>
   function msgapprovenew() {
   	//alert(ngtid);
   	var ngtid = $("#ngtid").val();;
   	var comment = $("#admincomments").val();
   	var hiddenSellerId =  $("#hiddenSellerId").val();
   	var hiddenBuyerId =  $("#hiddenBuyerId").val();
   
   	console.log("msgapprovenew data");
   	console.log(ngtid);
   	console.log(comment);
   
   	if (!comment) {
   		document.getElementById("demo").innerHTML = "Please enter comment";
   		document.getElementById("admincomments").focus();
   		return true;
   

   
   	} else {
   
   		if (confirm("Are you sure you want to Approve?") == true) {
   			$.ajax({
   				url: '<?php echo base_url(); ?>Manageasks/approvebidmsg',
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
   				$('#aprbtn').attr('disabled', true);
   				$('#rejetcbtn').attr('disabled', true);
   				$('#cnlbtn').attr('disabled', true);
   			}
   		}
   
   	}
   }
   
   function msgrejectnew() {
   	//alert(ngtid);
   	var ngtid = $("#ngtid").val();;
   	var comment = $("#admincomments").val();
   
   	console.log("msgrejectnew data");
   	console.log(ngtid);
   	console.log(comment);
   
   	//alert(comment);
   	if (!comment) {
   		document.getElementById("demo").innerHTML = "Please enter comment";
   		document.getElementById("admincomments").focus();
   		return true;
   
   	} else
     {
   
   		if (confirm("Are you sure you want to Reject?") == true) {
   			$.ajax({
   				url: '<?php echo base_url(); ?>Managebids/rejectmsg',
   				type: 'GET',
   				data: {
   					ngtid: ngtid,
   					comment: comment
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
   			if (comment) {
   				$('#aprbtn').attr('disabled', true);
   				$('#rejetcbtn').attr('disabled', true);
   				$('#cnlbtn').attr('disabled', true);
   			}
   
   		}
   	}
   }
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