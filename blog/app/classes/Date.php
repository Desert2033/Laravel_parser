<?php

namespace App\classes;

	class Date
	{
		private $searchDate;

		public function __construct()
		{
			$this->searchDate = '/<p class="categorydate"><span (.*?)>(.*?)<\\/span><\\/p>/is';
		}

		public function getDate($News)
		{
			preg_match($this->searchDate, $News, $date);
			return $date[2]; // возвращает строку даты
		}
	}

?>
