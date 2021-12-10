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
  if(isset($_SESSION['cart'])) {
    $total = 0;
    foreach($_SESSION['cart'] as $product_id => $quantity) {
      $result = $mysqli->query("SELECT * FROM products WHERE id = ".$product_id);
      if($result){
        if($obj = $result->fetch_object()) {
          $cost = $obj->price * $quantity;
          $user = $_SESSION["username"];
          $query = $mysqli->query("INSERT INTO orders (product_code, product_name, product_desc, price, units, total, email) VALUES('$obj->product_code', '$obj->product_name', '$obj->product_desc', $obj->price, $quantity, $cost, '$user')");
          if($query){
            $newqty = $obj->qty - $quantity;
            if($mysqli->query("UPDATE products SET qty = ".$newqty." WHERE id = ".$product_id)){
            }
          }
          //send mail script
          $query = $mysqli->query("SELECT * from orders order by date desc");
          if($query){
            while ($obj = $query->fetch_object()){
              $subject = "Your Order ID ".$obj->id;
              $message = "<html><body>";
              $message .= '<p><h4>Order ID ->'.$obj->id.'</h4></p>';
              $message .= '<p><strong>Date of Purchase</strong>: '.$obj->date.'</p>';
              $message .= '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
              $message .= '<p><strong>Product Name</strong>: '.$obj->product_name.'</p>';
              $message .= '<p><strong>Price Per Unit</strong>: '.$obj->price.'</p>';
              $message .= '<p><strong>Units Bought</strong>: '.$obj->units.'</p>';
              $message .= '<p><strong>Total Cost</strong>: '.$obj->total.'</p>';
              $message .= "</body></html>";
              $headers = "From: support@md.deve.br";
              $headers .= "MIME-Version: 1.0\r\n";
              $headers .= "Content-Type: text/html; charset=utf8\r\n";
              $sent = mail($user, $subject, $message, $headers) ;
              if($sent){
                $message = "";
              } else {
                echo 'Failure';
              }
            }
          }
        }
      }
    }
  }
  unset($_SESSION['cart']);
  header("location:success.php");
?>