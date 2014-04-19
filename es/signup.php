<?php include("includes/header.php"); ?>
<div class="row signup-container">
	<section class="form-box">
		<h4> Regístrese </h4>
		<form role="form">
  		  <div class="form-group">
  		    <input type="text" class="form-control" id="ref-code" placeholder="Código referencial">
  		  </div>
  		  <div class="form-group">
		      <section class="row">
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="partner" value="direct" checked>
					      <label>Ventas Directas</label>
					    </label>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="partner" value="partner">
					      <label>Socio</label>
					    </label>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
 					 <div class="radio">
 					   <label>
 					     <input type="radio" name="optionsRadios" id="personal" value="personal">
					      <label>Personal</label>
 					   </label>
 					 </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="business" value="business">
					      <label>Empresa</label>
					    </label>
					  </div>
				  </div>
			  </section>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" id="first-name" placeholder="Nombre *" required>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" id="last-name" placeholder="Apellido *" required>
		  </div>
		  <div class="form-group">
		    <input type="email" class="form-control" id="email" placeholder="E-mail *" required>
		  </div>
		  <div class="form-group">
		    <input type="phone" class="form-control" id="phone" placeholder="Teléfono *" required>
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="terms" value="agree_terms" required> He leído y acepto los <a href="#" data-toggle="modal" data-target=".terms">Términos y Condiciones</a>
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="terms" value="agree_policy" required> He leído y acepto las <a href="../includes/NeXXStarsPP.pdf" target="_blank">Políticas y Procedimientos</a>
		  </div>
		  <button type="submit" class="btn btn-primary">Continuar</button>
		</form>
	</section>
</div>
<?php include('includes/footer.php'); ?>
