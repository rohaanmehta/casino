<?= $this->extend('Admin/header') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Messages</h1>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <select name='count' class='count mb-2'>
                <option value="20" selected>20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
                <option value="2000">2000</option>
            </select>

            <div class="row">
                <div class='table-responsive'>
                    <table class='table table-striped table-bordered table-hover'>
                        <thead>
                            <th class='tr_col' column=''>User Name</th>
                            <th class='tr_col' column='depo_user_amount'>Message</th>
                            <th class='tr_col' column=''>Created Date</th>
                            <th class='tr_col' column=''>Created Time</th>
                            <th class='tr_col' column=''>Action</th>
                        </thead>
                        <tbody>
                            <?php if (isset($messages) && !empty($messages) && sizeof($messages) > 0) {
                                foreach ($messages as $row) { ?>
                                    <tr>
                                        <td><?= $row['user_name'] ?></td>
                                        <td><?= $row['msg'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                                        <td><?= date('H:i:s', strtotime($row['created_at'])) ?></td>
                                        <td>
                                            <button type="button"  msgid ='<?= $row['id'] ?>'  userid ='<?= $row['msg_user_id'] ?>' class="msg-btn bg-secondary border-0 btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                Reply
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan='5' class='text-center'> No Entries !</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class='w-100 d-flex justify-content-end pr-5'>
                    <?= $links ?>
                </div>
                <input type='hidden' class='msg-user-id'/>
                <input type='hidden' class='msg-id'/>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reply </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class='msg-content form-control' rows='3'></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary msg-send">Send Message</button>
            </div>
        </div>
    </div>
</div>

<script src="public/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        <?php if (isset($_GET['count'])) { ?>
            $('.count').val(<?= $_GET['count'] ?>);
        <?php } ?>

        $('.count').change(function() {
            window.location.href = '<?= base_url('admin_msgs?count=') ?>' + $(this).val();
        });

        $('.tr_col').click(function() {
            window.location.href = '<?= base_url('admin_msgs?column=') ?>' + $(this).attr('column');
        });

        $('.msg-btn').click(function() {
            var userid = $(this).attr('userid');
            var msgid = $(this).attr('msgid');
            $('.msg-user-id').val(userid);
            $('.msg-id').val(msgid);
        });

        $('.msg-send').click(function() {
            var userid = $('.msg-user-id').val();
            var msgid = $('.msg-id').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('reply_to_user') ?>",
                data: {
                    userid: userid,
                    msgid: msgid,
                    msg:$('.msg-content').val()
                },
                cache: false,
                dataType: "json",
                success: function(data) {
                    if (data.result == '200') {
                        toast('info', 'Message Sent !');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toast('info', 'Something went wrong !');
                    }
                }
            });
        });
    })
</script>
<?= $this->endSection() ?>