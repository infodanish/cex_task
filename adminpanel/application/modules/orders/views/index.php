<?php 
//session_start();
//print_r($_SESSION["chheda_webadmin"]);
//echo "<pre>";
//print_r($roles);exit;
?>

<!-- start: Content -->
<div id="content" class="page-body">
	 <!-- <div class="page-title">
      <div>
        <h1>Orders</h1>            
      </div>
      <div>
        <ul class="breadcrumb">
          <li><a href="<?php echo base_url();?>home"><i class="fa fa-home fa-lg"></i></a></li>
          <li><a href="<?php echo base_url();?>orders">Orders</a></li>
        </ul>
      </div>
    </div>  -->
	<div class="container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6">
					<div class="page-header-left">
						<h3>Orders
						</h3>
					</div>
				</div>
				<div class="col-lg-6">
					<ol class="breadcrumb pull-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>orders"><i data-feather="home"></i></a></li>
						<li class="breadcrumb-item active">Orders</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
    <div class="card">
		<div class="container">
			<div class="row">
				<div class="col-sm-2 col-xs-12">
					<div class="dataTables_filter searchFilterClass form-group">
						<label for="firstname" class="control-label">Customer</label>
						<input id="sSearch_0" name="sSearch_0" type="text" class="searchInput form-control"/>
					</div>
				</div>
				<div class="col-sm-2 col-xs-12">
					<div class="dataTables_filter searchFilterClass form-group">
						<label for="firstname" class="control-label">Order Number</label>
						<input id="sSearch_1" name="sSearch_1" type="text" class="searchInput form-control"/>
					</div>
				</div>
				
				<div class="control-group clearFilter">
					<div class="controls">
						<a href="orders"><button class="btn" style="margin:32px 10px 10px 10px;">Clear Search</button></a>
					</div>
				</div>
			</div>
		</div>
 
         <div class="clearfix"></div>
         <div class="card-body">
          	<div class="box-content">
            	 <div class="table-responsive scroll-table" style="overflow-x:scroll;">
                    <table class="dynamicTable display table table-bordered non-bootstrap">
                        <thead>
                          <tr>
							<th>Customer</th>
							<th>Email ID</th>
							<th>Contact No.</th>
							<th>Order Number</th>
							<th>Net Payment</th>
							<th>Order Status</th>
							
							<th>Order Date</th>
						<?php if($_SESSION["chheda_webadmin"][0]->user_type == 1){?>
							<!--<th>Cart Total</th>-->
							
							
							<!--<th>Our Amount</th>-->
						<?php }?>	
							
							
						</tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>           
                </div>
            </div>
         </div>
         <div class="clearfix"></div>
    </div>
</div><!-- end: Content -->
			
<script>
	
	
	function deleteData(id,status)
	{
		var sta="";
		var sta1=" ";
		
		if(status=='Active')
		{
			sta="In-active";
		}
		else{
			sta="Active";
		}
		
    	var r=confirm("Are you sure to " +sta);
    	if (r==true)
   		{
    		//window.location.href="users/delete?id="+id;
			$.ajax({
				url: "<?php echo base_url().$this->router->fetch_module();?>/delRecord/",
				data:{"id":id,"status":sta},
				async: false,
				type: "POST",
				success: function(data2){
					data2 = $.trim(data2);
					if(data2 == "1")
					{
						displayMsg("success","Record has been Updated!");
						setTimeout("location.reload(true);",1000);
						
					}
					else
					{
						displayMsg("error","Oops something went wrong!");
						setTimeout("location.reload(true);",1000);
					}
				}
			});
    	}
    }
	
	
	
	
	
	document.title = "Orders";
</script>
