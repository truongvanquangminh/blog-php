<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Hộp thư đến</h2>
        <?php
        if (isset($_GET['seenid'])) {
            $seenid = mysqli_real_escape_string($db->link, $_GET['seenid']);
            if (isset($seenid)) {
                $seenid = $seenid;
                $query = "UPDATE tbl_contact SET status = '1' WHERE id = '$seenid'";
                $update_row = $db->update($query);
                if ($update_row) {
                    echo "<span class='success'>Message move to seen box</span>";
                } else {
                    echo "<span class='error'>Something Wrong</span>";
                }
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT.</th>
                        <th>Người gửi</th>
                        <th>Email</th>
                        <th>Tin nhắn</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbl_contact WHERE status ='0' ORDER BY id DESC";
                    $msg = $db->select($query);
                    if ($msg) {
                        $i = 0;
                        while ($result = $msg->fetch_assoc()) {
                            $i++; ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $fm->textShorten($result['body'], 30); ?></td>
                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                <td>
                                    <a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">Xem</a> ||
                                    <a onclick="return confirm('Bạn có chắc chắn Di chuyển tin nhắn này không?');" href="?seenid=<?php echo $result['id']; ?>">Đã xem</a>

                                </td>
                            </tr>
                    <?php
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box round first grid">
        <h2>Đã xem tin nhắn</h2>
        <?php
        // Seen Message Delete Query
        if (isset($_GET['delid'])) {
            $delid = $_GET['delid'];
            $delquery = "DELETE FROM tbl_contact WHERE id = '$delid'";
            $deldata = $db->delete($delquery);
            if ($deldata) {
                echo "<span class='success'>Đã xóa tin nhắn thành công.</span>";
            } else {
                echo "<span class='error'>Tin nhắn không bị xóa.</span>";
            }
        }
        ?>
        <?php
        // Move to inbox
        if (isset($_GET['unseenid'])) {
            $unseenid = $_GET['unseenid'];
            $query = "UPDATE tbl_contact SET status = '0' WHERE id = '$unseenid'";
            $update_row = $db->update($query);
            if ($update_row) {
                echo "<span class='success'>Di chuyển tin nhắn đến Hộp chưa đọc</span>";
            } else {
                echo "<span class='error'>Có gì đó không đúng</span>";
            }
        }                 ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT.</th>
                        <th>Người gửi</th>
                        <th>Email</th>
                        <th>Tin nhắn</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbl_contact WHERE status ='1' ORDER BY id DESC";
                    $msg = $db->select($query);
                    if ($msg) {
                        $i = 0;
                        while ($result = $msg->fetch_assoc()) {
                            $i++; ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $fm->textShorten($result['body'], 30); ?></td>
                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                <td>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa không?');" href="?delid=<?php echo $result['id']; ?>">Xóa</a> ||
                                    <a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">Xem</a> ||
                                    <a href="?unseenid=<?php echo $result['id']; ?>">Chưa đọc</a>
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