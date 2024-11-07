<?php
    $title = 'Add user'; 
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php'; # kas sisse logitud
    require_once 'db/conn.php';  # kaasa obj

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // POST päringuga saadud andmete töötlemine
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $pass2 = $_POST['password2'];
        if ($pass === $pass2) { # võrdle paroole
            $isSuccess = $user->insertUser($name, $pass); # lisa kasutaja
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
?>
<div class="header text-center">
    <h1>Add user</h1>
</div>

    <form method="post" action="">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Username">User name</label>
                <input required type="text" class="form-control" id="username" name="username">
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
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>


<?php require_once 'includes/footer.php'; ?>