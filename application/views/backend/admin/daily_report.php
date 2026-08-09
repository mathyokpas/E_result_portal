<!--
<form name="bwdatesdata" action="" method="post" action="">
  <table width="100%" height="117"  border="0">
<tr>
    <th width="27%" height="63" scope="row">From Date :</th>
    <td width="73%">
<input type="date" name="fdate" class="form-control" id="fdate">
    	</td>
  </tr>

  <tr>
    <th width="27%" height="63" scope="row">To Date :</th>
    <td width="73%">
    	<input type="date" name="tdate" class="form-control" id="tdate"></td>
  </tr>
  <tr>
    <th width="27%" height="63" scope="row">Request Type :</th>
    <td width="73%">
         <input type="radio" name="requesttype" value="mtwise" checked="true">Month wise
          <input type="radio" name="requesttype" value="yrwise">Year wise</td>
  </tr>
<tr>
    <th width="27%" height="63" scope="row"></th>
    <td width="73%">
    	<button class="btn-primary btn" type="submit" name="submit">Submit</button>
  </tr>
 
</table>
     </form>
     <div class="row">
      <div class="col-xs-12">
      	 <?php
      	 if(isset($_POST['submit']))
{ 
$fdate=$_POST['fdate'];
$tdate=$_POST['tdate'];
$rtype=$_POST['requesttype'];

?>
<?php if($rtype=='mtwise'){
$month1=strtotime($fdate);
$month2=strtotime($tdate);
$m1=date("F",$month1);
$m2=date("F",$month2);
$y1=date("Y",$month1);
$y2=date("Y",$month2);
    ?>
        <h4 class="header-title m-t-0 m-b-30">Sales Report Month Wise</h4>
<h4 align="center" style="color:blue">Sales Report  from <?php echo $m1."-".$y1;?> to <?php echo $m2."-".$y2;?></h4>
		<hr >
		<div class="row">
                            <table class="table table-bordered" width="100%"  border="0" style="padding-left:40px">
                                <thead>
                                   <tr>
<th>S.NO</th>
<th>Month / Year </th>
<th>Sales</th>
</tr>
                                </thead>
                                <?php $invoice =  $this->db->get('invoice', 'payment')->result_array();
$ret=mysqli_query($con,"select month(creation_timestamp) as lmonth,year(creation_timestamp) as lyear,
    invoice.description,invoice.amount_paid from invoice 
    join payment on payment.invoice_id=invoice.invoice_id 
    where date(invoice.creation_timestamp) between '$fdate' and '$tdate' 
    group by lmonth,lyear ");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                                <tbody>
                                    <tr>
                    <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['lmonth']."/".$row['lyear'];?></td>
              <td><?php  echo $total=$row['amount_paid'];?></td>
             
                    </tr>
                <?php
$ftotal+=$total;
$cnt++;
}?>
<tr>
                  <td colspan="2" align="center">Total </td>
              <td><?php  echo $ftotal;?></td>
                 
                </tr>             
                                </tbody>
                            </table>
                            <?php } } else {
$year1=strtotime($fdate);
$year2=strtotime($tdate);
$y1=date("Y",$year1);
$y2=date("Y",$year2);
?>
                       <h4 class="header-title m-t-0 m-b-30">Sales Report Year Wise</h4>
<h4 align="center" style="color:blue">Sales Report  from <?php echo $y1;?> to <?php echo $y2;?></h4>
        <hr >
        <div class="row">
                            <table class="table table-bordered" width="100%"  border="0" style="padding-left:40px">
                                <thead>
                                   <tr>
<th>S.NO</th>
<th>Year </th>
<th>Sales</th>
</tr>
                                </thead>
                                <?php
$ret=mysqli_query($con,"select month(OrderDate) as lmonth,year(OrderDate) as lyear,
    tblproduct.SellingPrice,tblorder.Quantity from tblorder 
    join tblproduct on tblproduct.ID=tblorder.ProductID 
    where date(tblorder.OrderDate) between '$fdate' and '$tdate'
    group by lyear ");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                                <tbody>
                                    <tr>
                    <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['lyear'];?></td>
              <td><?php  echo $total=$row['SellingPrice']*$row['Quantity'];?></td>
             
                    </tr>
                <?php
$ftotal+=$total;
$cnt++;
}?>
<tr>
                  <td colspan="2" align="center"
                                </tbody>
                            </table>  <?php } } }?>  
                        </div>
 
      </div>
    </div>  
-->

<?php echo form_open(base_url() . 'admin/showIncomePayment' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
                            <div class="form-group">
    
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('report_date_from');?></label>
                                <div class="col-sm-12">
                                    <select name="invoice_id" class="form-control select2">
                                        <option value=""><?php echo get_phrase('select_start_date_of_transaction');?></option>

                                        <?php $my_invoice_date =  $this->db->get('invoice')->result_array();
                                        foreach($my_invoice_date as $key => $fromdate):?>
                                        <option value="<?php echo $fromdate['invoice_id'];?>"<?php if($invoice_id == $fromdate['invoice_id']) echo 'selected="selected"' ;?>><?php echo $fromdate['creation_timestamp'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>


                            
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('report_date_to');?></label>
                                <div class="col-sm-12">
                                    <select name="class_id"  class="form-control select2" onchange="show_students(this.value)">
                                        <option value=""><?php echo get_phrase('select_to_end_date_of_transaction');?></option>

                                        <?php $to_invoice_date =  $this->db->get('invoice')->result_array();
                                        foreach($to_invoice_date as $key => $todate):?>
                                        <option value="<?php echo $todate['invoice_id'];?>"<?php if($invoice_id == $todate['invoice_id']) echo 'selected="selected"' ;?>>Class: <?php echo $todate['creation_timestamp'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="" id="student_id_0" style="display:<?php if(isset($student_id) && $student_id > 0) echo 'none'; else echo 'block';?>"  class="form-control">
                                        <option value=""><?php echo get_phrase('Select Class First');?></option>
                                    </select>
                                </div>
                            </div>
                            
                            <input class="" type="hidden" value="selection" name="operation">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('Get Details');?></button>
                        </div>

                                        </form>





<div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('daily report');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
                    
                                <div class="form-group">
                    <div class="col-sm-12">
                    <select id="invoice_id" class="form-control">
                    <option value=""><?php echo get_phrase('select_day');?></option>

                    <?php $invoice =  $this->db->get('invoice')->result_array();
                    foreach($invoice as $key => $invoice):?>
                
                    <option value="<?php echo $invoice['invoice_id'];?>"
                    <?php if($invoice_id == $invoice['invoice_id']) echo 'selected';?>><?php echo $invoice['creation_timestamp'];?></option>
                   
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>
                 <button type="button" id="find" class="btn btn-success btn-rounded btn-sm btn-block">Get Report</button>
                 <hr>
				
 				<!-- PHP that includes table for subject starts here  ------>
                <div id="data">
                <?php include 'showIncomePayment.php';?>
                </div>
                <!-- PHP that includes table for subject ends here  ------>


				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$('#invoice_id').select2();
		$('#find').on('click', function() 
		{
			var invoice_id = $('#invoice_id').val();
			 if (invoice_id == "") {
           $.toast({
            text: 'Please select class before clicking get student button',
            position: 'top-right',
            loaderBg: '#f56954',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        })
            return false;
        }
			$.ajax({
				url: '<?php echo site_url('admin/getIncomePayment/');?>' + invoice_id
			}).done(function(response) {
				$('#data').html(response);
			});
		});

	});


</script>