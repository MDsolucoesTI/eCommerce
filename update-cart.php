<?php
//////////////////////////////////////////////////////////////////////////
// Criacao...........: 07/2009
// Sistema...........: Loja Virtual
// Analistas.........: Marilene Esquiavoni & Denny Paulista Azevedo Filho
// Desenvolvedores...: Marilene Esquiavoni & Denny Paulista Azevedo Filho
// Copyright.........: Marilene Esquiavoni & Denny Paulista Azevedo Filho
//////////////////////////////////////////////////////////////////////////

  if(session_id() == '' || !isset($_SESSION)){session_start();}
  include 'config.php';
  $product_id = $_GET['id'];
  $action = $_GET['action'];
  if($action === 'empty')
    unset($_SESSION['cart']);
  $result = $mysqli->query("SELECT qty FROM products WHERE id = ".$product_id);
  if($result){
    if($obj = $result->fetch_object()) {
      switch($action) {
        case "add":
          if($_SESSION['cart'][$product_id]+1 <= $obj->qty)
            $_SESSION['cart'][$product_id]++;
          break;
        case "remove":
          $_SESSION['cart'][$product_id]--;
          if($_SESSION['cart'][$product_id] == 0)
            unset($_SESSION['cart'][$product_id]);
          break;
      }
    }
  }
  header("location:cart.php");
?>