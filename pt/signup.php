<?php include("includes/header.php"); ?>
<div class="row signup-container">
	<section class="form-box">
		<h4> Cadastre-se </h4>
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
					      <label>Vendas Diretas</label>
					    </label>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="partner" value="partner">
					      <label>Parceiro</label>
					    </label>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
 					 <div class="radio">
 					   <label>
 					     <input type="radio" name="optionsRadios" id="personal" value="personal">
					      <label>Pessoal</label>
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
		    <input type="text" class="form-control" id="first-name" placeholder="Nome *" required>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" id="last-name" placeholder="Sobrenome *" required>
		  </div>
		  <div class="form-group">
		    <input type="email" class="form-control" id="email" placeholder="Email *" required>
		  </div>
		  <div class="form-group">
		    <input type="phone" class="form-control" id="phone" placeholder="Telefone *" required>
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="terms" value="agree_terms" required> Li e aceito os <a href="#" data-toggle="modal" data-target=".terms">Termos e Condições</a>
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="terms" value="agree_policy" required> Li e aceito as <a href="includes/NeXXStarsPP-pt.pdf" target="_blank">Regras e Procedimentos </a>
		  </div>
		  <button type="submit" class="btn btn-primary">Continuar</button>
		</form>
	</section>
</div>
<?php include('includes/footer.php'); ?>
