<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


function findOrderMenuType($order_code) {
  $menu_type = '';
  switch (count($order_code)) {
  case 0:
    break;
  case 1:
    switch ($order_code[0]) {
      case 'N':
        $menu_type = lang('c_basic_menu');
        break;
      case 'R':
        $menu_type = lang('c_diet_menu');
        break;
      default:
        $menu_type = lang('medio_menu');
    }
    break;
  default:
    $order_code = array_unique($order_code);
    if (!in_array('N1', $order_code) && !in_array('N2', $order_code)) {
      $menu_type = lang('diet_menu');
    } elseif (!in_array('R1', $order_code) && !in_array('R2', $order_code)) {
      $menu_type = lang('basic_menu');
    } else {
      $menu_type = lang('combine_menu');
    }
  }
  return $menu_type;
}

function getOrderDescription($order_detail, $plates, $cool_drink_list, $order_date) {
  $guarnicio_id = '';
  $description = array();
  $guarnicio = array();
  $primer = array();
  $segon = array();
  $cool_drink = array();
  $postre = array();
  $order_code = implode('', $order_detail['order_code']);
  $basic_order_codes = array('N','N1','N2','N1R2','R1N1','R2N1','N2R2','R2N2');
  $regim_order_codes = array('R1', 'R2');
  //For order codes R1 and R2 need to get normal entrant so getting the
  //Basic guarnicio
  if (in_array($order_code, $regim_order_codes)) {
    $CI = get_instance();
    $CI->load->model('menus/mdl_menus');
    $guarnicio_id = $CI->mdl_menus->get_basic_guarnicio_id($order_date);
  }
  $guarnicio_postre_key = -1; // Diet
  if (in_array($order_code, $basic_order_codes)) {
    $guarnicio_postre_key = 0; // Basic
  }
  unset($order_detail['order_code']);
  unset($order_detail['total_price']);
  foreach ($order_detail as $menu_type=>$order_det) {
      
    if (!is_array($order_det))
      continue;
    //echo $guarnicio_postre_key;
    $count = 0;
    foreach ($order_det as $key=>$sub_orders) {

      if (isset($sub_orders['order'])) {
        $order_array = $sub_orders['order'];
        //If order code is either R1 or R2 Entrante is Basic and Desert is Diet
        if ($guarnicio_id) {
          $guarnicio[] = $plates["$guarnicio_id"];
        } else if (!in_array($plates[$order_array['Guarnicio']], $guarnicio) && $menu_type == $guarnicio_postre_key) {
            $guarnicio[] = $plates[$order_array['Guarnicio']]; 
        }
        if (isset($order_array['Primer'])) {
          $primer[] = $plates[$order_array['Primer']];
        }
        if (isset($order_array['Segon'])) {
          $segon[] = $plates[$order_array['Segon']];
        }
        if (!in_array($plates[$order_array['Postre']], $postre) && $menu_type == $guarnicio_postre_key && !(in_array($order_code, array('N2R1', 'R1N2', 'N1R1')))) {
          $postre[] = $plates[$order_array['Postre']];
        }
        // For the below codes Entrante is Diet and Desert is Basic
        if (in_array($order_code, array('N2R1', 'R1N2', 'N1R1')) && count($postre) == 0) {
          $postre[] = $plates[$order_array['Postre']];
        }

        if (isset($sub_orders['cool_drink'])) {
          foreach ($sub_orders['cool_drink'] as $drinks) {
            $cool_drink[] = $cool_drink_list[$drinks];
          }  
        }  
      }
    }
  }
  
  $description = $guarnicio;
  foreach($primer as $value) {
    $description[] = $value;
  }
  foreach($segon as $value) {
    $description[] = $value;
  }
  foreach($postre as $value) {
    $description[] = $value;
  }
  foreach($cool_drink as $value) {
    $description[] = $value;
  }
  return $description;
}

function getDrinksInformation($order, $drinks_list) {
  $fields = array('drink1_id','drink2_id');
  $drink_name_list = [];
  foreach ($fields as $field) {
    if ($order->{$field} != 0) {
      if (array_key_exists($drinks_list[$order->{$field}], $drink_name_list)) {
        $drink_name_list[$drinks_list[$order->{$field}]] = $drinks_list[$order->{$field}]. ' - 2';
      } else {
        $drink_name_list[$drinks_list[$order->{$field}]] = $drinks_list[$order->{$field}]. ' - 1';
      }
    }
  }
  $drink_name_list = implode(', ', $drink_name_list);
  return $drink_name_list;
}


?>
