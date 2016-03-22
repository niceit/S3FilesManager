<ul class="tree-file choose-folders">
    <?php if($path == ''): ?>
    <li class="sub-<?php echo md5("/"); ?>">
        <div class="tree-file-row" onclick="setFolderSelectedPath('/');">
            <i class="fa fa-folder-open-o"></i>
            <span class="name-prefix">/</span>
        </div>
        <span class="sub"></span>
    </li>
    <?php  endif; ?>
    <?php
        if ($files):
            foreach ($files as $file):
                ?>
                <li class="sub-<?php echo md5($file['prefix']); ?>">
                    <div class="tree-file-row" onclick="setFolderSelectedPath('<?php echo $file['prefix'] ?>');">
                        <?php if($file['isSub'] == 1) : ?>
                            <a href="javascript:;" class="arrow-item" data-id="<?php echo md5($file['prefix']); ?>" data-prefix="<?php echo ($file['prefix']); ?>"><span><i class="fa fa-caret-right"></i></span></a>
                        <?php else : ?>
                            <span class="no-sub" ></span>
                        <?php endif; ?>
                        <i class="fa fa-folder-open-o"></i>
                        <span class="name-prefix"><?php echo $file['name']; ?></span>
                    </div>
                    <span class="sub"></span>
                 </li>
                <?php
            endforeach;
        endif;
    ?>
</ul>