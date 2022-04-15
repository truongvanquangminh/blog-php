<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách người dùng</h2>
        <?php
        if (isset($_GET['deluser'])) {
            $deluser = mysqli_real_escape_string($db->link, $_GET['deluser']);
            if (isset($deluser)) {
                $deluser = $deluser;
                $delquery = "DELETE FROM tbl_user WHERE id = '$deluser'";
                $deldata = $db->delete($delquery);
                if ($deldata) {
                    echo "<span class='success'>Xóa người dùng thành công.</span>";
                } else {
                    echo "<span class='error'>Người dùng chưa được xóa.</span>";
                }
            }
        }

        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT.</th>
                        <th>Tên</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbl_user ORDER BY id DESC";
                    $alluser = $db->select($query);
                    if ($alluser) {
                        $i = 0;
                        while ($result = $alluser->fetch_assoc()) {
                            $i++; ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['username']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td>
                                    <?php
                                    if ($result['role'] == '0') {
                                        echo 'Admin';
                                    } elseif ($result['role'] == '1') {
                                        echo 'Author';
                                    } elseif ($result['role'] == '2') {
                                        echo 'Editor';
                                    } ?>
                                </td>
                                <td>
                                    <?php if (Session::get('userRole') == '0') {
                                    ?>
                                        <a onclick="return confirm('Bạn có chắc xóa không?');" href="?deluser=<?php echo $result['id'] ?>">Xóa</a>
                                    <?php
                                    } ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'include/footer.php' ?>