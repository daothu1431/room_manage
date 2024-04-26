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

<?php
layout('footer', 'admin');