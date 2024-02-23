<?php //if (isset($_GET['subpage']) && $_GET['subpage'] == 'management_items') : ?>

<div class="col-md-12">
    <div class="management">
        <h1><?php echo $args['table_name'] ?></h1>
        <div class="toc_row">
            <h2>سطر جدید</h2>
            <div>
                <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <input type="hidden" name="action" value="toc_form_handler">
                    <input type="hidden" name="page" value="add-row">
                    <input type="hidden" name="table_name" value="<?php echo $args['wp_table_name'] ?>">
                    <input type="hidden" name="toc_form_nonce" value="<?php echo wp_create_nonce('my_form_nonce'); ?>">
                    <label for="name">نام محصول</label>
                    <input name="name" placeholder="نام محصول"
                           style="padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                    <label for="thickness">ضخامت</label>
                    <input name="thickness" placeholder="ضخامت"
                           style="padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                    <label for="factory">کارخانه</label>
                    <input name="factory" placeholder="کارخانه"
                           style="padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                    <label for="state">وضعیت</label>
                    <input name="state" placeholder="وضعیت"
                           style="padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                    <label for="depot">انبار</label>
                    <input name="depot" placeholder="انبار"
                           style="padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                    <label for="price">قیمت</label>
                    <input name="price" placeholder="قیمت"
                           style="padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
<!--                    <button type="submit">-->
<!--                        <i class="fa fa-plus"></i>-->
<!--                    </button>-->
                    <input type="submit" value="ثبت">
                </form>
            </div>
        </div>
        <h3>لیست ستون ها</h3>
        <table>
            <tr>
                <th>نام</th>
                <th>ضخامت</th>
                <th>کشور/کارخانه</th>
                <th>وضعیت</th>
                <th>انبار</th>
                <th>تاریخ بروزرسانی</th>
                <th>قیمت</th>
                <th>نوسانات</th>
            </tr>
            <?php
            foreach ($args['data'] as $row) {
                echo "<tr>";
                echo "<td>$row->name</td>";
                echo "<td>$row->thickness</td>";
                echo "<td>$row->factory</td>";
                echo "<td>$row->state</td>";
                echo "<td>$row->depot</td>";
                echo "<td>$row->update_date</td>";
                echo "<td>$row->price</td>";
                echo "<td>$row->previous_price</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <style>
        .management {
            background-color: #dde0dd;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
        }

        .management .toc_row {
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
</div>
