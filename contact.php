<!DOCTYPE html>
<html>

    <?php 
    // session_start();
 
 // // Check if the user is logged in, if not then redirect him to login page
 // if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
 //     header("location: login.php");
 //     exit;
 // }
    include('nav-bar/top_nav.html'); ?>
  
    <div class="hero-wrap hero-bread" style="background-image: url('images/banner-contact.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php"  style="color: red;">Home</a></span> <span style="color: red;">Contact us</span></p>
            <h1 class="mb-0 bread"  style="color: red;">Contact us</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
      	<div class="row d-flex mb-5 contact-info">
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Address:</span> 12, Jalan 123, Kuala Lumpur, Malaysia</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span> <a href="tel://12 3456789">+6012 3456789</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span> <a href="mailto:onlinemec@email.com">onlinemec@email.com</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Website</span> <a href="#">www.onlinemec.com</a></p>
	          </div>
          </div>
        </div>
        <div class="row block-9">
          <div class="col-md-12 order-md-last d-flex">
            <form action="#" class="bg-white p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          
          </div>
<!-- 
          <div class="col-md-6 d-flex">
          	<div id="map" class="bg-white"></div>
          </div> -->
        </div>
      </div>
    </section>

    <?php include('nav-bar/footer.html'); ?>

  
</html>