<form action="" name="reg_form" method="post">
    <div id="main">
        <div id="login">
            <div id="login_input">
            	<center><h3><strong>��nete ya y forma parte del fant�stico mundo de {servername}!</strong></h3></center>
            </div>
        </div>
        <div id="mainmenu" style="margin-top: 20px;">
            <a href="index.php">Inicio</a>
            <a href="reg.php">Registrarse</a>
            <a href="{forum_url}">Foros</a>
            <a href="contact.php">Contacto</a>
            <a href="credit.php">Cr�ditos</a>
        </div>
        <div id="rightmenu" class="rightmenu">
            <div id="title">Registro en {servername}</div>
            <div id="content">
                <center>
                    <div id="text1">
                    	<table>
                        	<tr>
                            	<td>Usuario:</td>
                                <td><input name="character" size="20" maxlength="20" type="text"></td>
                            </tr>
                        	<tr>
                            	<td>Contrase�a:</td>
                                <td><input name="passwrd" size="20" maxlength="20" type="password"></td>
                            </tr>
                        	<tr>
                            	<td>Correo electr�nico:</td>
                                <td><input name="email" size="20" maxlength="40" type="text"></td>
                            </tr>
                        </table>
                    </div>
            		<div id="register" class="bigbutton" onclick="document.reg_form.submit();">�Registrate!</div>
            		<div id="text2">
                		<div id="text3">
							<center><b>Aceptar el reglamento <input name="rgt" type="checkbox"></b></center>
               			 </div>
            		</div>
                </center>
			</div>
		</div>
	</div>
</form>