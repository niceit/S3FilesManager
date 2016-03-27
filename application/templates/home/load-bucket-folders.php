<?php
    switch ($popup_type) {
        case 'create_folder':
            $handle_onclick = "PrettyS3FilesManager.Bucket.setPopupCreateFolderSelectPath";
            $handle_sub_folder = "PrettyS3FilesManager.Bucket.loadPopupCreateFolderSubFolder";
            $handle_sub_id = "create-folder";
            break;
        case 'upload_file':
            $handle_onclick = "PrettyS3FilesManager.S3Upload.setPopupUploadFileSelectPath";
            $handle_sub_folder = "PrettyS3FilesManager.S3Upload.loadPopupUploadFileSubFolder";
            $handle_sub_id = "upload-file";
            break;
    }
?>
<ul class="tree-file choose-folders">
    <?php if ($path == '') : ?>
    <li class="sub-<?php echo $handle_sub_id . '-' . md5("/"); ?>">
        <div class="tree-file-row" onclick="<?php echo $handle_onclick ?>('/');">
            <i class="fa fa-folder-open-o"></i>
            <span class="name-prefix">/</span>
        </div>
        <span class="sub"></span>
    </li>
    <?php  endif; ?>
    <?php
        if ($files) :
            foreach ($files as $file):
                ?>
                <li class="sub-<?php echo $handle_sub_id . '-' . md5($file['prefix']); ?>">
                    <div class="tree-file-row item" onclick="<?php echo $handle_onclick ?>('<?php echo $file['prefix'] ?>');">
                        <?php if($file['isSub'] == 1) : ?>
                            <a href="javascript:;" onclick="<?php echo $handle_sub_folder ?>(this)" class="arrow-item" data-id="<?php echo $handle_sub_id . '-' . md5($file['prefix']); ?>" data-prefix="<?php echo ($file['prefix']); ?>"><span><i class="fa fa-caret-right"></i></span></a>
                        <?php else : ?>
                            <span class="no-sub" ></span>
                        <?php endif; ?>
                        <i class="fa fa-folder-open-o"></i>
                        <span class="name-prefix"><?php echo $file['name']; ?></span>
                    </div>
                    <div class="sub"></div>
                 </li>
                <?php
            endforeach;
        endif;
    ?>
</ul>