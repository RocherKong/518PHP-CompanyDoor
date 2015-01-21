<?php
/**
 * 获取数据字典
 * @param $key      //键值，方便查找数据
 * @param $fileName //字典文件名 目录Common/Dict/
 * @return mixed
 */
function dict($key = '', $fileName = 'Setting') {
    static $_dictFileCache  =   array();
    $file = MODULE_PATH . 'Common' . DS . 'Dict' . DS . $fileName . '.php';
    if (!file_exists($file)){
    	unset($_dictFileCache);
    	return null;
    }
    if(!$key && !empty($_dictFileCache)) return $_dictFileCache;
    if ($key && isset($_dictFileCache[$key])) return $_dictFileCache[$key];
    $data = require_once $file;
    $_dictFileCache = $data;
	return $key ? $data[$key] : $data;
}