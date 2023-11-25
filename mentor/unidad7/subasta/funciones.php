<?php
  
    function boton_ficticio($caption,$url) {
        return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor='white'><FONT size ='-1'><a href = '$url'>$caption</A></FONT></TD></TR></TABLE>";
    }

    function formateaFecha($fecha) {
        ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $matriz_fecha);
        return $matriz_fecha[3]."/".$matriz_fecha[2]."/".$matriz_fecha[1];
    }

    function formateaEuros($euros) {
        return str_replace(".", ",", $euros);	
    }  

    function checkEuros(&$euros) {
        $basu="";
        for ($i=0; $i<strlen($euros); $i++)
            if ($euros[$i]!=".") $basu.=$euros[$i];
        $basu=strtr($basu,",",".");
        $resultado = ( $basu == number_format((float)$basu,2,".","") );
        $euros=(float)$basu;
        return $resultado;
    }
  
?>