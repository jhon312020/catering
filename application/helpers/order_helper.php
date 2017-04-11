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

function getOrderDescription($order_detail, $plates, $cool_drink_list) {
    $description = array();
    $guarnicio = array();
    $primer = array();
    $segon = array();
    $cool_drink = array();
    $postre = array();
    $order_code = implode('',$order_detail['order_code']);
    $basic_order_codes = array('N','N1','N2','N1R1','N1R2','R1N1','R2N1','N2R2','R2N2');
    $guarnicio_postre_key = -1; // Diet
    if (in_array($order_code, $basic_order_codes)) {
      $guarnicio_postre_key = 0; // Basic
    }
    unset($order_detail['order_code']);
    unset($order_detail['total_price']);
    foreach ($order_detail as $menu_type=>$order_det) {
      if (!is_array($order_det))
        continue;
      foreach ($order_det as $key=>$sub_orders) {
        if (isset($sub_orders['order'])) {
          $order_array = $sub_orders['order'];
          if (!in_array($plates[$order_array['Guarnicio']], $guarnicio) && $menu_type == $guarnicio_postre_key)
              $guarnicio[] = $plates[$order_array['Guarnicio']];
          if (isset($order_array['Primer'])) {
            $primer[] = $plates[$order_array['Primer']];
          }
          if (isset($order_array['Segon'])) {
            $segon[] = $plates[$order_array['Segon']];
          }
          if (!in_array($plates[$order_array['Postre']], $postre) && $menu_type == $guarnicio_postre_key)
            $postre[] = $plates[$order_array['Postre']];

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
