<?php

if(!defined('_INCODE'))
die('Access denied...');

$data = [
    'pageTitle' => 'Danh sách nhóm người dùng'
];

layout('header', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$currentMonthYear = date('Y-m');

// Xử lý lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody('get');

    // Xử lý lọc theo từ khóa
    if(!empty($body['datebill'])) {
        $datebill = $body['datebill'];
        
        if(!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        }else {
            $operator = 'WHERE';
        }

        $filter .= " $operator bill.create_at LIKE '%$datebill%'";

    }
}

$allGroup = getRaw("SELECT * FROM groups");

// Xử lý thêm người dùng
if(isPost()) {
    // Validate form
    $body = getBody(); // lấy tất cả dữ liệu trong form
    $errors = [];  // mảng lưu trữ các lỗi
    
    //Valide họ tên: Bắt buộc phải nhập, >=5 ký tự
    if(empty(trim($body['name']))) {
        $errors['name']['required'] = '** Bạn chưa nhập tên danh mục';
    }
   
   // Kiểm tra mảng error
  if(empty($errors)) {
    // không có lỗi nào
    $dataInsert = [
        'name' => $body['name'],
    ];

    $insertStatus = insert('groups', $dataInsert);
    if ($insertStatus) {
        setFlashData('msg', 'Thêm nhóm người dùng mới thành công');
        setFlashData('msg_type', 'suc');
        redirect('?module=groups');
    }

  }else {
        // Có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra chính xác thông tin nhập vào');
        setFlashData('msg_type', 'err');
        setFlashData('errors', $errors);
        setFlashData('old', $body);  // giữ lại các trường dữ liệu hợp lê khi nhập vào
    }

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


    <!-- Them -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h4 style="margin: 20px 0">Thêm nhóm người dùng mới</h4>
            <hr />
            <form action="" method="post" class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Tên nhóm <span style="color: red">*</span></label>
                        <input type="text" placeholder="Tên nhóm" name="name" id="" class="form-control" value="<?php echo old('name', $old); ?>">
                        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                    </div>

                </div>
                <div class="form-group">                    
                    <div class="btn-row">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm nhóm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="box-content box-service">
        <div class="collect-left">
            <div class="collect-left_top">
                <div>
                    <h3>Quản lý nhóm người dùng</h3>
                    <i>Các danh mục thu được áp dụng</i>
                </div>
                <button onclick="return alert('Chức năng này đang trong thời gian phát triển thêm')" class="service-btn" style="border: none; color: #fff"><i class="fa fa-plus"></i></button>
            </div>

            <div class="collect-list">
             <?php 
                foreach($allGroup as $item) {
                    ?>
                        <!-- Item 1 -->
                        
                            <div class="collect-item">
                                <div class="service-item_left">
                                    <div class="service-item_icon">
                                        <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/service-icon.svg" alt="">
                                    </div>

                                    <div>
                                        <h6><?php echo $item['name'] ?></h6>
                                        <i>Đang áp dụng cho hệ thống</i>
                                    </div>
                                </div>

                                <div class="service-item_right">
                                    <div class="edit">
                                        <a title="Phân quyền" href="<?php echo getLinkAdmin('groups','permission',['id' => $item['id']]); ?>"><img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/permission.png" style="width: 100%; object-fit: cover" alt=""></a>                                 
                                    </div>
                                    <!-- <div class="del">
                                        <a href="<?php echo getLinkAdmin('groups','delete',['id' => $item['id']]); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa dịch vụ không ?')"><img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/service-delete.svg" alt="" disable></a>
                                    </div> -->
                                </div>
                            </div>
                        
                    <?php
                }
                
             ?>
            </div>
        </div>
    <div>
</div>

<?php

layout('footer', 'admin');
?>

