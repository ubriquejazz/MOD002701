<?php

	require_once "funciones.php";

/******** Sesión usuario anónimo *********/
if ($_GET["tipo"]==1)
{
	// Iniciamos la sesión sin información y mostramos sus datos
	session_start();
	
	$resultadoStr="<CENTER><H1>Sesión típica con usuario anónimo
					</H1><P><H3>Creamos una sesión anónima y mostramos 
					sus datos.</H3></CENTER>".dame_datos_sesion();
				
} // END Sesión usuario anónimo

else  

/***** Sesión usuario conocido ******/
if ($_GET["tipo"]==2)
{
	// Iniciamos la sesión con un nombre específico
	session_name("Mi_sesión");	
	session_start();
	
	$resultadoStr="<CENTER><H1>Sesión particularizada con usuario 
						anónimo </H1><P><H3>Creamos una sesión 
						particularizada y mostramos sus datos.
						</H3></CENTER>".dame_datos_sesion();

} // END Sesión usuario conocido

else  

/***** Sesión típica con usuario registrado ******/
if ($_GET["tipo"]==3)
{	
	// Iniciamos la sesión
	session_start();
	
	// Si está definido las variables del formulario, creamos las variables de sesión
	if (isset($_POST['nombre_edit'])) $_SESSION['nombre']=$_POST['nombre_edit'];
	else if (empty($_SESSION['nombre'])) $_SESSION['nombre']="";
	if (isset($_POST['usuario_edit'])) $_SESSION['usuario']=$_POST['usuario_edit'];
	else if (empty($_SESSION['usuario'])) $_SESSION['usuario']="";
	if (empty($_SESSION['hora'])) $_SESSION['hora']=time();
	if (empty($_SESSION['contador'])) $_SESSION['contador']=1;
	else $_SESSION['contador']++;
	if (empty($_SESSION['pagina'])) $_SESSION['pagina']=$_SERVER['PHP_SELF'];
	
	// Mostramos la información de la sesión
	$resultadoStr= "<CENTER><H1>Sesión típica con usuario registrado</H1>
					<P><H3>Introduce los datos para registrar la sesión</H3>";				 
	
	$resultadoStr.= "<TABLE border=1 WIDTH=300><TR><TD>
		<FORM METHOD=\"POST\" ACTION=\"".$_SERVER['PHP_SELF']."?".SID."&tipo=3\">
			<CENTER><BR>
				Nombre <INPUT NAME=\"nombre_edit\" VALUE=\"".$_SESSION['nombre']."\"><P>
				Login <INPUT NAME=\"usuario_edit\" VALUE=\"".$_SESSION['usuario']."\"><P>
				<INPUT TYPE=\"submit\" VALUE=\"Registrar sesión\"</CENTER>
		</FORM></TD></TR></TABLE></CENTER><P>
		
		Nombre de la sesión: <P><B>".$_SESSION['nombre']."</B><P>
		Nombre del usuario : <P><B>".$_SESSION['usuario']."</B><P>
		Hora última entrada: <P><B>".strftime("%H:%M:%S del %d/%m/%Y",$_SESSION['hora'])."</B><P>
		Nº entradas en web : <B>".$_SESSION['contador']."</B><P>
		Página web en la que ha entrado : <P><B>".$_SESSION['pagina'].
									"</B><P>";

    // Mostramos la información de la sesión codificada 
	$cadena=session_encode();
	$resultadoStr.= "La función <B>session_encode()</B> devuelve 
							la cadena: <P><B>$cadena</B><P>";
	
	$resultadoStr.=  "Ahora borramos el contenido de la variable 
		'usuario' y observamos como varía ";
	
	// Borramos una variable de la sesión				
	unset ($_SESSION['usuario']);
	if (! isset ($_SESSION['usuario']))
		$resultadoStr.= "<P>La variable 'usuario' ya no está registrada.";
	// Volvemos a mostrar la información de la sesión codificada y vemos que ya no aparece la variable "usuario". 
	$cadena=session_encode();
	$resultadoStr.= "la función <B>session_encode()</B>. Al final 
			de la cadena ya no aparece usuario: <P><B>$cadena</B><P>";
	
} // END Sesión típica con usuario registrado

// Página HTML del resultado
echo "<HTML>
		<HEAD><TITLE>Ejemplo 5 - Unidad 5 - Curso Iniciación de PHP 5</TITLE></HEAD>
		<BODY>$resultadoStr
		<BR><BR><input type=button onClick='window.location.href = \"sesion01.php\"' value='Volver a la página anterior'>
		</BODY>		
		</HTML>
	";

?>

