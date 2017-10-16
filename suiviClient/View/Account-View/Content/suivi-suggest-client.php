              <div class="row center game-row-padding">
                <div class="container">
                    <i class="ion-ios-paper-outline accc-huge-icon accc-color"></i>
                    <h4 class="bold accc-color">Suggestions Clientes</h4>
                    <h5>Emmetez et consultez vos suggestions en rappart avec le traitement de votre courrier.</h5>
                </div>
              </div> 

              <div class="row center" id="road-game">
                  <div class="container">
                      <table class="MyTable striped bordered bold centered responsive-table" >
                          <thead class="accc-back-color white-text">
                              <tr>
                                  <th data-field="id">Numero Suggestion</th>
                                  <th data-field="id">Numero suivi courrier</th>
                                  <th data-field="id">Suggestion</th>
                                  <th data-field="id">Date Envoi</th>
                                  <th data-field="id">Service Indexé</th>
                                  <th data-field="id">Action</th>
                              </tr>
                          </thead>
                          <tbody>

                          </tbody>               
                            <tfoot>

                            </tfoot>
                      </table>
                  </div>
                  <span id="add-new-suggest"><i class="ion-plus-round small accc-color"></i><i class="ion-ios-paper-outline medium accc-color"></i></span>   

              </div>
              <div class="row center">
                <div class="container">
                <div class="container">
                          <form id="suivi-client-suggest" class="game-row-padding dash-form acc-big-top-margin hidden">
                          <i class="ion-information-circled accc-color accc-huge-icon"></i>
                          <h5 class="accc-color bold game-bottom-small-padding">Suggestion Cliente</h5>

                          <label>Numero de suivi Courrier</label>
                          <select class="browser-default" id="select-num-suivi-suggest" name="suggest-idCourrier">
                            <option value=""selected>Choisissez votre numéro</option>
                              <?php foreach ($_SESSION['courrier'] as $key => $value): ?>
                                  <option value="<?php echo $value->idCourrier; ?>"><?php echo $value->numSuivi; ?></option>
                              <?php endforeach ?>
                          </select>

                          <div class="col s12 input-field">
                            <i class="ion-edit small prefix game-main-color"></i>
                            <textarea  name="client-suivi-suggest" class="materialize-textarea required" id="client-suggest"></textarea>
                            <label class="" for="client-suggest">Suggestion</label>
                          </div>

                          <div class="col s12 input-field">
                            <i class="ion-android-lock small prefix game-main-color"></i>
                            <input type="password" class="required" name="client-suivi-conf-password" id="client-password" maxlength="25">
                            <label for="client-password">Mot de passe de confirmation</label>
                          </div>

                          <button type="submit" class="btn submit-button left" id="submit-suggest-client">Changer</button>
                          <button class="btn submit-button right">Annuler</button>

                              <input type="hidden" value="3" name="client-control">
                           <div class="loaderAjax acc-medium-top-margin">
                          <img src="AjaxLoader/loading2.gif" />
                         </div>
                         </form>
                 </div>
              </div>
              </div>


<script src="js/manage-client.js"></script>