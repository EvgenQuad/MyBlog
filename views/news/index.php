<?php include ROOT.'/views/layouts/header.php';?>
	
	<div class='container'>
		<?php 
			if(isset($newsList)):
				foreach ($newsList as $newsItem):	

		?>
	
			<article>
				<div>
					<div class='image'>
						<img src="<?php echo News::getImage($newsItem['id']); ?>" alt=""/>
					</div>
					<h2 class="title">
						<a href='/news/<?php echo $newsItem['id'];?>'><?php echo $newsItem['title']?></a>
					</h2>
					<p class="content">
						<?php echo (substr($newsItem['content'],0,1000)."...");?>	
					</p>
					<div class="clearfix"></div>
				</div>
				<p class="date"><?php echo $newsItem['date'];?></p>
			</article>

		<?php 
			endforeach;
			endif;
		?>

		<?php echo $pagination -> get(); ?>
		
	</div>
	
<?php include ROOT.'/views/layouts/footer.php';?>
			
	