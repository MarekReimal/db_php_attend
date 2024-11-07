<?php
    $title = 'User Login'; 

    require_once 'includes/header.php'; 
    require_once 'db/conn.php'; # kontrollib ühenduse
    
    //If data was submitted via a form POST request, then...
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = strtolower(trim($_POST['username']));
        $password = $_POST['password'];
        $new_password = md5($password.$username);

        $result = $user->getUser($username,$new_password);
        if(!$result){
            echo '<div class="alert alert-danger">Username or Password is incorrect! Please try again. </div>';
        }else{
            $_SESSION['username'] = $username; # määra sessi muutujasse kasutaja
            $_SESSION['userid'] = $result['idusers']; # määra kasutaja id sessi muutujasse
            header("Location: viewrecords.php"); # suuna lehele
        }
# Iga kord, kui kasutaja teeb uue päringu, saadetakse brauserilt serverile sessiooni ID küpsis (nt PHPSESSID).
# Server kontrollib, millised andmed on seotud selle ID-ga (sealhulgas kasutajanimi $_SESSION['username']), ja käitub vastavalt.
    }
?>

<h1 class="text-center"><?php echo $title ?> </h1>
   
<?php # rida küsid vaja, suunab tagasi miskit 
# kui input type='password' siis phpmyadmin hashib parooli ja salvestab db-s, kasutaja sisse logimisel vaja kaitsta paroole ja hoida
# neid DB-s hashitud kujul, logimise andmed vaja saata üle https
?>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <table class="table table-sm">
            <tr>
                <td><label for="username">Username: * </label></td>
                <td><input type="text" name="username" class="form-control" id="username" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['username']; ?>">
                </td>
            </tr>
            <tr>
                <td><label for="password">Password: * </label></td>
                <td><input type="password" name="password" class="form-control" id="password">
                </td>
            </tr>
        </table><br/><br/>
        <input type="submit" value="Login" class="btn btn-primary btn-block"><br/>
        <a href="#"> Forgot Password </a>
            
    </form><br/><br/><br/><br/>

<?php include_once 'includes/footer.php'?>