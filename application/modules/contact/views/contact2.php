<h1 class="page-header">Contato</h1>

<div class="row">
   <div class="col-md-12">

      <div class="contact">
         <div class="row">
            <div class="col-md-12">

              <div class="contact">
                  <div class="row">
                     <div class="col-md-6 col-sm-6">
                        <div class="cwell">
                           <!-- Contact form -->
                          <div class="form">

                            <!-- Contact form (not working)-->
                            <?php //echo form_open('contato/enviar', array('id'=>'form-contato', 'class'=>'form-horizontal')); ?>
                            <form action="#" class="form-horizontal">
                                <!-- Name -->
                                <div class="form-group">
                                  <label class="control-label col-md-3" for="nome">Nome</label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control" id="nome" name="nome" value="<?php //echo set_value('nome'); ?>">
                                  </div>
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                  <label class="control-label col-md-3" for="email">Email</label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" name="email" value="<?php //echo set_value('email'); ?>">
                                  </div>
                                </div>
                                <!-- Telefone -->
                                <div class="form-group">
                                  <label class="control-label col-md-3" for="telefone">Telefone</label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?php //echo set_value('telefone'); ?>">
                                  </div>
                                </div>
                                <!-- mensagem -->
                                <div class="form-group">
                                  <label class="control-label col-md-3" for="mensagem">Mensagem</label>
                                  <div class="col-md-9">
                                    <textarea class="form-control" id="mensagem" name="mensagem" rows="3"><?php //echo set_value('mensagem'); ?></textarea>
                                  </div>
                                </div>
                                <!-- Buttons -->
                                <div class="form-group">
                    							<div class="col-md-9 col-md-offset-3">
                    								<button type="submit" class="btn btn-default">Enviar</button>
                    								<button type="reset" class="btn btn-default">Limpar</button>
                    							</div>
                                </div>
                            </form>
                          </div>
                          <hr />

                           <div class="csoci">
                               <!-- Social media icons -->
                               <strong>Entre em contato:</strong>
                               <div>
                                <a href="mailto:contato@mar-advogados.com.br">contato@company.com.br</a>
                               </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6 col-sm-6">
                        <div class="cwell">
                          <!-- Google maps -->
                          <div class="gmap">
                             <!-- Google Maps. Replace the below iframe with your Google Maps embed code -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3727345.29191313!2d-83.57844964318824!3d24.172236503345843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d1b134ad952377%3A0x3fcee92f77463b5e!2sKey+West%2C+FL+33040%2C+EUA!5e0!3m2!1spt-BR!2sbr!4v1424399407237" width="345" height="203" marginheight="0" marginwidth="0" scrolling="no" frameborder="0" style="border:0"></iframe>
                          </div>

                           <hr />
                           <div class="address">
                               <address>
                                  <strong>Company Site.</strong><br>
                                  Av. Address, n° 1234<br>
                                  Planalto Paulista - 01234-567 - São Paulo - SP<br>
                                  <abbr title="Telefone">(11) 2211-6655</abbr>
                               </address>
                           </div>
                           </div>
                     </div>
                  </div>

               </div>

            </div>
         </div>
      </div>
   </div>
</div>