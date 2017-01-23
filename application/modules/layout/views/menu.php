<?php 
$menus = ($this->mdl_menu->get()->result_array());
foreach($menus as $menu){
?>
<li><a href="<?php echo site_url('page')."/" ;?><?php echo $menu['url']?>" style="margin-right:0px"><?php echo $menu['title']?></a></li>
<?php
}
?>
<!--li class="mbl_menu active" style="display:none;"><a href="index.html" style="margin-right:0px">HOME</a></li>
<li><a href="historia.html" style="margin-right:0px">HISTORIA</a></li>
<li><a href="marcas.html" style="margin-right:0px">MARCAS</a></li>
<li><a href="tiendas.html" style="margin-right:0px">TIENDAS</a></li>
<li><a href="actualidad.html" style="margin-right:0px">ACTUALIDAD</a></li-->
