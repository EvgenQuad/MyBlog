<?php include ROOT.'/views/layouts/header.php';?>
	<div class='container'>
		<article>
			<div>
				<div class='image'>
					<img src="<?php echo News::getImage($newsItem['id']); ?>" alt=""/>
				</div>
				<h2 class="title">
					<?php echo $newsItem['title']?>
				</h2>
				<p class="content"> 
					<?php echo $newsItem['content'];?>	
				</p>
				<div class="clearfix"></div>
			</div>
			<p class="date">
				<a class='btn btn-primary' href="/news/<?php echo $newsItem['id'];?>/download">DOWNLOAD</a>	
				<?php echo $newsItem['date'];?>
			</p>
		</article>
	</div>
<?php include ROOT.'/views/layouts/footer.php';?>