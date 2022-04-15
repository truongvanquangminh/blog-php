<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
        <ul>

            <?php

            $query = "SELECT * FROM tbl_category";
            $category = $db->select($query);
            if ($category) {
                while ($result = $category->fetch_assoc()) {
            ?>

                    <li><a href=""><?php echo $result['name'] ?></a></li>
                <?php
                }
            } else {
                ?>
                <li>No Category Created.</li>
            <?php
            } ?>
        </ul>
    </div>



</div>