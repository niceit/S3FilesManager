<ul class="tree-file">
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
                    <i class="fa fa-folder-open-o"></i>  <a href="javascript:;" onclick="loadFrefix('<?php echo $file['prefix']; ?>', 0)" ><span class="name-prefix" ><?php echo $file['name']; ?></span></a>
                  <span class="create-sub-folder" ><a onclick="popup_detail('<?php echo base64_encode($file['prefix']); ?>', '<?php echo $file['prefix']; ?>')" href="#"><i class="fa fa-eye"></i>  </a>&nbsp;&nbsp;<a onclick="loadFolderNewLeft('<?php echo $file['prefix']; ?>');" title="Create sub folder"  href="javascript:;"><i class="fa fa-plus-circle"></i></a></span>
                </span>
                <span class="sub"></span>
            </li>
            <?php
        endforeach;
    endif;
    ?>
</ul>
