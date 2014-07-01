<?php
require("config.php");
if (isset($_POST['createForm'])) {
    $postDate = date("Y-m-d");
    $query = "INSERT INTO blogpost (title,imageURL,bodyHTML,postDate,category,author) VALUES (:title,:imageURL,:bodyHTML,:postDate,:category,:author)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':title', $_POST['Title']);
    $stmt->bindParam(":imageURL", $_POST['ImageURL']);
    $stmt->bindParam(":bodyHTML", $_POST['postHTMLCreate']);
    $stmt->bindParam(":postDate", $postDate);
    $stmt->bindParam(":category", $_POST['Category']);
    $stmt->bindParam(":author", $_POST['Author']);
    try {
        $stmt->execute();
        $result = 'Post Successfully Created!';
    } catch (PDOException $ex) {
        $result = 'Post Not Submitted: ' . $ex->getMessage();
    };
    echo $result;
};

if (isset($_POST['enteredTitle'])) {
    try {
        $stmt = $db->prepare("SELECT title FROM blogpost;");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            echo "<option value='" . htmlspecialchars($row['title'], ENT_QUOTES) . "'>";
        }
    } catch (PDOException $ex) {
        echo 'Error: ' . $ex->getMessage();
    };
}
if (isset($_POST['postName'])) {
    $title = json_decode($_POST['postName']);
    try {
        $stmt = $db->prepare("SELECT * FROM blogpost WHERE title LIKE :title;");
        $stmt->bindParam(':title',$title);
        $stmt->execute();
        $json = $stmt->fetchAll();
        echo json_encode($json);
    } catch (PDOException $ex) {
        echo 'Error: ' . $ex->getMessage();
    };
}
if (isset($_POST['editUpdateForm'])) {

    $query = "UPDATE blogpost SET
                title = :title,
                imageURL = :imageURL,
                bodyHTML = :bodyHTML,
                category = :category,
                author = :author
                WHERE postID = :postID;";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':postID',$_POST['editPostID']);
    $stmt->bindParam(':title', $_POST['Title']);
    $stmt->bindParam(":imageURL", $_POST['ImageURL']);
    $stmt->bindParam(":bodyHTML", $_POST['postHTMLUpdate']);
    $stmt->bindParam(":category", $_POST['Category']);
    $stmt->bindParam(":author", $_POST['Author']);
    try {
        $stmt->execute();
        $result = 'Post Submitted';
    } catch (PDOException $ex) {
        $result = 'Post Not Submitted: ' . $ex->getMessage();
    };
    echo $result;
}

if (isset($_POST['postToDelete'])) {
    $query = "Delete FROM blogpost
                WHERE postID = $_POST[postToDelete];";

    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute();
        $result = 'Post ' . $_POST['postToDelete'] . ' Deleted';
    } catch (PDOException $ex) {
        $result = 'Post ' . $_POST['postToDelete'] . ' Not Deleted: ' . $ex->getMessage();
    };

    echo $result;

}
?>