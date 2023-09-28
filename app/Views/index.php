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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino </title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/images/logo.png') ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Allan:wght@400;700&family=Sora:wght@200&display=swap');

        body {
            background-image: url('public/images/background.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            font-family: Sora;
        }

        .bg {
            /* background-color: #4B5893 !important; */
            background: linear-gradient(98.3deg, rgb(0, 0, 0) 10.6%, rgb(221 23 23) 97.7%);
            border-radius: 8px;
            /* background-image: url('public/images/casinoboard.png');
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
            border-color: #a3b0bb;
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
            background-image: url('public/images/scoreboard.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            /* margin-left: 20px; */
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
    </style>
</head>
<?php // print_r($last_roll);?>
<body class=''>
    <section id='header'>
        <div class='header bg_dark'>
            <a href='<?= base_url('/') ?>'><img class='p-0 logo img-responsive' src='<?= base_url('public/images/logo.png') ?>' /></a>
            <div class="input-group my_modal" btn='wallet_btn' data-bs-toggle="modal" data-bs-target="#exampleModal" style='width:140px'>
                <span class="mt-2 mb-2 bg-light input-group-text">
                    <!-- <i class="ms-1 fa fa-dollar" style="font-size:20px;color:#a3b0bb;"></i>  -->
                    <img src='<?= base_url('public/images/cash3.png') ?>' class='img-responsive p-0 coins' />
                </span>
                <input type="text" class="text-blue mt-2 mb-2 btn form-control user_coins" readonly value='<?php if (isset($coins)) {
                                                                                                                echo $coins;
                                                                                                            } ?>'>
            </div>
            <div class="dropdown">
                <a class='btn dropdown-toggle' data-bs-toggle="dropdown" style='padding-top:12px'><i style='color:#fff' data-feather="user"></i></span></a>
                <ul class="dropdown-menu" style='font-size:14px'>
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        <li><a class="dropdown-item"><i style='color:#102d52;' data-feather="user"></i><?= $username ?></a></li>
                    <?php } else { ?>
                        <li><a class="dropdown-item my_modal" id='login_btn' data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"><i style='color:#102d52;' data-feather="log-in"></i> Login</a></li>
                        <li><a class="dropdown-item my_modal" id='register_btn' data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"><i style='color:#102d52;' data-feather="edit"></i> Register</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='activity_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i style='color:#102d52;' data-feather="activity"></i> Activity</a></li>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='fairness_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i style='color:#102d52;' data-feather="clipboard"></i> Fairness</a></li>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='wallet_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i style='color:#102d52;' data-feather="credit-card"></i> Wallet</a></li>
                    <li><a class="dropdown-item my_modal" style='cursor:pointer' btn='support_btn' data-bs-toggle="modal" data-bs-target="#exampleModal"><i style='color:#102d52;' data-feather="headphones"></i> Support</a></li>
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i style='color:#102d52;' data-feather="log-out"></i> Logout</a></li>
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
                            <p class='h4 text-light'> Next Round starts at <span id='timer'><?= date('H:i:s'); ?></span></p>
                        </div>
                        <div class='d-flex justify-content-center bg-light rounded'>
                            <div class='w50- m-4 ms-0 me-0 btn-light' style='border-top-left-radius:10px;border-bottom-left-radius:10px;'>
                                <img class='dice1 mt-2' src='<?= base_url('public/images/dice_'.$last_roll[0]['dice1'].'.png') ?>' />
                            </div>
                            <div class='w50- m-4 ms-0 me-0 btn-light' style='border-top-left-radius:10px;border-bottom-left-radius:10px;'>
                                <img class='dice1 mt-2' src='<?= base_url('public/images/dice_'.$last_roll[0]['dice2'].'.png') ?>' />
                            </div>
                        </div>
                        <label class="form-label small text-light" style='font-weight:600;color:#a3b0bb'>Bet for next round ?</label>
                        <div class='rounded-1 p-3 mb-4' style='background:#ffffff14'>
                            <!-- <div class='d-flex p-0 col-12'> -->
                            <div class='row m-0'>
                                <div class='col-4 p-1'>
                                    <input type='text' autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class='mb-1 form-control w-100 amount_btn' placeholder='AMOUNT' id='amount' />
                                    <input type='text' readonly style='background:#10242a' id='win' placeholder='WIN' class='mb-1 form-control w-100 amount_btn' />
                                </div>

                                <div class='col-4 p-1'>
                                    <button type='button' class="mb-1 even w-100 btn three">EVEN</button>
                                    <button type='button' class="mb-1 odd w-100 btn three">ODD</button>
                                </div>

                                <div class='col-4 p-1'>
                                    <button type='button' class="mb-1 h-100 w-100 btn amount_btn reset">RESET</button>
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
                                <a href="" class='butn butn__new w-100'><span>PLACE BET</span></a>
                                <!-- <button class='butn btn butn__new w-100'>PLACE BET</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-xs-12 col-md-6 col-lg-4 scoreboard' style='height:450px;padding:0px 50px 0px 50px;'>
                    <div class='row table-responsive' style='width:180px;height:200px;border-radius:10px;margin:auto;margin-top:150px !important; '>
                        <table class='table table-sm text-center' style='color:#a3b0bb'>
                            <thead>
                                <th>Wagered</th>
                                <th>Profit</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td class='green'>33<i class="ms-1 fa fa-dollar" style="font-size:15px;color:#a3b0bb;"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- </form> -->
    </section>
    <section id='footer'>
        <div class='footer w-100 mt-5' style='display:flex;'>
            <div class='text-center p-1 w-25 my_modal' style="background-color: #111a1c;" btn='activity_btn' data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i style='color:#f2f2f2' data-feather="activity"></i><br>
                <span class='small' style='font-size:12px;color:#a3b0bb'>Activity</span>
            </div>
            <div class='text-center p-1 w-25 my_modal' style="background-color: #111a1c;" btn='fairness_btn' data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i style='color:#f2f2f2' data-feather="clipboard"></i><br>
                <span class='small' style='font-size:12px;color:#a3b0bb'>Fairness</span>
            </div>
            <div class='text-center p-1 w-25 my_modal' style="background-color: #111a1c;" btn='wallet_btn' data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i style='color:#f2f2f2' data-feather="credit-card"></i><br>
                <span class='small' style='font-size:12px;color:#a3b0bb'>Wallet</span>
            </div>
            <div class='text-center p-1 w-25 my_modal' style="background-color: #111a1c;" btn='support_btn' data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i style='color:#f2f2f2' data-feather="headphones"></i><br>
                <span class='small' style='font-size:12px;color:#a3b0bb'>Support</span>
            </div>
        </div>
    </section>
    <section id='modal'>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header btn-primary" style=' background-color:#102d52 !important'>
                        <h5 class="modal-title" id="exampleModalLabel">Previous Activity</h5>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close" style="font-size:30px;color:#fff;"></i><br>
                        </button>
                    </div>
                    <div class="modal-body" id='activity' style='display:none'>
                        <div class='row p-4 table-responsive' style='max-height:300px;border-radius:10px;'>
                            <table class='table table-bordered table-striped table-sm text-center' style='color:#a3b0bb'>
                                <thead>
                                    <th>Previous Rolls</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-body" style='color:#102d52' id='fairness' style='display:none'>
                        This paper proposes a fair electronic gambling scheme for the Internet. The proposed scheme provides a unique link between payment and gambling outcome so that the winner can be ensured to get the payment. Since an optimal fair exchange method is used in gambling message exchange the proposed system guarantees that no one can successfully cheat during a gambling process. Our system requires an off-line Trusted Third Party (TTP). If a cheating occurs, the TTP can resolve the problem and make the gambling process fair.<br>
                        None of the user information are shared with the third party apps.
                    </div>
                    <div class="modal-body" id='wallet' style='display:none'>
                        <!-- <div class='row'> -->
                            <!-- <label class='form-check-label'>Deposit</label> -->
                            <!-- <form id='payment-form'>
                                <script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_LwlcxlhCLkhkRi" async> </script>
                            </form> -->

                            <!-- <button id="rzp-button1" class="btn btn-outline-dark btn-lg"><i class="fas fa-money-bill"></i> Own Checkout</button> -->
                            <!-- <span class='h5'> Deposit </span> -->
                            <!-- <div class='row'>
                                <label class='form-check-label mt-4 h6' style='line-height:1.5'>GET 100 % Bonus on First Deposit ! <mark>Coupon Code - NEW USER </mark></label>
                                <div class='d-flex'>
                                    <a href='https://payments-test.cashfree.com/forms/test33'>
                                        <button class='btn w-100 bg_dark text-light'> Deposit Now</button>
                                    </a>
                                </div>
                            </div> -->
                        <!-- </div> -->
                        <div class='row'>
                            <label class='form-check-label'>Deposit</label>
                            <div class='d-flex'>
                                <input type='text' value='1000' placeholder='Amount' onkeypress="return event.charCode >= 48 && event.charCode <= 57 " class='deposit-amt form-control w-75 rounded-0 rounded-start' />
                                <button id="rzp-button1" class='btn w-25 bg_dark text-light rounded-0 rounded-end deposit-req'> Deposit </button>
                            </div>
                        </div>
                        <hr class='w-100 mt-4'>
                        </hr>
                        <div class='row'>
                            <label class='form-check-label'>Withdraw</label>
                            <div class='d-flex'>
                                <input type='text' placeholder='Amount' onkeypress="return event.charCode >= 48 && event.charCode <= 57 " class='withdraw-amt form-control w-75 rounded-0 rounded-start' />
                                <button class='btn w-25 bg_dark text-light rounded-0 rounded-end withdraw-req'> Withdraw </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body" id='settings' style='display:none'>
                        settings<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>
                    </div>
                    <div class="modal-body" id='support' style='display:none'>
                        <span>Drop us a message and we will reply you back shortly</span>
                        <textarea class='p-1 mt-2 w-100' rows=4 style='resize:none'></textarea><br>
                        <div class='d-flex justify-content-center'>
                            <button class='w-50 btn' style='background:#102d52;color:#fff'>Send</button>
                        </div>
                    </div>
                    <div class="modal-body" id='register' style='display:none'>
                        <form id='register_form'>
                            <input type="text" class='form-control mb-2' name='user_name' placeholder='Username' />
                            <div class="text-danger" id="error-user_name"></div>
                            <input type="text" class='form-control mb-2' name='user_email' placeholder='Email' />
                            <div class="text-danger" id="error-user_email"></div>
                            <input type="text" class='form-control mb-2' name='user_phone' onkeypress="return event.charCode >= 48 && event.charCode <= 57 " placeholder='Number' />
                            <div class="text-danger" id="error-user_phone"></div>
                            <input type="text" class='form-control mb-1' name='user_password' placeholder='Password' />
                            <div class="text-danger" id="error-user_password"></div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="0" name='age_confirmation' id="age_confirmation">
                                <label class="form-check-label small">
                                    I am at least 18 years of age , and accept the Terms & Conditions.
                                </label>
                                <div class="text-danger" id="error-age_confirmation"></div>
                            </div>
                            <div class='d-flex justify-content-center'>
                                <button class='w-50 btn' style='background:#102d52;color:#fff'>Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body" id='login' style='display:none'>
                        <form id='login_form'>
                            <input type="text" class='form-control mb-2' name='email' placeholder='Email' />
                            <input type="text" class='form-control mb-1' name='password' placeholder='Password' />
                            <div class='row text-center mb-2 login_msg' style='display:none'>
                                <span class='text-danger'> Email or Password is Invalid </span>
                            </div>
                            <div class='d-flex justify-content-center'>
                                <button class='w-50 btn' style='background:#102d52;color:#fff'>Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="text/javascript" src="<?= base_url('/assets/js/moment.js'); ?>"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript" src="<?= base_url('/assets/js/razorpay.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            // setInterval(timer, 1000);
            // $('.deposit-amt').keyup(function(){
            //     if($(this).val() > 200 ){
            //         $('.deposit-req').prop('disabled',false);
            //     }else{
            //         $('.deposit-req').prop('disabled',true);
            //     }
            // });

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
                        if (data.result == 500) {
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
                            $('.btn').trigger('click');
                            $('.user_coins').val(data.user_balance);
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
                }else{
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
                            } else  if (data.result == 500) {
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
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
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
                }
                if ($(this).attr('btn') == 'support_btn') {
                    $('#activity').css('display', 'none');
                    $('#fairness').css('display', 'none');
                    $('#settings').css('display', 'none');
                    $('#wallet').css('display', 'none');
                    $('#support').css('display', 'block');
                    $('#register').css('display', 'none');
                    $('#login').css('display', 'none');
                    $('.modal-title').html('Support');
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
                }
                if ($(this).attr('id') == 'login_btn') {
                    $('#activity').css('display', 'none');
                    $('#fairness').css('display', 'none');
                    $('#settings').css('display', 'none');
                    $('#wallet').css('display', 'none');
                    $('#register').css('display', 'none');
                    $('#login').css('display', 'block');
                    $('#support').css('display', 'none');
                    $('.modal-title').html('Login');
                }
                if ($(this).attr('btn') == 'wallet_btn') {
                    <?php if (isset($user_id) && !empty($user_id)) { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#wallet').css('display', 'block');
                        $('#support').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'none');
                        $('.modal-title').html('Wallet');
                    <?php } else { ?>
                        $('#activity').css('display', 'none');
                        $('#fairness').css('display', 'none');
                        $('#settings').css('display', 'none');
                        $('#wallet').css('display', 'none');
                        $('#register').css('display', 'none');
                        $('#login').css('display', 'block');
                        $('#support').css('display', 'none');
                        $('.modal-title').html('Login');
                    <?php } ?>
                }
            });

            feather.replace();
            // $('.slider').change(function() {
            //     // alert($(this).val());
            //     $('#total').val($(this).val());
            // });
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
    </script>
</body>

</html>