<?= $this->extend('Admin/header') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Withdraw</h1>
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
                            <th class='tr_col' column='with_user_amount'>Withdraw Amount</th>
                            <th class='tr_col' column=''>Created at</th>
                            <th class='tr_col' column='with_status'>Status</th>
                        </thead>
                        <tbody>
                            <?php if (isset($withdraw) && !empty($withdraw) && sizeof($withdraw) > 0) {
                                foreach ($withdraw as $row) { ?>
                                    <tr>
                                        <td><?= $row['user_name'] ?></td>
                                        <td><?= $row['with_user_amount'] ?></td>
                                        <td><?= date('d-m-Y H:i:s', strtotime($row['created_at'])) ?></td>
                                        <td>
                                            <select userid='<?= $row['with_user_id']?>' <?php if ($row['with_status'] == "REJECTED" || $row['with_status'] == "COMPLETED") {
                                                        echo "disabled";
                                                    } ?> with_id='<?= $row['id'] ?>' class='form-control withdraw-status'>
                                                <option value='PENDING' <?php if ($row['with_status'] == "PENDING") {
                                                                            echo "selected";
                                                                        } ?>>PENDING</option>
                                                <option value='COMPLETED' <?php if ($row['with_status'] == "COMPLETED") {
                                                                                echo "selected";
                                                                            } ?>>COMPLETED</option>
                                                <option value='REJECTED' <?php if ($row['with_status'] == "REJECTED") {
                                                                                echo "selected";
                                                                            } ?>>REJECTED</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan='4' class='text-center'> No Entries !</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class='w-100 d-flex justify-content-end pr-5'>
                    <?= $links ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="public/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        <?php if (isset($_GET['count'])) { ?>
            $('.count').val(<?= $_GET['count'] ?>);
        <?php } ?>

        $('.count').change(function() {
            window.location.href = '<?= base_url('admin_withdraw?count=') ?>' + $(this).val();
        });

        $('.tr_col').click(function() {
            window.location.href = '<?= base_url('admin_withdraw?column=') ?>' + $(this).attr('column');
        });

        $('.withdraw-status').change(function() {
            var id = $(this).attr('with_id');
            var userid = $(this).attr('userid');
            $.ajax({
                type: "POST",
                url: "<?= base_url('withdraw_status') ?>",
                data: {
                    id: id,
                    userid: userid,
                    status: $(this).val(),
                },
                cache: false,
                dataType: "json",
                success: function(data) {

                    if (data.result == 200) {
                        toast('info', 'Status Updated !');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        toast('info', 'Something went wrong !');
                    }
                }
            });
        });
    })
</script>
<?= $this->endSection() ?>