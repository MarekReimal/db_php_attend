<?php
    $title = 'User list'; 
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php'; # kas sisse logitud
    require_once 'db/conn.php';  # kaasa obj
    $results = $user->getUsers();
?>

<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="header text-center">
            <h1>User list</h1>
            <a href="form_adduser.php" class="btn btn-primary">Add new user</a>
        </div>

        <table class=table style="margin-left: auto">
            <tr>
                <th>#</th>
                <th>User name</th>
                <th>Actions</th>
            </tr>
            <?php while($r = $results->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                        <td><?php echo $r['idusers'] ?></td>
                        <td><?php echo $r['username'] ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $r['idusers'] ?>" class="btn btn-warning">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete this record?');" href="delete_user.php?id=<?php echo $r['idusers'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                </tr> 
            <?php }?>
        </table>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>