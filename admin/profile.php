<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>
<?php
$userid = Session::get('userId');
$userrole = Session::get('userRole');

?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Cập nhật thông tin</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name     = mysqli_real_escape_string($db->link, $_POST['name']);
            $username = mysqli_real_escape_string($db->link, $_POST['username']);
            $email    = mysqli_real_escape_string($db->link, $_POST['email']);

            $query = "UPDATE tbl_user
            SET
            name     = '$name',
            username = '$username',
            email    = '$email'           
            WHERE id = '$userid'";
            $updated_row = $db->update($query);
            if ($updated_row) {
                echo '<span class="success">Cập nhật thông tin thành công.</span>';
            } else {
                echo '<span class="error">Thông tin chưa được cập nhật.</span>';
            }
        }
        ?>
        <div class="block">
            <?php

            $query = "SELECT * FROM tbl_user WHERE id = '$userid' AND role = '$userrole'";
            $getuser = $db->select($query);
            if ($getuser) {
                while ($result = $getuser->fetch_assoc()) {
            ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Tên</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Username</label>
                                </td>
                                <td>
                                    <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Cập nhật" />
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
<?php include 'include/footer.php' ?>