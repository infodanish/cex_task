
<!--section start-->
<br><br><br><br>
<section class="cart-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table cart-table table-responsive-xs">
                    <thead>
                    <tr class="table-head">
                        <th scope="col">image</th>
                        <th scope="col">product name</th>
                        <th scope="col">Category</th>
                        <th scope="col">quantity</th>
                        <th scope="col">Weight</th>
                        <th scope="col">price</th>
                        <!-- <th scope="col">action</th> -->
                        <!--<th scope="col">total</th>-->
                    </tr>
                    </thead>
                    <?php 
                    
                    $total = '';
                    if(!empty($cartdetail)){
                     foreach ($cartdetail as $key => $value) {
                        //  echo "<pre>";
                        //  print_r($value);
                        $total=$total+$value['item_qty']*$value['item_unit_price'];?>
                        <tbody>
                        <tr>
                            <td>
                                <a href="#"><img src="<?= base_url()?>assets/images/pro3/1.jpg" alt=""></a>
                            </td>

                            <td><a href="#"><?=$value['product_sizetype']?><br><?= (!empty($value['item_name'])?"(".$value['item_name'].")": "") ?></a>
                                <div class="mobile-cart-content row">
                                    <div class="col-xs-3">
                                        <div class="qty-box">
                                            <div class="input-group">
                                               <input type="text" name="quantity" class="form-control input-number" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <h2 class="td-color">&#8377; <?=$value['item_unit_price']?></h2></div>
                                    <div class="col-xs-3">
                                        <h2 class="td-color"></h2></div>
                                </div>
                            </td>
                            <td>
                                <h6><?=$value['category_name']?></h6>
                            </td>
                          
                            <td>
                                <div class="qty-box">
                                    <div class="input-group">
                                        <input type="number" name="quantity" id="item_qty<?php echo $value['item_id']; ?>"  class="form-control input-number" value="<?=$value['item_qty']?>" readonly>
                                    </div>
                                </div>
                            </td>
                            <td><?=$value['weight']?></td>
                            <!-- <td><a href="#" class="icon"  onclick="deleteitemcart(<?php echo $value['cart_id'] ?>)"><i class="ti-close"></i></a></td> -->
                            <td>
                                <h2 class="td-color">&#8377; <?=$value['item_total_price']?></h2></td>
                        </tr>
                        </tbody>

                    <?php } } ?>
                    
                </table>
                <table class="table cart-table table-responsive-md">
                    <tfoot>
                    <tr>
                        <td>total price :</td>
                        <td>
                            <h2><?=$total?></h2></td>
                    </tr>
                    </tfoot>
                </table>
                <!--<div class="col-lg-6"></div><div class="col-lg-6"></div>--><br/>
                <div class="col-lg-6" style="margin-left:40%">
                    <div class="row order-success-sec">
                        <div class="col-sm-6">
                            <h4>summary</h4>
                            <ul class="order-detail">
                                <li>order ID: <?=$value['order_id']?></li>                            
                                <li>Payment ID: <?=$value['invoice']?></li>
                                <li>Order Date: <?=$value['created_on']  ?></li>
                                <li>Order Amount: &#8377; <?=$total?></li>
                                <li>Shipping Charges: &#8377; <?=$value['shipping_charges']?></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h4>shipping address</h4>
                            <ul class="order-detail">
                                <li><?=$value['shipping_address']?></li>
                                <li><?=$value['shipping_address2']?></li>
                                <li><?=$value['shipping_city']?></li>
                                <li><?=$value['shipping_state']?></li>
                                <li><?= $value['shipping_pincode']?></li>
                            </ul>
                        </div>
                        <div class="col-sm-12 payment-mode">
                            <h4>payment method</h4>
                            <p>Razorpay</p>
                        </div>
                        <!-- <div class="col-md-12">
                            <div class="delivery-sec">
                                <h3>expected date of delivery</h3>
                                <h2>october 22, 2018</h2></div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
  
    </div>
</section>
<!--section end-->


</body>

</html>
