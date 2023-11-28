<?php

   function imprimir_cabecera() {
      echo "<HTML><HEAD><TITLE>Forum</TITLE></HEAD>
         <BODY bgcolor='orange' >
         <TABLE bgcolor='black' border='0' align='center' cellspacing='3' cellpadding='3' width='100%'>
         <TR><TH colspan='5' width='100%' bgcolor='black'>&nbsp;<FONT size='6' color='orange' face='arial, helvetica'>
         DWES Exam</FONT>&nbsp</TH></TR>
         </TABLE>";
   } 

   function imprimir_footer() {
      echo"<center><div style='color: red';> <p>";
      if (isset($_SESSION["error"])) {
         echo $_SESSION["error"];
         unset($_SESSION["error"]); 
      }
      echo "</p></div></center><br>";
      echo "<p>Copyright " . date('Y') . " IES Kursaal</p>";
      echo "<p>This is a fictitious company created by <a href='http://ieskursaal.es'>IES Kursaal</a>, solely for the creation and development of educational training materials. Any resemblance to real products or services is purely coincidental. Information provided about the products or services is also fictitious and should not be construed as representative of actual products or services on the market in a similar product or service category.</p>";
      echo "</body></html>";
   }

   function boton_ficticio($caption,$url)
   {
      return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
         <TR><TD bgcolor='white'>
         <FONT size ='-1' face='arial, helvetica'><a href = '$url'>$caption</A></FONT>
         </TD></TR></TABLE>";
   } 
   
   function modifica($fecha) {
      $array_fecha = explode ("-",$fecha);
      return "$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";
   }

   class foro {

      private $fichero = "foro.txt";
      public $mensajes = 0;

      function __construct($path) {
         if (!chdir($path))
            echo "no encuentro el directorio";
         if (!file_exists($this->fichero)) {
            echo "vamos a crear un fichero nuevo";
            $id_fichero = fopen($this->fichero, "w");
            fclose($id_fichero);
         }
      }

      function leer_todos() {
         $id_fichero = fopen($this->fichero, "r");
         $registros = array();
         $this->mensajes = 0;
         while (!feof($id_fichero)) {
            $registro_str = fgets($id_fichero);
            if($registro_str != null) {
               $registro = explode("~", $registro_str);
               array_push($registros, $registro);
               $this->mensajes++;
            }
         }
         fclose($id_fichero);
         return $registros;
      }

      function alta($usuario, $fecha, $asunto, $contenido, $respuestas) {
         $id_fichero = fopen($this->fichero, "a");
         $this->leer_todos();
         $n = $this->mensajes;
         $registro = array($n, $usuario, $fecha, $asunto, $contenido, $respuestas);
         $registro_str = "\n" . implode("~", $registro);
         fputs($id_fichero, $registro_str);
         fclose($id_fichero);
      }

      function baja($id_to_del) {
         $id_fichero_tmp = fopen("basura.tmp", "w");
         $matriz = $this->leer_todos();
         $j = 0;
         for ($i=0; $i<count($matriz); $i++) {
             if ($matriz[$i][0] != $id_to_del) {
                 $matriz[$i][0] =$j;
                 $registro_str = implode("~", $matriz[$i]);
                 //if ($j>0) fputs($id_fichero_tmp, "\n");    
                 fputs($id_fichero_tmp, $registro_str);
                 $j++;
             }
         }
         fclose($id_fichero_tmp);
         unlink($this->fichero);
         rename("basura.tmp", $this->fichero);
      }
   }

   function test_alta() {
      $apoteke = new foro(getcwd());
      echo $apoteke->mensajes."\n";
      $fecha=date("Y-m-d");
      $fecha2 = modifica($fecha);
      $apoteke->alta("juan", $fecha2, "nada", "sin contenido", 0);
      print_r($apoteke->leer_todos());
   }

   function test_baja($id_to_del) {
      $apoteke = new foro(getcwd());
      $matriz = $apoteke->leer_todos();
      echo $apoteke->mensajes."\n";
      $apoteke->baja($id_to_del);
      $matriz = $apoteke->leer_todos();
      echo $apoteke->mensajes."\n";
  }

?>