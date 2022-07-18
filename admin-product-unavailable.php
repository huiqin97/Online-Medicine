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
	$check=[];
    $product_obj = new manageProduct();

    $productType = "";
	$productType = $product_obj->getProductType();
	$resp = $product_obj->getNonAvailableProductDetails($productType);

    if(isset($_POST['form_submit'])){
		$message="";

		$check = $_POST['isCheck'];
		if(empty($check)) 
		{
			$message="Product Availability remain unchanged";
		} 
		else 
		{
			$N = count($check);

			$message="$N product is set to non-available";
			for($i=0; $i < $N; $i++)
			{
				$admin_obj->updateProductAvailability($check[$i],1);
			}
			header("location: admin-product.php?type=");
		}
    }

    include('nav-bar/top_nav_admin.php'); ?>

<div class="hero-wrap hero-bread" style="background-image: url('images/banner-3.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread" style="color:#6E85B7 ;">Set product to available</h1>
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
					<?php if(!empty($message)): ?>
						
						<div class='alert alert-primary' role='alert'>
							<?php echo $message ?> 
						</div>
					<?php endif; ?>
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
								<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?type=';?>">
                                    <input type="hidden" name="po_id" value="<?=$product['PRODUCT_ID']?>">
									<td class="product-remove">
                                    <input type="checkbox" name='isCheck[]' value="<?=$product['PRODUCT_ID']?>" >
									</td>
									
							</div>
								
						        
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
						  <input type="submit" name="form_submit" value="Process" class="btn btn-primary py-2 px-2">
						  </form>
					  </div>
    			</div>
				
    		</div>

			</div>
		</section>

    <?php  include('nav-bar/footer-admin.html'); ?>
</html>