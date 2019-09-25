<?php 
	
	session_start();
	if (!isset($_SESSION['para_assistir']) || !count($_SESSION['para_assistir'])) {
		$_SESSION['para_assistir'] = [];
	}
	if (!isset($_SESSION['disponiveis']) || !count($_SESSION['disponiveis'])) {
		
		$_SESSION['disponiveis'] = array(
			'Game of Thrones',
			'La casa de papel',
			'Big Little Lies',
			'The Hausting of Hill House',
			'Westworld',
			'Tha Handmaid\'s Tale',
		);
	} else {
		// $ultima = count($_SESSION['disponiveis'])-1;
		// unset($_SESSION['disponiveis'][$ultima]);
	}
	if (isset($_GET['de']) && $_GET['de']) {
		
		$id = $_GET['id'];
		switch ($_GET['de']) {
			case 'disponiveis':
				
				if (isset($_SESSION['disponiveis'][$id])) {
					$_SESSION['para_assistir'][] = $_SESSION['disponiveis'][$id];
				}
				unset($_SESSION['disponiveis'][$id]);
				break;
			case 'para_assistir':
				$para = $_GET['para'];
				if ($para == 'disponiveis') {
					if (isset($_SESSION['para_assistir'][$id])) {
						$_SESSION['disponiveis'][] = $_SESSION['para_assistir'][$id];
					}
					unset($_SESSION['para_assistir'][$id]);
					
				} else {
					if (isset($_SESSION['para_assistir'][$id])) {
						$_SESSION['assistidos'][] = $_SESSION['para_assistir'][$id];
					}
					unset($_SESSION['para_assistir'][$id]);
				}
				
				break;
			
			case 'assistidos':
				if (isset($_SESSION['assistidos'][$id])) {
					$_SESSION['para_assistir'][] = $_SESSION['assistidos'][$id];
				}
				unset($_SESSION['assistidos'][$id]);
				
				break;
		
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de séries 🎞</title>

	<link href="style.css?v=<?= rand() ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light&display=swap" rel="stylesheet">

</head>
<body>
	
	<h1 id="site_title">Minha lista de Séries 📽</h1>
	
	<div class="col-33">
		<h2 class="category_title">🎞 Disponíveis
			<span> id=_"myBtn">+</span>
		</h2>
		<ul>
			<?php 
				foreach ($_SESSION['disponiveis'] as $index => $serie) {
					echo "	
						<li>
							$serie
							<a href=\"?de=disponiveis&id=$index\">
								➡️
							</a>
						</li>";
				}
			?>
		</ul>
	</div>

	<div class="col-33">
		<h2 class="category_title">🍿 Para Assistir</h2>
		<ul>
			<?php 
				foreach ($_SESSION['para_assistir'] as $index => $serie) {
					echo "	
						<li>
							$serie
							<a href=\"?de=para_assistir&para=disponiveis&id=$index\">
								⬅️
							</a>
							<a href=\"?de=para_assistir&para=assistidos&id=$index\">
								➡️
							</a>
						</li>";
				}
			?>
		</ul>
	</div>

	<div class="col-33">
		<h2 class="category_title">🥰 Assistidos</h2>
		<ul>
			<?php 
				foreach ($_SESSION['assistidos'] as $index => $serie) {
					echo "	
						<li>
							$serie
							<a href=\"?de=assistidos&id=$index\">
								⬅️
							</a>
						</li>";
				}
			?>
		</ul>
	</div>

	

<!-- The Modal -->
	<div id="myModal" class="modal">

<!-- Modal content -->
	<div class="modal-content">
        <span class="close">&times;</span>
		<p>..Nova Série..</p>
		<form>
			<input type="text" class="input" name="nome" value="">
			<
		</form>
    </div>

</div>

<!-- <pre>
<?php 
	print_r($_SESSION);
	?>
</pre> -->

<script>
	// Get the modal
		var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal
	btn.onclick = function() {
	modal.style.display = "block";
}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	modal.style.display = "none";
}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
    if (event.target == modal) {
    modal.style.display = "none";
}
}


</script>

</body>
</html>