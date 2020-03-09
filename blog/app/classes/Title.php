<?php

namespace App\classes;

class Title
{
	private $searchTitle;

	public function __construct()
	{
		$this->searchTitle = '/<h2 class="searchheadline"><a (.*?)>(.*?)<\\/a><\\/h2>/is';
	}

	public function getTitle($News){
		preg_match($this->searchTitle, $News, $title);
		return $title[2]; // возвращает только строку названия
	}
}

