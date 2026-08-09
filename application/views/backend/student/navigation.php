    <!-- Left navbar-header -->

    <style>
    /* Shared accent-color cycle for the top-level menu items — used by both the mobile tile grid and the desktop sidebar */
    #side-menu > li:nth-of-type(8n+1) { --tile-accent: #2563eb; }
    #side-menu > li:nth-of-type(8n+2) { --tile-accent: #7c3aed; }
    #side-menu > li:nth-of-type(8n+3) { --tile-accent: #db2777; }
    #side-menu > li:nth-of-type(8n+4) { --tile-accent: #ea580c; }
    #side-menu > li:nth-of-type(8n+5) { --tile-accent: #16a34a; }
    #side-menu > li:nth-of-type(8n+6) { --tile-accent: #0891b2; }
    #side-menu > li:nth-of-type(8n+7) { --tile-accent: #ca8a04; }
    #side-menu > li:nth-of-type(8n+8) { --tile-accent: #dc2626; }

    /* Sidebar background — same soft gradient as the site-editor, on every screen size */
    .navbar-default.sidebar {
      background: linear-gradient(165deg, #e8edfb 0%, #eee8fa 30%, #fbe9f2 65%, #fdf0e6 100%) !important;
      box-shadow: 2px 0 10px rgba(0,0,0,.06) !important;
    }

    /* Profile row polish */
    #side-menu > li.user-pro > a > img.img-circle {
      border: 3px solid #7c3aed !important;
      box-shadow: 0 2px 8px rgba(124,58,237,.35) !important;
    }
    #side-menu > li.user-pro > a {
      color: #1e293b !important;
      font-weight: 600 !important;
    }

    /* Desktop / laptop sidebar — colored left-border + colored icon per item, keeps the normal list layout */
    @media (min-width: 768px) {
      #side-menu > li:not(.sidebar-search):not(.user-pro) {
        margin: 6px 10px !important;
      }
      #side-menu > li:not(.sidebar-search):not(.user-pro) > a {
        display: block !important;
        background: #fff !important;
        border-radius: 10px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,.08) !important;
        border-left: 4px solid var(--tile-accent, #2563eb) !important;
        color: var(--tile-accent, #333333) !important;
        font-weight: 600 !important;
        transition: transform .12s ease, box-shadow .12s ease !important;
      }
      #side-menu > li:not(.sidebar-search):not(.user-pro) > a:hover {
        transform: translateX(2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,.14) !important;
        background: #fff !important;
      }
      #side-menu > li:not(.sidebar-search):not(.user-pro) > a i {
        color: var(--tile-accent, #2563eb) !important;
      }
      /* Submenu items get the same boxed-card treatment, in their parent's accent color */
      #side-menu > li .nav-second-level > li {
        margin: 5px 8px !important;
      }
      #side-menu > li .nav-second-level > li > a {
        display: block !important;
        background: #fff !important;
        border-radius: 8px !important;
        box-shadow: 0 1px 2px rgba(0,0,0,.06) !important;
        border-left: 3px solid var(--tile-accent, #2563eb) !important;
        color: var(--tile-accent, #555) !important;
        transition: transform .12s ease, box-shadow .12s ease !important;
      }
      #side-menu > li .nav-second-level > li > a i {
        color: var(--tile-accent, #555) !important;
      }
      #side-menu > li .nav-second-level > li:hover > a,
      #side-menu > li .nav-second-level > li.active > a {
        background: color-mix(in srgb, var(--tile-accent, #2563eb) 10%, white) !important;
        box-shadow: 0 3px 8px rgba(0,0,0,.12) !important;
        transform: translateX(2px) !important;
      }
    }

    /* Colorful tiled mobile menu, matching the site-editor look */
    @media (max-width: 767px) {
      #side-menu {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
        padding: 14px !important;
        list-style: none !important;
        margin: 0 !important;
      }
      #side-menu > li.sidebar-search,
      #side-menu > li.user-pro {
        grid-column: 1 / -1 !important;
      }
      #side-menu > li:not(.sidebar-search):not(.user-pro) {
        background: #fff !important;
        border-radius: 10px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,.08) !important;
        border-top: 4px solid var(--tile-accent, #2563eb) !important;
      }
      #side-menu > li:not(.sidebar-search):not(.user-pro) > a {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        gap: 8px !important;
        padding: 16px 8px !important;
        min-height: 84px !important;
        color: var(--tile-accent, #1e293b) !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        white-space: normal !important;
        background: transparent !important;
      }
      #side-menu > li:not(.sidebar-search):not(.user-pro) > a i {
        font-size: 20px !important;
        color: var(--tile-accent, #2563eb) !important;
      }
      #side-menu > li:not(.sidebar-search):not(.user-pro) > a .fa.arrow {
        display: none !important;
      }
      /* Accent colors are assigned above, shared with the desktop styling */

      /* When a tile's submenu is open, let it span the full width so the sub-items have room */
      #side-menu > li:has(> ul.nav-second-level.in),
      #side-menu > li:has(> ul.nav-second-level.opened),
      #side-menu > li:has(> ul.nav-second-level[style*="block"]) {
        grid-column: 1 / -1 !important;
      }
      #side-menu > li > ul.nav-second-level {
        text-align: left !important;
      }
      /* Submenu items inside an expanded tile get the same boxed-card treatment */
      #side-menu > li .nav-second-level > li {
        margin: 5px 0 !important;
      }
      #side-menu > li .nav-second-level > li > a {
        display: block !important;
        background: #fff !important;
        border-radius: 8px !important;
        box-shadow: 0 1px 2px rgba(0,0,0,.06) !important;
        border-left: 3px solid var(--tile-accent, #2563eb) !important;
        color: var(--tile-accent, #333) !important;
        padding-left: 10px !important;
      }
      #side-menu > li .nav-second-level > li > a i {
        color: var(--tile-accent, #333) !important;
      }
      #side-menu > li .nav-second-level > li:hover > a,
      #side-menu > li .nav-second-level > li.active > a {
        background: color-mix(in srgb, var(--tile-accent, #2563eb) 12%, white) !important;
      }
    }
    </style>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span> </div>
                        <!-- /input-group -->
            </li>
            
            <li class="user-pro">
                        <?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                            if (!file_exists($face_file)) {
                                $face_file = 'uploads/default.jpg';                                 
                            }
                            ?>

                    <a href="#" ><img src="<?php echo base_url() . $face_file;?>" alt="user-img" class="img-circle"> <span class="hide-menu">

                       <?php 
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                        ?>
                        <span class="fa arrow"></span></span>
                    </a>
                        <ul class="nav nav-second-level">
                           
                            <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                </li>



    <li> <a href="<?php echo base_url();?>student/dashboard" ><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard') ;?></span></a> </li>
    
    <li class="<?php if ($page_name == 'student_mark') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/student_mark">
                    <i class="fa fa-credit-card p-r-10"></i>
                    
                        <span class="hide-menu"><?php echo get_phrase('Check Result'); ?></span>
                </a>
            </li> 
             <li class="<?php if ($page_name == 'cummulative') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/cummulative">
                    <i class="fa fa-credit-card p-r-10"></i>
                    
                        <span class="hide-menu"><?php echo get_phrase('Check Cummulative Result'); ?></span>
                </a>
            </li> 
     <li class="<?php if ($page_name == 'student_mark1') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/student_mark1">
                    <i class="fa fa-credit-card p-r-10"></i>
                    
                        <span class="hide-menu"><?php echo get_phrase('Check Progresive Result'); ?></span>
                </a>
            </li> 
    <li class="<?php if ($page_name == 'student_mark2') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/student_mark2">
                    <i class="fa fa-credit-card p-r-10"></i>
                    
                        <span class="hide-menu"><?php echo get_phrase('Nursery Progresive Result'); ?></span>
                </a>
            </li> 
             <li class="<?php if ($page_name == 'cummulative') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>student/cummulative">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('get cummulative result'); ?></span>

                        </a>

                    </li>
     <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>assignment/assignment">
                    <i class="fa fa-credit-card p-r-10"></i>
                    
                        <span class="hide-menu"><?php echo get_phrase('Check Assignment'); ?></span>
                </a>
            </li> 
     <li class="<?php if ($page_name == 'studymaterial') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>studymaterial/study_material">
                    <i class="fa fa-credit-card p-r-10"></i>
                    
                        <span class="hide-menu"><?php echo get_phrase('Check E-Notes'); ?></span>
                </a>
            </li> 
    <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/invoice">
                    <i class="fa fa-credit-card p-r-10"></i>
                    
                        <span class="hide-menu"><?php echo get_phrase('take_/_practice_CBT'); ?></span>
                </a>
            </li> 


    <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-plus p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Academics');?><span class="fa arrow"></span></span></a>
        
        <ul class=" nav nav-second-level<?php
            if ($page_name == 'subject' ||
                    $page_name == 'teacher' ||
                    $page_name == 'class_mate' ||
                    $page_name == 'assignment' || $page_name == 'study_material' )
                echo 'opened active';
            ?>">


            
                <li class="<?php if ($page_name == 'subject') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>student/subject">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Subject'); ?></span>
                    </a>
                </li>


                <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>student/teacher">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Teacher'); ?></span>
                    </a>
                </li>

                    
                <li class="<?php if ($page_name == 'class_mate') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>student/class_mate">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Class Mate'); ?></span>
                    </a>
                </li>

                    
                <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>assignment/assignment">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Assignment_/_Homework'); ?></span>
                    </a>
                </li>
                
                    
                <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>assignment/assignment">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Notes'); ?></span>
                    </a>
                </li>

                    
                <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>assignment/assignment">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Check_results'); ?></span>
                    </a>
                </li>

                    
                <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>assignment/assignment">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Virtual_classroms'); ?></span>
                    </a>
                </li>

                    
                <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>assignment/assignment">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Attendance'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>studymaterial/study_material">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Study Material'); ?></span>
                    </a>
                </li>


 
 
         </ul>
    </li>

            <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/invoice">
                    <i class="fa fa-credit-card p-r-10"></i>
                    
                        <span class="hide-menu"><?php echo get_phrase('video_lessons'); ?></span>
                </a>
            </li> 

            <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/invoice">
                    <i class="fa fa-credit-card p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Invoice'); ?></span>
                </a>
            </li> 

        <li class="<?php if ($page_name == 'payment_history') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/payment_history">
                    <i class="fa fa-credit-card p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Payment History'); ?></span>
                </a>
        </li>               
                                
            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/manage_profile">
                    <i class="fa fa-gears p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('manage_profile'); ?></span>
                </a>
            </li>

            <li class="">
                <a href="<?php echo base_url(); ?>login/logout">
                    <i class="fa fa-sign-out p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Logout'); ?></span>
                </a>
            </li>
                  
                  
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->