<!DOCTYPE html>
<html>

<?php 
	require_once "backend/adminSide.php";
    require_once "backend/manageProduct.php";
    session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    $admin_obj = new admin();

    $resp=[];
    $product_obj = new manageProduct();

    $productType = "";
	$productType = $product_obj->getProductType();
	$resp = $product_obj->getFeatureProductDetails($productType);

    // var_dump($resp_temp);
    // if(isset($_POST['process'])){
    //     $po_id = strval($_POST['po_id']);

    // }

    include('nav-bar/top_nav_admin.php'); ?>

<div class="hero-wrap hero-bread" style="background-image: url('images/banner-3.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread">Products</h1>
          </div>
        </div>
      </div>
    </div>
    
        <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row d-flex mb-5">
    			<div class="col-md-12 ftco-animate">
                <div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">

    				<ul class="product-category">
    					<li><a href="admin-product.php?type=" >All</a></li>
    					<li><a href="admin-product.php?type=health-monitor" >Health Monitors & Test</a></li>
    					<li><a href="admin-product.php?type=pills" >Medicines</a></li>
    					<li><a href="admin-product.php?type=first-aid" >First Aid Supplies</a></li>
    					<li><a href="admin-product.php?type=vitamins">Vitamins & Supplements</a></li>
						<li><a href="admin-product.php?type=covid">Covid-19</a></li>
    				</ul>
    			</div>
    		</div>
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>Product Availability</th>
						        <th>Product Name</th>
						        <th>Product Amount</th>
                                <th>Product Price</th>
						      </tr>
						    </thead>
						    <tbody>
							 <?php foreach ($resp['productDetails'] as $product): ?>
								<tr class="text-center">
								<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<td class="product-remove">
                                    <input type="hidden" name="po_id" value="<?=$product['PRODUCT_ID']?>">
                                    <!-- <label class="switch"> -->
                                        <input type="checkbox" value="<?=$product['PRODUCT_AVAILABILITY'] ?>">
                                    <!-- </label> -->
                                    <input type="hidden" name="form_submit" value="">
                             
                        </div>
                                </td>

								</form>
						        
						        <td class="product-name">
						        	<h3><?=$product['PRODUCT_NAME']?></h3>
						        </td>
						        
						        <td class="price"> <?=$product['PRODUCT_AMT']?></td>
						        
						        <td class="quantity">RM 
								<?=$product['PRODUCT_PRICE']?>
					          </td>
							  
							  <?php endforeach; ?> 
						    </tbody>
						  </table>
					  </div>
    			</div>
				
    		</div>

			</div>
		</section>

    <?php  include('nav-bar/footer-admin.html'); ?>
</html>