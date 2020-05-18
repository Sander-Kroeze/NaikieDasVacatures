<?php

?>

<!--formulier voor het inloggen-->
<form id="loginform" name="inloggen" method="POST" action="" enctype="multipart/form-data">
    <p>Inloggen</p>
    <input type="text" class="input" placeholder="E-mail" name="email"/>
    <input type="password" class="input" placeholder="Password" name="password"/>
    <input type="hidden" name="submit" value="true">
    <input type="submit" class="loginbutton" value="login"  style="color: white" id="submit"/>
</form>

<!--formulier voor het registreren.-->
<form id="registerform" name="register" method="POST" action="" enctype="multipart/form-data">
    <p>Registreren</p>
    <input type="text" class="input" placeholder="E-mail" name="registeremail"/>
    <input type="password" class="input" placeholder="Password" name="registerpassword"/>
    <input type="hidden" name="registersubmit" value="true">
    <input type="submit" class="loginbutton" value="Registreren"  style="color: white" id="submit"/>
</form>