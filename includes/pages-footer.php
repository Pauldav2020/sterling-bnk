<?php 
error_reporting(0);
require_once 'email.php';
?>

<footer>
            <div class="footer-container">
                <div class="columns">
                    <div class="col">
                        <a href="index">
                            <img src="./../assets/images/starling-logo.png" alt="Starling Logo">
                        </a>
                        <p>
                            Our relationships are built on trust that we build every day through every interaction. Our employees are empowered to do the right 
                            thing to ensure they share our customers’ vision for success.
                        </p>
                    </div>
                    <div class="col">
                        <h4>Company Overview</h4>
                        <ul>
                            <li><a href="about-us"><i class="fa-solid fa-caret-right"></i>About Us</a></li>
                            <li><a href="contact-us"><i class="fa-solid fa-caret-right"></i>Contact Us
                            </a></li>
                        </ul>
                    </div>
                    <div class="col">
                        <h4>Banking Services</h4>
                        <ul>
                            <li><a href="loans"><i class="fa-solid fa-caret-right"></i>Loans</a></li>
                            <li><a href="business-banking"><i class="fa-solid fa-caret-right"></i>Small Business</a></li>
                            <li><a href="commercial-banking"><i class="fa-solid fa-caret-right"></i>Commercial Banking</a></li>
                            <li><a href="invest-rt"><i class="fa-solid fa-caret-right"></i>Investment Banking</a></li>
                            <li><a href="personal-banking"><i class="fa-solid fa-caret-right"></i>Personal Banking</a></li>
                        </ul>
                    </div>
                    <div class="col">
                        <h4>Get In Touch</h4>
                        <div class="col-last">
                            <ul>
                                <li><i class="fa-solid fa-location-dot"></i><a href="https://goo.gl/maps/aQhch75YbqkHS5uE8">Portsmouth, UK</a></li>
                                <li><i class="fa-solid fa-phone"></i>(+44) 440</li>
                                <li><i class="fa-regular fa-envelope"></i><?=$email?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
     
    <!-- live chats start here -->
    <?php include './livechat.php';?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="./assets/js/pages.js"></script>
</html>