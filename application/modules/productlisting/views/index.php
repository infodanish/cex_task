<!-- section start -->
<section class="section-b-space ratio_square section-t-space-0">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">                
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="top-banner-wrapper">
                                   <!--  <a href="#"><img src="images/category-banner/1.jpg" class="img-fluid blur-up lazyload" alt=""></a> -->
                                    <div class="top-banner-content small-section category-name">
                                        <h2>Product Listing</h2> 
                                    </div>
                                </div>
                                <div class="collection-product-wrapper">                                    
                                    <div class="product-wrapper-grid product-load-more">
                                        <div class="row" id="productData">
                                           
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section End -->


<!-- Quick-view modal popup start-->
<span id="Quickviewmodel"></span>
<!-- Quick-view modal popup end-->

</body>

</html>

<script type="text/javascript">
$(window).load(function() {
	//alert("hhhh");return false;
	getRecords();
	//alert("here...");return false;
});

function getRecords(){
	//$("#loadingdata").show();
	//alert("here");return false;
	
	$.ajax({
 		url: '<?php echo base_url();?>productlisting/getRecords',
		data: {},
		dataType: 'json',
 		type: 'post',
 		success: function(response)
 		{
			//alert(response.htmldata);
     		if(response.msg == "success")
     		{
				$("#productData").html(response.htmldata);
				//console.log(response.htmldata);
     		}else{
				
     		}
       	}
  	});
	
}
</script>