<!-- start: Content -->
<div id="content" class="page-body">
	
	<div class="container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6">
					<div class="page-header-left">
						<h3>Products
						</h3>
					</div>
				</div>
				<div class="col-lg-6">
					<ol class="breadcrumb pull-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>products"><i data-feather="home"></i></a></li>
						<li class="breadcrumb-item active">Products</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="page-title-border">
			<div class="col-sm-12 col-md-12 left-button-top">
			<?php 
		//	if ($this->privilegeduser->hasPrivilege("ProductAddEdit")) 
		//	{
			?>
			<a href="<?php  echo base_url();?>products/addEdit" style="float:right" class="btn btn-primary icon-btn">
				<i class="fa fa-plus"></i>Add products
			</a>
			<?php
			//}
			?>
	
			
				<div class="clearfix"></div>
			</div>
		</div>   
		<div class="container">
			<div class="row">
				<div class="col-sm-2 col-xs-12" >
					<div class="dataTables_filter searchFilterClass form-group">
						<label for="firstname" class="control-label">Category</label>
						<input id="sSearch_0" name="sSearch_0" type="text" class="searchInput form-control"/>
					</div>
				</div>
				<div class="col-sm-2 col-xs-12">
					<div class="dataTables_filter searchFilterClass form-group">
						<label for="firstname" class="control-label">Product Name</label>
						<input id="sSearch_2" name="sSearch_2" type="text" class="searchInput form-control"/>
					</div>
				</div>
				<div class="control-group clearFilter">
					<div class="controls">
						<a href="products"><button class="btn" style="margin:32px 10px 10px 10px;">Clear Search</button></a>
					</div>
				</div>
			</div>
		</div>  
	
	<div class="clearfix"></div>
	<div class="card-body">
		<div class="box-content">
			<div class="table-responsive scroll-table">
			<table class="dynamicTable display table table-bordered non-bootstrap">
				<thead>
				<tr>
					<th>Category</th>
					<th>Product Name</th>
					<th>Actions</th>
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
</div>
<!-- end: Content -->

<script>
	function changestatus(id,status)
	{
		var sta="";
		var sta1=" ";
		if(status=='Active')
		{
			sta1 = "Dis-approve";
			sta = "In-active";
		}
		else
		{
			sta1 = "Approve";
			sta = "Active";
		}
		var r=confirm("Are you sure to " +sta1);
		if(r)
		{
			$.ajax({
				url: "<?php echo base_url().$this->router->fetch_module();?>/changestatus/",
				data:{"id":id,"status":sta},
				type: "POST",
				dataType: "JSON",
				success: function(response)
				{
					if(response.success)
					{
						displayMsg("success","Record has been Updated!");
					}
					else
					{
						displayMsg("error","Oops something went wrong!");
					}
					setTimeout("location.reload(true);",1000);
				}
			});
		}
	}
	
	$(".export_products").on("click", function()
	{
		$('.export_products').attr("disabled","disabled");
		var act = "<?php  echo base_url();?>products/export";
		// href="<?php  echo base_url();?>products/export"
		$("#frm_filters").attr("action",act);
		$("#frm_filters").submit();
	});
	
	$("#frm_filters").on("submit", function()
	{
		$('.export_products').removeAttr("disabled");
		
		$('.export_products_sizes').removeAttr("disabled");
		
		setTimeout("location.reload(true);",1000);
	});
	
	<?php
	if(isset($_SESSION['product_export_success']))
	{
		?>
		displayMsg("<?php echo $_SESSION['product_export_success']; ?>", "<?php echo $_SESSION['product_export_msg']; ?>");
		<?php
		unset($_SESSION['product_export_success']);
		unset($_SESSION['product_export_msg']);
	}
	?>
	
	document.title = "Products";
</script>
