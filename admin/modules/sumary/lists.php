<?php

if(!defined('_INCODE'))
die('Access denied...');

$data = [
    'pageTitle' => 'Thu/Chi - Tổng kết'
];

layout('header', 'admin', $data);
layout('breadcrumb', 'admin', $data);



// Xử lý lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody('get');

}

$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>

<?php
layout('navbar', 'admin', $data);
?>

<div class="container-fluid">

    <div id="MessageFlash">          
            <?php getMsg($msg, $msgType);?>          
    </div>
    
    <div class="box-content container">
        <!-- Tìm kiếm -->
        <form action="" method="get" style="margin-bottom: 40px">
            <div class="row">
                 <div class="col-3">
                    <input style="height: 50px" type="month" class="form-control" name="datebill" id="" value="<?php echo (!empty($datebill))? $datebill:$currentMonthYear; ?>">
                </div>

                <div class="col-3">
                    <select name="" id="" class="form-select">
                        <option value="">Tổng kết theo</option>
                        <option value="">Theo tháng</option>
                        <option value="">Theo quý</option>
                        <option value="">Theo năm</option>
                    </select>
                </div>

                <div class="col">
                    <button style="height: 50px; width: 50px" type="submit" class="btn btn-success"> <i class="fa fa-search"></i></button>
                </div>   
            </div>
            <input type="hidden" name="module" value="sumary">
        </form>

        <a href="<?php echo getLinkAdmin('collect'); ?>" class="btn btn-success min"><i class="fa fa-save"></i> Quản lý danh mục thu</a>
        <a href="<?php echo getLinkAdmin('spend'); ?>" class="btn btn-success min"><i class="fa fa-save"></i> Quản lý danh mục chi</a>
        <a href="<?php echo getLinkAdmin('receipt'); ?>" class="btn btn-success min"><i class="fa fa-save"></i> Quản lý phiếu thu</a>
        <a href="<?php echo getLinkAdmin('payment'); ?>" class="btn btn-success min"><i class="fa fa-save"></i> Quản lý phiếu chi</a>
        
        <h3 class="sumary-title">Thống kê doanh thu theo từng tháng</h3>
        <div class="report-receipt-spend">
            <div class="report-receipt">
                <p>Tổng khoản thu (tiền vào)</p>
                <div class="report-ts">
                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/trend-up.svg" alt="">
                    <p>1.500.000đ</p>
                </div>
            </div>

            <div class="report-spend">
                <p>Tổng khoản chi (tiền ra)</p>
                <div class="report-ts">
                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/trend-down.svg" alt="">
                    <p style="color: red">1.500.000đ</p>
                </div>
            </div>

            <div class="report-spend">
                <p>Lợi nhuận</p>
                <div class="report-ts">
                    <img src="" alt="">
                    <p>1.500.000đ</p>
                </div>
            </div>
        </div>
    <div>

</div>

<?php

layout('footer', 'admin');
?>

