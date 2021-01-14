<?php 
error_reporting(0);
?>
<style>
	.appended .appenddia{
		border-bottom: 1px solid black;
	}
</style>


<

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
		<div class="card-body">             
			<div class="box-content">
				<div class="col-sm-8 col-md-12">
					<form class="form-horizontal" id="form-validate" method="post" enctype="multipart/form-data">
						<input type="hidden" id="product_id" name="product_id" value="<?php if(!empty($product_details[0]->product_id)){echo $product_details[0]->product_id;}?>" />
						
						<div class="control-group form-group">
							<label class="control-label"><span>Category*</span></label> 
							<div class="controls">
								<select id="category_id" name="category_id" class="form-control">
									<option value="">Select Category Name</option>
									<?php if(isset($categories) && !empty($categories))
									{?>
										<?php foreach($categories as $cdrow)
										{	
											$sel ="";
											$sel = ($cdrow->category_id == $product_details[0]->category_id)?'selected="selected"':'';
										?>
										<option value="<?php echo $cdrow->category_id;?>" <?php echo $sel; ?>><?php echo $cdrow->category_name;?></option>
									<?php 
										}
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="control-group form-group">
							<label class="control-label"><span>Product Name*</span></label>
							<div class="controls">
								<input type="text" class="form-control required" placeholder="Enter Product Name" id="product_name" name="product_name" value="<?php if(!empty($product_details[0]->product_name)){echo $product_details[0]->product_name;}?>" >
							</div>
						</div>
						
						
						<div class="control-group form-group">
							<label class="control-label"><span>Product Price*</span></label>
							<div class="controls">
								<input type="number" class="form-control " placeholder="Enter Product price" id="product_price" name="product_price" value="<?php if(!empty($product_details[0]->product_price)){echo $product_details[0]->product_price;}?>" >
								<span id="skucode_msg" style="color:red;display: none;"></span>
							</div>
						</div>
						
						<div class="control-group form-group">
							<label class="control-label" for="product_image">Product Image*</label>
							<div class="controls">
								
								<input class="input-xlarge" id="input_product_image" value="<?php if(!empty($product_details[0]->product_image)){echo $product_details[0]->product_image;}?>" name="input_product_image" type="hidden" >
								
								<input class="input-xlarge" id="product_image" name="product_image" type="file">
								<?php if(!empty($product_details[0]->product_image) && file_exists(DOC_ROOT_FRONT."/images/product_images/".$product_details[0]->product_image))
								{
								?>
									<img style="width: 150px;height:150px;padding-top:5px;" src="<?php echo FRONT_URL; ?>/images/product_images/<?php echo $product_details[0]->product_image; ?>"></img>
								<?php 
								}
								?>
							</div>
						</div>

						<div class="control-group form-group">
							<label class="control-label"><span>Product Description*</span></label>
							<div class="controls">
								<textarea name="product_description" id="product_description" placeholder="Enter Product Description" class="form-control editor"><?php if(!empty($product_details[0]->product_description)){echo $product_details[0]->product_description;}?></textarea>
							</div>
						</div>
						
						<div class="form-actions form-group">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="button" class="btn btn-primary" onclick=window.location.href="<?php echo base_url('products')?>">Cancel</button>
							<!-- <a href="<?php echo base_url();?>products" class="btn btn-primary">Cancel</a> -->
						</div>
						
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>        
</div><!-- end: Content -->								

<script>


	
$( document ).ready(function() 
{	
	var config = {enterMode : CKEDITOR.ENTER_BR, height:200, filebrowserBrowseUrl: '../js/ckeditor/filemanager/index.html', scrollbars:'yes',
			toolbar_Full:
			[
						['Source', 'Templates'],['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
						['Find','Replace','-','Subscript','Superscript'],
						['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],['BidiLtr', 'BidiRtl' ],
						['Maximize', 'ShowBlocks'],['Undo','Redo'],['Bold','Italic','Underline','Strike'],			
						['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],			
						['SelectAll','RemoveFormat'],'/',
						['Styles','Format','Font','FontSize'],
						['TextColor','BGColor'],								
						['Image','Flash','Table','HorizontalRule','Smiley'],
					],
					 width: "620px"
			};
	$('.editor').ckeditor(config);
	
	
});



var vRules = 
{
	category_id:{required:true},
	product_price:{required:true},
	product_name:{required:true, alphanumericwithspace:true}
	
};
var vMessages = 
{
	category_id:{required:"Please select category."},
	product_price:{required:"please enter price."},
	product_name:{required:"please enter name."},
};

$("#form-validate").validate({
	ignore:[],
	rules: vRules,
	messages: vMessages,
	submitHandler: function(form) 
	{	
		
		var act = "<?php echo base_url();?>products/submitForm";
		$("#form-validate").ajaxSubmit({
			url: act, 
			type: 'post',
			dataType: 'json',
			cache: false,
			clearForm: false,
			beforeSubmit : function(arr, $form, options){
			},
			success: function(response) 
			{
				if(response.success)
				{
					displayMsg("success",response.msg);
					setTimeout(function(){
						window.location = "<?php echo base_url();?>products";
					},2000);
				}
				else
				{	
					//$("#error_msg").show();
					$(".btn-primary").show();
					displayMsg("error",response.msg);
					return false;
				}
			}
		});
	}
});

$(document).ready(function()
{
	
	
});

document.title = "Add/Edit Product";

</script>					
