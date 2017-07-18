<?php
session_start();


	$host_db = "localhost";
	$user_db = "root";
	$pass_db = "sr1920la";
	$db_name = "Rh";
	$tbl_name = "Usuarios";
		$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

	if ($conexion->connect_error) {
	 die("La conexion falló: " . $conexion->connect_error);
	}

	$username = $_POST['Usuario'];
	$password = $_POST['Password'];

  echo "$username";

  if ($username == '')
  {
   header('Location: ErrorIndex.php');
  }
  if ($_POST["Usuario"] == '' || $_POST["Password"] == '' )
   {
     header('Location: ErrorIndex.php?Mensaje=Usuario o contraseña estan vacios');
       session_destroy();

  exit;
  }



	$sql = "SELECT * FROM $tbl_name WHERE Usuario = '$username'";

  echo $sql;

	$result = $conexion->query($sql);


	if ($result->num_rows > 0) {
	 }
	 $row = $result->fetch_array(MYSQLI_ASSOC);



	 if ( $password == $row['Password'] ) {

	    $_SESSION['loggedin'] = true;
	    $_SESSION['username'] = $username;
	    $_SESSION['start'] = time();
	    $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
			// $_SESSION['nivel'] = $row['IdNivel'];

	    echo "Bienvenido! " . $_SESSION['username'];
	     header('Location: production/index.php');
	 } else {
	    header('Location: ErrorIndex.php?Mensaje=Usuario o contraseña incorrecta');

    // echo "error";


	 }
	 mysqli_close($conexion);
	 ?>
