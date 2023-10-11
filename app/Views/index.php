<?php
$session = session();
$user_id = $session->get('user_id');
$username = $session->get('username');
// $coins = $user_id;
$coins = '';
if (isset($user_id) && !empty($user_id)) {
    $db = db_connect();
    $coins = $db->table('coin')->where('user_id', $user_id)->get()->getResultArray();
    $coins = $coins[0]['coins'];
    // print_r($coins);
    // $coins= '0';
}
$total_option = 'ODD';
if ($last_roll[0]['total'] % 2 == 0) {
    $total_option = 'EVEN';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino </title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/images/logo.webp') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/toastify.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Allan:wght@400;700&family=Sora:wght@200&display=swap');

        body {
            background-color: #000;
            background-image: url('public/images/background.webp');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            font-family: Sora;
        }

        .bg {
            /* background-color: #4B5893 !important; */
            background: linear-gradient(98.3deg, rgb(0, 0, 0) 10.6%, rgb(221 23 23) 97.7%);
            border-radius: 8px;
            /* background-image: url('public/images/casinoboard.webp');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;         */
        }

        .bg_dark {
            /* background-color: #102d52 !important; */
            background: linear-gradient(180deg, rgba(2, 0, 36, 1) 0%, rgb(46 61 68) 66%, rgb(46 79 88) 95%)
        }

        /* bootstrap csss   */
        button,
        textarea:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        input,
        select {
            box-shadow: none !important;
            outline: none !important;
        }

        input,
        select:focus {
            border: 1px solid lightgrey !important;
        }

        input[type=range] {
            height: 39px;
            -webkit-appearance: none;
            margin: 10px 0;
            width: 100%;
            border: none !important;
        }

        input[type=range]:focus {
            outline: none;
            border: none !important;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 12px;
            cursor: pointer;
            animate: 0.2s;
            box-shadow: 1px 1px 2px #A6A6A6;
            background: rgb(255 171 34);
            border-radius: 4px;
            border: 2px solid rgb(255 171 64);
        }

        input[type=range]::-webkit-slider-thumb {
            box-shadow: 1px 1px 2px #A6A6A6;
            border: 2px solid #fff;
            height: 30px;
            width: 30px;
            border-radius: 0px;
            background: #f3f3f3;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -11px;
        }

        input[type=range]:focus::-webkit-slider-runnable-track {
            background: rgb(255 171 34);
        }

        input[type=range]::-moz-range-track {
            width: 100%;
            height: 12px;
            cursor: pointer;
            animate: 0.2s;
            box-shadow: 1px 1px 2px #A6A6A6;
            background: rgb(255 171 34);
            border-radius: 4px;
            border: 2px solid #F27B7F;
        }

        input[type=range]::-moz-range-thumb {
            box-shadow: 1px 1px 2px #A6A6A6;
            border: 2px solid #F27B7F;
            height: 30px;
            width: 30px;
            border-radius: 0px;
            background: rgb(255 171 34);
            cursor: pointer;
        }

        input[type=range]::-ms-track {
            width: 100%;
            height: 12px;
            cursor: pointer;
            animate: 0.2s;
            background: transparent;
            border-color: transparent;
            color: transparent;
        }

        input[type=range]::-ms-fill-lower {
            background: rgb(255 171 34);
            border: 2px solid #F27B7F;
            border-radius: 8px;
            box-shadow: 1px 1px 2px #A6A6A6;
        }

        input[type=range]::-ms-fill-upper {
            background: rgb(255 171 34);
            border: 2px solid #F27B7F;
            border-radius: 8px;
            box-shadow: 1px 1px 2px #A6A6A6;
        }

        input[type=range]::-ms-thumb {
            margin-top: 1px;
            box-shadow: 1px 1px 2px #A6A6A6;
            border: 2px solid #F27B7F;
            height: 30px;
            width: 30px;
            border-radius: 0px;
            background: rgb(255 171 34);
            cursor: pointer;
        }

        input[type=range]:focus::-ms-fill-lower {
            background: rgb(255 171 34);
        }

        input[type=range]:focus::-ms-fill-upper {
            background: rgb(255 171 34);
        }

        .header {
            /* background-color: #0000; */
            display: flex;
            justify-content: space-between;
        }

        .logo {
            width: 60px;
            margin-left: 10px;
        }

        .coins {
            width: 30px;
        }

        .footer_icons {
            width: 100%;
        }

        .panel {
            width: 100%;
            /* background-color: #f3f3f3; */

        }


        /* {
            width: 100%;
        } */

        .btn-primary {
            background-color: rgb(255 171 34) !important;
            font-weight: 600;
            font-size: 17px;
        }

        .green {
            color: #0fd30f;
        }

        tr {
            border-color: #858585;
        }

        .btn::placeholder {
            color: #a3b0bb;
        }

        .my_modal {
            cursor: pointer;
        }

        /* new dice css */



        :root {
            --primary-color: #1e2a3a;
            --secondary-color: #607890;
            --accent-color: #f9bc60;
            --background-color: #f5f5f5;
            --box-shadow-color: 30, 42, 58;
        }




        /* DICES */

        .dice2 {
            /* display: none; */
            border-radius: 10px;
            box-shadow: rgba(var(--box-shadow-color), 0.35) 0px 5px 15px;
            height: 100px;
            position: relative;
            width: 100px;
        }

        .text-blue {
            color: #000;
            font-weight: 700;
            font-size: larger;
        }

        .scoreboard {
            /* background-image: url('public/images/scoreboard.webp');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain; */
            height: 100%;
            max-height: 434px;
            /* height: 340px; */
            /* margin-left: 20px; */
            /* background-image: linear-gradient(90deg, #a81a1a, #870de8); */
            background-color: #10242a;
            border: 4px solid #254852 !important;
            /* max-width: 300px; */
            width: 100%;
            overflow-y: scroll;
        }

        @media screen and (max-width: 350px) {
            .scoreboard {
                font-size: 11px;
            }
        }

        .bet_btn {
            background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #8A6E2F 40%, transparent 80%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #5d4a1f 62.5%, #5d4a1f 100%) !important;
            font-weight: 500;
            font-size: 14px;
            transition: transform .2s;
        }

        .bet_btn:hover {
            transform: scale(1.02);
        }

        /* //bet button  */

        .butn:link,
        .butn:visited {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            /* font-size: 2.5rem; */
            text-transform: uppercase;
            text-decoration: none;
            background-color: #5e16bd;
            /* background-image: linear-gradient(90deg, #501aa8, #870de8); */
            background-image: linear-gradient(90deg, #a81a1a, #870de8);
            padding: 10px;
            /* height: 6rem; */
            /* width: 40rem; */

            /* margin-right: 13px; */
            border-radius: 4px;
            border: none;
            color: #fff;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }

        .butn::before {
            background: #fff;
            content: "";
            height: 155px;
            opacity: 0;
            position: absolute;
            top: -50px;
            transform: rotate(35deg);
            width: 50px;
            transition: all 3000ms cubic-bezier(0.19, 1, 0.22, 1);
        }

        .butn::after {
            background: #fff;
            content: "";
            height: 20rem;
            opacity: 0;
            position: absolute;
            top: -50px;
            transform: rotate(35deg);
            transition: all 3000ms cubic-bezier(0.19, 1, 0.22, 1);
            width: 8rem;
        }

        .butn__new::before {
            left: -50%;
        }

        .butn__new::after {
            left: -100%;
        }

        .butn:hover,
        .butn:active {
            transform: translateY(-3px);
            color: #fff;
            box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.3);
        }

        .butn__new:hover::before {
            left: 120%;
            opacity: 0.5s;
        }

        .butn__new:hover::after {
            left: 200%;
            opacity: 0.6;
        }

        .butn span {
            z-index: 20;
        }

        /* even odd btns  */

        .three {
            /* background-color: #5e16bd; */
            background-color: #10242a;
            border: 4px solid #254852;
            transition: all 0.4s;
            transition-timing-function: cubic-bezier(0.5, 3, 0, 1);
            color: #fff;
        }

        .three:hover {
            transform: scale(1.2, 1.2);
            color: #fff;
        }

        .amount_btn {
            /* background-color: #5e16bd; */
            background-color: #10242a;
            border: 4px solid #254852 !important;
            /* border: 4px linear-gradient(90deg, #a81a1a, #870de8) !important; */
            /* transition: all 0.4s; */
            /* transition-timing-function: cubic-bezier(0.5, 3, 0, 1); */
            color: #fff;
            text-align: center;
        }

        .amount_btn::placeholder,
        .amount_btn:hover {
            color: #fff;
        }

        .amount_btn:focus {
            background-color: #10242a;
            border: 4px solid #254852 !important;
            color: #fff;
        }

        .footer {
            /* position: absolute; */
            /* bottom: 0; */
        }

        @media screen and (min-width: 1440px) {
            .body {
                min-height: 77vh;
            }
        }

        .error-text {
            font-size: 13px;
            margin-bottom: 16px;
        }

        .dice-margin {
            margin-top: 25px;
            margin-bottom: 25px;
        }

        .scoreboard-box {
            margin-top: 20px;
        }

        @media screen and (max-width: 767px) {
            .scoreboard-box {
                margin-top: 0px;
            }
        }

        .coin-show {
            width: 160px;
        }

        @media screen and (max-width: 400px) {
            .mobile-font {
                font-size: 12px !important;
            }

            .dice-margin {
                margin-top: 0px;
                margin-bottom: 0px;
            }

            .scoreboard {
                height: 300px;
            }

            .coin-show {
                width: 120px;
            }

            .coins {
                width: 25px;
            }

            .logo {
                width: 50px;
                margin-top: 4px;
            }

            .mobile-font-heading {
                font-size: 12px !important;
                margin-bottom: 4px;
                margin-top: 6px;
            }

            .dropdown-item {
                font-size: 13px;
            }

            .mobile-feather-icon {
                width: 20px;
                margin-left: 0px;
                margin-right: 3px;
            }

            .mobile-font-heading-2 {
                font-size: 15px;
            }

            .toastify {
                font-size: 11px !important;
            }

            input[type='radio']:checked:after {
                width: 20px;
                height: 20px;
                border-radius: 15px;
                top: -2px;
                left: -3px;
                position: relative;
                background-color: #000;
                content: '';
                display: inline-block;
                visibility: visible;
                border: 2px solid white;
            }
        }

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            /* background: #cbcbcb; */
            background: #101e22;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .secure-font {
            -webkit-text-security: disc;
        }
    </style>
</head>

<body class='' style='padding:0px !important'>
    <section id='header'>
        <div class='header bg_dark'>
            <a href='<?= base_url('/') ?>'><img class='p-0 logo img-responsive' src='<?= base_url('public/images/logo.webp') ?>' /></a>
            <div class="input-group my_modal coin-show" btn='wallet_btn' data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="mt-2 mb-2 bg-light input-group-text">
                    <img src='<?= base_url('public/images/cash3.webp') ?>' class='img-responsive p-0 coins' />
                </span>
                <input type="text" autocomplete="off" class="p-0 mobile-font text-blue mt-2 mb-2 btn form-control user_coins" readonly value='<?php if (isset($coins)) {
                                                                                                                                                    echo $coins;
                                                                                                                                                } ?>'>
            </div>
            <div class="dropdown">
                <a class='btn dropdown-toggle' data-bs-toggle="dropdown" style='padding-top:12px'><i class='mobile-feather-icon' style='color:#fff;' data-feather="user"></i></span></a>
                <ul class="dropdown-menu" style='font-size:14px'>
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='user-edit' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="user"></i><?= $username ?></a></li>
                    <?php } else { ?>
                        <li><a class="dropdown-item my_modal" id='login_btn' data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="log-in"></i> Login</a></li>
                        <li><a class="dropdown-item my_modal" id='register_btn' data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="edit"></i> Register</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='activity_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="activity"></i> Activity</a></li>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='fairness_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="clipboard"></i> Fairness</a></li>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='wallet_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="dollar-sign"></i> Deposit</a></li>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='support_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="headphones"></i> Support</a></li>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='withdraw_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="credit-card"></i> Withdraw</a></li>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='transaction_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="edit"></i> Transactions</a></li>
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class='mobile-feather-icon' style='color:#102d52;' data-feather="log-out"></i> Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
    <section id='body'>
        <div class='container body'>
            <!-- <form id='bet_form' class='p-0 col-xs-10 bg'> -->
            <!-- //new above  -->
            <div class='row m-3 bg col-xs-10 bg p-1 pt-3'>
                <div class='col-xs-12 col-md-6 col-lg-8'>
                    <div class='panel'>
                        <div class='next-round'>
                            <p class='h4 text-light mobile-font'> Next Round starts at <span id='timer'><?= date('H:i:s'); ?></span></p>
                        </div>
                        <div class='d-flex justify-content-center bg-light rounded'>
                            <div class='dice-margin btn-light' style='border-top-left-radius:10px;border-bottom-left-radius:10px;'>
                                <img class='dice1 mt-2' style='width:100%;min-width:100px;' src='<?= base_url('public/images/dice_' . $last_roll[0]['dice1'] . '.webp') ?>' />
                            </div>
                            <div class='dice-margin btn-light' style='border-top-left-radius:10px;border-bottom-left-radius:10px;'>
                                <img class='dice1 mt-2' style='width:100%;min-width:100px;' src='<?= base_url('public/images/dice_' . $last_roll[0]['dice2'] . '.webp') ?>' />
                            </div>
                        </div>
                        <label class="form-label small text-light mobile-font" style='font-weight:600;color:#a3b0bb'>Previous round winner : <?= $total_option . ' ( ' . $last_roll[0]['total'] . ' )' ?> , Bet for next round ?</label>
                        <div class='rounded-1 p-3 mb-4' style='background:#ffffff14'>
                            <!-- <div class='d-flex p-0 col-12'> -->
                            <div class='row m-0'>
                                <div class='col-6 col-md-4 p-1'>
                                    <input type='text' autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class='mb-1 form-control w-100 amount_btn mobile-font' placeholder='AMOUNT' id='amount' />
                                    <input type='text' readonly style='background:#10242a' id='win' placeholder='WIN' class='mobile-font mb-1 form-control w-100 amount_btn' />
                                </div>

                                <div class='col-6 col-md-4 p-1'>
                                    <button type='button' class="mobile-font mb-1 even w-100 btn three">EVEN</button>
                                    <button type='button' class="mobile-font mb-1 odd w-100 btn three">ODD</button>
                                </div>

                                <div class='col-12 col-md-4 p-1'>
                                    <button type='button' class="mobile-font mb-1 h-100 w-100 btn amount_btn reset">RESET</button>
                                </div>
                            </div>

                            <!-- <div class='col-2 p-1'>
                                        <input type='text' class='form-control w-100 amount_btn'/>
                                    </div> -->
                            <!-- <input class='btn bg_dark form-control' id='amount' style='border:none !important;color:#a3b0bb' placeholder='Amount' onkeypress="return event.charCode >= 48 && event.charCode <= 57" /> -->
                            <!-- <button class='btn text-light w-25 bg_dark'> Even </button>
                                    <button class='btn text-light w-25 bg_dark'> Odd </button> -->
                            <input type='hidden' name='bet_option' id='bet-option' />
                            <!-- </div> -->

                            <!-- </div> -->
                            <div class='row m-0 mt-1 p-1'>
                                <!-- <input type="range" class="form-range slider" min="2" max="12" step="1" id="customRange3"> -->
                                <!-- <button class='text-white btn bet_btn'>BET</button> -->
                                <a href="" class='butn butn__new w-100 mobile-font'><span>PLACE BET</span></a>
                                <!-- <button class='butn btn butn__new w-100'>PLACE BET</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class='scoreboard-box d-flex justify-content-center col-lg-4 col-md-6 mb-3'>
                    <div class='scoreboard'>
                        <div class='d-flex justify-content-center mb-2' style='margin-left:11px;background:#556672'>
                            <p class='text-light m-0 mobile-font'>Your bet history</p>
                        </div>
                        <div class='row table-responsive' style='width:80%;margin:auto;'>
                            <table class='table table-sm text-center  mobile-font' style='color:#a3b0bb;'>
                                <thead>
                                    <th>Bet option</th>
                                    <th>Wagered</th>
                                </thead>
                                <tbody>
                                    <?php if (isset($user_bet_history) && !empty($user_bet_history)) {
                                        foreach ($user_bet_history as $row) { ?>
                                            <tr>
                                                <td><?= $row['betoption']; ?></td>
                                                <td class='green'><?= $row['amount']; ?><i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan='2'> No bets found</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </form> -->
    </section>
    <section id='footer'>
        <div class='footer w-100 mt-5' style='display:flex;'>
            <div class='text-center p-1 w-25 my_modal' style="background-color: #111a1c;" btn='activity_btn' data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i style='color:#f2f2f2' class="mobile-feather-icon" data-feather="activity"></i><br>
                <span class='small' style='font-size:12px;color:#a3b0bb'>Activity</span>
            </div>
            <div class='text-center p-1 w-25 my_modal' style="background-color: #111a1c;" btn='fairness_btn' data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i style='color:#f2f2f2' class="mobile-feather-icon" data-feather="clipboard"></i><br>
                <span class='small' style='font-size:12px;color:#a3b0bb'>Fairness</span>
            </div>
            <div class='text-center p-1 w-25 my_modal' style="background-color: #111a1c;" btn='wallet_btn' data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i style='color:#f2f2f2' class="mobile-feather-icon" data-feather="dollar-sign"></i><br>
                <span class='small' style='font-size:12px;color:#a3b0bb'>Deposit</span>
            </div>
            <div class='text-center p-1 w-25 my_modal' style="background-color: #111a1c;" btn='support_btn' data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i style='color:#f2f2f2' class="mobile-feather-icon" data-feather="headphones"></i><br>
                <span class='small' style='font-size:12px;color:#a3b0bb'>Support</span>
            </div>
        </div>
    </section>
    <section id='modal'>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header btn-primary bg_dark text-light">
                        <h6 class="mobile-font-heading-2 modal-title" id="exampleModalLabel"></h6>
                        <button type="button" class="btn close-modal-btn p-0" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close" style="font-size:20px;color:#fff;"></i><br>
                        </button>
                    </div>
                    <div class="modal-body" id='activity' style='display:none'>
                        <div class='row p-4 table-responsive' style='max-height:300px;border-radius:10px;'>
                            <table class='table table-bordered table-striped table-sm text-center' style='background:#10242a;color:#a3b0bb'>
                                <thead>
                                    <th class='mobile-font'>Date</th>
                                    <th class='mobile-font'>Total</th>
                                    <th class='mobile-font'>Bet option</th>
                                </thead>
                                <tbody>
                                    <?php if (isset($previous_activity) && !empty($previous_activity)) {
                                        foreach ($previous_activity as $single) { ?>
                                            <tr>
                                                <td class='mobile-font' style='color:#a3b0bb'><?= date('d-m-Y', strtotime($single['created_at'])); ?></td>
                                                <td class='mobile-font' style='color:#a3b0bb'><?= $single['total']; ?></td>
                                                <td class='mobile-font' style='color:#a3b0bb'><?php if ($single['total'] % 2 == 0) {
                                                                                                    echo 'EVEN';
                                                                                                } else {
                                                                                                    echo 'ODD';
                                                                                                } ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-body" id='transaction' style='display:none'>
                        <div class='row p-4 pt-2 pb-1 table-responsive' style='max-height:300px;border-radius:10px;'>
                            <table class='table table-bordered table-striped table-sm text-center' style='background:#10242a;color:#a3b0bb'>
                                <thead>
                                    <th class='mobile-font'>Type</th>
                                    <th class='mobile-font'>Amount</th>
                                    <th class='mobile-font'>Status</th>
                                </thead>
                                <tbody>
                                    <?php if (isset($transactions) && !empty($transactions)) {
                                        foreach ($transactions as $single2) { ?>
                                            <tr>
                                                <?php if (isset($single2['with_user_amount'])) { ?>
                                                    <td class='mobile-font' style='color:#a3b0bb'> Withdraw</td>
                                                    <td class='mobile-font' style='color:#a3b0bb'><?= $single2['with_user_amount']; ?></td>
                                                    <td class='mobile-font' <?php if ($single2['with_status'] == 'PENDING') { ?> style="color:#ff4b4b" <?php } else { ?> style="color:#4bffac" <?php }  ?>'> <?= $single2['with_status']; ?></td>
                                                <?php } else { ?>
                                                    <td class='mobile-font' style='color:#a3b0bb'> Deposit</td>
                                                    <td class='mobile-font' style='color:#a3b0bb'><?= $single2['depo_user_amount']; ?></td>
                                                    <td class='mobile-font' style='color:#4bffac'>COMPLETED</td>
                                                <?php } ?>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-body" style='color:#102d52' id='fairness' style='display:none'>
                        <p class='m-0 mobile-font'>
                            This paper proposes a fair electronic gambling scheme for the Internet. The proposed scheme provides a unique link between payment and gambling outcome so that the winner can be ensured to get the payment. Since an optimal fair exchange method is used in gambling message exchange the proposed system guarantees that no one can successfully cheat during a gambling process. Our system requires an off-line Trusted Third Party (TTP). If a cheating occurs, the TTP can resolve the problem and make the gambling process fair.<br>
                            None of the user information are shared with the third party apps.
                        </p>
                    </div>
                    <div class="modal-body" id='wallet' style='display:none'>
                        <div class='row'>
                            <!-- <img src='<?= base_url('public/images/coupon.webp'); ?>'/> -->
                            <?php if ($first_deposit == 1) { ?>
                                <p class="bg-danger text-light w-auto m-auto mb-3">Get free 300$ on your First Deposit</p>
                            <?php } ?>
                            <label class='form-check-label mobile-font'>Deposit</label>
                            <div class='p-3 pt-2'>
                                <input type='text' value='' autocomplete="off" placeholder='Amount' onkeypress="return event.charCode >= 48 && event.charCode <= 57" class='mobile-font mb-2 deposit-amt form-control rounded' />
                                <button id="rzp-button1" class='mobile-font btn form-control bg_dark text-light rounded deposit-req'> Deposit </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body" id='withdraw' style='display:none'>
                        <div class='row'>
                            <p class='m-0 form-check-label mobile-font' style='line-height:1.2em;'>Withdraw</p>
                            <div class='p-3 pt-2'>
                                <input type='text' autocomplete="off" placeholder='Amount' onkeypress="return event.charCode >= 48 && event.charCode <= 57 " class='mobile-font mb-2 withdraw-amt form-control rounded' />
                                <button class='btn form-control mobile-font bg_dark text-light rounded withdraw-req'> Withdraw </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body" id='support' style='display:none'>
                        <form id='support_form' autocomplete='off'>
                            <p class='m-0 mobile-font' style='line-height:1.4em;'> Drop us a message and we will reply you back shortly</p>
                            <textarea class='support_msg mobile-font p-1 mt-2 w-100' name='msg' rows=3 style='resize:none'></textarea>
                            <p class='small support_err text-danger mb-0' style='display:none'>This field is required </p><br>
                            <div class='d-flex justify-content-center'>
                                <button class='w-50 btn mobile-font' style='background:#102d52;color:#fff'>Send</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body" id='register' style='display:none'>
                        <form id='register_form' autocomplete='off'>
                            <input type="text" class='form-control mb-1' name='user_name' placeholder='Username' />
                            <div class="text-danger error-text" id="error-user_name"></div>
                            <input type="text" class='form-control mb-1' name='user_email' placeholder='Email' />
                            <div class="text-danger error-text" id="error-user_email"></div>
                            <input type="text" class='form-control mb-1' name='user_phone' onkeypress="return event.charCode >= 48 && event.charCode <= 57 " placeholder='Number' />
                            <div class="text-danger error-text" id="error-user_phone"></div>
                            <input type="text" class='secure-font form-control mb-1' name='user_password' placeholder='Password' />
                            <div class="text-danger error-text" id="error-user_password"></div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="0" name='age_confirmation' id="age_confirmation">
                                <label class="form-check-label small">
                                    I am at least 18 years of age , and accept the Terms & Conditions.
                                </label>
                                <div class="text-danger error-text" id="error-age_confirmation"></div>
                            </div>
                            <div class='d-flex justify-content-center'>
                                <button class='w-50 btn' style='background:#102d52;color:#fff'>Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body" id='user-edit' style='display:none'>
                        <form id='user_edit_form'>
                            <p style='font-weight: 700;' class='mobile-font-heading'> Personal Information</p>
                            <input type="text" autocomplete="off" class='mobile-font form-control mb-1' name='edit_user_name' value='<?php if (isset($user_info) && !empty($user_info)) {
                                                                                                                                            echo $user_info[0]['user_name'];
                                                                                                                                        } ?>' placeholder='Username' />
                            <div class="text-danger error-text mb-1" id="error-edit_user_name"></div>
                            <input type="text" autocomplete="off" class='mobile-font form-control mb-1' disabled name='edit_user_email' value='<?php if (isset($user_info) && !empty($user_info)) {
                                                                                                                                                    echo $user_info[0]['user_email'];
                                                                                                                                                } ?>' placeholder='Email' />
                            <div class="text-danger error-text mb-1" id="error-edit_user_email"></div>
                            <input type="text" autocomplete="off" class='mobile-font form-control mb-1' name='edit_user_phone' value='<?php if (isset($user_info) && !empty($user_info)) {
                                                                                                                                            echo $user_info[0]['user_phone'];
                                                                                                                                        } ?>' onkeypress="return event.charCode >= 48 && event.charCode <= 57 " placeholder='Number' />
                            <div class="text-danger error-text mb-1" id="error-edit_user_phone"></div>
                            <p style='font-weight: 700;' class='mobile-font-heading'> Bank Details </p>

                            <div class='d-flex' style='align-items:center'>
                                <input type="radio" id='upi' class='payment-method me-1' value='UPI' name="payment-method" <?php if (isset($user_info) && !empty($user_info) && $user_info[0]['user_upi'] != '') { ?> checked <?php } ?>> <label for="upi" class='mobile-font' style='font-size:14px;'>UPI</label><br>
                            </div>
                            <div class='d-flex' style='align-items:center'>
                                <input type="radio" id='bank-detail' class='payment-method me-1' value='bank-account' name="payment-method" <?php if (isset($user_info) && !empty($user_info) && $user_info[0]['user_account_no'] != '') { ?> checked <?php } ?>> <label style='font-size:14px;' class='mobile-font' for="bank-detail">Bank Details </label>
                            </div>

                            <input type="text" autocomplete="off" class='mobile-font form-control mb-1 mt-1 upi-details' name='user_upi' value='<?php if (isset($user_info) && !empty($user_info)) {
                                                                                                                                                    echo $user_info[0]['user_upi'];
                                                                                                                                                } ?>' placeholder='UPi ID or Number' />
                            <div class="text-danger error-text mb-1" id="error-user_upi"></div>

                            <div id='user-bank-details' style='display:none'>
                                <input type="text" autocomplete="off" class='mobile-font form-control mb-1 mt-1' name='user_account_number' value='<?php if (isset($user_info) && !empty($user_info)) {
                                                                                                                                                        echo $user_info[0]['user_account_no'];
                                                                                                                                                    } ?>' placeholder='Account Number' />
                                <div class="text-danger error-text mb-1" id="error-user_account_number"></div>
                                <input type="text" autocomplete="off" class='mobile-font form-control mb-1 mt-1' name='user_account_name' value='<?php if (isset($user_info) && !empty($user_info)) {
                                                                                                                                                        echo $user_info[0]['user_account_name'];
                                                                                                                                                    } ?>' placeholder='Account Name' />
                                <div class="text-danger error-text mb-1" id="error-user_account_name"></div>
                                <input type="text" autocomplete="off" class='mobile-font form-control mb-1 mt-1' name='user_account_ifsc' value='<?php if (isset($user_info) && !empty($user_info)) {
                                                                                                                                                        echo $user_info[0]['user_account_ifsc'];
                                                                                                                                                    } ?>' placeholder='IFSC' />
                                <div class="text-danger error-text mb-1" id="error-user_account_ifsc"></div>
                            </div>

                            <div class='d-flex justify-content-center mt-3'>
                                <button class='w-50 btn bg_dark text-light mobile-font'>Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body" id='login' style='display:none'>
                        <form id='login_form' autocomplete='off'>
                            <input type="text" class='form-control mb-2' name='email' placeholder='Email' />
                            <input type="text" class='form-control secure-font' name='password' placeholder='Password' />
                            <div class='row text-right mb-2 login_msg' style='display:none'>
                                <span class='text-danger error-text'> Email or Password is Invalid </span>
                            </div>
                            <div class='mt-2 d-flex justify-content-center'>
                                <button class='w-50 btn' style='background:#102d52;color:#fff'>Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="<?= base_url('assets/js/bootstrap.js'); ?>"></script>
    <script src="<?= base_url('assets/js/feather.js'); ?>"></script>
    <script src="<?= base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?= base_url('assets/js/font-awesome.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('/assets/js/moment.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('/assets/js/razorpay-checkout.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('/assets/js/toastify.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('/assets/js/razorpay.js'); ?>"></script>
    <!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script> -->

    <script>
        $(document).ready(function() {

            <?php if (isset($user_info) && !empty($user_info) && $user_info[0]['user_upi'] != '') { ?>
                $('.upi-details').css('display', 'block');
                $('#user-bank-details').css('display', 'none');
            <?php } else { ?>
                $('#user-bank-details').css('display', 'block');
                $('.upi-details').css('display', 'none');
            <?php } ?>

            $('.payment-method').click(function() {
                // alert($(this).val());
                if ($(this).val() == 'UPI') {
                    $('.upi-details').css('display', 'block');
                    $('#user-bank-details').css('display', 'none');
                } else {
                    $('#user-bank-details').css('display', 'block');
                    $('.upi-details').css('display', 'none');
                }
            });

            $('.withdraw-req').click(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('withdraw') ?>",
                    data: {
                        amount: $('.withdraw-amt').val(),
                    },
                    cache: false,
                    dataType: "json",
                    success: function(data) {

                        if (data.result == 600) {
                            toast('info', 'Update bank details to withdraw');
                            return true;
                        } else if (data.result == 500) {
                            toast('info', 'User cannot be found');
                            return true;
                        } else if (data.result == 400) {
                            toast('info', 'Insufficient balance');
                            return true;
                        } else if (data.result == 300) {
                            toast('info', 'Minimum withdrawal is 1000');
                            return true;
                        } else if (data.result == 200) {
                            toast('info', 'Withdrawal requested !');
                            // $('.close-modal-btn').trigger('click');
                            // $('.user_coins').val(data.user_balance);
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                });
            });

            $('.even').click(function() {
                $('.even').css('border', '4px solid red');
                $('.odd').css('border', '4px solid #254852');
                $('#bet-option').val('EVEN');
            });

            $('.odd').click(function() {
                $('.odd').css('border', '4px solid red');
                $('.even').css('border', '4px solid #254852');
                $('#bet-option').val('ODD');
            });

            $('#amount').keyup(function() {
                var bet = $('#amount').val() * 90 / 100;
                if (bet == 0) {
                    bet = '';
                } else {
                    bet = parseInt(bet) + parseInt($('#amount').val());
                }

                $('#win').val(bet);
            });

            $('.reset').click(function() {
                $('#win').val('');
                $('#amount').val('');
                $('.even').css('border', '4px solid #254852');
                $('.odd').css('border', '4px solid #254852');
                $('#bet-option').val('');
            });

            $('.butn__new').click(function(e) {
                e.preventDefault();
                // alert();
                <?php if (!isset($user_id)) { ?>
                    let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('exampleModal')) // Returns a Bootstrap modal instance
                    modal.show();
                    $('#activity').css('display', 'none');
                    $('#fairness').css('display', 'none');
                    $('#settings').css('display', 'none');
                    $('#wallet').css('display', 'none');
                    $('#register').css('display', 'none');
                    $('#login').css('display', 'block');
                    $('#support').css('display', 'none');
                    $('#user-edit').css('display', 'none');
                    $('#withdraw').css('display', 'none');
                    $('#transaction').css('display', 'none');
                    $('.modal-title').html('Login');
                    // alert();
                <?php } else { ?>

                    if ($('#bet-option').val() == '') {
                        toast('info', 'Choose a betting option');
                        return true;
                    }

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('bet') ?>",
                        data: {
                            amount: $('#amount').val(),
                            betoption: $('#bet-option').val(),
                        },
                        cache: false,
                        dataType: "json",
                        success: function(data) {
                            if (data.result == 100) {
                                toast('info', 'You have already placed a bet for next round !');
                                return true;
                            } else if (data.result == 500) {
                                toast('info', 'User cannot be found');
                                return true;
                            } else if (data.result == 400) {
                                toast('info', 'Insufficient balance');
                                return true;
                            } else if (data.result == 300) {
                                toast('info', 'Amount must be greater than 0');
                                return true;
                            } else if (data.result == 200) {
                                toast('info', 'Bet placed !');
                                $('.user_coins').val(data.user_balance);
                                $('.reset').trigger('click');
                            }
                        }
                    });
                <?php } ?>
            });

            $('#login_form').submit(function(e) {
                e.preventDefault();
                $('.login_msg').css('display', 'none');
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Auth') ?>",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        // console.log(data.success);
                        if (data.result == '200') {
                            toast('info', 'Logged in');
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $('.login_msg').css('display', 'block');
                        }
                    }
                });
            });

            $('#register_form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('register') ?>",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.error) {
                            var i = 0;
                            $.each(data, function(key, value) {
                                if (value != '') {
                                    $("#error-" + key).html(value);
                                    $("#" + key).addClass("border-danger");
                                    if (i == 1) {
                                        $('#' + key).focus();
                                    }
                                    i++;
                                } else {
                                    $("#error-" + key).html(" ");
                                    $("#" + key).removeClass("border-danger");
                                }
                            });
                        } else {
                            toast('info', 'Registered Successfully');
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                });
            });


            $('#user_edit_form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('user_edit_form') ?>",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.error) {
                            var i = 0;
                            $.each(data, function(key, value) {
                                if (value != '') {
                                    $("#error-" + key).html(value);
                                    $("#" + key).addClass("border-danger");
                                    if (i == 1) {
                                        $('#' + key).focus();
                                    }
                                    i++;
                                } else {
                                    $("#error-" + key).html(" ");
                                    $("#" + key).removeClass("border-danger");
                                }
                            });
                        } else {
                            $('.close-modal-btn').trigger('click');
                            toast('info', 'User Details Updated !');
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                });
            });

            $('.my_modal').click(function() {
                // alert();
                if ($(this).attr('btn') == 'activity_btn') {
                    $('#activity').css('display', 'block');
                    $('#fairness').css('display', 'none');
                    $('#settings').css('display', 'none');
                    $('#wallet').css('display', 'none');
                    $('#support').css('display', 'none');
                    $('#register').css('display', 'none');
                    $('#login').css('display', 'none');
                    $('.modal-title').html('Previous Activity');
                    $('#withdraw').css('display', 'none');
                    $('#transaction').css('display', 'none');
                    $('#user-edit').css('display', 'none');
                }
                if ($(this).attr('btn') == 'fairness_btn') {
                    $('#activity').css('display', 'none');
                    $('#fairness').css('display', 'block');
                    $('#settings').css('display', 'none');
                    $('#wallet').css('display', 'none');
                    $('#support').css('display', 'none');
                    $('#register').css('display', 'none');
                    $('#login').css('display', 'none');
                    $('.modal-title').html('Fairness');
                    $('#withdraw').css('display', 'none');
                    $('#transaction').css('display', 'none');
                    $('#user-edit').css('display', 'none');
                }
                if ($(this).attr('btn') == 'support_btn') {
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#support').css('display', 'block');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'none');
                        $('.modal-title').html('Support');
                        $('#withdraw').css('display', 'none');
                        $('#transaction').css('display', 'none');
                        $('#user-edit').css('display', 'none');
                    <?php } else { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#user-edit').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'block');
                        $('#support').css('display', 'none');
                        $('#withdraw').css('display', 'none');
                        $('#transaction').css('display', 'none');
                        $('.modal-title').html('Login');
                    <?php } ?>
                }
                if ($(this).attr('id') == 'register_btn') {
                    $('#activity').css('display', 'none');
                    $('#fairness').css('display', 'none');
                    $('#settings').css('display', 'none');
                    $('#wallet').css('display', 'none');
                    $('#register').css('display', 'block');
                    $('#login').css('display', 'none');
                    $('#support').css('display', 'none');
                    $('.modal-title').html('Register');
                    $('#withdraw').css('display', 'none');
                    $('#transaction').css('display', 'none');
                    $('#user-edit').css('display', 'none');
                }
                if ($(this).attr('id') == 'login_btn') {
                    $('#activity').css('display', 'none');
                    $('#fairness').css('display', 'none');
                    $('#settings').css('display', 'none');
                    $('#wallet').css('display', 'none');
                    $('#register').css('display', 'none');
                    $('#user-edit').css('display', 'none');
                    $('#login').css('display', 'block');
                    $('#support').css('display', 'none');
                    $('.modal-title').html('Login');
                    $('#withdraw').css('display', 'none');
                    $('#transaction').css('display', 'none');
                }
                if ($(this).attr('btn') == 'withdraw_btn') {
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#withdraw').css('display', 'block');
                        $('#support').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'none');
                        $('#user-edit').css('display', 'none');
                        $('#transaction').css('display', 'none');
                        $('.modal-title').html('Withdraw');
                    <?php } else { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#user-edit').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'block');
                        $('#support').css('display', 'none');
                        $('#withdraw').css('display', 'none');
                        $('#transaction').css('display', 'none');
                        $('.modal-title').html('Login');
                    <?php } ?>
                }
                if ($(this).attr('btn') == 'wallet_btn') {
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#wallet').css('display', 'block');
                        $('#withdraw').css('display', 'none');
                        $('#transaction').css('display', 'none');
                        $('#support').css('display', 'none');
                        $('#user-edit').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'none');
                        $('.modal-title').html('Deposit');
                    <?php } else { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#user-edit').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'block');
                        $('#support').css('display', 'none');
                        $('#withdraw').css('display', 'none');
                        $('#transaction').css('display', 'none');
                        $('.modal-title').html('Login');
                    <?php } ?>
                }

                if ($(this).attr('btn') == 'user-edit') {
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#user-edit').css('display', 'block');
                        $('#withdraw').css('display', 'none');
                        $('#transaction').css('display', 'none');
                        $('#support').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'none');
                        $('.modal-title').html('User Details');
                    <?php } else { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#user-edit').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'block');
                        $('#support').css('display', 'none');
                        $('#withdraw').css('display', 'none');
                        $('#transaction').css('display', 'none');
                        $('.modal-title').html('Login');
                    <?php } ?>
                }

                if ($(this).attr('btn') == 'transaction_btn') {
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#user-edit').css('display', 'none');
                        $('#transaction').css('display', 'block');
                        $('#withdraw').css('display', 'none');
                        $('#support').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'none');
                        $('.modal-title').html('Transactions');
                    <?php } else { ?>
                        $('#transaction').css('display', 'none');
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#user-edit').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'block');
                        $('#support').css('display', 'none');
                        $('#withdraw').css('display', 'none');
                        $('.modal-title').html('Login');
                    <?php } ?>
                }
            });

            $('#support_form').submit(function(e) {
                e.preventDefault();
                $('.support_err').css('display', 'none');
                if ($('.support_msg').val() == '') {
                    $('.support_err').css('display', 'block');
                    return true;
                }

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('user_send_msg') ?>",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        // console.log(data.success);
                        if (data.result == '200') {
                            toast('info', 'Message Sent, you will receive a reply shortly !');
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000);
                        } else {
                            // $('.support_err').css('display', 'block');
                            toast('info', 'Something went wrong');
                        }
                    }
                });
            });

            feather.replace();
        });

        function timer() {
            var dt = new Date();
            var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

            // console.log(dt.getHours());
            if (dt.getHours() >= 18) {
                //time difference for next date
                // var nextday = dt.getDate();
                // var nextday =  moment().add('days', 1).format('L');
                // nextday = nextday+' 18:00:00';

                var new_time = 29 - dt.getHours();
                console.log(new_time);

            } else {
                console.log(time);
            }
        }

        function toast(classname, msg) {
            Toastify({
                text: msg,
                className: classname,
                style: {
                    background: "linear-gradient(90deg, #a81a1a, #870de8)",
                }
            }).showToast();
        }

        function update_balance(amount, payment_id) {
            // alert(amount);
            $.ajax({
                type: "POST",
                url: "<?= base_url('update_user_balance') ?>",
                data: {
                    amount: amount,
                    payment_id: payment_id
                },
                // contentType: false,
                cache: false,
                // processData: false,
                dataType: "json",
                success: function(data) {
                    if (data.result == '200') {
                        toast('info', 'Wallet updated !');
                        // $('.user_coins').val(data.user_balance);
                        // $('.close-modal-btn').trigger('click');
                        // $('.deposit-amt').val('');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        toast('info', 'Something went wrong !');
                    }
                }
            });
        }
    </script>
</body>

</html>