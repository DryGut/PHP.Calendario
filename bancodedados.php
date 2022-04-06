<?php

declare(strict_types=1);

//verifica se foi enviado dados via POST
if($_SERVER['REQUEST_METHOD']== 'POST'){
  $id = (isset($_POST['id']) && $_POST['id'] != null) ? $_POST['id'] : "";
  $criador = (isset($_POST['criador']) && $_POST['criador'] != null) ? $_POST['criador'] : "";
  $descricao = (isset($_POST['descricao']) && $_POST['descrciao'] != null) ? $_POST['descricao'] : "";
} else if(!isset($id)) {
  $id = (isset($_GET['id']) && $_GET['id'] != null) ? $_GET['id'] : "";
  $criador = NULL;
  $descricao = NULL;
}

//criando a conexao com o banco de dados
try {
  $conexao = new PDO("mysql:host=localhost;dbname=", "login", "senha");
  $conexao->setAttribute(PDO::ATTRERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf-8");
} catch(PDOException $e){
  echo "Erro ao se conectar: ".$e->getMessage();
}

//bloca que cuidado de inserir e atualizar os dados
if(isset($_REQUEST['op']) && $_REQUEST['op'] == "inserir" && $criador != "") {
  try {
    if($id != "") {
      $sql = $conexao->prepare("UPDATE eventos SET criador=?, descricao=? WHERE id=?");
      $sql->bindParam(4, $id);
    } else {
      $sql = $conexao->prepare("INSERT INTO eventos (criador, descricao) VALUES (?, ?)");
    }
    $sql->bindParam(1, $criador);
    $sql->bindParam(2, $descricao);

    if($sql->execute()) {
      if($sql->rowCount() > 0) {
        echo "Cadastro Realizado com Sucesso!";
        $id = null;
        $criador = null;
        $descricao = null;
      } else {
        echo "Erro ao tentar Cadastrar!";
      }
    } else {
      throw new PDOException("Erro ao executar!");
    }
  } catch (PDOException $e) {
    echo "Erro: ".$e->getMessage();
  }
}

//bloco para edição e recupeção dos cadastros
if (isset($REQUEST['op']) && $REQUEST['op'] == "upd" && $id != "") {
  try {
    $sql = $conexao->prepare("SELECT * FROM eventos WHERE id = ?");
    $sql->bindParam(1, $id, PDO::PARAM_INT);
    if($sql->execute()) {
      $editar = $sql->fetch(PDO::FETCH_OBJ);
      $id = $editar->id;
      $criador = $editar->criador;
      $descricao = $editar->descricao;
    } else {
      throw new PDOException("Erro ao executar!");
    }
  } catch (PDOException $e) {
    echo "Erro: ".$e->getMessage();
  }
}

//bloco que irá fazer a remoção de dados
if (isset($REQUEST['op']) && $REQUEST['op'] == "del" && $id != "") {
  try {
    $sql = $conexao->prepare("DELETE FROM eventos WHERE id = ?");
    $sql->bindParam(1, $id, PDO::PARAM_INT);
    if($sql->execute()) {
      echo "Remoção realizada com Sucesso!";
      $id = null;
    } else {
      throw new PDOException("Erro ao executar!");
    }
  } catch (PDOException $e) {
    echo "Erro: ".$e->getMessage();
  }
}
?>