<?php 
$ad = get_admin($this->session->userdata('KDBhindiAdminSession')->id);
 ?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link d-flex">
        <div class="profile-image">
          <?php if($ad['image']!=""){ ?>
          <img src="<?php echo base_url()."uploads/administrator/".$ad['image']; ?>" alt="image"/>
          <?php }else{ ?>
          <img src="<?php echo base_url()."" ?>assest/administrator/images/faces/default_male.jpg" alt="image"/>
          <?php } ?>
        </div>
        <div class="profile-name">
          <p class="name"> <?php echo $ad['name']; ?> </p>
          <p class="designation"> Administator </p>
        </div>
      </div>
    </li>
    <li class="nav-item"> 
      <a class="nav-link" href="<?php echo base_url(); ?>administrator/dashboard"> 
        <i class="icon-layout menu-icon"></i> <span class="menu-title">Dashboard</span>
      </a> 
    </li>
    <li class="nav-item active"> 
      <a class="nav-link" href="<?php echo base_url(); ?>administrator/slider"> 
        <i class="fa fa-bullhorn menu-icon"></i> <span class="menu-title">Slider</span> 
      </a> 
    </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts"> <i class="icon-box menu-icon"></i> <span class="menu-title">Master</span> <i class="menu-arrow"></i> </a>
      <div class="collapse" id="page-layouts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/master/category">Collections</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/master/sub_category">Category</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/master/gender">Gender</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/master/price">Price Range</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/master/trending">Trending Product</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/master/welcomenote">Welcome Note</a></li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/product"> <i class="fa fa-user-circle menu-icon"></i> <span class="menu-title">Product Master</span> </a> </li>
    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/gallery/photo"> <i class="icon-image menu-icon"></i> <span class="menu-title">Photo Gallery</span> </a> </li>
    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/advertisement"> <i class="icon-paper menu-icon"></i> <span class="menu-title">Advertisement</span> </a> </li>

    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/offerzone"> <i class="icon-image menu-icon"></i> <span class="menu-title">Offer Zone</span> </a> </li>
    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/customer"> <i class="icon-record menu-icon"></i> <span class="menu-title">Customer</span> </a> </li>

    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/order"> <i class="icon-circle-check menu-icon"></i> <span class="menu-title">Order</span> </a> </li>

    <li class="nav-item"> 
      <a class="nav-link" href="<?php echo base_url(); ?>administrator/favorite"> 
        <i class="icon-heart menu-icon"></i> <span class="menu-title">Favourite Product</span> 
      </a> 
    </li>


    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>administrator/testimonial"> <i class="icon-speech-bubble menu-icon"></i> <span class="menu-title">Testimonoial</span> </a> </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url(); ?>administrator/subscription">
        <i class="mdi mdi-email menu-icon"></i>
        <span class="menu-title">Subscription</span>
      </a>
    </li>
    <li class="nav-item nav-doc"> <a class="nav-link bg-primary" href="javascript:void(0)" onclick="check_confirm();"> <i class="icon-book menu-icon"></i> <span class="menu-title">Signout</span> </a> </li>
  </ul>
</nav>
