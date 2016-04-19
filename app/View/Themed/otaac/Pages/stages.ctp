<div class="panel panel-default panel-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Level</th>
                <th>Experience</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($level = 1; $level <= 100; $level++) { ?>
                <tr>
                    <?php
                    $level_calculate = $level - 1;
                    $exp = (50 * ($level_calculate) * ($level_calculate) * ($level_calculate) - 150 * ($level_calculate) * ($level_calculate) + 400 * ($level_calculate)) / 3;
                    ?>
                    <td><?php echo $level ?></td>
                    <td><?php echo $exp ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>