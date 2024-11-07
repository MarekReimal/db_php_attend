    
<?php
    $title = 'Edit User'; 

    require_once 'includes/header.php'; 
    require_once 'includes/auth_check.php';
    require_once 'db/conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // POST päringuga saadud andmete töötlemine
        $id = $_POST['id'];
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $pass2 = $_POST['password2'];
        if ($pass === $pass2) { # võrdle paroole
            $isSuccess = $user->editUser($id, $name, $pass); # lisa kasutaja
            if ($isSuccess){
                header("Location: list_users.php"); # suuna
            } else { # lisamine ebaõnnestus ?>
                <div class="alert alert-success" role="alert">
                Operation has failed.
                </div>
        <?php }
        } else {
        include 'includes/errormessage_pass.php'; # paroolid ei ole võrdsed
        }
    }

    if(!isset($_GET['id']))
    {
        //echo 'error';
        include 'includes/errormessage.php';
        header("Location: list_users.php");
    }
    else{
        $id = $_GET['id'];
        $userDetails = $user->getUserDetails($id);
    
?>

    <h1 class="text-center">Edit User: <?php echo $userDetails['username'] ?> </h1>

    <form method="post" action="">
    <div class="row d-flex justify-content-center">
    <div class="col-md-6">
        <input type="hidden" name="id" value="<?php echo $userDetails['idusers'] ?>" />
        <div class="form-group">
            <label for="firstname">User Name</label>
            <input type="text" class="form-control" value="<?php echo $userDetails['username'] ?>" id="username" name="username">
        </div>
        <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="password2">Confirm password</label>
                <input required type="password" class="form-control" id="password2" name="password2">
            </div>
        
        <a href="list_users.php" class="btn btn-default">Back To List</a>
        <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
        </div>
        </div>
    </form>

<?php } ?>
<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>