<?php
/**
 * 基于搜索引擎的分词 
 * 通过把待分词的内容提交给搜索引擎，然后提取出红色文字部分，仅限于短文本分词
 * 
 * @author ushe
 * @link http://www.usheweb.com/
 */

namespace Usheweb\Analysis;

class Baidu extends ASearchEngine
{
	protected $_url = 'http://www.baidu.com/s?wd=';

	public function getkeywords()
	{
		$content = $this->getContent();
		preg_match_all("|<em>(.*)</em>|iU", $content, $matches);

		if (isset($matches[1])) {
			$matches = $matches[1];
		} else {
			$matches = array();
		}

		foreach ($matches as &$value) {
			$value = strtolower($value);
		}

		$matches = array_unique($matches);
		return $matches;
	}
}