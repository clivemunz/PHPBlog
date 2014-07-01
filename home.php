<?php include('loginscript.php'); ?>
<?php $page = 'home'; ?>
<?php include('header.php'); ?>
<?php

$stmt = $db->prepare("SELECT
                postID,
                title,
                imageURL,
                bodyHTML,
                postDate,
                category,
                author
            FROM blogpost
            ORDER BY postID DESC
            LIMIT 10;");
$stmt->execute();
$posts = $stmt->fetchAll()
?>
    <section id="home" data-speed="6" data-type="background" class=text-center>
        <h2>Clive Munz</h2>
        <p class="lead">A blog about things I generally find interesting.</p>
        <img src="Resources/clivelars.png"/>
    </section>
<?php $z = 0; foreach ($posts as $thispost) { ?>

    <div class="container">
        <hr>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-site" >

                    <div class="panel-heading" >

                        <h3>
                            <a href="post.php?date=<?php echo $thispost['postDate']; ?>&id=<?php echo $thispost['postID']; ?>"><?php echo $thispost['title']; ?></a>
                        </h3>
                        <h5><?php echo 'By: ';
                            echo $thispost['author'];
                            echo '&nbsp&nbsp&nbsp Date: ';
                            echo $thispost['postDate']; ?></h5>
                    </div>
                    <div class="panel-body"><?php echo $thispost['bodyHTML']; ?></div>

                    <div class="panel-footer text-right " ><a
                            href="post.php?date=<?php echo $thispost['postDate']; ?>&id=<?php echo $thispost['postID']; ?>#disqus_thread"
                            class="btn btn-primary">Link</a></div>
                </div>
            </div>
            <?php if ($z == 0) { ?>
                <div class="col-md-4">
                    <div class="panel panel-site">
                        <div class="panel-heading"  >
                            <h4>Links</h4>
                        </div>
                        <div class="panel-body" >
                            Email: <a href="mailto:cliveamunz@gmail.com">cliveamunz@gmail.com</a><br/>
                            Flickr: <a href="https://www.flickr.com/photos/clivemunz/">www.flickr.com/photos/clivemunz/</a>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <!-- Put add here? -->
            <?php } ?>
        </div>

    </div>

    <?php $z++; } ?>

    <br/><br/><br/>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'clivemunz'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = '//' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    </script>
<?php include('footer.php'); ?>