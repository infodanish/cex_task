<?php 
//session_start();
//print_r($_SESSION["webadmin"]);

//print_r($users);
//echo "Name: ".$users[0]->first_name;
?>
<!-- start: Content -->
<div id="content" class="page-body">
	<!-- <div class="page-title">
		<div>
			<h1>Add User</h1>            
		</div>
		<div>
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url();?>home"><i class="fa fa-home fa-lg"></i></a></li>
				<li><a href="<?php echo base_url();?>users">Users</a></li>
			</ul>
		</div>
	</div> -->
	<div class="container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6">
					<div class="page-header-left">
						<h3>Users
							<small>Chheda Admin panel</small>
						</h3>
					</div>
				</div>
				<div class="col-lg-6">
					<ol class="breadcrumb pull-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>users"><i data-feather="home"></i></a></li>
						<li class="breadcrumb-item active">Users</li>
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
						<input type="hidden" id="user_id" name="user_id" value="<?php if(!empty($users[0]->user_id)){echo $users[0]->user_id;}?>" />
						<div class="control-group form-group">
							<label class="control-label" for="selectError">Role</label>
							<div class="controls">
								<select id="role_id" name="role_id" class="input-xlarge form-control">
									<option value="">Select</option>
									<?php 
									if(isset($roles) && !empty($roles))
									{
										foreach($roles as $cdrow)
										{
											$sel = ($cdrow->role_id == $users[0]->role_id) ? 'selected="selected"' : '';
											// if($cdrow->role_id == 2){continue;}
										?>
										<option value="<?php echo $cdrow->role_id;?>" <?php echo $sel; ?>><?php echo $cdrow->role_name;?></option>
									<?php 
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="control-group form-group">
							<label class="control-label" for="focusedInput">First Name*</label>
							<div class="controls">
								<input class="input-xlarge form-control" id="first_name" name="first_name" type="text" value="<?php if(!empty($users[0]->first_name)){echo $users[0]->first_name;}?>">
							</div>
						</div>
						<div class="control-group form-group">
							<label class="control-label" for="focusedInput">Last Name*</label>
							<div class="controls">
								<input class="input-xlarge form-control" id="last_name" name="last_name" type="text" value="<?php if(!empty($users[0]->last_name)){echo $users[0]->last_name;}?>">
							</div>
						</div>
						<div class="control-group form-group">
							<label class="control-label" for="focusedInput">Email Id*</label>
							<div class="controls">
								<input class="input-xlarge form-control" id="email_id" name="email_id" type="text" value="<?php if(!empty($users[0]->email_id)){echo $users[0]->email_id;}?>">
							</div>
						</div>
						<div class="control-group form-group">
							<label class="control-label" for="focusedInput">User Name*</label>
							<div class="controls">
								<input class="input-xlarge form-control" id="user_name" name="user_name" type="text" value="<?php if(!empty($users[0]->user_name)){echo $users[0]->user_name;}?>" <?php if(!empty($users[0]->user_name)){?>  readonly <?php }?>>
							</div>
						</div> 
						<?php if(empty($users[0]->user_id)){?>
							<div class="control-group form-group">
								<label class="control-label" for="focusedInput">Password*</label>
								<div class="controls">
									<input class="input-xlarge form-control" id="password" name="password" type="password" value="">
								</div>
							</div>
							<div class="control-group form-group">
								<label class="control-label" for="focusedInput">Confirm Password*</label>
								<div class="controls">
									<input class="input-xlarge form-control" id="confirm_password" name="confirm_password" type="password" value="">
								</div>
							</div>
						<?php }?>	
						<div class="control-group form-group">
							<label class="control-label" for="focusedInput">Contact No*</label>
							<div class="controls">
								<input class="input-xlarge form-control" id="phone" name="phone" type="text" value="<?php if(!empty($users[0]->phone)){echo $users[0]->phone;}?>">
							</div>
						</div>
						<div class="control-group form-group">
							<label class="control-label" for="status">Status*</label>
							<div class="controls">
								<select name="status" id="status" class="form-control">
									<option value="Active" <?php if(!empty($users[0]->status) && $users[0]->status == "Active"){?> selected <?php }?>>Active</option>
									<option value="In-active" <?php if(!empty($users[0]->status) && $users[0]->status == "In-active"){?> selected <?php }?>>In-active</option>
								</select>
							</div>
						</div>
						<div class="form-actions form-group">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="<?php echo base_url();?>users" class="btn btn-primary">Cancel</a>
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
	/*$.noty({
		text:"This is a success notification",
		layout:"topRight",
		type:"success"
	});*/
});

var vRules = {
	first_name:{required:true},
	last_name:{required:true},
	email_id:{required:true, email:true,remote: {
						url:"<?php echo base_url('users/dataEmailExist');?>" ,
						type: "post",
						data: {email_id: function() {return $( "#email_id" ).val();},user_id:function() {return $( "#user_id" ).val();}}
					  }},
	user_name:{required:true,remote: {
						url:"<?php echo base_url('users/dataUsernameExist');?>" ,
						type: "post",
						data: {user_name: function() {return $( "#user_name" ).val();},user_id:function() {return $( "#user_id" ).val();}}
					  }},
	<?php if(empty($users[0]->user_id)){?>
		password:{required:true},
		confirm_password:{required:true,equalTo:password},
	<?php }?>
	role_id:{required:true},
	phone:{required:true,digits:true}
};
var vMessages = {
	first_name:{required:"Please enter first name"},
	last_name:{required:"Please enter last name"},
	email_id:{required:"Please enter email id",email:"Please enter correct email id",remote:"Email Id Already Exist."},
	user_name:{required:"Please enter user name",remote:"Username Already Exist."},
	<?php if(empty($users[0]->user_id)){?>
		password:{required:"Please enter password"},
		confirm_password:{required:"Please enter confirm password",equalTo:"Password does not match."},
	<?php }?>	
	role_id:{required:"Please select role."},
	phone:{required:"Please enter contact no.",digits:"Please enter only digits"}
};

$("#form-validate").validate({
	rules: vRules,
	messages: vMessages,
	submitHandler: function(form) 
	{
		var act = "<?php echo base_url();?>users/submitForm";
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
						window.location = "<?php echo base_url();?>users";
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

document.title = "Add/Edit Admin Users";
</script>