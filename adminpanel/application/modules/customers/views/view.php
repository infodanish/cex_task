<?php 
error_reporting(0);
?>
<style>
	.appended .appenddia{
		border-bottom: 1px solid black;
	}
</style>

<div id="content" class="page-body">
				<!-- <div class="page-title">
                  <div>
                    <h1>Customer</h1>            
                  </div>
                  <div>
                    <ul class="breadcrumb">
                      <li><a href="<?php echo base_url();?>home"><i class="fa fa-home fa-lg"></i></a></li>
                      <li><a href="<?php echo base_url();?>Customers">Customers</a></li>
                    </ul>
                  </div>
                </div> -->
				
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
                 <div class="card-body">             
                    <div class="box-content">
                        <div class="col-sm-8 col-md-4">
							<form class="form-horizontal" id="form-validate" method="post" enctype="multipart/form-data">
								<input type="hidden" id="product_id" name="product_id" value="<?php if(!empty($details[0]->product_id)){echo $details[0]->product_id;}?>" />
							  
								<div class="control-group form-group">
									<label class="control-label"><span>First Name</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->first_name)){echo $details[0]->first_name;}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>Last Name</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->last_name)){echo $details[0]->last_name;}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>Gender</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->gender)){echo $details[0]->gender;}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>Email ID</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->email_id)){echo $details[0]->email_id;}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>Phone</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->phone_no)){echo $details[0]->phone_no;}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>Birth Date</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->date_of_birth)){echo date("d-m-Y",strtotime($details[0]->date_of_birth));}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>Pincode</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->pincode)){echo $details[0]->pincode;}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>Country</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->country_id)){echo $details[0]->country_id;}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>State</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->state_id)){echo $details[0]->state_id;}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>City</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->city_id)){echo $details[0]->city_id;}?>
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>Address</span></label>
									<div class="controls">
										<?php if(!empty($details[0]->address)){echo $details[0]->address;}?>
									</div>
								</div>
								
						
								<div class="form-actions form-group">
									<!--<button type="submit" class="btn btn-primary">Submit</button>-->
									<a href="<?php echo base_url();?>customers" class="btn btn-primary">Cancel</a>
								</div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                 </div>
                </div>        
			</div><!-- end: Content -->								
<script>

 



$( document ).ready(function() {
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

var vRules = {
	
	product_type:{required:true},
	product_price:{required:true},
	gift_validity:{digits:true, required:true},
	metal:{required:true},
	category_id:{required:true},
	color_id:{required:true},
	width:{required:true},
	height:{required:true},
	diamond_name:{required:true},
	//clarity_id:{required:true},
	no_of_diamonds:{required:true},
	weight:{required:true},
	product_total_weight:{required:true},
	diamond_quality_price1:{required:true},
	diamond_quality_price2:{required:true},
	gemstone_name:{required:true},
	no_of_gemstone:{required:true},
	gem_weight:{required:true},
	gemstone_price:{required:true},
	making_charge:{required:true},
};
var vMessages = {
	
	product_type:{required:"Please select product type"},
	product_price:{required:"Please enter product price"},
	gift_validity:{required:"Plese enter month"},
	metal:{required:"Please select metal"},
	category_id:{required:"Please select category"},
	color_id:{required:"Please select color"},
	width:{required:"Please enter width"},
	height:{required:"Please enter height"},
	diamond_name:{required:"Please select diamond name"},
	//clarity_id:{required:"Please select stone clarity"},
	no_of_diamonds:{required:"Please enter no of diamonds"},
	weight:{required:"Please enter weight"},
	product_total_weight:{required:"Please enter total weight"},
	diamond_quality_price1:{required:"Please enter diamond quality"},
	diamond_quality_price2:{required:"Please enter diamond quality"},
	gemstone_name:{required:"Please enter gemstone name"},
	no_of_gemstone:{required:"Please enter no of gemstone"},
	gem_weight:{required:"Please enter weight"},
	gemstone_price:{required:"Please enter price"},
	making_charge:{required:"Please enter making charges"},
};

$("#form-validate").validate({
	rules: vRules,
	messages: vMessages,
	submitHandler: function(form) 
	{
		var act = "<?php echo base_url();?>products/submitForm";
		$("#form-validate").ajaxSubmit({
			url: act, 
			type: 'post',
			cache: false,
			clearForm: false,
			success: function (response) {
				var res = eval('('+response+')');
				if(res['success'] == "1")
				{
					displayMsg("success",res['msg']);
					setTimeout(function(){
						window.location = "<?php echo base_url();?>products";
					},2000);

				}
				else
				{	
					//$("#error_msg").show();
					displayMsg("error",res['msg']);
					return false;
				}
			}
		});
	}
});


$(document).ready(function(){
	
});


document.title = "View Customer";

 
</script>					
