<?php $ManageAdmin->NotificationsInfo(); ?>
<?php $ManageAdmin->memberAdminInfo(); ?>
<?php $ManageAdmin->typeNotification(); ?>
	    <div class="row center game-row-padding zero-margin" class="general-info">
	       		
	       			<p class="generalStats zero-margin">
	  					<i class="ion-android-notifications accc-huge-icon accc-color"></i>
	  					<h4 class="accc-color zero-margin">Notifications</h4>
	  					<h6 class="bold">Consultez l'activité des membres lors de l'utilisation du système</h6>	

	  					                       <p class="accc-wrapper-button adding-filter-depart-internal">
                         <i class="ion-plus-round white-text small adding-Member-trigger"></i>
                         <i class="ion-funnel white-text small adding-Member-trigger"></i> 
                      </p>
	  				</p>
	  
           <div class="row center hidden" id="Filtrage-wrapper"> 
                <div class="col s6">
                        <h5 class="accc-color">Filtrage</h5>
                                <i class="ion-ios-settings-strong accc-color large"></i>
                                <div class="col s12 input-field">
                                    <label>Choisissez le filtrage</label><br>
                                    <select class="browser-default" name="" id="filter-select-type-courrier">
                                        <option value="dateEnr-search" selected>Par Date Enregistrement</option>
                                        <option value="type-search">Par Type Notification</option>
                                        <option value="resp-search">Par Responsable Action</option>
                                        <option value="">Enlever le filtre</option>
                                    </select>
                       </div>
                </div>

                <div class="col s6">


                          <div class="col s12 search-element dateEnr-search">
                            <h5 class="accc-color">Recherche par date enregistrement</h5>
                            <i class="ion-android-calendar accc-color medium"></i>
                            <i class="ion-ios-search-strong accc-color large"></i>
                            <form id="search-courrier-byDate-notification" class="admin-form dash-form">
                              <div class="col s12 input-field">
                                  <i class="ion-calendar prefix"></i>
                                  <input id="date-form" name="date-search-courrier" type="text" class="form-control datepicker required">                              
                                  <label for="date-form">Sélectionnez une date</label>
                                  <button type="submit" class="btn submit-button center" id="submit-search-courrier-date">Rechercher</button>
                                  <button type="" class="btn submit-button center" id="cancel-search-courrier-date-archive">Reinitialiser</button>
                                  
                                  <div class="loaderAjax acc-medium-top-margin">
                                    <img src="../AjaxLoader/loading2.gif" />
                                  </div>
                              </div>
                            </form>
                          </div>

                            <div class="col s12 search-element resp-search hidden" id="respactionsearch">
                                   <h5 class="accc-color">Recherche par Responsable/Courrier</h5>
                               	     <i class="ion-ios-person accc-color medium"></i>
	                          		<i class="ion-android-search accc-color large"></i>

                                <div class="col s6 input-field">
                                    <label>Choisissez une entité</label><br>
                                    <select class="browser-default" name="" id="filter-select-notification-initiator">
	                                <option value="" disabled selected>Choisissez un utilisateur</option>
	                                <option value="">Rien</option>
		                                <?php foreach ($_SESSION['memberAdminInfo'] as $key => $value) :?>
		                                		<option value="<?php echo strtoupper($value->nom." ".$value->prenom); ?>"><?php echo $value->nom." ".$value->prenom; ?></option>
		                            	<?php endforeach; ?>
                                    </select>
                                </div>
                           		
                                <form id="search-courrier-byNumSuivi-archive" class="admin-form dash-form">
                                    <div class="col s6 input-field">
                                      <input type="number"  name="num-suivi-search" class="required" id="num-suivi-search-id" />
                                      <label class="" for="num-suivi-search-id">Identifiant de suivi courrier</label>
                                    </div>
                                </form>

                                <button class="btn submit-button center" id="submit-respAction">Rechercher</button>
                                <button class="btn submit-button center" id="cancel-respAction">Réinitialiser</button>
                                	      <div class="loaderAjax acc-medium-top-margin">
	                                        <img src="../AjaxLoader/loading2.gif" />
	                                      </div>
                      		</div>

	                          <div class="col s12 search-element type-search input-field hidden">
	                              	<h5 class="accc-color">Filtrage par Type Notification</h5>
	                         		<i class="ion-qr-scanner accc-color medium"></i>
	                          		<i class="ion-android-search accc-color large"></i>
	                              <select class="browser-default" name="" id="filter-select-notification-type">
	                                <option value=""selected>Tout</option>
	                                	<?php foreach ($_SESSION['typeNotification'] as $key => $value) :?>
		                                		<option value="<?php echo $value->action; ?>"><?php echo $value->action; ?></option>
		                            	<?php endforeach; ?>
	                              </select>
	                          </div>


                </div>

              </div> 



	              <div class="row" id="gamer-info-table">
	                 <?php if($_SESSION['NotificationsInfo'][0]!=0) :?>
	                      <table class="MyTable striped bordered bold centered" id="archives-table">
	                          <thead class="orange white-text">
	                              <tr>
	                                  <th data-field="id">Identifiant Notification</th>
	                                  <th data-field="id">Type Notification</th>
	                                  <th data-field="id">Initiateur</th>
	                                  <th data-field="id">Privilège</th>
	                                  <th data-field="id">Date Notification</th>
	                                  <th data-field="id">Contenu</th>
	                              </tr>
	                          </thead>
	                          <tbody>
	                          
	                          		<?php foreach ($_SESSION['NotificationsInfo'] as $key => $value): ?>
	                          			<?php $contentLog=json_decode($value->contenu); ?>
	                          			<tr class="<?php echo $value->action; ?> <?php echo $contentLog->NotCourrier; ?> <?php echo strtoupper($value->nom." ".$value->prenom); ?> <?php echo substr($value->dateEnr,0,10); ?>">
	                          				<td><?php echo $value->idNotification; ?></td>
											<td><?php echo $value->action; ?></td>
											<td><?php echo $value->nom." ".$value->prenom; ?></td>
											<td><?php echo $value->poste; ?></td>
											<td><?php $date=new DateTime($value->dateEnr); echo $date->format('d-m-Y H:i:s'); ?></td>
											<td>
												<span>
												<?php  
													foreach ($contentLog as $key => $value) {
														echo $value." ; ";
													}
												?>
												</span>

											</td>
	                          			</tr>
	                          		<?php endforeach ?>	

	                          </tbody>               
	                      </table>
	                  	                          	  <?php else: ?>
                        		<h4 class="accc-color zero-margin">Aucune notification enregistrée.</h4>
	                          	<?php endif; ?>
	              </div>
	  	   </div>
<script src="../js/manage-admin.js"></script>
<script src="../js/filterCourrier.js"></script>