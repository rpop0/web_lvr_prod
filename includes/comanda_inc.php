<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor/autoload.php';

	if(isset($_POST['submitComanda']))
	{
		$EidComanda;

		$nume = $_POST['detaliiNume'];
		$prenume = $_POST['detaliiPrenume'];
		$email = $_POST['detaliiEmail'];
		$telefon = $_POST['detaliiTelefon'];
		$adresa = $_POST['detaliiAdresa'];
		$sup = $_POST['detaliiSup'];
		$data = time();

		if(empty($nume) || empty($prenume) || empty($email) || empty($telefon) || empty($adresa))
		{
			header("Location: cos_pg");
			exit();
		}
		else
		{
			$sql = "INSERT INTO comenzi (nume, prenume, adresa, email, telefon, sup, data) VALUES (?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$sql))
			{
				header("Location: cos_pg");
				exit();
			}
			else
			{
				mysqli_stmt_bind_param($stmt, "sssssss", $nume,$prenume,$adresa,$email,$telefon,$sup,$data);
				mysqli_stmt_execute($stmt);

				$sql = "SELECT * FROM comenzi WHERE data = ".$data.";";
				$result = mysqli_query($conn,$sql);
				$resultCheck = mysqli_num_rows($result);
				
				if($resultCheck > 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						foreach($_SESSION['shopping_cart'] as $key => $product)
						{
							$sql = "INSERT INTO comenzi_aux (id_comanda, id_produs, cantitate) VALUES (?, ?, ?);";
							$stmt = mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql))
							{
								header("Location: cos_pg");
								exit();
							}
							else
							{
								mysqli_stmt_bind_param($stmt, "sss", $row['id_comanda'],$product['id'],$product['cant']);
								mysqli_stmt_execute($stmt);
								$EidComanda = $row['id_comanda'];
								
								
							}
						}
					}
				}
				unset($_SESSION['shopping_cart']);
				header("Location: index");
				
				$mail = new PHPMailer(true);
				try{
					$mail->isSMTP();
					$mail->Host = 'smtp.gmail.com';
					$mail->SMTPAuth = true;
					$mail->Username = 'livrariladomiciliufr@gmail.com';
					$mail->Password ='flaviu123';
					$mail->SMTPSecure = 'tsl';
					$mail->Port = 587;

					$mail->setFrom('no-reply@livrariladomicilui.fr', 'no-reply');
					$mail->addAddress('poprosian@gmail.com');
					$mail->isHTML(true);
					$mail->Subject = "[admin] Comanda #".$EidComanda." plasata";
					$mail->Body = "Comanda cu numarul  #".$EidComanda." a fost plasata de catre ".$nume." ".$prenume.". Click <a href='http://86.126.210.151/admin/admin_comenzi_pg'>AICI.</a>";
					$mail->send();
				} catch (Exception $e){
					echo 'Email could not be sent.';
					echo 'Mailer Error: '.$mail->ErrorInfo;
				}

			}
		}
	}

?>