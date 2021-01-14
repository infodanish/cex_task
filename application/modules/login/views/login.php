<body>


    <!--section start-->
    <section class="login-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Login</h3>
                    <div class="theme-card">
                        <form class="theme-form" id="frm_login">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="login_email" name="login_email" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="review">Password</label>
                                <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Enter your password">
                            </div><button type="submit"class="btn btn-solid">Login</button> 
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3>Registration</h3>
                    <div class="theme-card authentication-right">
                        <form class="theme-form" id="frm_guser">
                            <div class="form-group">
                                <label for="full_name">Name*</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your name">
                            </div>
							<div class="form-group">
                                <label for="email_id">Email*</label>
                                <input type="text" class="form-control" id="email_id" name="email_id" placeholder="Enter your Email">
                            </div>
							<div class="form-group">
                                <label for="password">Password*</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password">
                            </div>
							<div class="form-group">
                                <label for="phone_no">Mobile*</label>
                                <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter your Email">
                            </div>
							<div class="form-group">
                                <label for="address">Address*</label>
                                <textarea id="address" name="address" class="form-control"></textarea>
                            </div>
                            <button type="submit"class="btn btn-solid">Submit</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
	<script>
    
    var vRules = {
			login_email:{required:true, email:true},
			login_password:{required:true}
		};

		var vMessages = {
			login_email:{required:"Please enter email.",email:"Please enter valid email."},
			login_password:{required:"Please enter password."}    
		};

		$("#frm_login").validate({
		rules: vRules,
		messages: vMessages,
		submitHandler: function(form) 
		{
			var act = "<?php echo base_url();?>login/loginvalidate";
			$("#frm_login").ajaxSubmit({
				url: act, 
				type: 'post',
				dataType: 'json',
				cache: false,
				clearForm: false, 
				beforeSubmit : function(arr, $form, options){
					//return false;
				},
				success: function (response) 
				{
					alert(response.msg);
					$('#myModal ').find(".modal-body").html("");
					$('#myModal ').find(".modal-body").html(response.msg);
					$('#myModal').modal('toggle');
					if(response.success)
					{
						setTimeout(function(){
							window.location = "<?php echo base_url();?><?=(!empty($_SESSION['last_state'])?$_SESSION['last_state']:"productlisting")?>";
						},2000);
					}
				}
			});
		}
	});
	
	
	var vgRules = {
		
			email_id:{required:true, email:true},
			full_name:{required:true},
			password:{required:true},
			phone_no:{required:true, digits:true},
		};

		var vgMessages = {
			email_id:{required:"Please enter email.",email:"Please enter valid email."},
			full_name:{required:"Please enter name."},
			password:{required:"Please enter password."},
			phone_no:{required:"Please enter mobile no."},			
		};

		$("#frm_guser").validate({
		rules: vgRules,
		messages: vgMessages,
		submitHandler: function(form) 
		{
			var act = "<?php echo base_url();?>login/guestdetailsvalidate";
			$("#frm_guser").ajaxSubmit({
				url: act, 
				type: 'post',
				dataType: 'json',
				cache: false,
				clearForm: false, 
				beforeSubmit : function(arr, $form, options){
					//return false;
				},
				success: function (response) 
				{
					alert(response.msg);
					$('#myModal ').find(".modal-body").html("");
					$('#myModal ').find(".modal-body").html(response.msg);
					$('#myModal').modal('toggle');
					if(response.success)
					{
						setTimeout(function(){
							window.location = "<?php echo base_url();?><?=(!empty($_SESSION['last_state'])?$_SESSION['last_state']:"productlisting")?>";
						},2000);
					}
				}
			});
		}
	});
	
  </script>