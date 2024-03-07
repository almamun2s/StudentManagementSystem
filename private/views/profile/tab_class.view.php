<?php if($classes) : ?>
    <table class="table table-hover table-striped" >
        <tr>
            <th>Class Name</th>
            <th>Created By</th>
            <th>Date</th>
        </tr>
            <?php foreach($classes as $class ): ?>
                <tr>
                    <td><?= esc($class->class_name) ?></td>
                    <td><?= esc($class->user_id->fname).' '.esc($class->user_id->lname) ?></td>
                    <td><?= get_date($class->date) ?></td>
                </tr>
            <?php endforeach;?>
    </table>
<?php else:?>
    <h4 class="text-center" >You did not joined any class yet.</h4>
<?php endif;?>