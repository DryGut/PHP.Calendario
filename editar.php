<?php
//chama os dados para serem editados
require_once 'bancodedados.php';

try {
  $sql = $conexao->prepare("SELECT * FROM eventos");
  if($sql->execute()) {
    while($editar = $sql->fetch(PDO::FETCH_OBJ)) {
      echo "<tr>";
      echo "<td>".$editar->criador."</td><td>".$editar->descricao
        ."</td><td><center><a href=\"?op=upd&id=?".$editar->id."\">[Alterar]</a>"
        ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        ."<a href=\"?op=del&id=".$editar->id."\">[Excluir]</a></center></td>";
      echo "</tr>";
    }
  } else {
    echo "Erro dados não encontrados!";
  }
} catch (PDOException $e) {
  echo "Erro: ".$e->getMessage();
}
?>