<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<!-- Bootstrap 4 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" integrity="sha384-FZzYjKRMnAkvzCNBc8bKjjsE+mztm3qX5h5n8+wppA94UvCpU6eRtn6RPaE/hch" crossorigin="anonymous">
</head>
<body>
	<div class="container py-4">
		<?= $this->renderSection('content') ?>
	</div>
	<!-- Bootstrap 4 JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-zxXh0nzXc0vZKjE11zHDa/XNwJFtxKvN8UyW5QhBq3HakbITKj8Lu1dILU6R5m6B" crossorigin="anonymous"></script>
</body>
</html>
