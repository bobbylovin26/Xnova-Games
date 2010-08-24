<form action="" name="lstpass_form" method="post">
    <div id="main">
        <div id="mainmenu" style="margin-top: 20px;">
            <a href="index.php">Inicio</a>
            <a href="reg.php">Registrarse</a>
            <a href="{forum_url}">Foros</a>
            <a href="contact.php">Contacto</a>
            <a href="credit.php">Créditos</a>
        </div>
        <div id="rightmenu" class="rightmenu">
            <div id="title">Recuperar clave perdida</div>
            <div id="content">
                <center>
                    <div id="text1">
						<div align="justify">
                        	Para recuperar tu contraseña, ingresa el email utilizado en el registro. Recibirás una nueva clave en la mayor brevedad posible.
                        </div>
                    </div>
            		<div id="register" class="bigbutton" onclick="document.lstpass_form.submit();">Recuperar clave</div>
                    <div id="text2">
                        <div id="text3">
                            <center><b>Correo electrónico: <input type="text" name="email" /></b></center>
                        </div>
                    </div>
                </center>
			</div>
		</div>
	</div>
</form>