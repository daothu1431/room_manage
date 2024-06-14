<?php
// function isActive($module) {
//   return strpos($_SERVER['REQUEST_URI'], $module) !== false ? 'active' : '';
// }

?>

<style> 
  .link__menu.active .menu__item {
    box-shadow: 1px 1px 10px #15a05c;
    border-bottom: 6px solid #15a05c; /* Example active border */
}
</style>

<!-- Main content -->
<div class="">
  <section class="content">
    <div class="container-fluid">
      <div class="menu__list">
        <!-- Item 1 -->
        <a href="<?php echo getLinkAdmin('room') ?>" class="link__menu ">
          <div class="menu__item">
            <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/room.png" class="menu__item-image" alt="">
            <p class="menu__item-title">Quản lý phòng</p>
          </div>
        </a>

        <!-- Item 2 -->
        <a href="<?php echo getLinkAdmin('tenant') ?>" class="link__menu ">
          <div class="menu__item">
            <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/client.png" class="menu__item-image" alt="">
            <p class="menu__item-title">Quản lý khách thuê</p>
          </div>
        </a>

        <!-- Item 3 -->
        <a href="<?php echo getLinkAdmin('contract'); ?>" class="link__menu ">
          <div class="menu__item">
            <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/contract.png" class="menu__item-image" alt="">
            <p class="menu__item-title">Quản lý hợp đồng</p>
          </div>
        </a>

        <!-- Item 4 -->
        <a href="<?php echo getLinkAdmin('services'); ?>" class="link__menu ">
          <div class="menu__item">
            <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/client.png" class="menu__item-image" alt="">
            <p class="menu__item-title">Quản lý dịch vụ</p>
          </div>
        </a>

        <!-- Item 5 -->
        <a href="<?php echo getLinkAdmin('bill'); ?>" class="link__menu ">
          <div class="menu__item">
            <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/invoice.png" class="menu__item-image" alt="">
            <p class="menu__item-title">Quản lý hóa đơn</p>
          </div>
        </a>

        <!-- Item 6 -->
        <a href="<?php echo getLinkAdmin('sumary'); ?>" class="link__menu ">
          <div class="menu__item">
            <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/room.png" class="menu__item-image" alt="">
            <p class="menu__item-title">Thu/Chi - Tổng kết</p>
          </div>
        </a>

        <!-- Item 7 -->
        <a href="<?php echo getLinkAdmin('users'); ?>" class="link__menu ">
          <div class="menu__item">
            <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/invoice.png" class="menu__item-image" alt="">
            <p class="menu__item-title">Người dùng hệ thống</p>
          </div>
        </a>

        <!-- Item 8 -->
        <a href="<?php echo getLinkAdmin('groups'); ?>" class="link__menu ">
          <div class="menu__item">
            <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/invoice.png" class="menu__item-image" alt="">
            <p class="menu__item-title">Nhóm người dùng</p>
          </div>
        </a>

        <!-- Item 9 -->
        <a href="<?php echo getLinkAdmin('rental_history'); ?>" class="link__menu ">
          <div class="menu__item">
            <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/invoice.png" class="menu__item-image" alt="">
            <p class="menu__item-title">Lịch sử hợp đồng</p>
          </div>
        </a>
      </div>
    </div>
  </section>
</div>
