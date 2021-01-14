<!-- start: Content -->
<div class="page-body">
	<div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Add Category
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>categories/addedit"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Add Category</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>  
    <div class="card">       
        <div class="card-body">             
            <div class="box-content">
            	<div class="col-sm-8 col-md-4">
               		<form class="form-horizontal" id="form-validate" method="post" enctype="multipart/form-data">
                    	<input type="hidden" id="category_id" name="category_id" value="<?php if(!empty($categories_details[0]->category_id)){echo $categories_details[0]->category_id;}?>" />
                        <div class="control-group form-group">
                            <label class="control-label" for="category_name">Category Name*</label>
                            <div class="controls">
                                <input class="input-xlarge form-control" id="category_name" name="category_name" type="text" value="<?php if(!empty($categories_details[0]->category_name)){echo $categories_details[0]->category_name;}?>">
                            </div>
                        </div>
                        
						
						<div class="form-actions form-group">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="<?php echo base_url();?>categories" class="btn btn-primary">Cancel</a>
						</div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>              
    </div>
</div>
<!-- end: Content -->			
<script>


var vRules = {
	category_name:{required:true, alphanumericwithspace:true}
};

var vMessages = {
	category_name:{required:"Please enter name."}
};

$("#form-validate").validate({
	rules: vRules,
	messages: vMessages,
	submitHandler: function(form) 
	{
		var act = "<?php echo base_url();?>categories/submitForm";
		$("#form-validate").ajaxSubmit({
			url: act, 
			type: 'post',
			dataType: 'json',
			cache: false,
			clearForm: false, 
			beforeSubmit : function(arr, $form, options){
				$(".btn-primary").hide();
				//return false;
			},
			success: function (response) 
			{
				$(".btn-primary").show();
				if(response.success)
				{
					displayMsg("success",response.msg);
					setTimeout(function(){
						window.location = "<?php echo base_url();?>categories";
					},2000);
				}
				else
				{	
					displayMsg("error",response.msg);
					return false;
				}
			}
		});
	}
});

$(".deleteImage").click(function()
{
	if(confirm("Are you sure you want to delete image ?"))
	{
		var category_id = $(this).attr("category_id");
		var category_image = $(this).attr("category_image");
		if(category_id !== "")
		{
			$.ajax({
				url: '<?php echo base_url();?>categories/deleteImage',
				data:{"category_id":category_id},
				type: 'post',
				dataType: 'json',
				cache: false,
				clearForm: false,
				success: function (response) 
				{
					if(response.success)
					{
						displayMsg("success", response.msg);
						setTimeout(function(){
						location.reload();
						},2000);
					}
					else
					{	
						displayMsg("error",response.msg);
						return false;
					}
				}
			});
		}
	}
});

document.title = "Add/Edit Categories";
</script>


