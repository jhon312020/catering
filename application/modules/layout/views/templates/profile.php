<?php
$this->load->view('header');

$this->load->view('navigation_menu');
?>    
<div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <h2 class="head_2">Perfil</h2>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-bottom">
                                <p>Nombre y apellidos</p>
                                <p>Empresa</p>
                                <p><span>ID Ciente:</span>2145</p>
                                <p><span>Codigo cliente:</span>2145</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-bottom ribbon-down">
                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label for="form-username">Email</label>
                                        <input type="email" name="form-email" placeholder="Nombre de Usuario" class="form-email form-control" id="form-email">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-password">Contrasena(cambiar contrasena)</label>
                                        <input type="password" name="form-password" placeholder="Contrasena" class="form-password form-control" id="form-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-number">DNI</label>
                                        <input type="number" name="form-number" placeholder="41256324N" class="form-number form-control" id="form-number">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-number">Telefono</label>
                                        <input type="number" name="form-tel-number" placeholder="000 00 00 00" class="form-number form-control" id="form-number">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-text">Intolerancias</label>
                                        <input type="text" name="form-text" placeholder="Lorem Ipsum dolor sit amet" class="form-text form-control" id="form-text">
                                    </div>
                                </form>
                                <div id="ribbon-container">
                                    <a href="#" id="ribbon" target="_blank">DATOS PERSONALES</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-bottom ribbon-down">
                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label for="form-username">IBAN</label>
                                        <input type="text" name="form-username" placeholder="ES25 4250 2502 0301 2504 2015" class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-username">?Quieres factura?</label>
                                        <br>
                                        <input class="checkbox-inline" type="checkbox" value=""> Si
                                        <input class="checkbox-inline" type="checkbox" value=""> No
                                    </div>
                                    <div class="form-group">
                                        <label for="form-message">Datos de facturacion:</label>
                                        <input type="message" name="form-message" placeholder="Nombre Empresa/Persona CIF/NIF Direccion de facturacion" class="form-message form-control" id="form-message">
                                    </div>
                                </form>
                                <div id="ribbon-container-green">
                                    <a class="ribbon_2" href="#" id="ribbon" target="_blank">DATOS DE PAGO</a>
                                </div>
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
