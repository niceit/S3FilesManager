<ul class="tree-file-content">

    <?php  if($old_fix != ''): ?>
        <li onclick="loadFrefix('<?php echo $old_fix; ?>', 0);"><span class="icos-folder"></span> ...</li>
    <?php endif;  ?>

    <?php
    if ($files):
        foreach ($files as $file):
    ?>
            <li onclick="loadFrefix('<?php echo $file['Prefix']; ?>', 0)"><span class="icos-folder"></span> <?php echo $file['Prefix']; ?></li>
    <?php
        endforeach;
    endif;
    ?>
</ul>


    <?php
    if ($listObjects):
    ?>
        <table class="table table-striped responsive-utilities jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th></th>
                    <th>
                        <input type="checkbox" id="check-all" class="flat">
                    </th>
                    <th class="column-title"> </th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Date </th>
                    <th class="column-title">Detail</th>
                    <th class="column-title no-link last"><span class="nobr">Action</span> </th>
                </tr>
            </thead>
            <tbody class="content-file" >
                <?php $i = 1;
                 foreach ($listObjects as $object):
                    ?>
                     <tr >
                         <td><?php echo $i++; ?></td>
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
            </tbody>
        </table>
        <?php
    endif;
    ?>

