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
                    <h1>Customers</h1>            
                  </div>
                  <div>
                    <ul class="breadcrumb">
                      <li><a href="<?php echo base_url();?>home"><i class="fa fa-home fa-lg"></i></a></li>
                      <li><a href="<?php echo base_url();?>customers">Customers</a></li>
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
								<input type="hidden" id="user_id" name="user_id" value="<?php if(!empty($details[0]->user_id)){echo $details[0]->user_id;}?>" />
								
								<div class="control-group form-group">
									<label class="control-label"><span>First Name*</span></label>
									<div class="controls">
										<input type="text" class="form-control required" placeholder="Enter First Name" id="first_name" name="first_name" value="<?php if(!empty($details[0]->first_name)){echo $details[0]->first_name;}?>" >
									</div>
								</div>
								<div class="control-group form-group">
									<label class="control-label"><span>Last Name*</span></label>
									<div class="controls">
										<input type="text" class="form-control required" placeholder="Enter Last Name" id="last_name" name="last_name" value="<?php if(!empty($details[0]->last_name)){echo $details[0]->last_name;}?>" >
									</div>
								</div>
								<div class="control-group form-group">
									<label class="control-label"><span>Email ID*</span></label>
									<div class="controls">
										<input type="text" class="form-control required" placeholder="Enter Email ID" id="email_id" name="email_id" value="<?php if(!empty($details[0]->email_id)){echo $details[0]->email_id;}?>" >
									</div>
								</div>
								<div class="control-group form-group">
									<label class="control-label"><span>Phone*</span></label>
									<div class="controls">
										<input type="text" class="form-control required" placeholder="Enter Phone" id="phone_no" name="phone_no" value="<?php if(!empty($details[0]->phone_no)){echo $details[0]->phone_no;}?>" >
									</div>
								</div>
								<?php if(empty($details[0]->password)){?>
								<div class="control-group form-group">
									<label class="control-label"><span>Password*</span></label>
									<div class="controls">
										<input type="password" class="form-control required" placeholder="Enter Password" id="password" name="password" value="<?php if(!empty($details[0]->password)){echo $details[0]->password;}?>" >
									</div>
								</div>
								
								<div class="control-group form-group">
									<label class="control-label"><span>Confirm Password*</span></label>
									<div class="controls">
										<input type="password" class="form-control required" placeholder="Enter Confirm Password" id="confirm_password" name="confirm_password" value="" >
									</div>
								</div>
								<?php }?>
								
								<div class="form-actions form-group">
									<button type="submit" class="btn btn-primary">Submit</button>
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
	
	$('#date_of_birth').datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
        changeYear: true
	});
	
	$('#pincode').blur(function(){
		var zip = $(this).val();
        var city = '';
        var state = '';
        var country = '';
        
        //make a request to the google geocode api
        $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+zip).success(function(response){
          //find the city and state
			city = '';
			state = '';
			country = '';
         
			if(response['status'] != 'OK'){
				$('#pincode').val('');
				$('#city_id').val('');
				$('#state_id').val('');
				$('#country_id').val('');
			}
          
			var address_components = response.results[0].address_components;
			
			$.each(address_components, function(index, component){
				var types = component.types;
				$.each(types, function(index, type){
			  
					/*if(type == 'locality') {
						city = component.long_name;
					}*/
					
					//if(city != "" ){
						if(type == 'administrative_area_level_2') {
							city = component.long_name;
						}
					//}	
				  
					if(type == 'administrative_area_level_1') {
						state = component.long_name;
					}
				  
					if(type == 'country') {
						country = component.long_name;
					}
				});
			});
         
			//pre-fill the city and state
			//alert("city:"+city+" state:"+state+" country:"+country);
            
			$('#city_id').val(city);
            $('#state_id').val(state);
            $('#country_id').val(country);
           
        });
      });

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
	
	first_name:{required:true},
	last_name:{required:true},
	email_id:{required:true,email:true,remote: {
						url:"<?php echo base_url('customers/dataExist');?>" ,
						type: "post",
						data: {email_id: function() {return $( "#email_id" ).val();},user_id:function() {return $( "#user_id" ).val();}}
					  }},
	phone_no:{required:true,digits:true},	
	password:{required:true},
	confirm_password:{required:true,equalTo:"#password"},
};
var vMessages = {
	
	first_name:{required:"Please enter first name."},
	last_name:{required:"Please enter last name."},
	email_id:{required:"Please enter email ID.",remote:"Email Id Already Exist."},
	phone_no:{required:"Please enter phone."},	
	password:{required:"Please enter password:"},
	confirm_password:{required:"Please enter confirm password."},
	
};

$("#form-validate").validate({
	rules: vRules,
	messages: vMessages,
	submitHandler: function(form) 
	{
		var act = "<?php echo base_url();?>customers/submitForm";
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
						window.location = "<?php echo base_url();?>customers";
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

document.title = "Add/Edit - Customers";

</script>					
