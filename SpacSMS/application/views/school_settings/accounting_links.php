<?php $status = ($transactions['status'] == 1 ? '' : 'disabled'); ?>
<div class="row">
    <div class="col-md-3">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <section class="panel">
            <header class="panel-heading">
                <h4 class="panel-title"><i class="fas fa-funnel-dollar"></i> <?=translate('transactions') . " " . translate('default_account') ?></h4>
            </header>
            <?php echo form_open('school_settings/accountingLinksSave' . $url, array('class' => 'form-horizontal form-bordered frm-submit-msg')); ?>
                <div class="panel-body">
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label"><?=translate('deposit') . " " . translate('acccount')?> <span class="required">*</span></label>
                        <div class="col-md-6">
                            <?php
                            $accounts_list = $this->app_lib->getSelectByBranch('accounts', $branch_id);
                            echo form_dropdown("deposit", $accounts_list, $transactions['deposit'], "class='form-control account_id' $status data-plugin-selectTwo data-width='100%'");
                            ?>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?=translate('expense') . " " . translate('acccount')?> <span class="required">*</span></label>
                        <div class="col-md-6">
                            <?php
                            $accounts_list = $this->app_lib->getSelectByBranch('accounts', $branch_id);
                            echo form_dropdown("expense", $accounts_list, $transactions['expense'], "class='form-control account_id' $status data-plugin-selectTwo data-width='100%'");
                            ?>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6  mb-md">
                            <div class="checkbox-replace">
                                <label class="i-checks">
                                    <input type="checkbox" name="status" <?=$transactions['status'] == 1 ? 'checked' : ''; ?> id="cb_status"> <i></i> Enable / Disable
                                </label>
                            </div>
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

<script type="text/javascript">
    $("input[type='checkbox']#cb_status").on("change", function() {
        if($(this).is(":checked")){
            $('.account_id').prop('disabled', false);
        } else {
            $('.account_id').prop('disabled', true);
        }
    });
</script>