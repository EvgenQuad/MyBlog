<?php include ROOT.'/views/layouts/header.php';?>
	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<form action="#" method="post" enctype="multipart/form-data">
					<input  type="text" name="title" class="form-control"><br>
					<textarea name="content" rows="10" class="form-control"></textarea><br>	
					<input type="file" name="image" ><br>
					<input type="submit" name="submit" class="btn btn-default" value="Post">
					<br>
					<br>
				</form>
			</div>
		</div>
	</div>

<?php include ROOT.'/views/layouts/footer.php';?>
