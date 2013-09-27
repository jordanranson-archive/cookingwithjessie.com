<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Cooking With Jessie</title>
	<base href='http://localhost/cookingwithjessie.com/'>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/site.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="../../assets/js/html5shiv.js"></script>
		<script src="../../assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>

	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Cooking With Jessie</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<!--<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Introduction <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Foreword</a></li>
							<li><a href="#">Stocking the Pantry</a></li>-->
							<!--<li><a href="#">Tools of the Trade</a></li>
							<li><a href="#">A Guide to This Book</a></li>
						</ul>
					</li>-->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Breakfast <b class="caret"></b></a>
						<ul class="dropdown-menu" id="breakfast-dropdown">
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dinner <b class="caret"></b></a>
						<ul class="dropdown-menu" id="dinner-dropdown">
						</ul>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">

		<section id="recipe" style="display: none" class="row">
			<div class="col-md-12">
				<h1>Title of the recipe</h1>
			</div>
			<br />
			<div class="col-md-5" class="ingredients">
				<ul class="list-unstyled" id="ingredients">
				</ul> 
			</div>
			<div class="col-md-7">
				<p class="stats">
					Prep. <em class="text-muted">&ndash; <span id="prep"></span></em>,
					Cook <em class="text-muted">&ndash; <span id="cook"></span></em>,
					Serves <em class="text-muted">&ndash; <span id="serves"></span></em>
				</p>
				<p class="description lead" id="description"></p>
				<h2>Directions</h2>
				<p class="directions" id="directions"></p>
			</div>

		</section>

	</div> <!-- /container -->


	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="http://codeorigin.jquery.com/jquery-2.0.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		function loadPage( json ) {
			// .gsx$<key>.$t = value
			// http://spreadsheets.google.com/feeds/list/0ApGAfJ71MNMzdEg4anV1bXVjN0dyelBsWVplMFJaMWc/<gid+1>/public/values?alt=json
			var recipes = json.feed.entry;

			var args, title, id, category;
			for( var i = 0; i < recipes.length; i++ ) {
				args = recipes[i].title.$t.split('#');
				title = args[0];
				category = args[1];

				$li = $( '<li><a href="./recipe/' + (i+1) + '">' + title + '</a></li>' );
				$li.appendTo( $( '#'+category+'-dropdown' ) );
			}
		}

		function loadRecipe( json ) {
			var data = json.feed.entry;
			var title = json.feed.title.$t.split('#')[0];
			var $recipe = $( '#recipe' );
			$recipe.hide();

			console.log( data );

			// title
			$recipe.find('h1').html( title );

			// ingredients
			for( var i = 0; i < data.length; i++ ) {
				var a = data[i].gsx$quantity.$t;
				var b = data[i].gsx$ingredient.$t;
				$recipe.find('ul').append( '<li>'+b+' <em class="text-muted">&ndash; '+a+'</em></li>' );
			}

			// description
			$recipe.find('.description').html( data[0].gsx$description.$t );

			// directions
			$recipe.find('.directions').html( data[0].gsx$directions.$t );

			$('#prep').html( data[0].gsx$prepcooktime.$t );
			$('#cook').html( data[1].gsx$prepcooktime.$t );
			$('#serves').html( data[0].gsx$serves.$t );

			$recipe.fadeIn();
		}
	</script>
	<script src="http://spreadsheets.google.com/feeds/worksheets/0ApGAfJ71MNMzdEg4anV1bXVjN0dyelBsWVplMFJaMWc/public/basic?alt=json-in-script&amp;callback=loadPage"></script>
	<script src="http://spreadsheets.google.com/feeds/list/0ApGAfJ71MNMzdEg4anV1bXVjN0dyelBsWVplMFJaMWc/<?php echo $id ?>/public/values?alt=json-in-script&amp;callback=loadRecipe"></script>
</body>
</html>
