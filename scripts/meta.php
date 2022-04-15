<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php

if (isset($_GET['pageid'])) {
    $pagetitleid = $_GET['pageid'];

    $query = "SELECT * FROM tbl_page WHERE id ='$pagetitleid'";
    $pages = $db->select($query);
    if ($pages) {
        while ($result = $pages->fetch_assoc()) {
?>
            <title><?php echo $result['name']; ?></title>
        <?php
        }
    }
} elseif (isset($_GET['id'])) {
    $postid = $_GET['id'];

    $query = "SELECT * FROM tbl_post WHERE id ='$postid'";
    $posts = $db->select($query);
    if ($posts) {
        while ($result = $posts->fetch_assoc()) {
        ?>
            <title><?php echo $result['title']; ?></title>
    <?php
        }
    }
} else {
    ?>
    <title><?php echo $fm->title(); ?></title>
<?php
}

?>