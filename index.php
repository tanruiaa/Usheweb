<?php
/**
 * 基于搜索引擎的分词 
 * 通过把待分词的内容提交给搜索引擎，然后提取出红色文字部分，仅限于短文本分词
 * 
 * @author ushe
 * @link http://www.usheweb.com/
 */

use \Usheweb\Analysis\Analysis;

header("Content-type:text/html;charset=utf-8");

require dirname(__FILE__) ."/Analysis.php";
// $se = array('Baidu', 'So', 'Soso');
$se = array('So');
$analysis = new Analysis($se);
// var_dump($analysis->getKeywords('PHP设计模式'));
var_dump($analysis->getKeywords('我爱北京天安门'));