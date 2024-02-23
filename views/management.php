<div class="col-md-12">
    <div class="management">
        <h1>مدیریت</h1>
        <div class="m_row">
            <h2>افزودن محصول جدید</h2>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="toc_form_handler">
                <input type="hidden" name="page" value="add-product">
                <input type="hidden" name="toc_form_nonce" value="<?php echo wp_create_nonce('my_form_nonce'); ?>">
                <input name="table_name" placeholder="نام جدول"
                       style="padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                <button type="submit">
                    <i class="fa fa-plus" style="font-size: 25px; cursor: pointer;"></i>
                </button>
            </form>
        </div>
        <?php
        foreach ($args['tables'] as $table) {
            echo "<div class='m_row'>";
            echo "<h2>$table->name</h2>";
            echo "<a href='?page=toc-admin-page&subpage=management_items&table_id=$table->id'>";
            echo "<i class='fa fa-edit' style='font-size: 25px; cursor: pointer;'></i>";
            echo "</a>";
            echo "</div>";
        }
        ?>
    </div>
</div>
<style>
    .management {
        background-color: #dde0dd;
        padding: 20px;
        margin: 20px;
        border-radius: 10px;
    }

    .management .m_row {
        background-color: #fff;
        padding: 20px;
        margin: 20px;
        border-radius: 10px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

</style>
<script>

</script>