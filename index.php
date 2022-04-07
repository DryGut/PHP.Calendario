<?php
session_start();
require_once 'formulario.php';
require 'bancodedados.php';
?>
<html lang="pt-br">
  <link rel="stylesheet" href="estilo.css">
  <head>
      <meta charset="utf-8">
      <title>Calendario Maroto</title>
  </head>
    <center><h2>
   <?php
      $mes = new Datetime();
      echo $mes->format("F Y");
   ?>
    <body>
      <form action="?op=inserir" method="POST" name=form1>
        <h3>Calendario Maroto</h3>
        <hr>
        <input type="hidden" name="id" <?php if(isset($id) && $id != null || $id != "") {
     echo "value=\"{$id}\"";
        }
     ?> />
      <fieldset>
         <center><p>
      Criador: <input type="text" name="criador" <?php if(isset($criador) && $criador != null || $criador != "") {
     echo "value=\"{$criador}\"";
      }
     ?> />
      Insira um Evento: <input type="text" name="descricao" <?php if(isset($descricao) && $descricao != null || $descricao != "") {
     echo "value=\"{$descricao}\"";
      }
     ?> />
         </p></center>
    <input style="float:right" type="submit" value="Cadastrar">
      </fieldset>
      </form>
    </body>
    <center><table>
    <tr>
      <th style="color: red">Dom</th>
      <th>Seg</th>
      <th>Ter</th>
      <th>Qua</th>
      <th>Qui</th>
      <th>Sex</th>
      <th>Sab</th>
    </tr>
    <?php calendario(); ?>
  </table></center>
</html>