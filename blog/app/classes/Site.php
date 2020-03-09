<?php

    namespace App\classes;

	class Site
	{
		private $site;
		private $path;

		public function __construct()
		{
			$this->path = 'https://dailyillini.com/news/';
			$this->site = file_get_contents($this->path);
		}

		public function getSite()
		{
			return $this->site;
		}
	}

?>
