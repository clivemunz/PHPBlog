<?php include('loginscript.php'); ?>
<?php
$pagepost;

if (isset($_GET['id'])) {
    $ThisPostID = $_GET['id'];
    $ThisPostDate = $_GET['date'];

    $stmt = $db->prepare("SELECT
                postID,
                title,
                imageURL,
                bodyHTML,
                postDate,
                category,
                author
            FROM blogpost
            WHERE postID = $ThisPostID");


    $stmt->execute();
    $posts = $stmt->fetchAll();
    $pagepost = $posts[0];

    $page =  $_GET['id'];
    ?>
    <?php include('header.php'); ?>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-site">
                    <div class="panel-heading">

                        <h3><?php echo str_replace("-"," ",$pagepost['title']); ?></h3>
                        <h5><?php echo 'By: ';
                            echo $pagepost['author'];
                            echo '&nbsp&nbsp&nbsp Date: ';
                            echo $pagepost['postDate']; ?></h5>
                    </div>
                    <div class="panel-body"><?php echo $pagepost['bodyHTML']; ?></a></div>

                    <div class="panel-footer text-right">
                        <div id="disqus_thread"></div>
                        <script src="/js/Disqus.js"></script>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-site">
                    <div class="panel-heading">
                        <h4>Links</h4>
                    </div>
                    <div class="panel-body">
                        Email: <a href="mailto:cliveamunz@gmail.com">cliveamunz@gmail.com</a><br/>
                        Flickr: <a href="https://www.flickr.com/photos/clivemunz/">www.flickr.com/photos/clivemunz/</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <?php } else {

    echo 'Article Not Found';
}?>
<?php include('footer.php'); ?>