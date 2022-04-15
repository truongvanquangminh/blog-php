<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>

<?php
$editpostid = mysqli_real_escape_string($db->link, $_GET['editpostid']);
if (!isset($editpostid) || $editpostid == null) {
    echo "<script>window.location = 'postlist.php'; </script>";
    // header("Location:catlist.php");
} else {
    $postid = $editpostid;
}

?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Cập nhật bài viết</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $cat    = mysqli_real_escape_string($db->link, $_POST['cat']);
            $body   = mysqli_real_escape_string($db->link, $_POST['body']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

            $permited       = array('jpg', 'jpeg', 'png', 'gif');
            $file_name      = $_FILES['image']['name'];
            $file_size      = $_FILES['image']['size'];
            $file_temp      = $_FILES['image']['tmp_name'];
            $div            = explode('.', $file_name);
            $file_ext       = strtolower(end($div));
            $uinque_image   = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $uinque_image;

            if ($title == "" || $cat == "" || $body == "" || $author == "") {
                echo "<span class='error'>Trường không được để trống.</span>";
            } else {
                if (!empty($file_name)) {
                    if ($file_size > 1048576) {
                        echo '<span class="error">Kích thước hình ảnh nên nhỏ hơn 1MB.</span>';
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo '<span class="error">Bạn chỉ có thể tải lên:-' . implode(',', $permited) . '</span>';
                    } else {
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE tbl_post
            SET
            cat_id     = '$cat',
            title  = '$title',
            body    = '$body'
            image   = '$uploaded_image',
            author  = '$author',
            user_id  = '$userid'
            WHERE id = '$postid'";
                        $updated_row = $db->update($query);
                        if ($updated_row) {
                            echo '<span class="success">DDữ liệu cập nhật thành công.</span>';
                        } else {
                            echo '<span class="error">Dữ liệu không được cập nhật.</span>';
                        }
                    }
                } else {
                    $query = "UPDATE tbl_post
            SET
            cat_id     = '$cat',
            title  = '$title',
            body    = '$body',            
            author  = '$author',
            user_id  = '$userid'
            WHERE id = '$postid'";
                    $updated_row = $db->update($query);
                    if ($updated_row) {
                        echo '<span class="success">Dữ liệu cập nhật thành công.</span>';
                    } else {
                        echo '<span class="error">Dữ liệu không được cập nhật.</span>';
                    }
                }
            }
        }
        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_post WHERE id = '$postid'";
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
                                    <input type="text" name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Thể loại</label>
                                </td>
                                <td>
                                    <select id="select" name="cat">
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
                                    <label>Tải hình ảnh</label>
                                </td>
                                <td>
                                    <img src="<?php echo $postresult['image']; ?>" height="80px" width="200px"><br />
                                    <input type="file" name="image" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Nội dung</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body" colspan="10"><?php echo $postresult['body']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tác giả</label>
                                </td>
                                <td>
                                    <input type="text" name="author" value="<?php echo $postresult['author']; ?>" class="medium" />
                                    <input type="hidden" name="userid" readonly value="<?php echo Session::get('userId') ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Lưu" />
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