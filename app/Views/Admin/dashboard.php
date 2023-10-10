<?= $this->extend('Admin/header') ?>
<?= $this->section('content') ?>
    <div class="content-wrapper">

      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div>
          </div>
        </div>
      </div>


      <section class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-3 col-6">

              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?= $month_total_users.' / '.$total_users ?></h3>
                  <p>Users this month / Total users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?= $month_total_deposit[0]['total_deposit'].' / '.$total_deposit[0]['total_deposit'] ?></h3>
                  <p>Deposits this month / Total Deposits</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-6">

              <div class="small-box bg-success">
                <div class="inner">
                <h3><?= $month_total_withdraw[0]['total_withdraw'].' / '.$total_withdraw[0]['total_withdraw'] ?></h3>
                  <p>Withdraw this month / Total Withdraw</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-6">

              <div class="small-box bg-danger">
                <div class="inner">
                <h3><?= $month_total_msgs.' / '.$total_msgs ?></h3>
                  <p>Messages this month / Total messages</p>
                </div>
                <div class="icon">
                  <i class="ion ion-info"></i>
                </div>
              </div>
            </div>

          </div>

        </div>
      </section>

    </div>
<?= $this->endSection() ?>
