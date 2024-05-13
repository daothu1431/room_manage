<?php
if(!isLogin()) {
    redirect('admin/?module=auth&action=login');
} 

$data = [
    'pageTitle' => 'Tổng quan'
];

layout('header', 'admin', $data);
layout('breadcrumb', 'admin', $data);


?>

<?php
layout('navbar', 'admin', $data);
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
                    <a href=""><div class="dashboard-link"></div></a>
                </div>
                
        </div>
    </div>
</div>

<?php
layout('footer', 'admin');