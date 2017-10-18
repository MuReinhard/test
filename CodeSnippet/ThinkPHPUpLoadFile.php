<?php

/*
     * TP上传操作
     * @author ShiO
     * @date 2015年9月21日 14:14:09
     * 20M = 20971520B
     * 5M  = 5242880B
     */
function upload($savePath, $maxSize = 20971520, $exts = array('jpg', 'gif', 'png', 'jpeg', 'mp4'), $saveName = array()) {
    if (!$saveName) {
        $saveName = time() . mt_rand(1000, 9999);
    } elseif ($saveName === true) {
        $saveName = array('uniqid', '');
    }
    $upload = new \Think\Upload();
    // 实例化上传类
    $upload->maxSize = $maxSize;
    // 设置附件上传大小
    $upload->exts = $exts;
    // 设置附件上传类型
    $upload->savePath = $savePath . '/';
    // 设置附件上传（子）目录
    $upload->autoSub = true;
    // 开启子目录保存
    $upload->subName = array('date', 'Ymd');
    // 自动子目录命名规则
    $upload->saveName = $saveName;
    // 文件命名规则
    $upload->rootPath = './Public/Uploads/';
    // 文件上传根目录

    // 上传文件
    $info = $upload->upload();
    if (!$info) {// 上传错误提示错误信息
        return array(false, $upload->getError());
    } else {// 上传成功
        return array(true, $info);
    }
}