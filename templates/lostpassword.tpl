<form action="" name="lstpass_form" method="post">
    <div id="main">
        <div id="mainmenu" style="margin-top: 20px;">
            <a href="index.php">Inicio</a>
            <a href="reg.php">Registrarse</a>
            <a href="{forum_url}">Foros</a>
            <a href="contact.php">Contacto</a>
            <a href="credit.php">Cr�ditos</a>
        </div>
        <div id="rightmenu" class="rightmenu">
            <div id="title">Recuperar clave perdida</div>
            <div id="content">
                <center>
                    <div id="text1">
						<div align="justify">
                        	Para recuperar tu contrase�a, ingresa el email utilizado en el registro. Recibir�s una nueva clave en la mayor brevedad posible.
                        </div>
                    </div>
            		<div id="register" class="bigbutton" onclick="document.lstpass_form.submit();">Recuperar clave</div>
                    <div id="text2">
                        <div id="text3">
                            <center><b>Correo electr�nico: <input type="text" name="email" /></b></center>
                        </div>
                    </div>
                </center>
			</div>
		</div>
	</div>
</form>