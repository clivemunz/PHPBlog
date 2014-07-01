<?php
require("config.php");

if (empty($_SESSION['user'])) {
    header("Location: home.php");
    die("Redirecting to home.php");
} else {
    $row = $_SESSION['user'];
    if ($row['admin'] == false) {
        header("Location: home.php");
        die("Redirecting to home.php");
    }
}

$page = 'admin';
?>
<?php include('header.php'); ?>
    <script src="js/adminajaxscripts.js"></script>
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <script type="text/javascript">
                    $('#adminTabs').click(function (e) {
                        e.preventDefault();
                        $(this).('show');
                    });
                </script>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="adminTabs">
                    <li class="active"><a href="#createPost" data-toggle="tab">Create Post</a></li>
                    <li><a href="#editPost" data-toggle="tab">Edit Post</a></li>
                    <li><a href="#editPermissions" data-toggle="tab">Edit Permissions</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane .fade active" id="createPost" style="border-color: #666666 ">
                        <div class="panel-heading"><h3>Create A New Post</h3></div>
                        <div class="panel-body">
                            <form class="form-horizontal" style="padding-left: 10px; padding-right: 10px" method="post"
                                  id="createPostForm">
                                <input type="hidden" name="createForm" id="createForm">

                                <div class="form-group">
                                    <label for="Title">Title</label>
                                    <input name="Title" type="text" class="form-control" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label for="Category">Category</label>
                                    <input name="Category" type="text" class="form-control" placeholder="Category">
                                </div>
                                <div class="form-group">
                                    <label for="Author">Author</label>
                                    <input name="Author" type="text" class="form-control"
                                           placeholder="Author First and Last">
                                </div>
                                <div class="form-group">
                                    <label for="ImageURL">Image URL</label>
                                    <input name="ImageURL" type="text" class="form-control" placeholder="Image URL">
                                </div>
                                <div class="form-group">
                                    <label for="postHTMLCreate">Post Body HTML</label>
                                    <textarea name="postHTMLCreate" style="width: 100%; max-width: 100%; min-height: 150px;" id="postHTMLCreate"
                                              class="form-control" placeholder="Body HTML" ></textarea>
                                </div>
                                <button class="btn btn-primary" name="blogSubmit" id="blogSubmit" type="button">Create
                                    Post
                                </button>
                            </form>
                        </div>
                    </div>


                    <!-- EDIT POST -->
                    <div class="tab-pane .fade" id="editPost">
                        <div class="panel-heading"><h3>Edit Post</h3></div>
                        <div class="panel-body">

                            <form class="form-horizontal" id="updateSearchForm"
                                  style="padding-left: 10px; padding-right: 10px">
                                <div class="form-group">
                                    <div class="form-inline">
                                        <label for="postSearch">Search For Post</label>
                                        <input name="postSearch" type="text" class="form-control" style="width: 100%;" list="searchDatalist"
                                               id="postSearch" placeholder="Post Title">
                                        <datalist id="searchDatalist" name="searchDatalist"></datalist>
                                    </div>

                                </div>
                            </form>


                            <form class="form-horizontal" style="padding-left: 10px; padding-right: 10px"
                                  id="updateForm">
                                <input type="hidden" name="editUpdateForm" id="editUpdateForm">
                                <input type="hidden" name="editPostID" id="editPostID">

                                <div class="form-group">
                                    <label for="Title">Title</label>
                                    <input name="Title" id="Title" type="text" class="form-control" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label for="Category">Category</label>
                                    <input name="Category" id="Category" type="text" class="form-control"
                                           placeholder="Category">
                                </div>
                                <div class="form-group">
                                    <label for="Author">Author</label>
                                    <input name="Author" id="Author" type="text" class="form-control"
                                           placeholder="Author First and Last">
                                </div>
                                <div class="form-group">
                                    <label for="ImageURL">Image URL</label>
                                    <input name="ImageURL" id="ImageURL" type="text" class="form-control"
                                           placeholder="Image URL">
                                </div>
                                <div class="form-group">
                                    <label for="postHTMLUpdate" >Post Body HTML</label>
                                    <textarea id="postHTMLUpdate" name="postHTMLUpdate"
                                              style="width: 100%; max-width: 100%; min-height: 150px;"
                                              class="form-control" placeholder="Body HTML"></textarea>
                                </div>
                                <input class="btn btn-primary" name="blogUpdate" id="blogUpdate" type="submit"
                                       value="Save Changes"/>
                                <button class="btn btn-danger" name="deletePost" id="deletePost">Delete Post</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane .fade" id="editPermissions">

                        <div class="panel-heading"><h3>Change User Permissions</h3></div>
                        <div class="panel-body">
                            <form class="form-horizontal" style="padding-left: 10px;">
                                <div class="form-group form-inline">
                                    <label for="Search" style="margin-right: 10px;">Search For Username</label>
                                    <input id="Search" type="text" class="form-control" placeholder="Username">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                                <table id="SearchResults" class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th style="width: 10%;">ID</th>
                                        <th style="width: 10%;">Username</th>
                                        <th style="width: 10%;">Email</th>
                                        <th style="width: 10%;">Admin</th>
                                    </tr>
                                    </thead>
                                </table>
                                <div class="form-group form-inline">
                                    <label style="margin-right: 10px;">Submit Changes To Table</label>
                                    <input type="submit" id="userChange" class="btn btn-danger"/>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div id="messageModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="messageModalHeader"/>
                </div>
                <div class="modal-body">
                    <p id="messageModalBodyText"/>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="confirmModalHeader"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"></button>
                    <button type="button" class="btn btn-danger"></button>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?>