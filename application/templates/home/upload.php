<div class="buckets-selection">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Choose available Buckets</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="bucket" class="select_butket form-control" tabindex="-1">
                <?php if (!empty($buckets)) : ?>
                    <?php foreach ($buckets['Buckets'] as $bucket) : ?>
                        <option value="<?php echo $bucket['Name'] ?>"><?php echo $bucket['Name'] ?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
        </div>
    </div>


    <a href="javascript:;" class="buttonM bBlue add-bucket-btn"><span class="icol-add"></span><span>Add new bucket</span></a>
</div>




<a href="javascript:;" class="buttonM bBlue add-folder-btn"><span class="icol-folder"></span><span>Create new folder</span></a>


<div id="create-bucket" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Add New Bucket</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="save-folder" class="btn btn-primary">Save</button>
            </div>

        </div>
    </div>
</div>
<div id="modal-add-folder" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Add new bucket folder</h4>
            </div>
            <div class="modal-body">
                <div class="body"></div>
                <div class="bucket-select-path">
                    <input type="hidden" name="select_folder_path" value="/">
                    <span class="selected-folder">/</span>
                    <br>
                    <input type="text" name="folder_name" value="" placeholder="Input new folder name without /">
                    <div class="add-folder-loading">
                        <img src='/assets/images/elements/loaders/5s.gif' /> &nbsp; <i>Please patience...</i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="save-folder" class="btn btn-primary">Save</button>
            </div>

        </div>
    </div>
</div>
