<table class="table table-striped responsive-utilities jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th>#</th>
            <th>
                <input id="check-all" value="" type="checkbox" class="flat" name="multiple_checkbox">
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
                $row_even = 'even';
                foreach ($listObjects as $object):
                    ?>
                     <tr class="row-<?php echo $i; ?> <?php echo $row_even; if ($row_even == 'even') { $row_even = 'odd'; } else { $row_even = 'even'; }  ?> pointer">
                         <td><?php echo $i; ?></td>
                         <td class="a-center ">
                             <input data-id="<?php echo $i; ?>" value="<?php echo base64_encode($object['key']); ?>" type="checkbox" class="flat file-checkbox" name="table_records">
                         </td>
                         <td>
                             <?php if ($object['is_file']): ?>
                                <a href="javascript:;" class="img-popup" data-toggle="modal" onclick="PrettyS3FilesManager.File.previewImage('<?php echo $object['url'] ?>');" data-target="#popup-image"><img class="img-file" src="<?php echo $object['url'] ?>" /></a>
                            <?php  endif; ?>
                         </td>
                         <td class=" "><?php echo $object['icon'] ?> <a onclick="PrettyS3FilesManager.File.fileProperties('<?php echo base64_encode($object['key']); ?>', '<?php echo $object['url'] ?>')" href="javascript:;" title=""><?php echo  $object['name'] ?></a></td>
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
                                     <li><a onclick="PrettyS3FilesManager.File.fileProperties('<?php echo base64_encode($object['key']); ?>', '<?php echo $object['url'] ?>')"  href="#"><i class="fa fa-eye"></i> Properties</a></li>
                                     <li><a onclick="PrettyS3FilesManager.File.delete('<?php echo base64_encode($object['key']); ?>', <?php echo $i; ?>);" href="javascript:;"  ><i class="fa fa-remove"></i> Delete</a></li>
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
                <a onclick="PrettyS3FilesManager.Bucket.reloadObjects();"  href="javascript:;" class="btn btn-info">
                    <i class="fa fa-refresh"> </i>
                    Refresh
                </a>
            </td>
        </tr>
        </tfoot>
    <?php else : ?>
        <tr><td colspan="7">There is no file in this folder</td></tr>
        <tr>
            <td colspan="7">
                <a onclick="PrettyS3FilesManager.Bucket.reloadObjects();"  href="javascript:;" class="btn btn-info">
                    <i class="fa fa-refresh"> </i>
                    Refresh
                </a>
            </td>
        </tr>
    <?php endif ?>
</table>
<script type="text/javascript">
    $(function () {
        $('.bulk_action input#check-all').on('ifChecked', function () {
            check_state = 'check_all';
            countChecked();
        });
        $('.bulk_action input#check-all').on('ifUnchecked', function () {
            check_state = 'uncheck_all';
            countChecked();
        });
    })
</script>