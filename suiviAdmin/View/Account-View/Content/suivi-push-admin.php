<?php $ManageAdmin->recupPush($_SESSION['adminInfo']->id); ?>
<?php $ManageAdmin->memberAdminInfo(); ?>
               <div class="row center game-row-padding">
                <div class="container">
                    <i class="ion-chatbubble-working accc-huge-icon accc-color"></i>
                    <h4 class="bold accc-color">Push Messages</h4>
                    <h5>Consultez & Rédigez vos différentes Push Messages</h5>
                    <a href="#push-explanation" class="btn submit-button">En savoir plus</a>
                </div>
            </div> 

                <p class="adding-Member-wrapper center-align">
                    <i class="ion-ios-download grey-text large  receive-push-trigger  pointer"></i> 
                    <i class="ion-ios-upload accc-color large game-small-left-margin send-push-trigger pointer"></i>
               </p> 

             <div class="row game-huge-top-margin" id="gamer-info-table">

                  <div class="hidden" id="push-send-wrapper">
                   <?php if(!($_SESSION['SendPush']===0)) :?>
                       <table class="MyTable striped bordered bold centered responsive-table" id="push-send-table">
                          <thead class="accc-back-color white-text">
                              <tr>
                                  <th data-field="id">Numéro Push</th>
                                  <th data-field="id">Destinataire</th>
                                  <th data-field="id">Date Envoi</th>
                                  <th data-field="id">Message</th>
                                  <th data-field="id">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                             <?php foreach ($_SESSION['SendPush'] as $key => $value) : ?>
                              <tr>
                                <td><?php echo $value->idPush; ?></td>
                                <td><?php echo $value->destinataire; ?></td>
                                <td><?php echo $value->date_envoi; ?></td>
                                <td><?php echo $value->messagePush; ?></td>
                                 <td><i class="ion-ios-trash white-text small btn waves-effect trash-button trash-push-inbox"></i><img src="../ajaxLoader/727.gif" class="loader-trash"/></td>
                              </tr>
                             <?php endforeach; ?>
                          </tbody>               
                       </table>
                     <?php else: ?>
                     <div class="error-send-push center">
                        <i class="ion-alert-circled accc-color large"></i> <h6 class="game-main-color bold center">Vous n'avez pas encore envoyé de messages.</h6> 
                     </div>  
                    <?php endif; ?>
                  </div>

                    <div class="" id="push-receive-wrapper">
                    <?php if(!($_SESSION['ReceivePush']===0)) :?> 

                      <table class="MyTable striped bordered bold centered responsive-table" id="push-receive-table">
                          <thead class="accc-back-color white-text">
                              <tr>
                                  <th data-field="id">Numéro Push</th>
                                  <th data-field="id">Expéditeur</th>
                                  <th data-field="id">Date Envoi</th>
                                  <th data-field="id">Message</th>
                                  <th data-field="id">Etat</th>
                                  <th data-field="id" class="hidden">Hidden State</th>
                                  <th data-field="id">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($_SESSION['ReceivePush'] as $key => $value) : ?>
                              <tr>
                                <td><?php echo $value->idPush; ?></td>
                                <td><?php echo $value->expediteur; ?></td>
                                <td><?php echo $value->date_envoi; ?></td>
                                <td><?php echo $value->messagePush; ?></td>
                                <td><?php 

                                  switch($value->statePush)
                                  {
                                      case 0 : 
                                      echo "Non lu";
                                      break;

                                      case 1:
                                       echo "Lu";
                                      break;
                                  }

                                 ?></td>
                                 <td class="hidden"><?php echo $value->statePush; ?></td>
                                <td>
                                  <i class="ion-ios-trash white-text small btn waves-effect trash-button trash-push"></i>
                                  <?php 
                                  switch($value->statePush)
                                      {
                                          case 0 : 
                                          echo "<i class='ion-android-checkbox-blank white-text small btn waves-effect alter-attribution-button game-tiny-top-margin state-seen-push-trigger'></i> ";
                                          break;

                                          case 1:
                                          echo "<i class='ion-android-checkbox white-text small btn waves-effect alter-attribution-button game-tiny-top-margin state-unseen-push-trigger'></i> ";
                                          break;
                                      }
                                   ?>   
                                  <img src="../ajaxLoader/727.gif" class="loader-trash"/> 
                                  <img src="../ajaxLoader/715.gif" class="push-read-loader"/>
                                </td>
                              </tr>
                             <?php endforeach; ?>
                          </tbody>               
                       </table>
                     <?php else: ?>
                     <div class="error-receive-push center">
                        <i class="ion-alert-circled accc-color large"></i> <h6 class="game-main-color bold center">Vous n'avez pas encore reçu de messages.</h6> 
                     </div>  
                    <?php endif; ?>
                     </div>
                </div>

                <p class="adding-Push-wrapper center-align">
                  <i class="ion-plus-round accc-color small push-adding-trigger"></i>
                    <i class="ion-chatbubble-working accc-color medium push-adding-trigger"></i>
                     <span class="accc-color bold push-adding-trigger">Rédiger Un nouveau PushMessage</span> 
               </p>


                <div class="row center">
                  <div class="container">
                      <div class="container">
                         <form id="new-Push-Message-registering" class="dash-form hidden">
                                <i class="ion-chatbubble-working accc-color accc-huge-icon"></i>
                                <h5 class="accc-color bold game-bottom-small-padding">Informations Push</h5>
                            
                              <div class="col s12 input-field">
                                 <p class="orange-text">
                                  <h5 class="accc-color">Destinataires</h5>
                                  <?php foreach ($_SESSION['memberAdminInfo'] as $key => $value): ?>
                                        <?php if(!($value->id===$_SESSION['adminInfo']->id)) : ?>
                                         <input type="checkbox" name="destinataire[]" class="filled-in" id="<?php echo $value->date_creation; ?>" value="<?php echo $value->id;?>"/>
                                         <label for="<?php echo $value->date_creation; ?>" class="dest-push orange-text"><?php echo $value->prenom; ?></label>
                                       <?php endif; ?>
                                  <?php endforeach ?>
                                </p>                                      
                              </div>
                                
                              <div class="input-field col s12">
                                  <i class="prefix small ion-edit"></i>
                                  <textarea id="push-message" name="push-message-content" class="materialize-textarea required"></textarea>
                                  <label for="push-message">Push Messages</label>
                              </div>
                                
                                <button type="submit" class="btn submit-button left" id="submit-push">Valider</button>
                                <button class="btn submit-button right" type="reset">Annuler</button>

                                <div class="loaderAjax acc-medium-top-margin">
                                  <img src="../AjaxLoader/loading2.gif" />
                               </div>

                              <input type="hidden" value="9" name="admin-control">
                         </form>

                      </div>
                  </div>  


                      </div>

              <div class="container">
                      <div class="col s12 info-input-file">
                        <p class="left-align bold" id="push-explanation">
                          <i class="ion-chatbubble-working small accc-color bold"></i>
                            Les push messages sont des messages courts de 150 caractères permettant de donner de brèves indications aux administrateurs de la plateforme game-gift.
                            Il est complètement composé de texte et permet une interactivité entre les administrateurs.
                          </p>
                      </div>       
              </div>
<script src="../js/manage-admin.js"></script>