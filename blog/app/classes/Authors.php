<?php

namespace App\classes;

	class Authors
	{
		private $searchAuthors;

		public function __construct()
		{
			$this->searchAuthors = '/<p>(.*?)<a (.*?)>(.*?)<\\/a>(.*?)<\\/p>/is';
		}

		public function getAuthors($News)
		{
			preg_match_all($this->searchAuthors, $News, $authors);

			if (!isset($authors[0][0]))
            {
                return null;
            }
			return strip_tags($authors[0][0]); // возвращает строку авторов
		}
	}

?>
