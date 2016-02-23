<ul class="tree-file">
    <?php
    if ($files):
        foreach ($files as $file):
            ?>
            <li class="sub-<?php echo md5($file['prefix']); ?>"><?php  if($file['isSub'] == 1): ?>
                    <span class="arrow" data-id="<?php echo md5($file['prefix']); ?>" data-prefix="<?php echo ($file['prefix']); ?>" ><i class="fa fa-caret-right"></i></span>
                <?php else : ?>
                    <span class="no-sub" ></span>
                <?php endif; ?>
                <i class="fa fa-folder-open-o"></i> <span class="name-prefix" onclick="loadFrefix('<?php echo $file['prefix']; ?>', 0)"><?php echo $file['name']; ?></span><a onclick="createnewfolder('<?php echo $file['prefix']; ?>');"  href="javascript:;">add</a>
            <span class="sub">
            </span>
            </li>
            <?php
        endforeach;
    endif;
    ?>
</ul>
