<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dynamic index.php for Mentors International Academy
 * - Loads editable sections from database via Website_content_model
 * - Falls back to static content if DB entries are missing
 */

$ci =& get_instance();
$ci->load->model('Website_content_model');

// helper to get content (returns string)
function get_section_content($ci, $slug, $field = 'content', $fallback = '') {
    $s = $ci->Website_content_model->get_section_by_slug($slug);
    if ($s && isset($s[$field]) && $s[$field] !== null && $s[$field] !== '') return $s[$field];
    return $fallback;
}

// helper to get image URL (returns complete URL)
function get_section_image_url($ci, $slug, $fallback_relative = '') {
    $s = $ci->Website_content_model->get_section_by_slug($slug);
    if ($s && !empty($s['image'])) {
        return base_url('uploads/website/' . $s['image']);
    }
    // fallback to site assets inside website/ folder
    return $fallback_relative ? base_url('website/' . ltrim($fallback_relative, '/')) : '';
}

// load gallery
$gallery = $ci->Website_content_model->gallery_list();

?><!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars(get_section_content($ci, 'site_title', 'content', 'Mentors International Academy')) ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta name="description" content="<?= htmlspecialchars(get_section_content($ci, 'meta_description', 'content', 'Mentors International Academy is a model school that tailors to the needs of children of all faith, tribe and socio-cultural background.')) ?>" >
    <meta name="keywords" content="<?= htmlspecialchars(get_section_content($ci, 'meta_keywords', 'content', 'Best school in FCT Abuja Nigeria, Mentors International Academy')) ?>" >
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QQYNF8JRHQ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-QQYNF8JRHQ');
    </script>

    <!-- Favicon -->
    <link href="<?= base_url('website/img/favicon.html') ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&amp;family=Inter:wght@600&amp;family=Lobster+Two:wght@700&amp;display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('website/lib/animate/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('website/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('website/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('website/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
            <a href="<?= base_url() ?>" class="navbar-brand">
                <h1 class="m-0 text-primary"><i class="fa fa-book-reader me-3"></i><?= htmlspecialchars(get_section_content($ci, 'site_brand', 'content', 'Mentors International Academy')) ?></h1>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="<?= base_url() ?>" class="nav-item nav-link active text-info"><?= htmlspecialchars(get_section_content($ci, 'menu_home_text', 'content', 'Home')) ?></a>
                    <a href="<?= base_url('about') ?>" class="nav-item nav-link"><?= htmlspecialchars(get_section_content($ci, 'menu_about_text', 'content', 'About Us')) ?></a>
                    <a href="<?= base_url('appointment') ?>" class="nav-item nav-link"><?= htmlspecialchars(get_section_content($ci, 'menu_appointment_text', 'content', 'Make Appointment')) ?></a>
                    <a href="<?= base_url('portal') ?>" class="nav-item nav-link"><?= htmlspecialchars(get_section_content($ci, 'menu_portal_text', 'content', 'Portal')) ?></a>
                    <a href="<?= base_url('contact') ?>" class="nav-item nav-link"><?= htmlspecialchars(get_section_content($ci, 'menu_contact_text', 'content', 'Contact Us')) ?></a>

                </div>
                <a href="<?= base_url('portal') ?>" class="btn btn-info rounded-pill px-3 d-none d-lg-block"><?= htmlspecialchars(get_section_content($ci, 'menu_portal_text', 'content', 'Portal')) ?><i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

 



        <!-- Carousel Start -->
        <div class="owl-carousel header-carousel position-relative">
            <?php
            // Slider: we expect slugs 'home_hero_image_1', 'home_hero_title_1', 'home_hero_text_1' etc.
            for ($i = 1; $i <= 3; $i++):
                $img_slug = "home_hero_image_{$i}";
                $title_slug = "home_hero_title_{$i}";
                $text_slug = "home_hero_text_{$i}";

                $img = get_section_image_url($ci, $img_slug, 'img/carousel-'.$i.'.jpeg');
                $title = get_section_content($ci, $title_slug, 'content', ($i==1?'The Best choice For Your Child':'Make A Brighter Future For Your Child'));
                $text  = get_section_content($ci, $text_slug, 'content', ($i==1?'Mentors International Academy is a model school that tailors to the needs of children of all faith, tribe and socio-cultural backgrounds.':'At Mentors International Academy Our goal is to groom individuals who would be able to break all tribal and religious barriers while also upholding their own values and identity'));
            ?>
                <div class="owl-carousel-item position-relative">
                    <img class="" src="<?= $img ?>" height="700px" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-2 text-white animated slideInDown mb-4"><?= $title ?></h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2"><?= $text ?></p>
                                    <a href="<?= htmlspecialchars(get_section_content($ci, 'home_hero_btn1_link_'.$i, 'content', '#')) ?>" class="btn btn-info rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft"><?= htmlspecialchars(get_section_content($ci, 'home_hero_btn1_text_'.$i, 'content', 'Learn More')) ?></a>
                                    <a href="<?= htmlspecialchars(get_section_content($ci, 'home_hero_btn2_link_'.$i, 'content', '#')) ?>" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight"><?= htmlspecialchars(get_section_content($ci, 'home_hero_btn2_text_'.$i, 'content', 'Apply Now')) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <!-- Carousel End -->


        <!-- Facilities Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3"><?= htmlspecialchars(get_section_content($ci, 'facilities_title', 'content', 'School Facilities')) ?></h1>
                    <p><?= htmlspecialchars(get_section_content($ci, 'facilities_subtext', 'content', 'We have gone the extra mile to make your child/ward learn comfortably with state of the art facilities.')) ?></p>
                </div>
                <div class="row g-4">
                    <?php
                    // facilities: expect slugs facility_1_title, facility_1_desc, facility_1_icon etc.
                    for ($f = 1; $f <= 4; $f++):
                        $ftitle = get_section_content($ci, "facility_{$f}_title", 'content', ['School Bus','Playground','Science lab','Smart Classroom'][$f-1]);
                        $fdesc  = get_section_content($ci, "facility_{$f}_desc", 'content', ['', '', '', ''][$f-1]);
                        $ficon  = get_section_content($ci, "facility_{$f}_icon", 'content', ['fa-bus-alt','fa-futbol','fa-home','fa-chalkboard-teacher'][$f-1]);
                        $fcolor = get_section_content($ci, "facility_{$f}_color", 'content', ['primary','success','warning','info'][$f-1]);
                        $col_delay = 0.1 + ($f-1)*0.2;
                    ?>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="<?= $col_delay ?>s">
                            <div class="facility-item">
                                <div class="facility-icon bg-<?= $fcolor ?>">
                                    <span class="bg-<?= $fcolor ?>"></span>
                                    <i class="fa <?= $ficon ?> fa-3x text-<?= $fcolor ?>"></i>
                                    <span class="bg-<?= $fcolor ?>"></span>
                                </div>
                                <div class="facility-text bg-<?= $fcolor ?>">
                                    <h3 class="text-<?= $fcolor ?> mb-3"><?= $ftitle ?></h3>
                                    <p class="mb-0"><?= $fdesc ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <!-- Facilities End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="mb-4"><?= htmlspecialchars(get_section_content($ci, 'about_vision_title', 'content', 'Our Vision')) ?></h1>
                        <p><?= get_section_content($ci, 'vision_text', 'content', 'Our vision is to raise world class leaders whose foundation is on strong Christian faith and who believe they can be great in life.') ?></p>
                        <h1 class="mb-4"><?= htmlspecialchars(get_section_content($ci, 'about_mission_title', 'content', 'Our Mission')) ?></h1>
                        <p class="mb-4"><?= get_section_content($ci, 'mission_text', 'content', 'To achieve the above, Mentors employs the Montessori method of teaching alongside jolly phonics, computer appreciation study and AI; thereby nurturing your children from cradle to become the best in their generation.') ?></p>
                        <div class="row g-4 align-items-center">
                            <div class="col-sm-6">
                                <a class="btn btn-primary rounded-pill py-3 px-5" href="<?= htmlspecialchars(get_section_content($ci, 'about_readmore_link', 'content', '#')) ?>">Read More</a>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1"></h6>
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img class="img-fluid w-75 rounded-circle bg-light p-3" src="<?= get_section_image_url($ci, 'about_main_image', 'img/logo.jpg') ?>" alt="">
                            </div>
                            <div class="col-6 text-start" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="<?= get_section_image_url($ci, 'about_image_2', 'img/about-2.jpg') ?>" alt="">
                            </div>
                            <div class="col-6 text-end" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="<?= get_section_image_url($ci, 'about_image_3', 'img/about-3.jpg') ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Call To Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100 rounded" src="<?= get_section_image_url($ci, 'cta_image', 'img/call-to-action.jpg') ?>" style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4"><?= htmlspecialchars(get_section_content($ci, 'cta_title', 'content', 'Apply for Admission')) ?></h1>
                                <p class="mb-4"><?= get_section_content($ci, 'cta_text', 'content', 'Our admission process is very seamless. Download admission form here or visit the school to pick-up a form for your child.') ?></p>
                                <a class="btn btn-primary py-3 px-5" href="<?= htmlspecialchars(get_section_content($ci, 'cta_download_link', 'content', 'Admission_FORM.pdf')) ?>" download><?= htmlspecialchars(get_section_content($ci, 'cta_download_text', 'content', 'Download Now')) ?><i class="fa fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call To Action End -->


        <!-- Classes Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3"><?= htmlspecialchars(get_section_content($ci, 'classes_title', 'content', 'School Classes')) ?></h1>
                    <p><?= htmlspecialchars(get_section_content($ci, 'classes_subtext', 'content', 'From Nursery to College, we have a space for every child regardless of your race or religion.')) ?></p>
                </div>
                <div class="row g-4">
                    <?php
                    // classes: either stored as class_1_title/class_1_image or fallback to static six items
                    for ($c = 1; $c <= 6; $c++):
                        $ctitle = get_section_content($ci, "class_{$c}_title", 'content', ['Art & Drawing','Color Management','Yoga','Phonics & Diction','Coding & Robotics','Music'][$c-1]);
                        $cimg = get_section_image_url($ci, "class_{$c}_image", 'img/classes-' . $c . '.jpg');
                        $delay = 0.1 + ($c-1)*0.2;
                    ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?= $delay ?>s">
                            <div class="classes-item">
                                <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                    <img class="img-fluid rounded-circle" src="<?= $cimg ?>" alt="">
                                </div>
                                <div class="bg-light rounded p-4 pt-5 mt-n5">
                                    <a class="d-block text-center h3 mt-3 mb-4" href="#"><?= $ctitle ?></a>
                                    <div class="row g-1">
                                        <div class="col-4">
                                            <div class="border-top border-3 border-primary pt-2">
                                                <h6 class="text-primary mb-1"></h6>
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="border-top border-3 border-success pt-2">
                                                <h6 class="text-success mb-1"></h6>
                                                <small></small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="border-top border-3 border-warning pt-2">
                                                <h6 class="text-warning mb-1"></h6>
                                                <small></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <!-- Classes End -->


        <!-- Appointment Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4"><?= htmlspecialchars(get_section_content($ci, 'appointment_title', 'content', 'Make Appointment')) ?></h1>
                                <form action="<?= htmlspecialchars(get_section_content($ci, 'appointment_form_action', 'content', '#')) ?>" method="post">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="gname" name="guardian_name" placeholder="Guardian Name">
                                                <label for="gname"><?= htmlspecialchars(get_section_content($ci, 'appointment_label_guardian', 'content', 'Guardian Name')) ?></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control border-0" id="gmail" name="guardian_email" placeholder="Guardian Email">
                                                <label for="gmail"><?= htmlspecialchars(get_section_content($ci, 'appointment_label_email', 'content', 'Guardian Email')) ?></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="cname" name="child_name" placeholder="Child Name">
                                                <label for="cname"><?= htmlspecialchars(get_section_content($ci, 'appointment_label_child', 'content', 'Child Name')) ?></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="cage" name="child_age" placeholder="Child Age">
                                                <label for="cage"><?= htmlspecialchars(get_section_content($ci, 'appointment_label_age', 'content', 'Child Age')) ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0" placeholder="Leave a message here" id="message" name="message" style="height: 100px"></textarea>
                                                <label for="message"><?= htmlspecialchars(get_section_content($ci, 'appointment_label_message', 'content', 'Message')) ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit"><?= htmlspecialchars(get_section_content($ci, 'appointment_submit_text', 'content', 'Submit')) ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100 rounded" src="<?= get_section_image_url($ci, 'appointment_image', 'img/appointment.jpg') ?>" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appointment End -->


        <!-- Gallery (optional section on homepage) -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3"><?= htmlspecialchars(get_section_content($ci, 'gallery_title', 'content', 'Photo Gallery')) ?></h1>
                    <p><?= htmlspecialchars(get_section_content($ci, 'gallery_subtext', 'content', 'Be inspired by our students and facilities.')) ?></p>
                </div>

                <div class="row g-2 pt-2">
                    <?php if (!empty($gallery)): ?>
                        <?php foreach ($gallery as $g): ?>
                            <div class="col-4">
                                <div class="card mb-3">
                                    <img class="img-fluid rounded bg-light p-1" src="<?= base_url('uploads/website/'.$g['image']) ?>" alt="<?= htmlspecialchars($g['title']) ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($g['title']) ?></h5>
                                        <p class="card-text"><?= htmlspecialchars($g['caption']) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- fallbacks -->
                        <div class="col-4"><img class="img-fluid rounded bg-light p-1" src="<?= base_url('website/img/classes-1.jpg') ?>" alt=""></div>
                        <div class="col-4"><img class="img-fluid rounded bg-light p-1" src="<?= base_url('website/img/classes-2.jpg') ?>" alt=""></div>
                        <div class="col-4"><img class="img-fluid rounded bg-light p-1" src="<?= base_url('website/img/classes-3.jpg') ?>" alt=""></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Gallery End -->


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4"><?= htmlspecialchars(get_section_content($ci, 'footer_contact_title', 'content', 'Get In Touch')) ?></h3>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?= htmlspecialchars(get_section_content($ci, 'footer_address', 'content', 'PLOTNO.39, PEYI EXTENTION BWARI ROAD, ABUJA, FCT, ABUJA')) ?></p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?= htmlspecialchars(get_section_content($ci, 'footer_phone', 'content', '08160402212')) ?></p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i><?= htmlspecialchars(get_section_content($ci, 'footer_email', 'content', 'info@MentorsInternationalAcademy.com')) ?></p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="<?= htmlspecialchars(get_section_content($ci, 'social_twitter', 'content', 'https://twitter.com/MentorsInternationalAcademyschools')) ?>"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="<?= htmlspecialchars(get_section_content($ci, 'social_facebook', 'content', 'https://www.facebook.com/MentorsInternationalAcademyInternationalAcademy/')) ?>"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="<?= htmlspecialchars(get_section_content($ci, 'social_instagram', 'content', 'https://www.instagram.com/MentorsInternationalAcademyschools/')) ?>"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Quick Links</h3>
                        <a class="btn btn-link text-white-50" href="<?= base_url('about') ?>">About Us</a>
                        <a class="btn btn-link text-white-50" href="<?= base_url('contact') ?>">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="#"><?= htmlspecialchars(get_section_content($ci, 'footer_quick_3', 'content', 'Classes')) ?></a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Photo Gallery</h3>
                        <div class="row g-2 pt-2">
                            <?php if (!empty($gallery)): ?>
                                <?php foreach(array_slice($gallery, 0, 6) as $g): ?>
                                    <div class="col-4">
                                        <img class="img-fluid rounded bg-light p-1" src="<?= base_url('uploads/website/'.$g['image']) ?>" alt="">
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-4"><img class="img-fluid rounded bg-light p-1" src="<?= base_url('website/img/classes-1.jpg') ?>" alt=""></div>
                                <div class="col-4"><img class="img-fluid rounded bg-light p-1" src="<?= base_url('website/img/classes-2.jpg') ?>" alt=""></div>
                                <div class="col-4"><img class="img-fluid rounded bg-light p-1" src="<?= base_url('website/img/classes-3.jpg') ?>" alt=""></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Newsletter</h3>
                        <p><?= htmlspecialchars(get_section_content($ci, 'footer_newsletter_text', 'content', 'Be the first to get an update from us! subscribe to our newsletter.')) ?></p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="<?= htmlspecialchars(get_section_content($ci, 'footer_newsletter_placeholder', 'content', 'Your email')) ?>">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2"><?= htmlspecialchars(get_section_content($ci, 'footer_newsletter_button', 'content', 'SignUp')) ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#"><?= htmlspecialchars(get_section_content($ci, 'footer_brand_text', 'content', 'Mentors International Academy')) ?></a>, All Right Reserved &copy; <?= date('Y') ?>. 
                            
                            Designed By <a class="border-bottom" href="<?= htmlspecialchars(get_section_content($ci, 'footer_designer_link', 'content', 'https://aveeict.com/')) ?>">AVEE ICT Consult & Services </a>
                            
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="<?= base_url() ?>">Home</a>
                                <a href="#"><?= htmlspecialchars(get_section_content($ci, 'footer_cookie_link_text', 'content', 'Cookies')) ?></a>
                                <a href="#"><?= htmlspecialchars(get_section_content($ci, 'footer_help_link_text', 'content', 'Help')) ?></a>
                                <a href="#"><?= htmlspecialchars(get_section_content($ci, 'footer_faq_link_text', 'content', 'FQAs')) ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('website/lib/wow/wow.min.js') ?>"></script>
    <script src="<?= base_url('website/lib/easing/easing.min.js') ?>"></script>
    <script src="<?= base_url('website/lib/waypoints/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('website/lib/owlcarousel/owl.carousel.min.js') ?>"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('website/js/main.js') ?>"></script>
</body>


</html>
