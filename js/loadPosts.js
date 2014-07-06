$(document).ready(function () {
    var offset = 0;
    var totalPosts;
    var numPosts;
    var postsPerPage = 5;
    var page = document.getElementById('page').value;
    document.onload = loadPosts(offset);
    document.onload = getNumPosts();

    $("#olderPostsBut").click(function () {
        offset = offset + postsPerPage;
        loadPosts(offset);
        $('#newerPostsBut').show();
        return false;
    });

    $("#newerPostsBut").click(function () {
        offset = offset - postsPerPage;
        loadPosts(offset);
        if (offset == 0) {
            $('#newerPostsBut').hide();
            $('#olderPostsBut').show();
        }
        if(numPosts == postsPerPage)
        {
            $('#olderPostsBut').show();
        }
        return false;
    });

    function nano(template, data) {
        return template.replace(/\{([\w\.]*)\}/g, function (str, key) {
            var keys = key.split("."), v = data[keys.shift()];
            for (i = 0, l = keys.length; i < l; _i++) v = v[this];
            return (typeof v !== "undefined" && v !== null) ? v : "";
        });
    };

    function loadPosts(offsetNum) {
        if(page == 'home'){page = '%';}
        $.ajax({
            type: "POST",
            url: "ajaxrequests.php",
            data: {'postsToLoad': offsetNum, 'cat': page},
            success: function (posts) {
                //alert(posts);
                setDivHTML(posts);
            },
            error: function (xhr, error, postData) {
                alert('Post Load Error: ' + postData + ': ' + xhr + ': ' + error);
            }
        });
    };

    function getNumPosts() {
        if(page == 'home'){page = '%';}
        $.ajax({
            type: "POST",
            url: "ajaxrequests.php",
            data: {'numPosts': '' , 'cat': page},
            success: function (num) {
                totalPosts = num;
            },
            error: function (xhr, error, postData) {
                alert('Post Load Error: ' + postData + ': ' + xhr + ': ' + error);
            }
        });
    };

    function setDivHTML(posts) {

        var postArray;
        postArray = JSON.parse(posts);

        $('#SetByJS div').html('');

        $.get("/Includes/postTemplateLinks.html", function (postTemplateLinks) {
            $.get("/Includes/postTemplateNone.html", function (postTemplateNone) {

                for (var i = 0; i < postArray.length; i++) {
                    if (i == 0) {
                        $("#SetByJS").append(nano(postTemplateLinks, postArray[i]))
                    }
                    else {
                        $("#SetByJS").append(nano(postTemplateNone, postArray[i]))
                    }
                }
            });
        });
        numPosts = postArray.length;

        if(numPosts == postsPerPage && offset + numPosts !== totalPosts)
        {
            $('#olderPostsBut').show();
        }
        else{$('#olderPostsBut').hide();}
        if(offset + numPosts == totalPosts)
        {$('#olderPostsBut').hide();}
    };
});