<?php include('loginscript.php');?>
<?php $page = 'sports'; ?>
<?php include('header.php');?>
    <section id="sports" data-speed="6" data-type="background" class="text-center">
        <h2>Sports</h2>
        <p class="lead">From climbing to MLB, it's a free for all.</p>
    </section>
    <script src="/js/loadPosts.js"></script>
    <div id="SetByJS"></div>
    <div class="container">
        <div class="row">
            <div class="span12" style="text-align:center; margin: 0 auto;">
                <form class="form-group form-horizontal center-block">
                    <div id="olderPostsBut" class="btn btn-primary">Older Posts</div>
                    <div id="newerPostsBut" class="btn btn-primary" style="display: none">Newer Posts</div>
                </form>
            </div>
        </div>
    </div>
    <script src="/js/DisqusCount.js"></script>
<?php include('footer.php');?>