<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["name"]; ?></a>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>            
          </li>

          <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Category
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="category.php?do=add" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="Category.php?do=manage" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage All Category</p>
                  </a>
                </li>              
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-write"></i>
                <p>
                  Blog Posts
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="post.php?do=add" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New Post</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="post.php?do=manage" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage All Posts</p>
                  </a>
                </li>              
              </ul>
            </li>
          
          <li class="nav-header">USER MANAGEMENT</li>
          <?php

          if($_SESSION["role"] == 1){ ?>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  All user Data
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="users.php?do=add" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New User</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="users.php?do=manage" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage All User</p>
                  </a>
                </li>              
              </ul>
            </li>
          
          <?php
          }
          else if($_SESSION["role"] == 2){?>
            <li class="nav-item">
            <a href="profile.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Manage Profile
              </p>
            </a>
          </li>

          <?php
          }

          ?>
          

          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-exit"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>