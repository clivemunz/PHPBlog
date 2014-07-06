<?php if (isset($_SESSION['Login.Error'])) {
    echo "<script type='text/javascript'>$('#Login').modal('show');}</script>";
} ?>

<div class="navbar navbar-inverse navbar-fixed-bottom footer">
    <div class="container">

        <p class="navbar-text pull-left">&copy; Clive Munz</p>

        <button class="navbar-toggle" data-toggle="collapse" data-target=".navFooterCollapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <?php if (empty($_SESSION['user'])): ?>
            <div class="collapse navbar-collapse navFooterCollapse navbar-inverse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#Login" data-toggle="modal">Admin</a></li>
                </ul>
            </div>
        <?php else: ?>
            <div class="collapse navbar-collapse navFooterCollapse navbar-inverse">
                <ul class="nav navbar-nav navbar-right">
                    <?php $row = $_SESSION['user'];
                    if ($row['admin'] == true) {
                        ?>
                        <li><a href="/Admin">Admin</a></li>
                    <?php
                    }
                    ?>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        <?php endif; ?>

    </div>
</div>

<div id="Login" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="form-inline" id="loginform" action="loginscript.php" method="post">
                <div class="modal-header text-center">
                    <h3><?php if (isset($_SESSION['Login.Error'])) {
                            echo $_SESSION['Login.Error'];
                            unset($_SESSION['Login.Error']);
                        } else {
                            echo 'Login';
                        } ?></h3>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label control-label">Username:</label>
                        <div>
                            <input class="form-control" id="userBox" type="text" name="username"
                                   value="<?php echo $submitted_username; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label control-label">Password:</label>
                        <div>
                            <input class="form-control" type="password" name="password" value=""/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger" data-dismiss="modal">Cancel</a>
                    <input type="submit" class="btn btn-info" value="Login"/>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>