<?php

namespace App\classes;

	class News
	{
		private $searchNews;

		public function __construct()
		{
			$this->searchNews = '/<div class="sno-animate">(.*?)<p>(.*?)<\\/p>(.*?)<\\/div>/is';
		}

		public function getNews($Site, $index)
		{
			preg_match_all($this->searchNews, $Site, $News);
			return $News[0][$index]; // возвращает элемент массива $News
		}

	}

?>
