<?php /* if ($search == 0): ?>
    <ul class="tree-file-content">
        <?php  if($old_fix != ''): ?>
            <li onclick="loadFrefix('<?php echo $old_fix; ?>', 0);"><i class="fa fa-folder-open-o"></i> ...</li>
        <?php endif;  ?>
    </ul>
<?php  endif; */ ?>
<table class="table table-striped responsive-utilities jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th>#</th>
            <th>
                <input value="" type="checkbox" class="flat" name="multiple_checkbox">
            </th>
            <th class="column-title"> </th>
            <th class="column-title">Name</th>
            <th class="column-title">Date </th>
            <th class="column-title">Size</th>
            <th class="column-title no-link last"><span class="nobr">Action</span> </th>
        </tr>
    </thead>
    <?php if ($listObjects): ?>

        <tbody class="content-file" >
            <?php
                $i = 1;
                foreach ($listObjects as $object):
                    ?>
                     <tr class="row-<?php echo $i; ?>">
                         <td><?php echo $i; ?></td>
                         <td class="a-center ">
                             <input data-id="<?php echo $i; ?>" value="<?php echo base64_encode($object['key']); ?>" type="checkbox" class="flat" name="table_records">
                         </td>
                         <td>
                             <?php if ($object['is_file']): ?>
                                <a href="javascript:;" class="img-popup" data-toggle="modal" onclick="click_popup('<?php echo $object['url'] ?>');" data-target="#popup-image"><img class="img-file" src="<?php echo $object['url'] ?>" /></a>
                            <?php  endif; ?>
                         </td>
                         <td class=" "><?php echo $object['icon'] ?> <a onclick="popup_detail('<?php echo base64_encode($object['key']); ?>', '<?php echo $object['url'] ?>')" href="javascript:;" title=""><?php echo  $object['name'] ?></a></td>
                         <td class=" "><?php echo date('M m,Y. H:m',$object['date']); ?></td>
                         <td class=" ">
                             <span><?php echo $object['size'] ?></span>
                         </td>
                         <td class=" last">
                             <div class="btn-group action-file">
                                 <button type="button" class="btn btn-danger">
                                     <i class="fa fa-gear"> </i>
                                     Action
                                 </button>
                                 <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                     <span class="caret"></span>
                                     <span class="sr-only">Action</span>
                                 </button>
                                 <ul class="dropdown-menu" role="menu">
                                     <li><a href="<?php echo $object['url'];  ?>"><i class="fa fa-cloud-download"></i> Download</a></li>
                                     <li><a onclick="popup_detail('<?php echo base64_encode($object['key']); ?>', '<?php echo $object['url'] ?>')"  href="#"><i class="fa fa-eye"></i> Properties</a></li>
                                     <li><a onclick="delete_file('<?php echo base64_encode($object['key']); ?>', <?php echo $i; ?>);" href="javascript:;"  ><i class="fa fa-remove"></i> Delete</a></li>
                                 </ul>
                             </div>
                         </td>
                     </tr>
                    <?php
                     $i++;
                endforeach;
            ?>
        <?php if ($load_more != 0):  ?>
            <tr><td colspan="8">
                    <a class="load-more"
                      <?php if ($search ==0): ?>
                            onclick="PrettyS3FilesManager.Bucket.loadObjects('<?php echo $frefix;  ?>', <?php echo $load_more; ?>);"
                        <?php else:   ?>
                          onclick="loadSearchFrefix( <?php echo $load_more; ?>);"
                        <?php endif;  ?>
                       href="javascript:;">Load more</a>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="7">
                <a class="btn btn-danger" onclick="PrettyS3FilesManager.File.deleteMultiple()" id="delete-multiple" href="javascript:;">
                    <i class="fa fa-trash"> </i>
                    Delete
                </a>
                <a onclick="refresh_butket();"  href="javascript:;" class="btn btn-info">
                    <i class="fa fa-refresh"> </i>
                    Refresh
                </a>
            </td>
        </tr>
        </tfoot>
    <?php else : ?>
        <tr><td colspan="7">There is no file in this folder</td></tr>
    <?php endif ?>
</table>

