<?php

namespace App\classes;

	class Image
	{
		private $searchImg;

		public function __construct()
		{
			$this->searchImg = '/<img src="(.*?)"(.*?)>/is';
		}

		public function getImage($News)
		{
			preg_match($this->searchImg, $News, $img);

			if (count($img) == 0)
				return 0;
			else{

				$image = file_get_contents($img[1]); // берем картинку по ссылке
                $image = base64_encode($image);
                $image = addslashes($image);
				return $image; // возвращаем саму картинку
			}
		}
	}


