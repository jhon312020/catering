<?php
  $this->load->view('header');
  $this->load->view('navigation_menu');
?>
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <h2 class="head_2">Contacto</h2>
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <div class="form-bottom">
                                <p> <?php echo $contact->address; ?>
                                    <br> Tel i fax. <?php echo $contact->telephone;?>
                                    <br> <?php echo $contact->email;?>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-bottom ribbon-down">
                              <?php echo $this->layout->load_view('layout/web_alerts'); ?>
                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label for="form-username">Nombre y Apellidos</label>
                                        <input type="text" name="name" class="form-username form-control" id="fusername">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-username">Email</label>
                                        <input type="email" name="email" class="form-email form-control" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-message">Mensaje</label>
                                        <textarea name="message" id="message" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn log_in center-block">ENVIAR</button>
                                </form>
                                <div id="ribbon-container-green">
                                    <a href="#" id="ribbon" target="_blank">FORMULARIO DE CONACTO</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
  $this->load->view('footer_nav_bar');
  $this->load->view('footer');
?>
