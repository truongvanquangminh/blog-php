<?php include 'include/header.php' ?>

<?php
$id = "";
if (isset($_GET['id'])) {
    $postid = mysqli_real_escape_string($db->link, $_GET['id']);
    if (isset($postid) || $postid != null) {
        $id = $postid;
    }
}
?>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <?php
            $query = "SELECT * FROM tbl_post WHERE id=$id";
            $post = $db->select($query);
            while ($result = $post->fetch_assoc()) {
            ?>
                <h2><?php echo $result['title']; ?></h2>
                <h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
                <img src="admin/<?php echo $result['image']; ?>" alt="post image" />
                <?php echo $result['body']; ?>
            <?php
            }
            ?>
        </div>

    </div>
    <?php include 'include/sidebar.php'; ?>
    <?php include 'include/footer.php'; ?>