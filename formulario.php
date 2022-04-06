<?php
//cria o layout e informações do calendario
  function linha($semana)
  {
    echo "<tr>";
    for($i = 0; $i <= 6; $i++) {
      if(isset($semana[$i])) {
        echo "<td><a href=editar.php>";
        if($semana[$i] != 0) {
          echo "{$semana[$i]}";
        }
        echo "</td>";
      }else{
        echo "<td></td>";
      }
    }
    echo "</tr>";
  }
  function calendario()
  {
    
    $dia = 1;
    $semana = array();
    while ($dia <= 31) 
    {
      array_push($semana, $dia);
      
      if(count($semana) == 7) 
      {
        linha($semana);
        $semana = array();
      }
      $dia++;
    }
    linha($semana);
  }
?>