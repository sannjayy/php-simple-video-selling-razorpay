<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">
    	<img src="assets/img/logo.png" alt="" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
			<!-- <li class="nav-item">
			  <a class="nav-link active" aria-current="page" href="/">Home</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Login</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Register</a>
			</li>
			<li class="nav-item dropdown">
			  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			    Dropdown
			  </a>
			  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
			    <li><a class="dropdown-item" href="#">Action</a></li>
			    <li><a class="dropdown-item" href="#">Another action</a></li>
			    <li><hr class="dropdown-divider"></li>
			    <li><a class="dropdown-item" href="#">Something else here</a></li>
			  </ul>
			</li> -->
		</ul>

      <form class="d-flex gap-2 mx-auto">
      	<?php
      	if(isset($_SESSION['logged']) && isset($_SESSION['id'])){
      		$user = find("first", USERS, $value='*', "where `id` = :id", array(':id' => $_SESSION['id']));
      	}
      	 
      	?>
      	<?=($user['is_admin'])? '<a href="admin"><button type="button" class="btn btn-danger">Admin</button></a>' : '' ?>
      	
      	<?=(isset($_SESSION['logged']) && isset($_SESSION['id']))? '<a href="view"><button type="button" class="btn btn-light">View</button></a>' : '<a href="register"><button type="button" class="btn btn-light">Register</button></a>' ?>

      	

      	<?=(isset($_SESSION['logged']) && isset($_SESSION['id']))? '<a href="logout"><button type="button" class="btn btn-danger">Logout</button></a>' : '<a href="login"><button type="button" class="btn btn-danger">Login</button></a>' ?>
      </form>
    </div>
  </div>
</nav>