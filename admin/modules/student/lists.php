<?php

if(!defined('_INCODE'))
die('Access denied...');


$data = [
    'pageTitle' => 'Danh sách phòng trọ'
];

layout('header', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Kiểm tra phân quyền
// $groupId = getGroupId();

// $permissionData = getPermissionData($groupId);

// $check = checkPermission($permissionData, 'student', 'lists');
// if(!$check) {
//     redirect('admin/?module=');
// }

// $checkRoleAdd = checkPermission($permissionData, 'student', 'add');
// $checkRoleEdit = checkPermission($permissionData, 'student', 'edit');
// $checkRoleDelete = checkPermission($permissionData, 'student', 'delete');
// Xử lý lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody('get');
    

    // Xử lý lọc theo từ khóa
    if(!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        
        if(!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        }else {
            $operator = 'WHERE';
        }

        $filter .= " $operator fullname LIKE '%$keyword%'";

    }

    //Xử lý lọc theo groups
    if(!empty($body['class_id'])) {
        $classId = $body['class_id'];

        if(!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        }else {
            $operator = 'WHERE';
        }

        $filter .= " $operator class_id = $classId";

    }
}

if(isset($_POST['deleteMultip'])) {
    $numberCheckbox = $_POST['records'];
        $extract_id = implode(',', $numberCheckbox);
        $checkDelete = delete('student', "id IN($extract_id)");
        if($checkDelete) {
            setFlashData('msg', 'Xóa dữ liệu thông tin học sinh thành công');
            setFlashData('msg_type', 'suc');
        }
        redirect('?module=student&action=lists');
}


/// Xử lý phân trang

$allStudent = getRows("SELECT id FROM student $filter");
// 1. Xác định số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; // Mỗi trang có 3 bản ghi

//2. Tính số trang
$maxPage = ceil($allStudent / $perPage);


// 3. Xử lý số trang dựa vào phương thức GET
if(!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if($page < 1 and $page > $maxPage) {
        $page = 1;
    }
}else {
    $page = 1;
}


$offset = ($page - 1) * $perPage;
// Truy vấn lấy tất cả dữ liệu
// $listAllstudent = getRaw("SELECT student.id, thumb, fullname, birthday, sex, address, class.name
//                 FROM student INNER JOIN class ON student.class_id = class.id
//  $filter ORDER BY class.name ASC LIMIT $offset, $perPage");

$listAllstudent = getRaw("SELECT * FROM student $filter LIMIT $offset, $perPage");

// Truy vấn lấy ra danh sách nhóm
// $allClass = getRaw("SELECT id, class.name FROM class ORDER BY id");

// Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=student','', $queryString);
    $queryString = str_replace('&page='.$page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&'.$queryString;
}

$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');

?>

<?php
layout('navbar', 'admin', $data);
?>

<div class="container-fluid">
        <div id="MessageFlash">
            <?php getMsg($msg, $msgType);?> 
        </div>
    <hr/>
    <!-- Tìm kiếm , Lọc dưz liệu -->
    <form action="" method="get">
        <div class="row">
           <!-- <div class="col-3">
                <div class="form-group">
                    <select name="class_id" id="" class="form-select">
                        <option value="">Chọn lớp học</option>
                       <?php

                        if(!empty($allClass)) {
                            foreach($allClass as $item) {
                        ?>
                               <option value="<?php echo $item['id'] ?>" <?php  echo (!empty($classId) && $classId == $item['id'])?'selected':false; ?>>Lớp: <?php echo $item['name'] ?></option> 
                        
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
           </div> -->
           <div class="col-4">
                <input type="search" name="keyword" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo (!empty($keyword))? $keyword:false; ?>">
           </div>

           <div class="col">
                <button type="submit" class="btn btn-primary "> <i class="fa fa-search"></i></button>
           </div>
        </div>
        <input type="hidden" name="module" value="student">
    </form>

    <form action="" method="POST" class="mt-3">
        
        <a href="<?php echo getLinkAdmin('student', 'add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Thêm</a>
        <a href="<?php echo getLinkAdmin('student', 'lists'); ?>" class="btn btn-secondary"><i class="fa fa-history"></i> Refresh</a>
        <button type="submit" name="deleteMultip" value="Delete" onclick="return confirm('Bạn có chắn chắn muốn xóa không ?')" class="btn btn-danger"><i class="fa fa-trash"></i> Xóa</button>
        <a href="<?php echo getLinkAdmin('student', 'import'); ?>" class="btn btn-success minn"><i class="fa fa-upload"></i> Import</a>
        <a href="<?php echo getLinkAdmin('student', 'export'); ?>" class="btn btn-success minn"><i class="fa fa-save"></i> Xuất Excel</a>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="check-all"  onclick="toggle(this)">
                    </th>
                    <th wìdth="5%">ID</th>
                    <th>Ảnh</th>
                    <th>Họ tên</th>
                    <th width=10%>Ngày sinh</th>
                    <th width=10%>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th wìdth="3%">Thao tác</th>
                </tr>
            </thead>
            <tbody>
    
                <?php
                    if(!empty($listAllstudent)):
                        $count = 0; // Hiển thi số thứ tự
                        foreach($listAllstudent as $item):
                            $count ++;
    
                ?>
                <tr>
                    <td>
                            <input type="checkbox" name="records[]" value="<?= $item['id'] ?>">                    
                    </td>
                            
                        
                    <td><?php echo $count; ?></td>
                    <td>
                        <?php echo (isFontIcon($item['thumb']))?$item['thumb']:'<img src="'.$item['thumb'].'" width=30 height=30 style="border-radius: 15px; object-fit: cover;"/>' ?>
                    </td>
                    <td><a href="<?php echo getLinkAdmin('student','edit',['id' => $item['id']]); ?>"><?php echo $item['fullname']; ?></a></td>
                    <td><?php echo getDateFormat($item['birthday'],'d-m-Y'); ?></td> 
                    <td><?php echo $item['sex'] ?></td>
                    <td><?php echo $item['address'] ?></td>
                    <td><?php echo $item['SDT'] ?></td>
              
                    <td class="">
                        <a href="<?php echo getLinkAdmin('student','edit',['id' => $item['id']]); ?>" class="btn btn-warning btn-sm" ><i class="fa fa-edit"></i> </a>
                        <a href="<?php echo getLinkAdmin('student','delete',['id' => $item['id']]); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')"><i class="fa fa-trash"></i> </a>
                    </td>                
                   
                   
    
                <?php endforeach; else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="alert alert-danger text-center">Không có dữ liệu thông tin học sinh</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </form>

    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
        <ul class="pagination pagination-sm">
            <?php
                if($page > 1) {
                    $prePage = $page - 1;
                   echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'/?module=student'.$queryString. '&page='.$prePage.'">Pre</a></li>';
                }
            ?>

            <?php 
                // Giới hạn số trang
                $begin = $page - 2;
                $end = $page + 2;
                if($begin < 1) {
                    $begin = 1;
                }
                if($end > $maxPage) {
                    $end = $maxPage;
                }
                for($index = $begin; $index <= $end; $index++){  ?>
            <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?> ">
                <a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=student'.$queryString.'&page='.$index;  ?>"> <?php echo $index;?> </a>
            </li>
            <?php  } ?>
            
            <?php
                if($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'?module=student'.$queryString.'&page='.$nextPage.'">Next</a></li>';
                }
            ?>
        </ul>
    </nav> 

</div>

<?php

layout('footer', 'admin');
?>
<script>
    function toggle(__this){
       let isChecked = __this.checked;
       let checkbox = document.querySelectorAll('input[name="records[]"]');
        for (let index = 0; index < checkbox.length; index++) {
            checkbox[index].checked = isChecked
        }
    }
</script>
