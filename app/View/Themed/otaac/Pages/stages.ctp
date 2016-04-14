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
            for ($level = 1, $rateExp = 0; $level <= 100; $level++) { ?>
                <tr>
                    <td><?php echo $level ?></td>
                    <td><?php echo ($level * 100) * rateExp ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>