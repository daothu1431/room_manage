<?php

$body = getBody();

if(!empty($body['id'])) {
    $studentId = $body['id'];
    $name = firstRaw("SELECT fullname FROM student WHERE id = $studentId");
    // Kiểm tra Id có tồn tại trong hệ thống hay không
    $userDetail = getRows("SELECT id, fullname FROM student WHERE id=$studentId");
    

    if($userDetail > 0) {
        // Thực hiện xóa
       
            $deleteStudent = delete('student', "id=$studentId");
            if($deleteStudent) {
                setFlashData('msg', 'Xóa học sinh '.'<strong>'.$name['fullname'].'</strong>'.' thành công');
                setFlashData('msg_type', 'suc');
            }else {
                setFlashData('msg', 'Lỗi hệ thống! Vui lòng thử lại sau');
                setFlashData('msg_type', 'err');
            }
    }else {
        setFlashData('msg', 'Học sinh không tồn tại trên hệ thống');
        setFlashData('msg_type', 'err');
    }
}

redirect('?module=student&action=lists');