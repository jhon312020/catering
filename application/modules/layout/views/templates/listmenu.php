<?php
$this->load->view('header');
$this->load->view('navigation_menu');
$template_path = base_url()."assets/cc/img/";
$ln = $this->uri->segment(1);
?>
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <h2 class="head_2">Pedido ref. 2157</h2>
                    <div class="col-sm-12 fix-left-right">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>DIA</th>
                                    <th>PRECIO</th>
                                    <th>FORMA DE PAGO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Menu Basico</b>
                                        <br> Ensalada, Espaguetis bolonyesa, croquetas caseras, fruta de
                                        <br> proximidad, pan, aceite, vinagre y cubietros</td>
                                    <td>02/01/2017</td>
                                    <td>36.90E</td>
                                    <td>Ticket restaurante</td>
                                </tr>
                                <tr>
                                    <td><b>Menu Basico</b>
                                        <br> Ensalada, Espaguetis bolonyesa, croquetas caseras, fruta de
                                        <br> proximidad, pan, aceite, vinagre y cubietros</td>
                                    <td>05/02/2017</td>
                                    <td>36.90E</td>
                                    <td>Giro bancario</td>
                                </tr>
                                <tr>
                                    <td><b>Menu Basico</b>
                                        <br> Ensalada, Espaguetis bolonyesa, croquetas caseras, fruta de
                                        <br> proximidad, pan, aceite, vinagre y cubietros</td>
                                    <td>10/03/2017</td>
                                    <td>36.90E</td>
                                    <td>Targeta de credito</td>
                                </tr>
                                <tr>
                                    <td><b>Menu Basico</b>
                                        <br> Ensalada, Espaguetis bolonyesa, croquetas caseras, fruta de
                                        <br> proximidad, pan, aceite, vinagre y cubietros</td>
                                    <td>21/04/2017</td>
                                    <td>36.90E</td>
                                    <td>Targeta de credito</td>
                                </tr>
                                <tr>
                                    <td><b>Menu Basico</b>
                                        <br> Ensalada, Espaguetis bolonyesa, croquetas caseras, fruta de
                                        <br> proximidad, pan, aceite, vinagre y cubietros</td>
                                    <td>30/05/2017</td>
                                    <td>90.25E</td>
                                    <td>Giro bancario</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="total">
                            <h2>Total: 36.90E</h2>
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