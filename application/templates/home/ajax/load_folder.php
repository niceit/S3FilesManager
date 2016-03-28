<ul class="tree-file">
    <?php if ($prefix == "/") : ?>
        <li class="sub-<?php echo md5("/"); ?>">
            <span class="item">
                <span class="no-sub" ></span>
                <i class="fa fa-folder-open-o"></i>  <a href="javascript:;" onclick="PrettyS3FilesManager.Bucket.loadObjects('<?php echo "/"; ?>', 0)" ><span class="name-prefix" >/</span></a>
            </span>
        </li>
    <?php endif; ?>
    <?php
        if ($files):
            foreach ($files as $file):
                ?>
                <li class="sub-<?php echo md5($file['prefix']); ?>">
                    <span class="item">
                        <?php  if($file['isSub'] == 1): ?>
                            <a href="javascript:;" class="arrow" data-id="<?php echo md5($file['prefix']); ?>" data-prefix="<?php echo ($file['prefix']); ?>"><span><i class="fa fa-caret-right"></i></span></a>
                        <?php else : ?>
                            <span class="no-sub" ></span>
                        <?php endif; ?>
                        <i class="fa fa-folder-open-o"></i>  <a href="javascript:;" onclick="PrettyS3FilesManager.Bucket.loadObjects('<?php echo $file['prefix']; ?>', 0)" ><span class="name-prefix name-<?php echo md5($file['prefix']); ?>" ><?php echo $file['name']; ?></span></a>
                        <span class="create-sub-folder" ><a onclick="PrettyS3FilesManager.File.fileProperties('<?php echo base64_encode($file['prefix']); ?>', '<?php echo $file['prefix']; ?>')" href="#"><i class="fa fa-eye"></i>  </a><a onclick="PrettyS3FilesManager.Bucket.deleteFolder('<?php echo base64_encode($file['prefix']); ?>', '0', '<?php echo md5($file['prefix']); ?>')" href="javascript:;"><i class="fa fa-remove"></i>  </a></span>
                    </span>
                    <span class="sub"></span>
                </li>
                <?php
            endforeach;
        endif;
    ?>
</ul>
