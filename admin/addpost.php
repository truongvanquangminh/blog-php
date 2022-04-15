<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Thêm bài viết mới</h2>
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

            if ($title == "" || $cat == "" || $body == "" || $author == "" || $file_name == "") {
                echo "<span class='error'>Trường không được để trống.</span>";
            } elseif ($file_size > 1048576) {
                echo '<span class="error">Kích thước hình ảnh nên nhỏ hơn 1MB.</span>';
            } elseif (in_array($file_ext, $permited) === false) {
                echo '<span class="error">Bạn chỉ có thể tải lên:-' . implode(',', $permited) . '</span>';
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query         = "INSERT INTO tbl_post (cat_id, title, body, image, author, user_id) VALUES ('$cat', '$title', '$body', '$uploaded_image', '$author', '$userid')";
                $inserted_rows = $db->insert($query);
                if ($inserted_rows) {
                    echo '<span class="success">New Post Added Successfully.</span>';
                } else {
                    echo '<span class="error">Data Not Added.</span>';
                }
            }
        }


        ?>

        <div class="block">
            <form action="addpost.php" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Tiêu đề</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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

                                        <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
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
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Nội dung</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body" colspan="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tác giả</label>
                        </td>
                        <td>
                            <input type="text" name="author" readonly value="<?php echo Session::get('username') ?>" class="medium" />
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