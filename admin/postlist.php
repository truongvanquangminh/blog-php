<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách bài viết</h2>
		<div class="block">
			<?php
			if (isset($_GET['delpostid'])) {
				$delpostid = mysqli_real_escape_string($db->link, $_GET['delpostid']);
				$postid = $delpostid;

				$query = "SELECT * FROM tbl_post WHERE id = '$postid'";
				$getData = $db->select($query);

				if ($getData) {
					while ($delimg = $getData->fetch_assoc()) {
						$dellink = $delimg['image'];
						unlink($dellink);
					}
				}
				$delquery = "DELETE FROM tbl_post WHERE id = '$postid'";
				$delData = $db->delete($delquery);

				if ($delData) {
					echo "<span class='success'>Dữ liệu đã xóa thành công</span>";
				} else {
					echo "<span class='success'>Dữ liệu chưa được xóa</span>";
				}
			}

			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">STT</th>
						<th width="15%">Tiêu đề bài viết</th>
						<th width="20%">Mô tả</th>
						<th width="10%">Thể loại</th>
						<th width="10%">Ảnh</th>
						<th width="10%">Tác giả</th>
						<th width="10%">Ngày</th>
						<th width="10%">Hành động</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post 
                        INNER JOIN tbl_category
                        ON tbl_post.cat_id = tbl_category.id
                        ORDER BY tbl_post.title DESC";
					$post = $db->select($query);
					if ($post) {
						$i = 0;
						while ($result = $post->fetch_assoc()) {
							$i++; ?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td style="font-weight:700"><?php echo $result['title']; ?></td>
								<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
								<td><?php echo $result['name']; ?></td>
								<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"></td>
								<td><?php echo $result['author']; ?></td>
								<td><?php echo $fm->formatDate($result['date']); ?></td>
								<td>
									<a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">Xem</a>
									<?php if (Session::get('userId') == $result['user_id'] || Session::get('userRole') == '0') {
									?>
										|| <a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Sửa</a> ||
										<a onclick="return confirm('Bạn có muốn xóa không?');" href="?delpostid=<?php echo $result['id']; ?>">Xóa</a>
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