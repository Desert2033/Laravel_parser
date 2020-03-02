<?php

namespace App\classes;

	use App\News;

    class Text
	{
		private $searchText;

		public function __construct()
		{
			$this->searchText = '/<p>(?!(.*?)<a(.*?)>(.*?)<\\/a>)(.*?)<\\/p>/is';
		}

		public function getText($News)
		{
			preg_match_all($this->searchText, $News, $text);
           $str = mb_convert_encoding( $text[4][0], "UTF-8");;
			return strip_tags($str); // возвращает строку текста новости
		}
	}
