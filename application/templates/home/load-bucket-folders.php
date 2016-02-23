<ul class="tree-file choose-folders">
    <?php
        if ($files):
            foreach ($files as $file):
                ?>
                <li class="sub-<?php echo md5($file['prefix']); ?>">
                    <div class="tree-file-row" onclick="<?php if (!$add_folder_option) : ?>setSelectedPath('<?php echo $file['prefix'] ?>');<?php else : ?>setFolderSelectedPath('<?php echo $file['prefix'] ?>');<?php endif ?>">
                        <?php if($file['isSub'] == 1) : ?>
                            <span onclick="loadBucketSubFolder($(this).parents('li:eq(0)'), '<?php echo $file['prefix']; ?>', this, <?php echo $add_folder_option ?>)" class="arrow" data-id="<?php echo md5($file['prefix']); ?>" data-prefix="<?php echo ($file['prefix']); ?>"></span>
                        <?php else : ?>
                            <span class="no-sub" ></span>
                        <?php endif; ?>
                        <span class="icos-folder"></span>
                        <span class="name-prefix"><?php echo $file['name']; ?></span>
                        <span class="sub"></span>
                    </div>
        </li>
                <?php
            endforeach;
        endif;
    ?>
</ul>