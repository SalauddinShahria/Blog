 <footer>
        <!-- Footer Widget Section Start -->
        <div class="footer-widget background-img section">
            <div class="container">
                <div class="row">

                    <!-- Footer Widget One Start-->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span> শিখবে সবাই </span> ব্লগ প্রজেক্ট </h4>
                        </div>
                        <p> আমি শিখবে সবাই এর একজন ছাত্র। একজন প্রোগ্রামার হিসেবে নতুন নতুন প্রজেক্ট করতে হয়। আমারকে ফলো করুন  </p>
                        <!-- Social Media -->
                        <div class="widget-title">
                            <h4><span> সোশ্যাল </span> মিডিয়া </h4>
                        </div>

                        <div class="social-media">
                            <ul>
                                <li>
                                    <a href=""><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget One End-->

                    <!-- Footer Widget Two Start -->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span> প্রয়োজনী </span> লিংক সমূহ </h4>
                        </div>
                        <div class="useful-links">
                            <ul>
                                <li><a href=""> আমাদের সম্নধে </a></li>
                                <li><a href=""> প্রটোফলিও </a></li>
                                <li><a href=""> পেজ </a></li>
                                <li><a href=""> আপনার প্রশন? </a></li>
                                <li><a href=""> আমাদের উদ্দেশ্য </a></li>
                                <li><a href="">  শর্তাবলী স্মূহ </a></li>
                                <li><a href=""> যোগাযোগ </a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget Two End -->

                    <!-- Footer Widget Three Start -->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span>আমাদের সাথে</span> যোগাযোগ </h4>
                        </div>
                        <div class="contact-with-us">
                            <ul>
                                <li>
                                    <a><i class="fa fa-home"></i> জিন্দাবাজার, সিলেট। </a>
                                </li>
                                <li>
                                    <a><i class="fa fa-envelope-o"></i>blog.project@gmail.com</a>
                                </li>
                                <li>
                                    <a><i class="fa fa-phone"></i> ০১৭৪৮-৮৪৬৯৮৪ </a>
                                </li>
                                <li>
                                    <a><i class="fa fa-clock-o"></i>সকাল ৯ টা থেকে সন্ধ্যা ৭ টা পর্যন্ত</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget Three End -->

                    <!-- Footer Widget Four Start -->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span>সাবস্ক্রাইব</span> করুন </h4>
                        </div>
                        <p> আমাদের ব্লগের নতুন নতুন ফিচার, সংবাদ, ও আপডেট পেতে সাবস্ক্রাইব করুন। </p>
                        <!-- Subscribe From Start -->
                        <form action="" method="POST">
                            <div class="form-group ">
                                <input type="email" name="email" placeholder="Enter Your Email" autocomplete="off" class="form-input" required="required">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <!-- Subscribe Button -->
                            <div class="">
                                <button type="submit" name="subscribe" class="btn-main"><i class="fa fa-paper-plane-o"></i> সাবস্ক্রাইব </button>
                            </div>
                        </form>
                        <!-- Subscribe From End -->

                        <?php
                            if(isset($_POST['subscribe'])){
                                $s_email = $_POST['email'];
                                $sub_date = $_POST['sub_date'];

                                $query = "INSERT INTO subscribtion_list (sub_email, sub_date) VALUES ('$s_email', now() )";
                                $subscribeDone = mysqli_query($db, $query);

                                if($subscribeDone){
                                  header("Location: index.php");
                                }
                                else{
                                  die("MySQLi Query Failed". mysqli_error($db));
                                } 

                            }   
                        ?>

                    </div>
                    <!-- Footer Widget Four End -->

                </div>
            </div>
        </div>
        <!-- Footer Widget Section End -->


        <!-- CopyRight Section Start -->
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <!-- Copyright Left Content -->
                    <div class="col-md-6">
                        <p><a href="">ব্লগ প্রজেক্ট</a> © ২০২০ অল রাইট রিসিভড</p>
                    </div>

                    <!-- Copyright Right Footer Menu Start -->
                    <div class="col-md-6">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="">আমাদের সমন্ধে</a></li>
                                <li><a href="">জিজ্ঞাসা</a></li>
                                <li><a href="">শর্তাবলী</a></li>
                                <li><a href="">যোগাযোগ</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Copyright Right Footer Menu End -->
                </div>
            </div>
        </div>
        <!-- CopyRight Section End -->
    </footer>
    <!-- ::::::::::: Footer Section End ::::::::: -->


    <!-- JQuery Library File -->
    <script type="text/javascript" src="assets/js/jquery-1.12.4.min.js"></script>
    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->

    <!-- Bootstrap JS -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <!-- Isotop JS -->
    <script src="assets/js/isotop.min.js"></script>

    <!-- Fency Box JS -->
    <script src="assets/js/jquery.fancybox.min.js"></script>

    <!-- Easy Pie Chart JS -->
    <script src="assets/js/jquery.easypiechart.js"></script>

    <!-- JQuery CounterUp JS -->
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!--- Menu Sticky --->
    <script src="assets/js/jquery.sticky.js"></script>

    <script src="assets/js/jquery.sticky.js"></script>
    <script>
      $(document).ready(function(){
        $("#sticker").sticky({topSpacing:0});
      });
    </script>

    <!-- BlueChip Extarnal Script -->
    <script type="text/javascript" src="assets/js/main.js"></script>

    <?php
        ob_end_flush();
    ?>

  </body>
</html>