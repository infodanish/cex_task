<?php //echo "<pre>";print_r($_SESSION);exit;?>
<div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>My profile
                                    <small>Chheda Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url()?>myprofile/addEdit"><i data-feather="home"></i> </li>
                                <li class="breadcrumb-item active">My profile </li></a>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card tab2-card">
                            <div class="card-header">
                                <h5>User Detais</h5>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show"  aria-labelledby="account-tab">
                                        <form  id="form-validate" method="post" action="#">
                                            <div class="form-group row">
                                                <label for="first_name" class="col-xl-3 col-md-4"><span>*</span> First Name</label>
                                                <input class="form-control col-xl-8 col-md-7" name="first_name" id="first_name" type="text" value="<?php if(!empty($user_details['first_name'])){echo $user_details['first_name'];}?>" required="">
                                            </div>
                                            <div class="form-group row">
                                                <label for="last_name" class="col-xl-3 col-md-4"><span>*</span> Last Name</label>
                                                <input class="form-control col-xl-8 col-md-7" name="last_name" id="last_name" type="text" value="<?php if(!empty($user_details['last_name'])){echo $user_details['last_name'];}?>" required="">
                                            </div>
                                            <div class="form-group row">
                                                <label for="email_id" class="col-xl-3 col-md-4"><span>*</span> Email</label>
                                                <input class="form-control col-xl-8 col-md-7" name="email_id" id="email_id" type="text" value="<?php if(!empty($user_details['email_id'])){echo $user_details['email_id'];}?>" <?php if(!empty($user_details['email_id'])){?> readonly <?php }?> required="">
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-xl-3 col-md-4"><span>*</span> Phone</label>
                                                <input class="form-control col-xl-8 col-md-7" name="phone" id="phone" type="text" value="<?php if(!empty($user_details['phone'])){echo $user_details['phone'];}?>" required="">
                                            </div>
											<div class="pull-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
									<a href="<?php echo base_url();?>home" class="btn btn-primary">Cancel</a>
                                </div>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>		
<script>
	var vRules = {
		first_name:{required:true},
		last_name:{required:true},
		email_id:{required:true,email:true},
		phone:{required:true, digits:true}
	};
	
	var vMessages = {
		first_name:{required:"Please enter first name."},
		last_name:{required:"Please enter last name."},
		email_id:{required:"Please enter email id."},
		phone:{required:"Please enter phone."}
	};

	$("#form-validate").validate({
		rules: vRules,
		messages: vMessages,
		submitHandler: function(form) 
		{
			$("#form-validate").ajaxSubmit({
				url: "<?php echo base_url();?>myprofile/submitForm", 
				type: 'post',
				dataType: 'JSON',
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
						displayMsg("success", response.msg);
						setTimeout(function(){
							window.location = "<?php echo base_url();?>myprofile/addEdit";
						},2000);
					}
					else
					{	
						displayMsg("error", response.msg);
						return false;
					}
				}
			});
		}
	});

	document.title = "My Profile";
	
</script>
</body>
</html>


