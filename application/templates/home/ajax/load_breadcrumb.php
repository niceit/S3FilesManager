<ul>
    <li><i class="fa fa-folder-open-o"></i> <a onclick="PrettyS3FilesManager.Bucket.loadObjects('/', 0)" href="javascript:;">/</a></li>
    <?php
    if(!empty($folder)):
            foreach ($folder as $row): $name .= $row . "/";  ?>
            <?php if ($row == end($folder)) : ?>
                    <li><?php echo $row; ?></li>
            <?php else: ?>
                    <li><a onclick="loadFrefix_bread('<?php echo $name; ?>', 0, '<?php echo md5($name); ?>')" href="javascript:;"><?php echo $row; ?></a></li>
                    <li>/</li>
             <?php endif; ?>
        <?php endforeach;
        endif;
    ?>
</ul>