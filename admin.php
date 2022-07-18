<!DOCTYPE html>
<html>

<?php 
	require_once "backend/adminSide.php";
    session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    $admin_obj = new admin();
    $resp=[];
    $resp =$admin_obj->getProcessPO();

    if(isset($_POST['process'])){
        $po_id = strval($_POST['po_id']);
        $admin_obj ->sendEmail($resp['PO_EMAIL']);
		$admin_obj->updatePoStatus($po_id);
        header("location: admin.php");
    }

    include('nav-bar/top_nav_admin.php'); ?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/banner-5.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Admin</a></span> <span>PO</span></p>
                <h1 class="mb-0 bread">Purchase Order</h1>
            </div>
            </div>
        </div>
        </div>
    
        <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row d-flex mb-5">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>Process</th>
						        <th>PO ID</th>
						        <th>Date</th>
                                <th>Subtotal</th>
						        <th>Billing Address</th>
						        <th>Name</th>
						      </tr>
						    </thead>
						    <tbody>
							 <?php foreach ($resp as $product): ?>
								<tr class="text-center">
								<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<td class="product-remove">
									<input type="hidden" name="po_id" value="<?=$product['PO_ID']?>">
									<input type="submit" value ="Process" name="process" class="btn btn-primary py-2 px-2">
									</td>

								</form>
						        
						        <td class="product-name">
						        	<h3><?=$product['PO_ID']?></h3>
						        </td>
						        
						        <td class="date"><?=$product['PO_ORDER_DATE']?></td>
						        
						        <td class="quantity"> RM 
								<?=$product['PO_TOTAL']?>
					          </td>
						        <td class="addr"> <?=$product['PO_ADDR'] ?></td>
                                <td class="item"> <?=$product['PO_NAME']?></td>
						        
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