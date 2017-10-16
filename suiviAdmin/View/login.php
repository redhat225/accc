<?php 
$backGreen="backGreen";
 ?>
<div class="row center accc-small-perc-top-margin">
	<div class="container">
		<div class="container">
			<h5 class="bold white-text accc-row-padding">Agence Comptable des Creances Contentieuses</h5>
			<div class="col s4 accc-right-barrow">
				<p class="logo-wrapper-circle">
					<img src="../img/index/dgtcp-logo.jpg"/>
				</p>
			</div>
			<div class="col s8">
				<h5 class="bold white-text zero-margin">Suivi Courrier Administrateur</h5>
				 <form id="login-admin-acc">
					<div class="input-field col s12">
						 <i class="prefix small ion-ios-person"></i>
					     <input id="login-admin" name="login-admin-content" type="email" class="required">
					     <label for="login-admin">Login</label>
				    </div>
				    <div class="input-field col s12">
						 <i class="prefix small ion-ios-person"></i>
					     <input id="password-admin" name="password-admin-content" type="password" class="required">
					     <label for="password-admin">Mot de Passe</label>
				    </div>
				    <button type="submit" id="submit-login-admin" class="btn submit-button">Connexion</button>
					<div class="loaderAjax acc-medium-top-margin">
				    	<img src="../AjaxLoader/loading.gif" />
				    </div>
				    <div class="error-form-wrapper acc-small-top-margin">
				    	<span id="error-login-admin-content" class="white-text hidden"></span>
				    </div>
				    <input type="hidden" name="flexpaper-content" value="<?php echo $f; ?>" />
				    <input type="hidden" name="client-control" value="2" />
				 </form>
				 <?php if(!(isset($_SESSION['AuthClient']))): ?>
				 <p class="accc-row-padding"> <a href="index.php?p=recovery" class="white-text">Mot de passe oublié</a></p>
				<?php 	endif; ?>
			</div>
			
		</div>
	</div>
</div>

<?php if(isset($_SESSION['AuthClient'])): ?>
  <div class="fixed-action-btn click-to-toggle" style="bottom: 35px; right: 12px;">
    <a class="btn-floating btn-large accc-back-color admin-floating-button">
      <i class="ion-email floating-icon-main admin" style="font-size:50px;"></i>
    </a>

    <ul id="bubble-menu-admin">
      <li><a href="index.php?p=compte" class="btn-floating accc-back-color"><i class="ion-easel white-text floating-icon-sub"></i></a></li>
      <li><a href="index.php?p=logout" class="btn-floating accc-back-color"><i class="ion-power white-text floating-icon-sub"></i></a></li>
   </ul>
  </div>
<?php endif; ?>