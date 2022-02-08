<?php
/**
 * 基于搜索引擎的分词 
 * 通过把待分词的内容提交给搜索引擎，然后提取出红色文字部分，仅限于短文本分词
 * 
 * @author ushe
 * @link http://www.usheweb.com/
 */

namespace Usheweb\Analysis;

class AnalysisBase
{
	private $_contentAdapter = null;
	private $_searchEngines = array();

	public function setContentAdapter($contentAdapter)
	{
		$this->_contentAdapter = $contentAdapter;
	}

	public function setSearchEngines($_searchEngines)
	{
		$this->_searchEngines = $_searchEngines;
	}

	public function geKeywords($content)
	{
		$keywords = array();

		foreach ($this->_searchEngines as $key => $searchEngine) {
			$searchEngine->setContentAdapter($this->_contentAdapter);
			$searchEngine->setContent($content);
			$_keywords = $searchEngine->getKeywords();
			// echo $key;
			// var_dump($_keywords);
			array_splice($keywords, count($keywords), 0, $_keywords);
		}
		
		return array_unique($keywords);
	}
}