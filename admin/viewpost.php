<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>

<?php
$viewpostid = mysqli_real_escape_string($db->link, $_GET['viewpostid']);
if (!isset($viewpostid) || $viewpostid == null) {
    echo "<script>window.location = 'postlist.php'; </script>";
    // header("Location:catlist.php");
} else {
    $postid = $viewpostid;
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Cập nhật bài viết</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location = 'postlist.php'; </script>";
        }

        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_post WHERE id = '$postid' ORDER BY id DESC";
            $getpost = $db->select($query);
            if ($getpost) {
                while ($postresult = $getpost->fetch_assoc()) {
            ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Tiêu đề</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $postresult['title']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Thể loại</label>
                                </td>
                                <td>
                                    <select id="select">
                                        <option>Chọn thể loại</option>

                                        <?php
                                        $query = "SELECT * FROM tbl_category";
                                        $category = $db->select($query);
                                        if ($category) {
                                            while ($result = $category->fetch_assoc()) {
                                        ?>

                                                <option <?php if ($postresult['cat_id'] == $result['id']) {
                                                        ?> selected="selected" <?php
                                                                            } ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                        <?php
                                            }
                                        } ?>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Hình ảnh</label>
                                </td>
                                <td>
                                    <img src="<?php echo $postresult['image']; ?>" height="100px" width="250px"><br />

                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Nội dung</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" readonly colspan="10"><?php echo $postresult['body']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tác giả</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $postresult['author']; ?>" class="medium" />

                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="OK" />
                                </td>
                            </tr>
                        </table>
                    </form>

            <?php
                }
            } ?>
        </div>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'include/footer.php' ?>