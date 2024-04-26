<?php
if (!defined('_INCODE')) die('Access Deined...');
/*
 * File này chứa chức năng đăng nhập
 * */

$data = [
    'pageTitle' => 'Đăng nhập hệ thống'
];

layout('header-login','admin', $data);

//Xử lý đăng nhập
if (isPost()){
    $body = getBody();
    if (!empty(trim($body['email'])) && !empty(trim($body['password']))){
        //Kiểm tra đăng nhập
        $email = $body['email'];
        $password = $body['password'];

        //Truy vấn lấy thông tin user theo email
        $userQuery = firstRaw("SELECT id, password FROM users WHERE email='$email' AND status=1");

        if (!empty($userQuery)){
            $passwordHash = $userQuery['password'];
            $user_id = $userQuery['id'];
            if (password_verify($password, $passwordHash)){

                //Tạo token login
                $tokenLogin = sha1(uniqid().time());

                //Insert dữ liệu vào bảng login_token
                $dataToken = [
                    'user_id' => $user_id,
                    'token' => $tokenLogin,
                    'create_at' => date('Y-m-d H:i:s')
                ];

                $insertTokenStatus = insert('login_token', $dataToken);
                if ($insertTokenStatus){
                    //Insert token thành công       
                    //Lưu loginToken vào session
                    setSession('loginToken', $tokenLogin);
                    //Chuyển hướng qua trang quản lý users
                    redirect('admin');
                }

            }else{
                setFlashData('msg', '** Mật khẩu không chính xác!');
                setFlashData('msg_type', 'err');
                setFlashData('old', $body);
               
            }
        }else{
            setFlashData('msg', '** Email chưa được kích hoạt!');
            setFlashData('msg_type', 'err');
            setFlashData('old', $body);
           
        }
    }else{
        setFlashData('msg', '** Vui lòng kiểm tra email và mật khẩu!');
        setFlashData('msg_type', 'err');
        setFlashData('old', $body);
       
    }

    redirect('admin/?module=auth&action=login');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$old = getFlashData('old');
?>
<div class="row">
    <div class="col-3" style="margin: 20px auto;">
        <div class="login">
        <h5 class="text-center">WElCOME TO EDUCATION</h5>
        <p class="text-center" style="color: #b2b1b1; margin-bottom: 20px">Hệ thống quản lý website Education</p>

        <div id="MessageFlash">
            <?php getMsg($msg, $msgType);?> 
        </div>

        <form action="" method="post">
            
            <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Địa chỉ email..." value="<?php echo old('email', $old); ?>">
            </div>
            <div class="form-group">
            <label for="">Mật khẩu</label>
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu...">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=forgot">Quên mật khẩu?</a></p>
        </form>
        </div>
    </div>
</div>
<?php

layout('footer-login', 'admin');

