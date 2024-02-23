<div class="col-md-12">
    <?php
        foreach ($args['tables'] as $table) {
            echo "<table>";
            echo "<tr>";
            echo "<th>نام</th>";
            echo "<th>ضخامت</th>";
            echo "<th>کارخانه</th>";
            echo "<th>وضعیت</th>";
            echo "<th>انبار</th>";
            echo "<th>تاریخ بروزرسانی</th>";
            echo "<th>قیمت</th>";
            echo "<th>نوسانات</th>";
            echo "</tr>";

            foreach ($table as $row) {
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
            echo "</table>";
        }
    ?>
</div>
