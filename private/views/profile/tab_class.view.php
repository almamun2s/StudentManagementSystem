<?php if($classes) : ?>
    <table class="table table-hover table-striped" >
        <tr>
            <th>Class Name</th>
            <th>Created By</th>
            <th>Created At</th>
        </tr>
            <?php foreach($classes as $class ): ?>
                <tr>
                    <td><a href="<?= ROOT ?>schools/singleClass/<?= $class->class_id ?>" class="text-decoration-none" ><?= esc($class->class_name) ?></a></td>
                    <td><a href="<?= ROOT ?>profile/<?= $class->user_id->user_id ?>" class="text-decoration-none" ><?= esc($class->user_id->fname).' '.esc($class->user_id->lname) ?></a></td>
                    <td><?= get_date($class->date) ?></td>
                </tr>
            <?php endforeach;?>
    </table>
<?php else:?>
    <h4 class="text-center" >Did not joined any class yet.</h4>
<?php endif;?>