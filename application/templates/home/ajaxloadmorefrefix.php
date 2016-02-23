<?php
if ($listObjects):
    ?>
    <?php
    foreach ($listObjects as $object):
        ?>
        <tr >
            <td><?php echo $sst++; ?></td>
            <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records">
            </td>
            <td>
                <?php if ($object['is_file']): ?>
                    <img style="height: 30px; " src="<?php echo $object['url'] ?>" />
                <?php  endif; ?>
            </td>
            <td class=" "><?php echo $object['icon'] ?> <a href="#" title=""><?php echo  $object['name'] ?></a></td>
            <td class=" "><?php echo date('M m,Y. H:m',$object['date']); ?></td>
            <td class=" "><span><strong>Size:</strong><?php echo  $object['size'] ?> Kb</span>
                <span><strong>Format: </strong><?php echo $object['format']; ?></span>
                <span><strong>Download: <a href="<?php echo $object['url'];  ?>" class="download" download=""><i class="fa fa-cloud-download"></i></a></strong></td>
            <td class=" last"><a href="#">View</a>
            </td>
        </tr>
        <?php
    endforeach;
    ?>

    <?php if ($load_more != 0):  ?>
        <tr><td colspan="8"><a class="load-more" onclick="loadFrefix('<?php echo $frefix;  ?>', <?php echo $load_more; ?>);" href="javascript:;">Load more</a></td></tr>
    <?php endif; ?>
    <?php
endif;
?>
