<div>
    <div class="order_nav title clearfix">
        Please fill in the return shipping information
    </div>
    <div class="info_tab dis_b text-center">
        <div class="inner_ct">
            <form id="post_form" method="post"
                  action="index.php?model=member_return&fun=ship&return_id=<?php echo $output['return']['refund_id']; ?>">
                <input type="hidden" name="form_submit" value="ok"/>
                <div class="shoplist clearfix">
                    <p class="txt">
                        <br><strong>Logistics company : </strong>
                        <select name="express_id">
                            <option value="0">-Please choose -</option>
                            <?php if (!empty($output['express_list']) && is_array($output['express_list'])) { ?>
                                <?php foreach ($output['express_list'] as $key => $val) { ?>
                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['e_name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <br>
                        <br><strong>Logistics number : </strong>
                        <input type="text" class="text " size="50" name="invoice_no" value=""
                               style=" border:1px solid ;"/>
                    <p class="hint">After 5 days of delivery, when the merchant chooses not to receive the goods, the
                        delay time operation will be carried out; if the goods are not disposed of according to the
                        discarded goods for more than 7 days, the administrator will confirm the refund directly.</p>
                    <br>
                    </p>
                    <div class="bottom">
                        <label class="submit-border">
                            <input type="submit" class="submit" id="confirm_button"
                                   value="Determination"/>
                        </label>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function () {
        $('#post_form').validate({
            errorLabelContainer: $('#warning'),
            invalidHandler: function (form, validator) {
                $('#warning').show();
            },
            submitHandler: function (form) {
                ajaxpost('post_form', '', '', 'onerror')
            },
            rules: {
                invoice_no: {
                    required: true
                }
            },
            messages: {
                invoice_no: {
                    required: 'Please fill in the Logistics Document Number'
                }
            }
        });
    });
</script>
