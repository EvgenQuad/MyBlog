<?php 
	
	include_once ROOT.'/models/News.php';
	include_once ROOT.'/components/Pagination.php';
	

	class NewsController
	{
		// список всіх новин
		public function actionIndex($page = 1)
		{	

			$newsList = array();
			$newsList = News::getNewsList($page);

			$total = News::getTotalNews();

			$pagination = new Pagination($total, $page, News::SBD, 'page-');

			require_once(ROOT.'/views/news/index.php');

			return true;
		}

		// перегляд однієї сторінки
		public function actionView($id)
		{
			if ($id){
				$newsItem = News::getNewsItemById($id);

				require_once(ROOT.'/views/news/view.php');
				
			}

			return true;
		}

		public function actionAdd()
		{
	        if (isset($_POST['submit'])) {

	            $title = $_POST['title'];
	            $content = $_POST['content'];

	            $id = News::createPost($title, $content);

	            if ($id) { 
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
                    }
                };

	            header("Location: /");
	        }

			require_once(ROOT.'/views/news/add.php');
			return true;
		}

		public function actionDownload($id)
		{
			$result = News::export_csv($id);
			if($result){
				News::file_force_download($result);
			}			
			
		}
	}

?>
