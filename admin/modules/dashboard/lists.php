<?php
if(!isLogin()) {
    redirect('admin/?module=auth&action=login');
} 

$data = [
    'pageTitle' => 'Tổng quan'
];

$userId = isLogin()['user_id'];
$userDetail = getUserInfo($userId);  
$roomId = $userDetail['room_id'];


if($userDetail['group_id'] == 7) {
    layout('header', 'admin', $data);
    layout('breadcrumb', 'admin', $data);
} else {
    layout('header-tenant', 'admin', $data);
    layout('sidebar', 'admin', $data);
}




?>

<?php
if($userDetail['group_id'] == 7) {
    layout('navbar', 'admin', $data);
}
?>
<?php 
if($userDetail['group_id'] == 7) {
    ?>
        <div class="container-fluid">
            <div class="box-content dashboard-content">
                <div class="content-left">

                    <div class="total-room">
                        <div class="content-left-title">
                            <div class="content-left-icon">
                                <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/content-left-icon.svg" alt="">
                            </div>
                            <p class="total-desc">Tổng số phòng</p>
                        </div>
                        <p class="total-count">12</p>
                    </div>
                    
                    <div class="content-left-child">
                        <div class="child-one">
                            <div class="content-left-title">
                                <div class="content-left-icon">
                                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/st.svg" alt="">
                                </div>
                                <p class="total-desc">Tổng số phòng có thể cho thuê</p>
                            </div>
                            <p class="total-count">12</p>
                            <a href=""><div class="dashboard-link"></div></a>
                        </div>

                        <div class="child-two">
                            <div class="content-left-title">
                                <div class="content-left-icon">
                                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/st.svg" alt="">
                                </div>
                                <p class="total-desc">Tổng số phòng đang trống</p>
                            </div>
                            <p class="total-count">12</p>
                            <div class="dashboard-link"><a href=""></a></div>
                        </div>

                    </div>


                    <div class="content-left-child">
                        <div class="child-three">
                            <div class="content-left-title">
                                <div class="content-left-icon">
                                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/st.svg" alt="">
                                </div>
                                <p class="total-desc">Tổng số phòng đang trong hạn hợp đồng</p>
                            </div>
                            <p class="total-count">12</p>
                            <a href=""><div class="dashboard-link"></div></a>
                        </div>

                        <div class="child-four">
                            <div class="content-left-title">
                                <div class="content-left-icon">
                                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/st.svg" alt="">
                                </div>
                                <p class="total-desc">Tổng số phòng đã hết hạn hợp đồng</p>
                            </div>
                            <p class="total-count">12</p>
                            <div class="dashboard-link"><a href=""></a></div>
                        </div>

                    </div>

                </div>

                <div class="content-right">
                        <div class="child-five">
                            <div class="content-left-title">
                                <div class="content-left-icon background-icon">
                                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/st.svg" alt="">
                                </div>
                                <p class="total-desc">Tổng số khách thuê</p>
                            </div>
                            <p class="total-count">12</p>
                            <a href=""><div class="dashboard-link"></div></a>
                        </div>

                        <div class="child-six">
                            <div class="content-left-title">
                                <div class="content-left-icon background-icon">
                                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/st.svg" alt="">
                                </div>
                                <p class="total-desc">Tổng số hóa đơn</p>
                            </div>
                            <p class="total-count">12</p>
                            <a href=""><div class="dashboard-link"></div></a>
                        </div>

                        <div class="child-seven">
                            <div class="content-left-title">
                                <div class="content-left-icon background-icon">
                                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/st.svg" alt="">
                                </div>
                                <p class="total-desc">Lợi nhuận</p>
                            </div>
                            <p class="total-count">12</p>
                        </div>
                        
                </div>
            </div>
        </div>
    <?php
} else {
    $billNear = firstRaw("SELECT * FROM bill WHERE room_id = $roomId ORDER BY create_at DESC LIMIT 1");
    $id = $billNear['id'];
    $date = firstRaw("SELECT MONTH(create_at) AS month, YEAR(create_at) AS year FROM bill WHERE id=$id");
    $tenantId = $billNear['tenant_id'];

    $tenantDetail = firstRaw("SELECT * FROM tenant WHERE id = $tenantId");
    $roomtDetail = firstRaw("SELECT * FROM room WHERE id = $roomId");
    $msg =getFlashData('msg');
    $msgType = getFlashData('msg_type');
?>

<div id="MessageFlash">          
    <?php getMsg($msg, $msgType);?>          
</div>
    
<!-- <body style="display: flex; justify-content: center; margin-top: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f7fafc;"> -->
    <h3 style="padding: 20px 0 20px 20px">Hóa đơn thu tiền nhà T<?php echo $date['month'] ?>/<?php echo $date['year'] ?> - <?php echo $billNear['trangthaihoadon'] == 0 ? '<span class="btn-kyhopdong-err">Chưa thanh toán</span>' : '<span class="btn-kyhopdong-suc">Đã thanh toán</span>' ?></h3>
    <div class="bill-content" style="margin: 0 auto;width: 60%; height: auto; background: #fff; box-shadow: 1px 1px 10px #ccc; text-align: center; padding: 50px 20px; line-height: 1.2;">
        <img style="width: 150px; " src="https://quanlytro.me/images/logo-quan-ly-tro.png" alt="">
        <h2 style="font-size: 28px; margin: 10px 0;">Hóa đơn tiền thuê nhà</h2>
        <h4 style="margin-top: 10px; margin-bottom: 15px">Tháng <?php echo $date['month'] ?>/<?php echo $date['year'] ?></h4>
        <p style="font-size: 14px;">Địa chỉ: 597 - Nguyễn Bỉnh Khiêm, Đằng Lâm, Hải An, Hải Phòng</p>
        <p>Mã hóa đơn: <b style="color: red; font-size: 18px"><?php echo $billNear['mahoadon'] ?></b></p>
        <div class="rowOne" style="display: flex; justify-content: space-around;">
            <p style="font-size: 14px; margin: 0;">Kính gửi: <b><?php echo $tenantDetail['tenkhach'] ?></b></p>
            <p style="font-size: 14px; margin: 0">Số điện thoại: <b>0<?php echo $tenantDetail['sdt'] ?></b></p>
        </div>
        <div class="rowTwo" style="display: flex; justify-content: space-around; margin-top: 10px;">
            <p style="font-size: 14px;">Đơn vị: <b><?php echo $roomtDetail['tenphong'] ?></b></b></p>
            <p style="font-size: 14px;">Lý do thu tiền: <b>Thu tiền hàng tháng</b></p>
        </div>

        <table border="1" cellspacing="0" width="100%" cellpadding="10" style="text-align: start;">
            <tr>
                <td><b>Khoản thu</b></td>
                <td><b>Chi tiết</b></td>
                <td><b>Thành tiền</b></td>
            </tr>
            <tr>
                <td style="font-size: 14px;"><b>Tiền phòng</b></td>
                <td>30 ngày x <?php echo number_format($roomtDetail['giathue'], 0, ',', '.') ?>đ</td>
                <td style="font-size: 16px;"><b><?php echo number_format($roomtDetail['giathue'], 0, ',', '.') ?> đ</b></td>
            </tr>
            <tr>
                <td style="font-size: 14px;"><b>Tiền điện</b></td>
                <td>Tính tiền: (Số cũ: <?php echo $billNear['sodiencu'] ?> - Số mới: <?php echo $billNear['sodienmoi'] ?>) x 4.000đ</td>
                <td style="font-size: 16px;"><b><?php echo number_format($billNear['tiendien'], 0, ',', '.') ?> đ</b></td>
                
            </tr>
            <tr>
                <td style="font-size: 14px;"><b>Tiền nước</b></td>
                <td>Tính tiền: (Số cũ: <?php echo $billNear['sonuoccu'] ?> - Số mới: <?php echo $billNear['sonuocmoi'] ?>) x 20.000đ</td>
                <td style="font-size: 16px;"><b><?php echo number_format($billNear['tiennuoc'], 0, ',', '.') ?> đ</b></td>
            </tr>
            <tr>
                <td style="font-size: 14px;"><b>Tiền rác (người)</b></td>
                <td>Tính tiền: <?php echo $billNear['songuoi'] ?> x 10.000đ</td>
                <td style="font-size: 16px;"><b><?php echo number_format($billNear['tienrac'], 0, ',', '.') ?>đ</b></td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;"><b>Tiền Wifi</b></td>
                <td>Tính tiền: <?php echo $billNear['chuky'] ?> x 50.000đ</td>
                <td style="font-size: 16px;"><b><?php echo number_format($billNear['tienmang'], 0, ',', '.') ?> đ</b></td>
            </tr>
            <tr>
                <td style="font-size: 14px;"><b>Nợ cũ</b></td>
                <td><b><?php echo number_format($billNear['nocu'], 0, ',', '.') ?> đ</b></td>
                <td style="font-size: 16px;"><b><?php echo number_format($billNear['nocu'], 0, ',', '.') ?> đ</b></td>
            </tr>
            <tr>
                <td style="font-size: 14px;"><b>Tổng tiền</b></td>
                <td colspan="2" style="text-align: right; font-size: 18px; color: #dc3545;"><b><?php echo number_format($billNear['tongtien'], 0, ',', '.') ?> đ</b></td>
            </tr>
            <tr>
                <td style="font-size: 14px;"><b>Thanh toán</b></td>
                <td colspan="2">
                   <div style="display: flex; gap: 50px">
                        <img style="width: 200px; height: 200px;" src="https://jeju.com.vn/wp-content/uploads/2020/05/vnpay-qr-23-06-2020-2.jpg" alt="">
                        <div>
                            <p style="color: red"><i><b>Lưu ý:</b></i></p>
                            <p>Nội dung thanh toán: <b><i>Mã hóa đơn + Tên phòng</i></b></p>
                        </div>
                   </div>
                </td>
            </tr>
        </table>

    </div>
<!-- </body> -->
</html>

<?php
}

layout('footer', 'admin');