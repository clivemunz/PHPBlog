loadSearchDropdown = function () {
    $.ajax({
        type: "POST",
        url: "ajaxrequests.php",
        data: {'enteredTitle': ''},

        success: function (titles) {
            document.getElementById("searchDatalist").innerHTML = titles;
        },
        error: function (xhr, error, response) {
            document.getElementById("postSearch").placeholder = "Post Title";
            alert('Search Options Error: ' + response + ': ' + xhr + ': ' + error);
        }
    });
};

clearEditForm = function () {
    document.getElementById("updateForm").reset();
    document.getElementById("postHTMLUpdate").innerHTML = null;
    document.getElementById("editPostID").innerHTML = null;
    document.getElementById("updateSearchForm").reset();
    loadSearchDropdown();
};

clearCreateForm = function () {
    document.getElementById("createPostForm").reset();
    loadSearchDropdown();
};

$(document).ready(function () {

    loadSearchDropdown();

    $("#blogSubmit").click(function () {

        var formData = $("#createPostForm").serialize();

        $.ajax({
            type: "POST",
            url: "ajaxrequests.php",
            data: formData,
            success: function (response) {
                if (response.indexOf('Not') > -1) {
                    $("#messageModal #messageModalHeader").html("Failure");
                    $("#messageModal #messageModalBodyText").html(response);
                }
                else {
                    $("#messageModal #messageModalHeader").html("Success");
                    $("#messageModal #messageModalBodyText").html(response);
                }
                $('#messageModal').modal('show');
                clearCreateForm();
            },
            error: function (response) {
                alert('Post Create Error: ' + response);
            }
        });
    });

    $("#postSearch").on('input', function () {

        if (document.getElementById("postSearch").value !== "") {

            $.ajax({
                type: "POST",
                url: "ajaxrequests.php",
                data: {'postName': JSON.stringify(document.getElementById("postSearch").value)},
                success: function (postData) {
                    var jsonresponse = JSON.parse(postData);
                    document.getElementById('editPostID').value = jsonresponse[0].postID;
                    document.getElementById('Title').value = jsonresponse[0].title;
                    document.getElementById('ImageURL').value = jsonresponse[0].imageURL;
                    document.getElementById('postHTMLUpdate').innerHTML = jsonresponse[0].bodyHTML;
                    document.getElementById('Author').value = jsonresponse[0].author;
                    document.getElementById('Category').value = jsonresponse[0].category;
                },
                error: function (xhr, error, postData) {
                    alert('Post Load Error: ' + postData + ': ' + xhr + ': ' + error);
                }

            });
        }
        else {
            clearEditForm();
        }
    });

    $("#updateForm").submit(function () {
        if (document.getElementById('editPostID').value !== "") {

            var formData = $("#updateForm").serialize();

            $.ajax({
                type: "POST",
                url: "ajaxrequests.php",
                data: formData,
                success: function (response) {
                    if (response.indexOf('Not') > -1) {
                        $("#messageModal #messageModalHeader").html("Failure");
                        $("#messageModal #messageModalBodyText").html(response);
                    }
                    else {
                        $("#messageModal #messageModalHeader").html("Success");
                        $("#messageModal #messageModalBodyText").html(response);
                    }
                    $('#messageModal').modal('show');
                    clearCreateForm();

                },
                error: function (response) {
                    alert('Post Update Error: ' + response);
                }
            });
        }
        else {
            alert('No Post Selected For Update');
        }
        return false;
    });

    $("#deletePost").click(function () {
        if (document.getElementById('editPostID').value !== "") {

            $.ajax({
                type: "POST",
                url: "ajaxrequests.php",
                data: { 'postToDelete': document.getElementById('editPostID').value},
                success: function (response) {
                    $("#messageModal #messageModalHeader").html("Success");
                    $("#messageModal #messageModalBodyText").html("Post Successfully Deleted!");
                    $('#messageModal').modal('show');
                    clearEditForm();
                }
            });
        }
        else {
            alert("No Post Selected For Delete");
        }
        return false;
    });
});
