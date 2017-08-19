<?php require 'includes/head.inc' ?>
  

<!--the header, see the file for the code-->
<?php include 'includes/header.inc' ?>
<div class="container">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
		  </ol>
		
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
			<div class="item active">
			  <img src="images/homecarousel1.png" alt="Speed">
			</div>
			<div class="item">
			  <img src="images/homecarousel2.png" alt="Safe">
			</div>

		  </div>
		
		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
		</div>
</div>
	
	
<div class="container">
	  <div class="row">
		<div class="col-md-4">
			<section>
				<a href="#">
					<img id="shortcut" src="images/philosophy.png" alt="Our Philosophy"/>
				</a>
			</section>
		</div>
		<div class="col-md-4">
			<section>
				<a href="#">
					<img id="shortcut" src="images/services.png" alt="Our Services"/>
				</a>
			</section>
		</div>
		
		<div class="col-md-4">
			<section>
				<a href="#">
					<img id="shortcut" src="images/testimonials.png" alt="Testimonials"/>
				</a>	
			</section>
		</div>
	 </div>
</div>

<a href="#">
	<img id="logo" src="images/icon3.png" alt="logo"/>
</a>
	

<?php require 'includes/footer.inc' ?>
