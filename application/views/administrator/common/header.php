<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-success">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo base_url(); ?>administrator/dashboard"><img src="<?php echo base_url(); ?>assest/administrator/images/logo-default.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url(); ?>administrator/dashboard"><img src="<?php echo base_url(); ?>assest/administrator/images/logo-mini-default.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-profile" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img src="<?php echo base_url(); ?>assest/administrator/images/faces/face1.jpg" alt="image">
              <span class="d-none d-lg-inline"><?php echo $this->session->userdata('KDBhindiAdminSession')->name; ?></span>
            </a>
            <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
              
              <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/profile">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                My Profile
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo base_url(); ?>administrator/change_password">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="javascript:void(0)" onClick="check_confirm();">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Signout
              </a>
            </div>
          </li>
          <!-- <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="mdi mdi-backburger"></i>
            </a>
          </li> -->
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
      </div>
    </nav>