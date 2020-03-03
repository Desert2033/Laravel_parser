<?php

    namespace App\classes;
    use App\classes\News;
    use App\classes\Date;
    use App\classes\Site;
    use App\classes\Text;
    use App\classes\Authors;
    use App\classes\Title;

	require_once 'headers.php';

	class Parser
	{
		private $countNews;
		private $Site;
		private $News;
		private $Title;
		private $Authors;
		private $Date;
		private $Text;
		private $Image;
		private $mass_news;

		public function __construct()
		{
            $this->countNews = 9;
			$this->Site = new Site();
			$this->News = new News();
			$this->Title = new Title();
			$this->Authors = new Authors();
			$this->Date = new Date();
			$this->Text = new Text();
			$this->Image = new Image();
		}

		public function Parse()
		{

			for ($i = 0; $i < $this->countNews; $i++) {

				$titleNews = $this->Title->getTitle($this->News->getNews($this->Site->getSite(), $i));
			    $authorsNews = $this->Authors->getAuthors($this->News->getNews($this->Site->getSite(), $i));
			    $dateNews = $this->Date->getDate($this->News->getNews($this->Site->getSite(), $i));
			    $textNews = $this->Text->getText($this->News->getNews($this->Site->getSite(), $i));
			    $imageNews = $this->Image->getImage($this->News->getNews($this->Site->getSite(), $i));

			    $this->mass_news[$i] = array('title' => $titleNews, 'date' => $dateNews, 'text' => $textNews, 'authors' => $authorsNews, 'image' => $imageNews);
			}

			return $this->mass_news;
		}

		public function getCount(){
			return $this->countNews;
		}

		public function setCount($count){
				$this->countNews = $count;
		}

}
