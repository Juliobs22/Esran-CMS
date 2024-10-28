<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inicio</title>
	
</head>
<body>
	<?php require_once('./inc/bootstrap.php') ?>
	<h1>head</h1>
	<?php
		try {
			$usuaerio = new UsuariosDto(0, 'usuarioPHP', '', 'ChangeME1234');
			$mainController = new MainController(
				array(
					'TYPE' => 'USER',
					'ACTION' => 'LOGIN',
					'CONT' => $usuaerio
				)
			);
			$result=$mainController->manageUser();
			echo 'hola<br>'.count ($result).'<br />';
			foreach ($result as $key => $value) {
				if ($key == 'result'){
					echo '(<br/>';
					foreach($value as $k => $v)
						echo $k.' => '.$v;
					echo '<br/>)';
					echo 'result'.count($value);
				} else {
					echo $key.' => '.$value.'<br>';
				}
			}
		} catch (TypeError $te) {
			echo '<h1>TypeError:</h1><br/> '.$te->getMessage();
            exit;
		} 
		catch (Exception $e) {
			echo '<h1>Error:</h1><br/> '.$e->getMessage();
            exit;
		}
	?>
</body>
</html>