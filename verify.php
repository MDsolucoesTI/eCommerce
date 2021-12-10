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
  $username = $_POST["username"];
  $password = $_POST["pwd"];
  $flag = 'true';
  $result = $mysqli->query('SELECT id,email,password,fname,type from users order by id asc');
  if($result === FALSE){
    die(mysql_error());
  }
  if($result){
    while($obj = $result->fetch_object()){
      if($obj->email === $username && $obj->password === $password) {
        $_SESSION['username'] = $username;
        $_SESSION['type'] = $obj->type;
        $_SESSION['id'] = $obj->id;
        $_SESSION['fname'] = $obj->fname;
        header("location:index.php");
      } else {
        if($flag === 'true'){
          redirect();
          $flag = 'false';
        }
      }
    }
  }
  function redirect() {
    echo '<h1>Invalid Login! Redirecting...</h1>';
    header("Refresh: 3; url=index.php");
  }
?>
