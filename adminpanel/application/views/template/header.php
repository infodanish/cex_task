<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/dashboard/favicon.png" type="image/x-icon">
    <title>Cex</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fontawesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flag-icon.css">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/icofont.css">

    <!-- Prism css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/prism.css">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="    https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>assets/css/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/noty_theme_default.css" rel="stylesheet">
    <!-- Chartist css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/chartist.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link href="<?PHP echo base_url();?>assets/css/jquery.dataTables.css" rel="stylesheet">
    <link href="<?PHP echo base_url();?>assets/css/jquery.dataTables.css" rel="stylesheet">
    <link href="<?PHP echo base_url();?>assets/css/jquery.noty.css" rel="stylesheet">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin.css">
    <link href="<?php echo base_url(); ?>assets/css/select2.css" type="text/css" rel="stylesheet" />

    <!-- <link type="text/css" rel="stylesheet"  href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css"/> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet"  href="<?php echo base_url(); ?>assets/css/bootstrap-material-datetimepicker.css"/>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/essential-plugins.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

   
    <!-- <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script> -->

    <!-- CK Editor plugins -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ckeditor/adapters/jquery.js"></script>  
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.v3.3.6.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/additional-methods.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.js"></script>
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-datepicker.min.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.colorbox.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script> -->
   
	
    <!-- Datatable plugin-->
    <script type="text/javascript" src='<?PHP echo base_url();?>assets/js/jquery.dataTables.min.js'></script>
	<script type="text/javascript" src='<?PHP echo base_url();?>assets/js/datatable.js'></script>
    <script type="text/javascript" src="<?PHP echo base_url();?>assets/js/jquery.noty.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url();?>assets/js/select2.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url();?>assets/js/moment-with-locales.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url();?>assets/js/bootstrap-material-datetimepicker.js"></script>
    <!-- <link rel="stylesheet" href="https://t00rk.github.io/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"> -->
    <!-- <script src="https://momentjs.com/downloads/moment-with-locales.js"></script> -->
    <!-- <script src="https://t00rk.github.io/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script> -->
    <script>
		function setTabIndex()
		{
			var tabindex = 1;
			$('input,select,textarea,.icon-plus,.icon-minus,button,a').each(function() {
				if (this.type != "hidden") {
					var $input = $(this);
					$input.attr("tabindex", tabindex);
					tabindex++;
				}
			});
		}
		
		$(function()
		{
			setTabIndex();
			$(".select2").each(function(){
				$(this).select2({
					placeholder: "Select",
					allowClear: true
				});
				$("#s2id_"+$(this).attr("id")).removeClass("searchInput");
			});
			//document.title = "Home - Commodity Alpha";
			//$(".inline").colorbox({inline:true, width:"50%",  onComplete : function() { 
			//$(this).colorbox.resize(); 
			//} });

			$(".dataTables_filter input.hasDatepicker").change( function () {
				/* Filter on the column (the index) of this element*/ 
				oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
			});
			
			window.scrollTo(0,0);
		});
		
		function displayMsg(type,msg)
		{	
			$.noty({
				text:msg,
				layout:"topRight",
				type:type
			});
		}
	</script>
</head>
<style>
  .dtp-buttons > button.btn {
             border: none;
             border-radius: 2px;
             position: relative;
             box-shadow: none;
             color: rgba(0,0,0, 0.87);
             padding: 5px 16px;
             font-size: 12px;
             margin: 10px 1px;
             font-weight: 500;
             text-transform: uppercase;
             letter-spacing: 0;
             will-change: box-shadow, transform;
             transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
             outline: 0;
             cursor: pointer;
             text-decoration: none;
             background: transparent;
         }
        .dtp-buttons > button.btn:hover,
        .dtp-buttons > button.btn:focus {
            background-color: rgba(153, 153, 153, 0.2);
        }
		.dtp {
			overflow-y: auto !important;
		}
		 
		.dtp > .dtp-content > .dtp-date-view > header.dtp-header ,.dtp div.dtp-date, .dtp div.dtp-time ,.dtp table.dtp-picker-days tr > td > a.selected{
			background: #6b3031 !important;
		}
	
</style>
<body>

<!-- page-wrapper Start-->
<div class="page-wrapper">

    <!-- Page Header Start-->
    <div class="page-main-header">
        <div class="main-header-right row">
            <div class="main-header-left d-lg-none">
                <div class="logo-wrapper">
				<a href="index.html"><img class="blur-up lazyloaded" src="<?php echo base_url(); ?>assets/images/dashboard/multikart-logo.png" alt="" width="50" height="50"></a></div>
            </div>
            <div class="mobile-sidebar">
                <div class="media-body text-right switch-sm">
                    <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
                </div>
            </div>
            <div class="nav-right col">
                <ul class="nav-menus">
                    <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize-2"></i></a></li>
                    
                    <li class="onhover-dropdown">
                        <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="<?php echo base_url(); ?>assets/images/dashboard/man.png" alt="header-user">
                            <div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            <li><a href="<?php echo base_url("home/logout");?>"><i data-feather="log-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
    </div>
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
	
        <!-- Page Sidebar Start-->
        <div class="page-sidebar">
            <div class="main-header-left d-none d-lg-block">
                <div class="logo-wrapper"><a href="<?php echo base_url(); ?>home"><img class="blur-up lazyloaded" src="<?php echo base_url(); ?>assets/images/dashboard/multikart-logo.png" alt=""></a></div>
            </div>
            <div class="sidebar custom-scrollbar">
                <div class="sidebar-user text-center">
                    
                </div>
                <ul class="sidebar-menu">
                    <li><a class="sidebar-header" href="<?php echo base_url(); ?>categories"><i data-feather="user-plus"></i><span>Categories</span></a></li>
					<li><a class="sidebar-header" href="<?php echo base_url(); ?>products"><i data-feather="user-plus"></i><span>Products</span></a></li>
					
                    <li><a class="sidebar-header" href="<?php echo base_url();?>orders"><i data-feather="settings"></i><span>Orders</span></a>
                    </li>

                    </li>
                    
                    </li>
                </ul>
            </div>
        </div>
        <!-- Page Sidebar Ends-->

        <!-- Right sidebar Start-->
        
        <!-- Right sidebar Ends-->

        
		</body>
		</html>