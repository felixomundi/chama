
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->

            <a class="navbar-brand ps-3" href="#">Chama Application </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->

            
            
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

<!-- Nav Item - Search Dropdown (Visible Only XS) -->
<li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       
    </a>
    
    
</li>

<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <!-- showing username at header -->
        <span class="mr-2 d-none d-lg-inline text-primary-600 large">
            <?php 
            $email = $_SESSION['login'];
            $sql2 = "SELECT users.* FROM `users` WHERE `email`=:email and status=1 ;";
            $query = $dbh->prepare($sql2);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                    echo $result->username;
               
              
                } 
            ?></span>
            
                 
                 <img   src="photo/<?php echo $result->profilepic;} ?>" class="img-profile rounded-circle" style="width:50px" alt="Cinque Terre">

        </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
         aria-labelledby="userDropdown">
        <a class="dropdown-item" href="update-profile.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
        </a>
        <a class="dropdown-item" href="update-password.php">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Update Password
        </a>
      
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout.php">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
        </a>
        <a class="dropdown-item" href="https://nyagaka.com" target="_blank">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
           Follow more
        </a>
    </div>
</li>

</ul>
        </nav>
