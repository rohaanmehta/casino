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
                            <?php if (isset($withdraw) && !empty($withdraw) && sizeof($withdraw) > 0 ) {
                                foreach ($withdraw as $row) { ?>
                                    <tr>
                                        <td><?= $row['user_name'] ?></td>
                                        <td><?= $row['with_user_amount'] ?></td>
                                        <td><?= date('d-m-Y H:i:s', strtotime($row['created_at'])) ?></td>
                                        <td><button with_id='<?= $row['id'] ?>' class='status btn btn-primary'><?= $row['with_status'] ?></button></td>
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
    })
</script>
<?= $this->endSection() ?>