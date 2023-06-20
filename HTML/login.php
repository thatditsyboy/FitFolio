<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitfolio</title>
    <link rel="icon" type="image/x-icon" href="../Images/Home/favicon.ico">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../CSS/home2.css">

    <!-- drop down arrow google-font link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>

<?php

//Storing email & password from login form for auth
$email=$_POST["email"];
$password=$_POST["password"];

//Creating connection to fitfolio database
$conn= new mysqli("localhost","root","password","fitfolio");

//Checking connection
if($conn->connect_error){
die("connection failed:".$conn->connect_error);
}

//Fetching Data 
$sql = "SELECT Email, Pass FROM users";
$result = $conn->query($sql);

// Authorizing Entered credentials with Database entries
$trigger=0;
while($row = $result->fetch_assoc()) {
    if ($email==$row["Email"] && $password==$row["Pass"]){
        $trigger++;
        break;
    }
}
if ($trigger==0){
    header( 'Location: sorry.html' );
}
$conn->close();

//Creating connection to fitfolio database
$conn= new mysqli("localhost","root","password","fitfolio");

//Checking connection
if($conn->connect_error){
die("connection failed:".$conn->connect_error);
}

//Fetching Data 
$sql = "SELECT UserName, Subscription, Age, Height_cm, Weight_kg FROM users WHERE Email='$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$name=$row["UserName"];
$age=$row["Age"];
$height=$row["Height_cm"];
$weight=$row["Weight_kg"];
$subscription=$row["Subscription"];

$conn->close();
  
?>

<!-- header section starts      -->

<header class="header">

    <a href="#" class="logo"> <span>Fit</span>Folio </a>

    <div id="menu-btn" class="fas fa-bars"></div>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#features">features</a>
        <a href="#pricing">pricing</a>
        <div class="calc-dropdown">
            <a href="#trainers" style="width: 150.1px; text-align: center; padding-left: 2.0039rem;">Calculators<span class="material-symbols-outlined">expand_more</span></a>
              <div class="calc-list">
                  <a href="Calculators/bmi.html">BMI</a>
                  <a href="Calculators/bmr.html">BMR</a>
                  <a href="Calculators/cbc.html">CBC</a>
              </div>
          </div>  
        <a href="#blogs">blogs</a>
        <div class="calc-dropdown">
        <a href="#" class="login-topright"><p>Profile <i class="fas fa-user-edit"></i></p></a>
           <div class="calc-list2">
              <p style="font-size: 1.54rem; color: white; display: inline-block; padding-left: 2rem; padding-right: 2rem; padding-top: 1.5rem;"><?php echo $name ?> <br><br> <?php echo $subscription ?></p>
              <a href="home.html" class="logout" style="width: 100%; font-size: 1.8rem; color: red; padding-top: 1.9rem;">Logout</a>
           </div>
        </div>
    </nav>

</header>

<!-- header section ends     -->

<!-- Login popup window starts -->
<!-- <div class="wrapper">

<span class="close-btn">x</span>
<div class="login" id="login-window">
    <h2 style="text-transform: uppercase; font-size: 2.5rem; color: aliceblue; width: 100%; text-align: center;">Login</h2>
    
    <form action="../Backend/login.php" method="post">
        <div class="input-space" id="Email-input-box">
            <input type="text" name="email" required id="emailinput">
            <label for="emailinput">Email</label>
        </div>
        <div class="input-space" id="Password-input-box">
            <input type="password" required id="pass-input" name="password">
            <label for="pass-input">Password</label>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox">Remember Me</label>
            <a href="#">Forgot Password?</a>
        </div>
        <input type="submit" class="login-button" value="Login">
        <div class="no-acc-yet">Don't have an account yet? <a href="#" style="font-size: 115%;" class="register-link"> Register!</a></div>
    </form>
</div>
<div class="register" id="registration-window">
    <h2 style="text-transform: uppercase; font-size: 2.5rem; color: aliceblue; width: 100%; text-align: center;">Register</h2>
    <form action="../Backend/register.php" method="post">
        <div class="input-space" id="name-input-box">
            <input type="text" name="name" required id="nameinput">
            <label for="nameinput">Name</label>
        </div>
        <div class="input-space" id="Email-input-box-register">
            <input type="text" name="email" required id="emailinputregister">
            <label for="emailinput">Email</label>
        </div>
        <div class="horizontal-input">
            <div class="input-space" id="age-input-box">
                <input type="number" name="age" required id="ageinput">
                <label for="ageinput">Age</label>
            </div>
            <div class="input-space" id="height-input-box">
                <input type="number" name="height" required id="heightinput">
                <label for="heightinput">Height</label>
            </div>
            <div class="input-space" id="weight-input-box">
                <input type="number" name="weight" required id="weightinput">
                <label for="weightinput">Weight</label>
            </div>
        </div>
        <div class="input-space" id="Password-input-box-register">
            <input type="password" required id="pass-input-register" name="password">
            <label for="pass-input">Password</label>
        </div>
        <div class="remember-forgot" id="subscription-radio">
            <label for="Free"><input type="radio" name="subscription" value="Free" id="Free">Free</label>
            <label for="Basic"><input type="radio" name="subscription" value="Basic" id="Basic">Basic</label>
            <label for="Premium"><input type="radio" name="subscription" value="Premium" id="Premium">Premium</label>
        </div>
        <div class="remember-forgot">
            <label id="tnc"><input type="checkbox" required>I agree to the terms & conditions</label>
        </div>
        <input type="submit" class="login-button" value="Register">
        <div class="no-acc-yet">Already have an account? <a href="#" style="font-size: 115%;" class="login-link"> Login!</a></div>
    </form>
</div>


</div> -->
<!-- Login popup window ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="swiper home-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide" style="background: url(../Images/Home/home-bg-1.jpg) no-repeat;">
                <div class="content">
                    <span>be strong, be fit</span>
                    <h3>Make yourself stronger than your excuses.</h3>
                    <a href="#" class="btn">get started</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background: url(../Images/Home/home-bg-2.jpg) no-repeat;">
                <div class="content">
                    <span>be strong, be fit</span>
                    <h3>Make yourself stronger than your excuses.</h3>
                    <a href="#" class="btn">get started</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background: url(../Images/Home/home-bg-3.jpg) no-repeat;">
                <div class="content">
                    <span>be strong, be fit</span>
                    <h3>Make yourself stronger than your excuses.</h3>
                    <a href="#" class="btn">get started</a>
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="image">
        <img src="../Images/Home/about-img.jpg" alt="">
    </div>

    <div class="content">
        <span>about us</span>
        <h3 class="title">Every day is a chance to become better</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione quia accusamus dicta inventore nobis obcaecati vero odio, id dolorum. Consequatur ex, aperiam deserunt nostrum perferendis illum unde ipsa? Consequatur, distinctio?</p>
        <div class="box-container">
            <div class="box">
                <h3><i class="fas fa-check"></i>body and mind</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, enim.</p>
            </div>
            <div class="box">
                <h3><i class="fas fa-check"></i>healthy life</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, enim.</p>
            </div>
            <div class="box">
                <h3><i class="fas fa-check"></i>strategies</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, enim.</p>
            </div>
            <div class="box">
                <h3><i class="fas fa-check"></i>workout</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, enim.</p>
            </div>
        </div>
        <a href="#" class="btn">read more</a>
    </div>

</section>

<!-- about section ends -->

<!-- features section starts  -->

<section class="features" id="features">

    <h1 class="heading"> <span>gym features</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <img src="../Images/Home/f-img-1.jpg" alt="">
            </div>
            <div class="content">
                <img src="../Images/Home/icon-1.png" alt="">
                <h3>body building</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, atque.</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

        <div class="box second">
            <div class="image">
                <img src="../Images/Home/f-img-2.jpg" alt="">
            </div>
            <div class="content">
                <img src="../Images/Home/icon-2.png" alt="">
                <h3>gym for men</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, atque.</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../Images/Home/f-img-3.jpg" alt="">
            </div>
            <div class="content">
                <img src="../Images/Home/icon-3.png" alt="">
                <h3>gym for women</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, atque.</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

    </div>

</section>

<!-- features section ends -->

<!-- pricing section starts  -->

<section class="pricing" id="pricing">

    <div class="information">
        <span>pricing plan</span>
        <h3>affordable pricing plan for your</h3>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam dolore excepturi ea suscipit fugiat cum quae, rerum optio mollitia! Tempora?</p>
        <p> <i class="fas fa-check"></i> cardio exercise </p>
        <p> <i class="fas fa-check"></i> weight lifting </p>
        <p> <i class="fas fa-check"></i> diet plans </p>
        <p> <i class="fas fa-check"></i> overall results </p>
        <a href="#" class="btn">all pricing</a>
    </div>

    <div class="plan basic">
        <h3>basic plan</h3>
        <div class="price"><span>$</span>30<span>/mo</span></div>
       <div class="list">
        <p> <i class="fas fa-check"></i> personal training </p>
        <p> <i class="fas fa-check"></i> cardio exercise </p>
        <p> <i class="fas fa-check"></i> weight lifting </p>
        <p> <i class="fas fa-check"></i> diet plans </p>
        <p> <i class="fas fa-check"></i> overall results </p>
       </div>
       <a href="#" class="btn">get started</a>
    </div>

    <div class="plan">
        <h3>premium plan</h3>
        <div class="price"><span>$</span>90<span>/mo</span></div>
       <div class="list">
        <p> <i class="fas fa-check"></i> personal training </p>
        <p> <i class="fas fa-check"></i> cardio exercise </p>
        <p> <i class="fas fa-check"></i> weight lifting </p>
        <p> <i class="fas fa-check"></i> diet plans </p>
        <p> <i class="fas fa-check"></i> overall results </p>
       </div>
       <a href="#" class="btn">get started</a>
    </div>

</section>

<!-- pricing section ends -->

<!-- trainers section starts  -->

<section class="trainers" id="trainers">

    <h1 class="heading"> <span>expert trainers</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="../Images/Home/trainer-1.jpg" alt="">
            <div class="content">
                <span>expert trainer</span>
                <h3>john deo</h3>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>
        </div>

        <div class="box">
            <img src="../Images/Home/trainer-2.jpg" alt="">
            <div class="content">
                <span>expert trainer</span>
                <h3>john deo</h3>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>
        </div>

        <div class="box">
            <img src="../Images/Home/trainer-3.jpg" alt="">
            <div class="content">
                <span>expert trainer</span>
                <h3>john deo</h3>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>
        </div>

        <div class="box">
            <img src="../Images/Home/trainer-4.jpg" alt="">
            <div class="content">
                <span>expert trainer</span>
                <h3>john deo</h3>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>
        </div>

    </div>

</section>

<!-- trainers section ends -->

<!-- banner section starts  -->

<section class="banner">

    <span>join us now</span>
    <h3>get upto 50% discount</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat architecto nesciunt aut sapiente quis inventore quam vitae quod illum incidunt.</p>
    <a href="#" class="btn">get discount</a>

</section>

<!-- banner section ends -->

<!-- review section starts  -->

<section class="review">

    <div class="information">
        <span>testimonials</span>
        <h3>what our clients says</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis voluptas praesentium asperiores fugiat, excepturi odit obcaecati a voluptatibus earum quisquam?</p>
        <a href="#" class="btn">read more</a>
    </div>

    <div class="swiper review-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, quo.</p>
                <div class="user">
                    <img src="../Images/Home/pic-1.png" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>designer</span>
                    </div>
                    <i class="fas fa-quote-left"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, quo.</p>
                <div class="user">
                    <img src="../Images/Home/pic-2.png" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>designer</span>
                    </div>
                    <i class="fas fa-quote-left"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, quo.</p>
                <div class="user">
                    <img src="../Images/Home/pic-3.png" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>designer</span>
                    </div>
                    <i class="fas fa-quote-left"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, quo.</p>
                <div class="user">
                    <img src="../Images/Home/pic-4.png" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>designer</span>
                    </div>
                    <i class="fas fa-quote-left"></i>
                </div>
            </div>

        </div>

    </div>

</section>


<!-- review section ends -->

<!-- blogs section starts  -->

<section class="blogs" id="blogs">

    <h1 class="heading"> <span>blogs</span> </h1>

    <div class="swiper blogs-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="../Images/Home/blog-1.jpg" alt="">
                </div>
                <div class="content">
                    <div class="link"> <a href="#">FitFolio Originals</a> <span>|</span> <a href="#">21st may, 2023</a> </div>
                    <h3>IS A CALORIE REALLY A CALORIE?</h3>
                    <p>Understanding how to balance your diet to give you the right amount of sanity – while not letting your hunger go wild.</p>
                    <a href="../HTML/blog1/blog1.html" class="btn">read more</a>
                </div>
            </div>
            
            <div class="swiper-slide slide">
                <div class="image">
                    <img src="../Images/Home/blog-2.jpg" alt="">
                </div>
                <div class="content">
                    <div class="link"> <a href="#">FitFolio Originals</a> <span>|</span> <a href="#">20th March, 2023</a> </div>
                    <h3>Motivation vs. Consistency: Which One Helps You Build Lifelong Habits?</h3>
                    <p>In the battle of motivation vs. consistency, which one wins?</p>
                    <a href="../HTML/blog-2/blog2.html" class="btn">read more</a>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="../Images/Home/blog-3.jpg" alt="">
                </div>  
                <div class="content">
                    <div class="link"> <a href="#">FitFolio Originals</a> <span>|</span> <a href="#">1st april, 2023</a> </div>
                    <h3>3 Ways to Support Your Hormone Health and Wellness with Breathwork</h3>
                    <p>The connection between breathwork and hormone health and wellness cannot be ignored. </p>
                    <a href="../HTML/blog3/blog3.html" class="btn">read more</a>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="../Images/Home/blog-4.jpg" alt="">
                </div>
                <div class="content">
                    <div class="link"> <a href="#">FitFolio Originals</a> <span>|</span> <a href="#">13th May, 2023</a> </div>
                    <h3>Incorporate Healthy Habits into Your Life with Habit Stacking</h3>
                    <p>You’ll learn how to make a plan to implement new habits, how to use habit stacking to build on existing habits, and how habits can help you create a new identity. </p>
                    <a href="../HTML/blog4/blog4.html" class="btn">read more</a>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="../Images/Home/blog-5.jpg" alt="">
                </div>
                <div class="content">
                    <div class="link"> <a href="#">FitFolio Originals</a> <span>|</span> <a href="#">11 June, 2023</a> </div>
                    <h3>5 Ways to Heal an Unhealthy Relationship with Food</h3>
                    <p>An unhealthy relationship with food can form for many reasons. Whether your parents or caregivers were long-term dieters.</p>
                    <a href="../HTML/blog5/blog5.html" class="btn">read more</a>
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- blogs section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a class="links" href="#home">home</a>
            <a class="links" href="#about">about</a>
            <a class="links" href="#features">features</a>
            <a class="links" href="#pricing">pricing</a>
            <a class="links" href="#trainers">trainers</a>
            <a class="links" href="#blogs">blogs</a>
        </div>

        <div class="box">
            <h3>opening hours</h3>
            <p> monday : <i> 7:00am - 10:30pm </i> </p>
            <p> tuesday : <i> 7:00am - 10:30pm </i> </p>
            <p> wednesday : <i> 7:00am - 10:30pm </i> </p>
            <p> friday : <i> 7:00am - 10:30pm </i> </p>
            <p> saturday : <i> 7:00am - 10:30pm </i> </p>
            <p> sunday : <i> closed </i> </p>
        </div>

        <div class="box">
            <h3>opening hours</h3>
            <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
            <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
            <p> <i class="fas fa-envelope"></i> fitfolio@gmail.com </p>
            <p> <i class="fas fa-map"></i> mumbai, india - 400104 </p>
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-linkedin"></a>
                <a href="#" class="fab fa-pinterest"></a>
            </div>
        </div>

        <div class="box">
            <h3>newsletter</h3>
            <p>subscribe for latest updates</p>
            <form action="">
                <input type="email" name="" class="email" placeholder="enter your email" id="">
                <input type="submit" value="subscribe" class="btn">
            </form>
        </div>

    </div>

</section>

<div class="credit"> created by <span>FitFolio Developers</span> | all rights reserved! </div>

<!-- footer section ends -->













<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="../JS/home.js"></script>

</body>
</html>