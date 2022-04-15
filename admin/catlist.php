<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách thể loại</h2>
        <?php

        if (isset($_GET['delcat'])) {
            $delid = mysqli_real_escape_string($db->link, $_GET['delcat']);
            $delid = $delid;
            $delquery = "DELETE FROM tbl_category WHERE id = '$delid'";
            $deldata = $db->delete($delquery);
            if ($deldata) {
                echo "<span class='success'>Đã xóa thành công thể loại.</span>";
            } else {
                echo "<span class='error'>Thể loại không thể xóa.</span>";
            }
        }

        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT.</th>
                        <th>Tên thể loại</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbl_category ORDER BY id DESC";
                    $category = $db->select($query);
                    if ($category) {
                        $i = 0;
                        while ($result = $category->fetch_assoc()) {
                            $i++; ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td>
                                    <a href="editcat.php?catid=<?php echo $result['id'] ?>">Sửa</a>
                                    ||
                                    <a onclick="return confirm('Bạn có chắc xóa không?'); " href="?delcat=<?php echo $result['id'] ?>">Xóa</a>
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