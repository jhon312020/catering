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
          $menu_type = lang('basic_menu');
          break;
        case 'R':
          $menu_type = lang('diet_menu');
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
    foreach ($order_detail as $order_det) {
      if (!is_array($order_det))
        continue;
      foreach ($order_det as $key=>$sub_orders) {
        if (!is_integer($key))
          continue;
        $order_array = $sub_orders['order'];
        if (!in_array($order_array['Guarnicio'], $description))
            $description[] = $plates[$order_array['Guarnicio']];
        if (isset($order_array['Primer'])) {
          $description[] = $plates[$order_array['Primer']];
        }
        if (isset($order_array['Segon'])) {
          $description[] = $plates[$order_array['Segon']];
        }
        if (!in_array($order_array['Postre'], $description))
          $description[] = $plates[$order_array['Postre']];

        if (isset($sub_orders['cool_drink'])) {
          foreach ($sub_orders['cool_drink'] as $drinks) {
            $description[] = $cool_drink_list[$drinks];
          }  
        }
      }
    }
    return $description;
}

function getDrinksInformation($order_id, $drinks_list) {
  $drink_name_list = array();
  $CI =& get_instance();
  $drinks = $CI->db->select('count(*) as quantity, drinks_id')->from('order_drinks')->where('order_id', $order_id)->group_by('drinks_id')->get()->result();
  //echo '<pre>'; print_r($drinks); echo'</pre>';
  //return;
  if ($drinks) {
    foreach ($drinks as $drink) {
      $drink_name_list[] = $drinks_list[$drink->drinks_id].' - '.$drink->quantity;
    }
    $drink_name_list = implode(', ', $drink_name_list);
  }
  return $drink_name_list;
  
}


?>
