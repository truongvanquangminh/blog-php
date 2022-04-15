<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>

<?php if (!Session::get('userRole') == '0') {
    echo "<script>window.location = 'index.php'; </script>";
} ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Thêm người dùng mới</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $fm->validation($_POST['name']);
                $username = $fm->validation($_POST['username']);
                $password = $fm->validation(md5($_POST['password']));
                $email = $fm->validation($_POST['email']);
                $role = $fm->validation($_POST['role']);


                $username = mysqli_real_escape_string($db->link, $username);
                $name = mysqli_real_escape_string($db->link, $name);
                $password = mysqli_real_escape_string($db->link, $password);
                $email = mysqli_real_escape_string($db->link, $email);
                $role = mysqli_real_escape_string($db->link, $role);


                if (empty($username) || empty($username) || empty($password) || empty($role) || empty($email)) {
                    echo "<span class='error'>Trường không được để trống.</span>";
                } else {
                    $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
                    $mailcheck = $db->select($mailquery);
                    if ($mailcheck != false) {
                        echo "<span class='error'>Email đã tồn tại</span>";
                    } else {
                        $query = "INSERT INTO tbl_user (name, username, password, email, role) VALUES ('$name','$username', '$password', '$email', '$role')";
                        $userinsert = $db->insert($query);
                        if ($userinsert) {
                            echo "<span class='success'>Tạo tài khoản thành công.</span>";
                        } else {
                            echo "<span class='error'>Tài khoản chưa tạo được</span>";
                        }
                    }
                }
            }
            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" placeholder="Enter name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Username..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Valid Email..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Vai trò người dùng</label>
                        </td>
                        <td>
                            <select id="select" name="role">
                                <option>Chọn vai trò người dùng</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Tạo" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include 'include/footer.php' ?>