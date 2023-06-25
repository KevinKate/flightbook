<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <p class="text-dark mr-auto"><a style="font-size:20px;" class="font-weight-bold text-dark" href="./a.php?page=home">Flight Booking Management System</a></p>

      <nav class="nav-menu d-none d-lg-block" id='top-nav'>
        <ul>
          <li class="nav-home"><a href="./a.php?page=home">Home</a></li>
           <li class="nav-schedule"><a href="./a.php?page=schedule">Schedule</a></li>
           <li class="nav-booked"><a href="./a.php?page=booked">Booked List</a></li>
          <li class="drop-down nav-flight nav-location"><a href="#">Maintenance</a>
            <ul>
              <li><a href="./a.php?page=flight">Flight List</a></li>
              <li><a href="./a.php?page=location">Location List</a></li>
             
              
            </ul>
          </li>
          <li class="drop-down nav-user"><a href="#"><?php echo $_SESSION['login_name'] ?> </a>
             <ul>
              <li><a href="./a.php?page=user">Users</a></li>
              <li><a href="javascript:void(0)" id="manage_account">Manage Account</a></li>
              <li><a href="./logout.php">Logout</a></li>
             
            </ul>
          </li>
        </ul>
      </nav><!-- .nav-menu -->


    </div>
  </header>
  <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>';
      if(page != ''){
        $('#top-nav li').removeClass('active')
        $('#top-nav li.nav-'+page).addClass('active')
      }
      $('#manage_account').click(function(){
      uni_modal('Manage Account','manage_account.php')
  })
    })

  </script>