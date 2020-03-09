<?php

namespace App\classes;

class CompareNews
{

	public function __construct()
	{
	}

public function compareNews($mass_news_bd, $mass_news, $count){

			if (isset($mass_news['image'])) {
				unset($mass_news['image']);
			}

		    $str_news1 = implode($mass_news); // right order
		    $str_news_hash1 = md5($str_news1);

		    for ($i = 0; $i < $count; $i++) {
		    	if (!isset($mass_news_bd[$i])) {
		    		break;
		    	}

		    	$mass2 = array($mass_news_bd[$i]['titleNews'],$mass_news_bd[$i]['dateNews'],$mass_news_bd[$i]['textNews'],$mass_news_bd[$i]['authorsNews']);
				$str_news2 = implode($mass2);
				$str_news_hash2 = md5($str_news2);

				if ($str_news_hash1 === $str_news_hash2) {
					return true;
				}

		    }

			return false;
		}

}

