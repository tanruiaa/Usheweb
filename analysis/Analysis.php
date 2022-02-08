<?php
/**
 * 基于搜索引擎的分词 
 * 通过把待分词的内容提交给搜索引擎，然后提取出红色文字部分，仅限于短文本分词
 * 
 * @author ushe
 * @link http://www.usheweb.com/
 */

namespace Usheweb\Analysis;

class Analysis
{
	private $_searchEngines = array('Baidu', 'So', 'Soso');
	// private $_searchEngines = array('So');
	private $_contentAdapter = 'File';

	private $_analysisBase = null;

	public function __construct($searchEngines = null)
	{
		if (is_array($searchEngines)) {
			$this->_searchEngines = $searchEngines;
		}

		$path = dirname(__FILE__);
		require "{$path}/ASearchEngine.php";
		require "{$path}/IContent.php";

		$searchEngines = array();
		foreach ($this->_searchEngines as $searchEngine) {
			require "{$path}/SearchEngine/{$searchEngine}.php";
			$_searchEngine = "\\Usheweb\\Analysis\\{$searchEngine}";
			$searchEngines[$searchEngine] = new $_searchEngine();
		}

		require "{$path}/Content/{$this->_contentAdapter}.php";
		$contentAdapte = "\\Usheweb\\Analysis\\{$this->_contentAdapter}";
		$contentAdapte = new $contentAdapte();

		require "{$path}/AnalysisBase.php";
		$this->_analysisBase  = new AnalysisBase();
		$this->_analysisBase->setContentAdapter($contentAdapte);
		$this->_analysisBase->setSearchEngines($searchEngines);
	}

	public function getKeywords($content)
	{
		return $this->_analysisBase->geKeywords($content);
	}
}