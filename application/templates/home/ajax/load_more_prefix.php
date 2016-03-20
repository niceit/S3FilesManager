<?php
if ($listObjects):
    ?>
    <?php
    foreach ($listObjects as $object):
        ?>
        <tr class="row-<?php echo $sst; ?>">
            <td><?php echo $sst; ?></td>
            <td class="a-center ">
                <input data-id="<?php echo $sst; ?>" value="<?php echo base64_encode($object['key']); ?>" type="checkbox" class="flat" name="table_records">
            </td>
            <td>
                <?php if ($object['is_file']): ?>
                    <a href="javascript:;" class="img-popup" onclick="click_popup('<?php echo $object['url'] ?>');" data-toggle="modal" data-target="#popup-image"><img class="img-file" src="<?php echo $object['url'] ?>" /></a>
                <?php  endif; ?>
            </td>
            <td class=" "><?php echo $object['icon'] ?> <a href="#" onclick="popup_detail('<?php echo base64_encode($object['key']); ?>', '<?php echo $object['url'] ?>')"  title=""><?php echo  $object['name'] ?></a></td>
            <td class=" "><?php echo date('M m,Y. H:m',$object['date']); ?></td>
            <td class=" ">
                <span><?php echo  $object['size'] ?> Kb</span>
            </td>
            <td class=" last">
                <div class="btn-group action-file">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Action</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $object['url'];  ?>"><i class="fa fa-cloud-download"></i> Download</a></li>
                        <li><a href="#" onclick="popup_detail('<?php echo base64_encode($object['key']); ?>', '<?php echo $object['url'] ?>')" ><i class="fa fa-eye"></i> View</a></li>
                        <li><a onclick="delete_file('<?php echo base64_encode($object['key']); ?>', <?php echo $i; ?>);" href="javascript:;"  ><i class="fa fa-remove"></i> Delete</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        <?php
        $sst++;
    endforeach;
    ?>

    <?php if ($load_more != 0):  ?>
        <tr><td colspan="8"><a class="load-more"
                                <?php if ($search ==0): ?>
                                    onclick="loadFrefix('<?php echo $frefix;  ?>', <?php echo $load_more; ?>);"
                                <?php else:   ?>
                                    onclick="loadSearchFrefix( <?php echo $load_more; ?>);"
                                <?php endif;  ?>
                               href="javascript:;">Load more</a></td></tr>
    <?php endif; ?>
    <?php
endif;
?>
