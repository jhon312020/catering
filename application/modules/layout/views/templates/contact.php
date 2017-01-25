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
                                <p>Calle Cato, 6 bajos
                                    <br> 08206 Sabadell
                                    <br> Barcelona
                                    <br> Tel i fax. 93 717 83 35
                                    <br> info@gumen-catering.com
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-bottom ribbon-down">
                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label for="form-username">Nombre y Apellidos</label>
                                        <input type="text" name="form-username" class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-username">Email</label>
                                        <input type="email" name="form-email" class="form-email form-control" id="form-email">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-message">Mensaje</label>
                                        <input type="message" name="form-message" class="form-message form-control" id="form-message">
                                    </div>
                                    <button type="submit" class="btn center-block">ENVIAR</button>
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
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="copyright">
                            Gumen Catering | Calle cato, 6 bajos. 08206 Sabadell | Tel/Fax. 93 717 8335
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="design">
                            <a href="#" class="btn-link">Condiciones legales</a> <i class="fa fa-lg fa-twitter-square"></i> <i class="fa fa-lg fa-facebook-square"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$this->load->view('footer');
?>