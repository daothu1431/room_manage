 <?php
  $userId = isLogin()['user_id'];
  $userDetail = getUserInfo($userId);

  // Kiểm tra phân quyền
$groupId = getGroupId();

$permissionData = getPermissionData($groupId);
?>
 
 
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module='; ?>" class="brand-link">
      <span class="brand-text font-weight-light text-uppercase">School</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo getLinkAdmin('users','profile') ?>" class="d-block"><?php echo $userDetail['fullname'];  ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo  _WEB_HOST_ROOT_ADMIN.'/?module=' ?>" class="nav-link  <?php echo (activeMenuSidebar('')) ? 'active':false;  ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?php echo activeMenuSidebar('student')?'menu-open':false; ?>">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('student')?'active':false; ?>">
              <i class="nav-icon fas fa-solid fa-graduation-cap"></i>
              <p>
                <?php $num = getRows("SELECT id FROM student") ?>
                Quản lý học sinh 
                <i class="right fas fa-angle-left"></i>
                <span class="badge badge-danger"><?php echo $num ?></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('student', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('student', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item has-treeview <?php echo activeMenuSidebar('groups')?'menu-open':false; ?>">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('groups')?'active':false; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Nhóm người dùng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('groups'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('groups', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php echo activeMenuSidebar('users')?'menu-open':false; ?>">
            <a href="#" class="nav-link  <?php echo activeMenuSidebar('users')?'active':false; ?>">
              <i class="nav-icon fas fa-user"></i>
              <?php $alluser = getRows("SELECT id FROM users") ?>
              <p>
                 Quản lý User
                <i class="right fas fa-angle-left"></i>
                <span class="badge badge-danger badge-sm"><?php echo $alluser ?></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('users', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('users', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>

          
          <?php if(checkPermission($permissionData, '', 'lists')): ?>
          <?php endif; ?>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
