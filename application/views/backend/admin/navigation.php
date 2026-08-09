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
            <!--
            <?php 
$admin_id = $this->session->userdata('login_user_id');
$row = $this->db->get_where('admin', array('admin_id' => $admin_id))->row();

echo "<pre style='background:#222;color:#0f0;padding:15px;'>
ADMIN DEBUG:
Admin ID: " . $admin_id . "
Level raw value: " . var_export($row->level, true) . "
</pre>";
?>
<?php echo "<div style='color:yellow;background:black;padding:10px;'>ROLE: " . $this->session->userdata('role') . "</div>"; ?>


-->
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

                            <!--

							<li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>

                            <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>

                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>

							-->

                            <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>

                        </ul>

                    </li>





     <!---  Permission for Admin Dashboard starts here ------>

        <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->dashboard;?>

        <?php if($check_admin_permission == '1'):?>

            <li> <a href="<?php echo base_url();?>admin/dashboard" ><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard') ;?></span></a> </li>

        <?php endif;?> 

    <!---  Permission for Admin Dashboard ends here ------>

                    

     <!---  Permission for Admin Manage Academics starts here ------>

     <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->manage_academics;?>

     <?php if($check_admin_permission == '1'):?>   

        <li> <a href="javascript:void(0);" ><i class="fa fa-mortar-board p-r-10"></i> <span class="hide-menu"> <?php echo get_phrase('Academics');?> <span class="fa arrow"></span></span></a>

                        <ul class=" nav nav-second-level<?php

            if (    $page_name == 'enquiry_category'||

                    $page_name == 'list_enquiry'||

                    $page_name == 'club'|| $page_name == 'noticeboard' ||

                    $page_name == 'circular'||

                    $page_name == 'academic_syllabus') echo 'opened active';

            ?> ">

                            

        <li class="<?php if ($page_name == 'enquiry_category') echo 'active';?>"> 



            <a href="<?php echo base_url();?>admin/enquiry_category">

                <i class="fa fa-angle-double-right p-r-10"></i>

                <span class="hide-menu"><?php echo get_phrase('Equiry Category');?></span>



            </a> 

        </li>



       <li class="<?php if ($page_name == 'enquiry') echo 'active'; ?> ">

                <a href="<?php echo base_url(); ?>admin/list_enquiry">

                <i class="fa fa-angle-double-right p-r-10"></i>

                      <span class="hide-menu"><?php echo get_phrase('list_enquiries'); ?></span>

                </a>

        </li>



        <li class="<?php if ($page_name == 'club') echo 'active'; ?>">

                <a href="<?php echo base_url(); ?>admin/club">

                <i class="fa fa-angle-double-right p-r-10"></i>

                      <span class="hide-menu"><?php echo get_phrase('school_clubs'); ?></span>

                </a>

        </li>



        <li class="<?php if ($page_name == 'circular') echo 'active'; ?> ">

                <a href="<?php echo base_url(); ?>admin/circular">

                <i class="fa fa-angle-double-right p-r-10"></i>

                 <span class="hide-menu"> <?php echo get_phrase('manage_circular'); ?></span>

                </a>

        </li>



         



         <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?>">

                <a href="<?php echo base_url(); ?>admin/academic_syllabus">

                <i class="fa fa-angle-double-right p-r-10"></i>

                     <span class="hide-menu"><?php echo get_phrase('syllabus'); ?></span>

                </a>

        </li>


		

		

                <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">

                <a href="<?php echo base_url(); ?>admin/noticeboard">

                <i class="fa fa-angle-double-right p-r-10"></i>

                   <span class="hide-menu"><?php echo get_phrase('manage_events'); ?></span>

                </a>

            </li>

                           

        </ul>

    </li>

    <?php endif;?> <!---  Permission for Admin Manage Academics ends here ------>

                   
<?php
$checking_level = $this->db->get_where('admin', array(
    'admin_id' => $this->session->userdata('login_user_id')
))->row()->level;
if ($checking_level == '1'): ?>
<li>
  <a href="https://mentorsinternationalacademy.com/site-editor" target="_blank">
    <i class="fa fa-edit"></i>
    <span class="hide-menu">Website Editor</span>
  </a>
</li>
<?php endif; ?>





    <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-university p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('health_status');?> & <?php echo get_phrase('health_history');?><span class="fa arrow"></span></span></a>

        

        <ul class=" nav nav-second-level<?php

        if ($page_name == 'class' ||

                $page_name == 'section' ||

                $page_name == 'class_routine')

            echo 'opened active';

        ?>">





                    

                     <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">

                    <a href="<?php echo base_url(); ?>admin/classes">

                    <i class="fa fa-angle-double-right p-r-10"></i>

                       <span class="hide-menu"><?php echo get_phrase('health_status'); ?></span>

                    </a>

                </li>





                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">

                    <a href="<?php echo base_url(); ?>admin/section">

                    <i class="fa fa-angle-double-right p-r-10"></i>

                        <span class="hide-menu"><?php echo get_phrase('health_history'); ?></span>

                    </a>

                </li>   

                

      

         

       

             </ul>

            </li>





    <!---  Permission for Admin Manage Employee starts here ------>

    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->manage_employee;?>

    <?php if($check_admin_permission == '1'):?> 



        <li class="staff"> <a href="javascript:void(0);" ><i data-icon="&#xe006;" class="fa fa-users p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('teachers');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php if ($page_name == 'teacher')echo 'opened active';?> ">



							<li class="<?php if ($page_name == 'department') echo 'active'; ?> ">

								<a href="<?php echo base_url(); ?>department/department">

								<i class="fa fa-angle-double-right p-r-10"></i>

									 <span class="hide-menu"><?php echo get_phrase('department'); ?></span>

								</a>

							</li>

							<li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">

								<a href="<?php echo base_url(); ?>admin/teacher">

								<i class="fa fa-angle-double-right p-r-10"></i>

									 <span class="hide-menu"><?php echo get_phrase('teachers'); ?></span>

								</a>

							</li>



                 		</ul>

   	 </li>

    <?php endif;?> <!---  Permission for Admin Manage Employee ends here ------>













    <!---  Permission for Admin Manage Student starts here ------>

    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->manage_student;?>

    <?php if($check_admin_permission == '1'):?>          

                

        <li class="student"> <a href="#" ><i data-icon="&#xe006;" class="fa fa-users p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('manage students');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php

            if ($page_name == 'new_student' ||

                    $page_name == 'student_class' ||

                    $page_name == 'student_information' ||

                    $page_name == 'view_student' ||

                    $page_name == 'searchStudent')

                echo 'opened active has-sub';

            ?> ">





                        

                    <li class="<?php if ($page_name == 'new_student') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/new_student">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                              <span class="hide-menu"><?php echo get_phrase('admission_form'); ?></span>

                        </a>

                    </li>





                    

                     <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_information' || $page_name == 'view_student') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/student_information">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                              <span class="hide-menu"><?php echo get_phrase('list_students'); ?></span>

                        </a>

                    </li>





    <li class="<?php if ($page_name == 'studentCategory') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>studentcategory/studentCategory">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('Student Categories'); ?></span>

                        </a>

     </li>

     

     <li class="<?php if ($page_name == 'studentHouse') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>studenthouse/studentHouse">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('Student House'); ?></span>

                        </a>

     </li>

     

     <li class="<?php if ($page_name == 'clubActivity') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>activity/clubActivity">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('Student Activity'); ?></span>

                        </a>

     </li>

     

     <li class="<?php if ($page_name == 'socialCategory') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>socialcategory/socialCategory">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('Social Category'); ?></span>

                        </a>

     </li>

        

     

                 </ul>

    </li>

    <?php endif;?> <!---  Permission for Admin Manage Student ends here ------>











    <!---  Permission for Admin Manage Attendance starts here ------>

    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->manage_attendance;?>

    <?php if($check_admin_permission == '1'):?> 



        <li class="attendance"> <a href="#" ><i data-icon="&#xe006;" class="fa fa-hospital-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('attendance');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php

            if ($page_name == 'manage_attendance' || $page_name == 'attendance_report') echo 'opened active'; ?>">

                        



                    <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/manage_attendance/<?php echo date("d/m/Y"); ?>">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                              <span class="hide-menu"><?php echo get_phrase('mark_attendance'); ?></span>

                        </a>

                    </li>





                    <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/attendance_report">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                              <span class="hide-menu"><?php echo get_phrase('view_attendance'); ?></span>

                        </a>

                    </li>



                

                 </ul>

                </li>

            <?php endif;?> <!---  Permission for Admin Manage Attendance ends here ------>

                

                







    <!---  Permission for Admin Manage Download Page starts here ------>

    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->download_page;?>

    <?php if($check_admin_permission == '1'):?> 



        <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-download p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('download_page');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php

            if ($page_name == 'assignment' ||

                    $page_name == 'study_material')

                echo 'opened active';

            ?> ">

                                     



            <li class="<?php if ($page_name == 'assignment') echo 'active'; ?>">

                <a href="<?php echo base_url(); ?>assignment/assignment">

                <i class="fa fa-angle-double-right p-r-10"></i>

                    <span class="hide-menu"><?php echo get_phrase('assignments'); ?></span>

                </a>

            </li>



   



                <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">

                <a href="<?php echo base_url(); ?>studymaterial/study_material">

                <i class="fa fa-angle-double-right p-r-10"></i>

                      <span class="hide-menu"><?php echo get_phrase('study_materials'); ?></span>

                </a>

            </li>



     

                 </ul>

        </li>



        <?php endif;?> <!---  Permission for Admin Download Page  ends here ------>

                                   





    <!---  Permission for Admin Download Parent Page starts here ------>

    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->manage_parent;?>

    <?php if($check_admin_permission == '1'):?> 



        <li class=" <?php if($page_name == 'parent')echo 'active';?>">

                    <a href="<?php echo base_url();?>admin/parent" >

                    <i class="fa fa-users p-r-10"></i>

                    <span class="hide-menu"><?php echo get_phrase('parents');?></span>

                    </a>    

        </li>

    <?php endif;?> <!---  Permission for Admin Download Page  ends here ------>







   



                

        <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-university p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('class');?> & <?php echo get_phrase('section');?><span class="fa arrow"></span></span></a>

        

            <ul class=" nav nav-second-level<?php

            if ($page_name == 'class' ||

                    $page_name == 'section' ||

                    $page_name == 'class_routine')

                echo 'opened active';

            ?>">





                        

                         <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/classes">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('manage_classes'); ?></span>

                        </a>

                    </li>





                    <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/section">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                            <span class="hide-menu"><?php echo get_phrase('manage_sections'); ?></span>

                        </a>

                    </li>   

                    

          

             

           

                 </ul>

                </li>



                



              <!--  <li class="<?php if ($page_name == 'mark_report_card') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/mark_report_card">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('mark_report_card'); ?></span>

                        </a>

                    </li>

                    <li class="<?php if ($page_name == 'view_student_report_card') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/view_student_report_card">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('view_student_report_card'); ?></span>

                        </a>

                    </li>
                    -->



                         <li class="<?php if ($page_name == 'subject') echo 'active'; ?>">

                            <a href="<?php echo base_url(); ?>subject/subject/">

                            <i class="fa fa-list p-r-10"></i>

                                 <span class="hide-menu"><?php echo get_phrase('subjects'); ?></span>

                            </a>

                        </li>



         

         <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-medkit p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('exams');?><span class="fa arrow"></span></span></a>

        

        <ul class=" nav nav-second-level<?php

        if ($page_name == 'submit_exam' || $page_name == 'grade' ||  $page_name == 'createExamination' || 

            $page_name == 'examQuestion') echo 'opened active';

        ?>">

                    

    

                    <li class="<?php if ($page_name == 'examQuestion') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/examQuestion">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('question_paper'); ?></span>

                        </a>

                    </li>



                    <!--<li class="<?php if ($page_name == 'grade') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/grade">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('exam_grades'); ?></span>

                        </a>

                    </li>-->



                    <li class="<?php if ($page_name == 'createExamination') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/createExamination">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('Add Examination'); ?></span>

                        </a>

                    </li>



     

                 </ul>

                </li>





           <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-bar-chart-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('student_scores');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php

            if ($page_name == 'marks' ||

                    $page_name == 'exam_marks_sms'||

                    $page_name == 'tabulation_sheet')

                echo 'opened active';

            ?>">

    

                    <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/marks">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('class_teacher'); ?></span>

                        </a>

                    </li>
                     <li class="<?php if ($page_name == 'cummulative') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/cummulative">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('get cummulative'); ?></span>

                        </a>

                    </li>
                    
                    <li class="<?php if ($page_name == 'marks_forKtoN') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/marks_forKtoN">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('KG_to_Nur_class_teacher'); ?></span>

                        </a>

                    </li>

            

                    <li class="<?php if ($page_name == 'student_marksheet_subject') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/student_marksheet_subject">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('subject_teacher'); ?></span>

                        </a>

                    </li>

                    <li class="<?php if ($page_name == 'mark_report_card') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/mark_report_card">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('mark_report_card'); ?></span>

                        </a>

                    </li>
                    <!--

                    <li class="<?php if ($page_name == 'view_student_report_card') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/view_student_report_card">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('view_student_report_card'); ?></span>

                        </a>

                    </li>
                    -->



</ul>
</li>


  

               

                

        <li class="collect_fee"> <a href="#" ><i data-icon="&#xe006;" class="fa fa-credit-card p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('fee_collection');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php

            if ($page_name == 'income' ||

                        $page_name == 'student_payment'||

                        $page_name == 'view_invoice_details'||

                        $page_name == 'invoice_add'||

                        $page_name == 'list_invoice'||

                        $page_name == 'studentSpecificPaymentQuery'||

                        $page_name == 'student_invoice')

                echo 'opened active';

            ?>">



                 <li class="<?php if ($page_name == 'student_payment') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/student_payment">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('collect_fees'); ?></span>

                        </a>

                    </li>

                    

                     <li class="<?php if ($page_name == 'student_invoice') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/student_invoice">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('manage_invoice'); ?></span>

                        </a>

                    </li>



                    <li class="<?php if ($page_name == 'fully_paid_invoice') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/fully_paid_invoice">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('fully_paid_invoice'); ?></span>

                        </a>

                    </li>



                    <li class="<?php if ($page_name == 'part_payment_invoice') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/part_payment_invoice">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('part_payment_invoice'); ?></span>

                        </a>

                    </li>



                    <li class="<?php if ($page_name == 'students_yet_to_pay') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/students_yet_to_pay">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('students_yet_to_pay'); ?></span>

                        </a>

                    </li>

     

                 </ul>

                </li>

                

                

                   

                

                                    

                    <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-fax p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('expenses');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php

            if ($page_name == 'expense' ||

                    $page_name == 'expense_category' )

                echo 'opened active';

            ?> ">

                     

                 <li class="<?php if ($page_name == 'expense') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>expense/expense">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('expense'); ?></span>

                        </a>

                    </li>







                    <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>expense/expense_category">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('expense_category'); ?></span>

                        </a>

                    </li>

     

                 </ul>

                </li>



                <!--



                 <li class="collect_fee"> <a href="#" ><i data-icon="&#xe006;" class="fa fa-credit-card p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('fee_collection');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php

            if ($page_name == 'income' ||

                        $page_name == 'student_payment'||

                        $page_name == 'view_invoice_details'||

                        $page_name == 'invoice_add'||

                        $page_name == 'list_invoice'||

                        $page_name == 'studentSpecificPaymentQuery'||

                        $page_name == 'student_invoice')

                echo 'opened active';

            ?>">

                    

                 <li class="<?php if ($page_name == 'student_payment') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/student_payment">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('collect_fees'); ?></span>

                        </a>

                    </li>

                    

                     <li class="<?php if ($page_name == 'student_invoice') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/student_invoice">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('manage_invoice'); ?></span>

                        </a>

                    </li>



                    <li class="<?php if ($page_name == 'student_invoice') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/student_invoice">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('list_of_students_that_paid_full'); ?></span>

                        </a>

                    </li>

    

                 </ul>

                </li>

                

    -->

                   

                <!--

                                    

                    <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-fax p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('expenses');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php

            if ($page_name == 'expense' ||

                    $page_name == 'expense_category' )

                echo 'opened active';

            ?> ">

                     

                 <li class="<?php if ($page_name == 'expense') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>expense/expense">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('expense'); ?></span>

                        </a>

                    </li>







                    <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>expense/expense_category">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('expense_category'); ?></span>

                        </a>

                    </li>

     

                 </ul>

                </li

                

    -->



                

        <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-university p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('hostel');?><span class="fa arrow"></span></span></a>

            <ul class=" nav nav-second-level<?php

            if ($page_name == 'dormitory' ||

                    $page_name == 'hostel_category' ||

                    $page_name == 'room_type' ||

                    $page_name == 'hostel_room' )

                echo 'opened active';

            ?>">



                <li class="<?php if ($page_name == 'dormitory') echo 'active'; ?> ">

                <a href="<?php echo base_url(); ?>admin/dormitory">

                <i class="fa fa-angle-double-right p-r-10"></i>

                   <span class="hide-menu"><?php echo get_phrase('manage_hostel'); ?></span>

                </a>

            </li>





                    <li class="<?php if ($page_name == 'hostel_category') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/hostel_category">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                            <span class="hide-menu"><?php echo get_phrase('hostel_category'); ?></span>

                        </a>

                    </li>



                    

                    <li class="<?php if ($page_name == 'hostel_room') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/hostel_room">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                            <span class="hide-menu"><?php echo get_phrase('hostel_room'); ?></span>

                        </a>

                    </li>

     

                 </ul>

                </li>

                

                

                

            <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-car p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('transportation');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level<?php

            if ($page_name == 'transport' ||

                    $page_name == 'transport_route' ||

                    $page_name == 'vehicle' )

                echo 'opened active';

            ?>">

                



        

                <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">

                <a href="<?php echo base_url(); ?>transportation/transport">

                <i class="fa fa-angle-double-right p-r-10"></i>

                   <span class="hide-menu"><?php echo get_phrase('transports'); ?></span>

                </a>

            </li>





                    <li class="<?php if ($page_name == 'transport_route') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>transportation/transport_route">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                            <span class="hide-menu"><?php echo get_phrase('transport_route'); ?></span>

                        </a>

                    </li>





                    

                     <li class="<?php if ($page_name == 'vehicle') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>transportation/vehicle">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                            <span class="hide-menu"><?php echo get_phrase('manage_vehicle'); ?></span>

                        </a>

                    </li>



     

                 </ul>

                </li>



        

        <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-gears p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('system_settings');?><span class="fa arrow"></span></span></a>

        

        <ul class=" nav nav-second-level<?php

                if ($page_name == 'system_settings' ||

                    $page_name == 'manage_language' ||

                    $page_name == 'paymentSetting' ||

                    $page_name == 'sms_settings')

                    echo 'opened active';

                ?>">  



 

                 <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>systemsetting/system_settings">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('general_settings'); ?></span>

                        </a>

                    </li>



  



                    <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>smssetting/sms_settings">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('manage_sms_api'); ?></span>

                        </a>

                    </li>







                    <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>admin/manage_language">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('manage_language'); ?></span>

                        </a>

                    </li>





                    <li class="<?php if ($page_name == 'paymentSetting') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>payment/paymentSetting">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('Payment Settings'); ?></span>

                        </a>

                    </li>

     

                 </ul>

                </li>

                

                

        <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-bar-chart-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('reports');?><span class="fa arrow"></span></span></a>

        

                        <ul class=" nav nav-second-level">  

                

                        <li class="<?php if ($page_name == 'daily_report') echo 'active'; ?>">

                        <a href="../../daily_report/salesreport.php" target="_blank">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('Generate Reports'); ?></span>

                        </a>

                </li>

   

                <li class="<?php if ($page_name == 'studentPaymentReport') echo 'active'; ?>">

                        <a href="<?php echo base_url(); ?>report/studentPaymentReport">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('Student Payments'); ?></span>

                        </a>

                </li>



                <li class="<?php if ($page_name == 'daily_report') echo 'active'; ?>">

                        <a href="<?php echo base_url(); ?>admin/daily_report">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('Daily Report'); ?></span>

                        </a>

                </li>



                <li class="<?php if ($page_name == 'daily_report_me') echo 'active'; ?>">

                        <a href="../../daily_report" target="_blank">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('Daily Report Me'); ?></span>

                        </a>

                </li>



                <li class="<?php if ($page_name == 'monthlyReport') echo 'active'; ?>">

                        <a href="<?php echo base_url(); ?>report/monthlyReport">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('Monthly Report'); ?></span>

                        </a>

                </li>



                <li class="<?php if ($page_name == 'termlyReport') echo 'active'; ?>">

                        <a href="<?php echo base_url(); ?>report/termlyReport">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('Termly Report'); ?></span>

                        </a>

                </li>



                <li class="<?php if ($page_name == 'annualReport') echo 'active'; ?>">

                        <a href="<?php echo base_url(); ?>report/annualReport">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                           <span class="hide-menu"><?php echo get_phrase('Annual Report'); ?></span>

                        </a>

                </li>   

                

                <li class="<?php if ($page_name == 'classAttendanceReport') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>report/classAttendanceReport">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('Attendance Report'); ?></span>

                        </a>

                </li>

                

                <li class="<?php if ($page_name == 'examMarkReport') echo 'active'; ?> ">

                        <a href="<?php echo base_url(); ?>report/examMarkReport">

                        <i class="fa fa-angle-double-right p-r-10"></i>

                             <span class="hide-menu"><?php echo get_phrase('Exam Mark Report'); ?></span>

                        </a>

                </li>



     

                 </ul>

                </li>





        <?php $checking_level = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->level;?>

        <?php if($checking_level == '1'):?>

        <li> <a href="#" ><i data-icon="&#xe006;" class="fa fa-cubes p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('role_managements');?><span class="fa arrow"></span></span></a>

        

            <ul class=" nav nav-second-level<?php

                        if ($page_name == 'newAdministrator') echo 'opened active'; ?>">



                        <li class="<?php if ($page_name == 'admin_add') echo 'active'; ?> ">

                            <a href="<?php echo base_url(); ?>admin/newAdministrator">

                            <i class="fa fa-angle-double-right p-r-10"></i>

                                 <span class="hide-menu"><?php echo get_phrase('new_admin'); ?></span>

                            </a>

                        </li>



     

                 </ul>

            </li>

        <?php endif;?>



        <?php $checking_level = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->level;?>

        <?php if($checking_level == '2'):?>

       



                        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">

                            <a href="<?php echo base_url(); ?>admin/manage_profile">

                            <i class="fa fa-gears p-r-10"></i>

                                 <span class="hide-menu"><?php echo get_phrase('manage_profile'); ?></span>

                            </a>

                        </li>

        <?php endif;?>





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