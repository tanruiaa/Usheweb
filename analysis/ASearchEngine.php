<?php
/**
 * 基于搜索引擎的分词 
 * 通过把待分词的内容提交给搜索引擎，然后提取出红色文字部分，仅限于短文本分词
 * 
 * @author ushe
 * @link http://www.usheweb.com/
 */

namespace Usheweb\Analysis;

abstract class ASearchEngine
{
	protected $_contentAdapter = null;
	protected $_content = '';
	protected $_url = '';

	public function setContentAdapter($contentAdapter)
	{
		$this->_contentAdapter = $contentAdapter;
	}

	public function setContent($content)
	{
		$this->_content = $content;
	}

	public function __construct($contentAdapter = null, $content = '')
	{
		$this->_contentAdapter = $contentAdapter;
		$this->_content = $content;
	}

	public function getContent()
	{
		$url = "{$this->_url}{$this->_content}";
		return $this->_contentAdapter->getContent($url);
	}

	abstract public function getkeywords();
}