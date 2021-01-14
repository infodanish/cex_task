<div id="content" class="page-body">
	 <!-- <div class="page-title">
      <div>
        <h1>Customers</h1>            
      </div>
      <div>
        <ul class="breadcrumb">
          <li><a href="<?php echo base_url();?>home"><i class="fa fa-home fa-lg"></i></a></li>
          <li><a href="<?php echo base_url();?>customers">Customers</a></li>
        </ul>
      </div>
    </div>  -->
	<div class="container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6">
					<div class="page-header-left">
						<h3>customers
							<small>Chheda Admin panel</small>
						</h3>
					</div>
				</div>
				<div class="col-lg-6">
					<ol class="breadcrumb pull-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>customers"><i data-feather="home"></i></a></li>
						<li class="breadcrumb-item active">customers</li>
					</ol>
				</div>
			</div>
		</div>
	</div> 
    <div class="card">
    	<div class="page-title-border">
        	<div class="col-sm-12 col-md-6 left-button-top">
            	<?php 
					//if ($this->privilegeduser->hasPrivilege("UserAddEdit")) {
				?>
					<p>
						<a href="<?php  echo base_url();?>customers/addEdit" class="btn btn-primary icon-btn"><i class="fa fa-plus"></i>Add Customer</a>
						
						
				<?php // }?>
					<a style="margin-left:10px;"  href="<?php  echo base_url();?>customers/export" class="btn btn-primary icon-btn"><i class="fa fa-plus"></i>Export</a>
            <div class="clearfix"></div>
            </div>
        </div>     
		
		<div class="container">
			<div class="row">
				<div class="col-sm-2 col-xs-12">
					<div class="dataTables_filter searchFilterClass form-group">
						<label for="firstname" class="control-label">First Name</label>
						<input id="sSearch_0" name="sSearch_0" type="text" class="searchInput form-control"/>
					</div>
				</div>
				<div class="col-sm-2 col-xs-12">
					<div class="dataTables_filter searchFilterClass form-group">
						<label for="firstname" class="control-label">Last Name</label>
						<input id="sSearch_1" name="sSearch_1" type="text" class="searchInput form-control"/>
					</div>
				</div>
				<div class="col-sm-2 col-xs-12">
					<div class="dataTables_filter searchFilterClass form-group">
						<label for="firstname" class="control-label">Email ID</label>
						<input id="sSearch_2" name="sSearch_2" type="text" class="searchInput form-control"/>
					</div>
				</div>
				<div class="col-sm-2 col-xs-12">
					<div class="dataTables_filter searchFilterClass form-group">
						<label for="firstname" class="control-label">Phone</label>
						<input id="sSearch_3" name="sSearch_3" type="text" class="searchInput form-control"/>
					</div>
				</div>
				<div class="control-group clearFilter">
					<div class="controls">
						<a href="customers"><button class="btn" style="margin:32px 10px 10px 10px;">Clear Search</button></a>
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
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email ID</th>
							<th>Phone</th>
							<th>Customer Status</th>
							<th data-bSortable="false">Details</th>
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
	function changestatus(id,status){
		var sta="";
		if(status=='Active')
		{
			sta = "In-active";
		}
		else
		{
			sta = "Active";
		}
		var r=confirm("Are you sure to Change Customer Status");
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
	
	document.title = "Customers";
</script>
