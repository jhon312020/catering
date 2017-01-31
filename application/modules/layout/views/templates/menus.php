<?php
$this->load->view('header');
$template_path = base_url()."assets/cc/img/";
$ln = $this->uri->segment(1);
$this->load->view('navigation_menu');
?>
    
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <h3 class="head_2">Menu: Lunes 02 enero 2017</h3>
                    <div class="col-sm-12 menuhead">
                        <div class="col-sm-8">
                            <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-menu"><i class="fa fa-calendar" aria-hidden="true"></i>SELECCIONA OTRO DIA</button>
                        </div>
                    </div>
                    <div class="col-sm-12 section-down">
                        <div class="menu-bottom">
                            <div class="col-sm-2 smallpad">
                                <img src="<?php echo $template_path; ?>dish1.png"><span>+</span>
                                <br>
                                <span>Ensalada</span>
                            </div>
                            <div class="col-sm-2 dishpad">
                                <img src="<?php echo $template_path; ?>dish1.jpg"> +
                                <br>
                                <span>Espaguetis la bolonyesa</span>
                                <p style="text-align: left;font-size: 12px;">tomaquet, carn 100%vedella, pastanaga i orenga</p>
								<span class="custom-checkbox col-sm-offset-5">
								<input type="checkbox"/>
								<span class="box-brown"><span class="tick"></span></span>
								</span>
                            </div>
                            <div class="col-sm-2 dishpad">
                                <img src="<?php echo $template_path; ?>dish2.jpg"> +
                                <br>
                                <span>Croquetes de carn de rostit</span>
                                <p style="text-align: left;font-size: 12px;">tomaquet, carn 100%vedella, pastanaga i orenga</p>
								<span class="custom-checkbox col-sm-offset-5">
								<input type="checkbox"/>
								<span class="box-brown"><span class="tick"></span></span>
								</span>
                            </div>
                            <div class="col-sm-1 smallpad">
                                <img src="<?php echo $template_path; ?>dish2.png"> +
                                <br>
                                <span>Fruita de proximitat</span>
                            </div>
                            <div class="col-sm-1 smallpad">
                                <img src="<?php echo $template_path; ?>dish3.png"> +
                                <br>
                                <span>Pa</span>
                            </div>
                            <div class="col-sm-1 smallpad">
                                <img src="<?php echo $template_path; ?>dish4.png"> +
                                <br>
                                <span>Oli i Vinagre</span>
                            </div>
                            <div class="col-sm-1 smallpad">
                                <img src="<?php echo $template_path; ?>dish5.png">
                                <br>
                                <span>Coberts</span>
                            </div>
                            <div class="col-sm-2 smallpad">
                                <h4>MENU SENCER</h4>
								<span class="custom-checkbox col-sm-offset-5">
								<input type="checkbox"/>
								<span class="box-brown"><span class="tick"></span></span>
								</span>
                            </div>
                        </div>
                        <div id="ribbon-container" class="ribbon-fix">
                            <a href="#" id="ribbon" target="_blank">MENU BASICO</a>
                        </div>
                    </div>
                    <div class="col-sm-12 section-down">
                        <div class="menu-bottom">
                            <div class="col-sm-2 smallpad">
                                <img src="<?php echo $template_path; ?>dish1.png"><span>+</span>
                                <br>
                                <span>Ensalada</span>
							</div>
                            <div class="col-sm-2 dishpad">
                                <img src="<?php echo $template_path; ?>dish1.jpg"> +
                                <br>
                                <span>Espaguetis la bolonyesa</span>
								<p style="text-align: left;font-size: 12px;">tomaquet, carn 100%vedella, pastanaga i orenga</p>
								<span class="custom-checkbox col-sm-offset-5">
								<input type="checkbox"/>
								<span class="box"><span class="tick"></span></span>
								</span>
                            </div>
                            <div class="col-sm-2 dishpad">
                                <img src="<?php echo $template_path; ?>dish2.jpg"> +
                                <br>
                                <span>Croquetes de carn de rostit</span>
								<p style="text-align: left;font-size: 12px;">tomaquet, carn 100%vedella, pastanaga i orenga</p>
								<span class="custom-checkbox col-sm-offset-5">
								<input type="checkbox"/>
								<span class="box"><span class="tick"></span></span>
								</span>
                            </div>
                            <div class="col-sm-1 smallpad">
                                <img src="<?php echo $template_path; ?>dish2.png"> +
                                <br>
                                <span>Fruita de proximitat</span>
                            </div>
                            <div class="col-sm-1 smallpad">
                                <img src="<?php echo $template_path; ?>dish3.png"> +
                                <br>
                                <span>Pa</span>
                            </div>
                            <div class="col-sm-1 smallpad">
                                <img src="<?php echo $template_path; ?>dish4.png"> +
                                <br>
                                <span>Oli i Vinagre</span>
                            </div>
                            <div class="col-sm-1 smallpad">
                                <img src="<?php echo $template_path; ?>dish5.png">
                                <br>
                                <span>Coberts</span>
                            </div>
                            <div class="col-sm-2 smallpad">
                                <h4>MENU SENCER</h4>
								<span class="custom-checkbox col-sm-offset-5">
								<input type="checkbox"/>
								<span class="box"><span class="tick"></span></span>
								</span>
                            </div>
                        </div>
						<div id="ribbon-container-green" class="ribbon-fix">
                        <a class="ribbon_2" href="#" id="ribbon" target="_blank">MENU DIET</a>
						</div>
                    </div>               
                    <div class="col-sm-12 menubottom">
                        <div class="col-sm-8">
                            <h4>Tienes 01:35h para pedir este menu</h4>
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-8">
                                    <span class="menuitemfont">Total: 7.90E</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-menu">ANADIR</button>
                                </div>
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