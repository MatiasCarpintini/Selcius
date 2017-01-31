
<style type="text/css">
		.btn {
		  border-radius: 5px;
		  padding: 15px 25px;
		  font-size: 22px;
		  text-decoration: none;
		  margin: 20px;
		  color: #fff;
		  position: relative;
		  display: inline-block;
		}
		.btn:active {
		  transform: translate(0px, 5px);
		  -webkit-transform: translate(0px, 5px);
		  box-shadow: 0px 1px 0px 0px;
		}

		.blue {
		  background-color: #55acee;
		  box-shadow: 0px 5px 0px 0px #3C93D5;
		}

		.blue:hover {
		  background-color: #6FC6FF;
		}
	</style>
	<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	<tr>
		<td style="background-color: #ecf0f1">
			<div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
				<h2 style="color: #e67e22; margin: 0 0 7px;font-family: 'Quicksand', sans-serif;" align="center">¿Olvidaste tu contraseña?</h2><br>
				<p style="margin: 2px; font-size: 25px;font-family: 'Quicksand', sans-serif;">
					Si ha perdido su contraseña o desea restablecerla, utilice el siguiente enlace. </p>
				<br>			
				<div style="width: 100%; text-align: center; margin-top: 20px;">
					<a style="
					text-decoration: none; border-radius: 5px; padding: 11px 23px; 
					.btn {
					  border-radius: 5px;
					  padding: 15px 25px;
					  font-size: 22px;
					  text-decoration: none;
					  margin: 20px;
					  color: #fff;
					  position: relative;
					  display: inline-block;
					}
					.btn:active {
					  transform: translate(0px, 5px);
					  -webkit-transform: translate(0px, 5px);
					  box-shadow: 0px 1px 0px 0px;
					}

					.blue {
					  background-color: #55acee;
					  box-shadow: 0px 5px 0px 0px #3C93D5;
					}

					.blue:hover {
					  background-color: #6FC6FF;
					}" href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}" class="btn blue" style="font-family: 'Quicksand', sans-serif;">Reset Password</a>	
				</div>
				<br><br>
					<p style="color: #33b5e5; margin: 0 0 7px;font-family: 'Quicksand', sans-serif;">* Si no solicitó un restablecimiento de contraseña, puede ignorar este correo electrónico de forma segura. Sólo una persona con acceso a su correo electrónico puede restablecer la contraseña de su cuenta.</p><br>
			</div>
		</td>
	</tr>
</table>	

