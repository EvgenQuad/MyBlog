<?php 
	class News
	{
		const SBD = 3; //Show By Default

		// повертає одну новину з відповідним id
		public static function getNewsItemById($id)
		{
			$id = intval($id);

			if ($id){ 
				
				$db = Db::getConnection();
				

				$result = $db -> query ('SELECT * FROM news WHERE id=' . $id);

				// $result -> setFetchMode(PDO::FETCH_NUM);
				$result -> setFetchMode(PDO::FETCH_ASSOC);

				$newsItem = $result -> fetch();

				return $newsItem;

			}	
			

		}
		// повертає масив новин
		public static function getNewsList($page = 1)
		{

			$page = intval($page);
			$offset = ($page - 1) * self::SBD;

			$db = Db::getConnection();
			
			$newList = array ();

			$result = $db -> query ('SELECT id, title, date, content FROM news ORDER BY date DESC LIMIT ' . self::SBD . ' OFFSET ' . $offset);

			$i = 0;

			while ($row = $result -> fetch()){
				$newsList[$i]['id'] = $row['id'];
				$newsList[$i]['title'] = $row['title'];
				$newsList[$i]['date'] = $row['date'];
				$newsList[$i]['content'] = $row['content'];
				$i++;
			}
			if(isset($newsList)){
				return $newsList;
			}
		}

		public static function getTotalNews()
		{
			$db = Db::getConnection();
			$result = $db -> query('SELECT count(date)+1 AS count FROM news');
			$result -> setFetchMode(PDO::FETCH_ASSOC);
			$row = $result -> fetch();

			return $row['count'];
		}
		


		public static function createPost($title, $content)
    	{
	        $db = Db::getConnection();

	        $sql = 'INSERT INTO news (title, content) VALUES (:title, :content)';

	        $result = $db->prepare($sql);
	        $result->bindParam(':title', $title);
	        $result->bindParam(':content', $content);
	        
	        if($result->execute()){
	        	return $db->lastInsertId();
	        }
	        else{
	        	return 0;
	        }
    	}


    	public static function getImage($id)
	    {
	        $noImage = 'no-image.jpg';
	        $path = '/upload/images/news/';

	        $pathToImage = $path . $id . '.jpg';

	        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToImage)) {
	            return $pathToImage;
	        }
	        return $path . $noImage;
	    }

	   	public static function export_csv($id)
		{
			$filename=$_SERVER['DOCUMENT_ROOT'].'/upload/tables/table.csv';
			$delim=','; 	
			$enclosed='"'; 	 	
			$escaped='\\'; 	 	
			$lineend='\\r\\n';

			$db = Db::getConnection();

			if(file_exists($filename)) {
				unlink($filename); 
			} 
			
			$result = $db -> query ("SELECT title, date, content INTO OUTFILE '" . $filename . "' FIELDS TERMINATED BY '" . $delim . "' ENCLOSED BY '" . $enclosed . "' ESCAPED BY '" .'\\'. $escaped . "' LINES TERMINATED BY '" . $lineend . "' FROM news WHERE id=" . $id);
			if($result){
				return $filename;
			}
			else{
				return false;
			}
		}

		function file_force_download($file)
		{
			if (file_exists($file)) {
				if (ob_get_level()) {
					ob_end_clean();
				}
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=' . basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));

				readfile($file);
				exit;
			}
		}




	}

 ?>