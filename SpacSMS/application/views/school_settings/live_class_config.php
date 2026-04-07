<div class="row">
    <div class="col-md-3">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <section class="panel">
            <header class="panel-heading">
                <h4 class="panel-title"><i class="fas fa-cogs"></i> Zoom Account Config</h4>
            </header>
            <?php echo form_open('school_settings/liveClassSave' . $url, array('class' => 'form-horizontal form-bordered frm-submit-msg')); ?>
                <div class="panel-body">
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Zoom API Key <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="zoom_api_key" value="<?=$config['zoom_api_key']?>" />
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Zoom API Secret <span class="required">*</span></label>
                        <div class="col-md-6 mb-md">
                            <input type="text" class="form-control" name="zoom_api_secret" value="<?=$config['zoom_api_secret']?>" />
                            <span class="error"></span>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-2 col-sm-offset-3">
                            <button type="submit" class="btn btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
                                <i class="fas fa-plus-circle"></i> <?=translate('save');?>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>