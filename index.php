<?php include('process.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TODO App</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<link href="./assets/styles.css" rel="stylesheet" />
</head>

<body>
	<div class="flex justify-center">
		<div class="my-24">
			<h1 class="text-center text-4xl font-bold mb-5">TODO App</h1>

			<div>
				<form method="post" action="process.php">
					<input type="text" name="title" placeholder="What to do?" class="py-2 px-3 rounded w-96 focus:outline-none" onChange={this.handleInputChange} />
					<button type="submit" name="save" class="bg-red-500 px-5 py-2 ml-2 text-white font-bold rounded focus:outline-none">
						Add
					</button>
				</form>
			</div>

			<div class="flex items-center my-2">
				<p class="text-xs text-black-100">Sort by</p>
				<select class="rounded text-xs ml-2 focus:outline-none" onChange={this.handleSort}>
					<option value="title">Title</option>
					<option value="date">Date</option>
				</select>
			</div>

			<?php 
			while ($row = mysqli_fetch_array($results)) { ?>
				<div id="<?php echo "item-" . $row['id'] ?>" class="shadow-md bg-white my-3 rounded py-2 px-3 flex items-center justify-between todo-item">
					<p><?php echo $row['title'] ?></p>
					<div class="hidden action-buttons">
						<button id="<?php echo "edit-" . $row['id'] ?>" class="focus:outline-none edit-btn">
							<i class="far fa-edit"></i>
						</button>
						<a href="process.php?del=<?php echo $row['id'] ?>" class="ml-2 focus:outline-none">
							<i class="far fa-trash-alt"></i>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

	<script>
		$(document).ready(function() {
			$(".edit-btn").on("click", function(e) {
				e.preventDefault();
				let itemNo = $(this).attr('id').split("-")[1];
				let title = $("#item-" + itemNo).find("p").text()
				$("#item-" + itemNo).empty()
				$("#item-" + itemNo).append(`
					<form method="post" action="process.php" class="w-full flex justify-between">
						<input type="hidden" name="id" value=${itemNo} />
						<input type="text" name="title" value="${title}" class="w-full mr-4 focus:outline-none update-field" />
						<button type="submit" name="update" class="focus:outline-none bg-green-500 text-white text-sm px-2 py-0.5 rounded">
							Update
						</button>
					</form>
				`)
			})
		})
	</script>
</body>

</html>