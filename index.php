<!-- Try CodeIgniter -->
<?php
    require "./components/session_details.php";
    if (isset($_SESSION['username'])) {
        header ("Location: ./dashboard.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>A&ccedil;a&iacute;: Adaptive Community - Assisted Infrastructure</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Join the Açaí Forum to discuss and propose infrastructure development in your city.">
        <meta name="keywords" content="city, development, infrastructure, forum, community">
        <meta name="author" content="Açaí Innovators Team">
        <?php require "./components/head.html"; ?>
    </head>
    <body>
        <?php require "./components/nav.php"; ?>
        <div class="background-half">
            <div class="full-center">
                <h1 class="fade-in-header">Everyone deserves to live in a well-constructed area.</h1>
                <p class="fade-in-description">But over time, the quality of infrastructure starts to go down.</p>
                <p class="fade-in-description"> Nobody wants cracks in their buildings and sidewalks. </p>
                <p class="fade-in-description"> So why not build your city, your way? </p>
            </div>
        </div>
        <div>
            <div class="text-center p-3 mt-5">
                <h2>This is A&ccedil;a&iacute;.</h2>
                <p>Adaptive Community-Assisted Infrastructure, also known as A&ccedil;a&iacute;, is a forum project dedicated to bridging gaps between communities, both socially and physically, by bringing to attention places of poor development. This website intends to give the community a voice that can operate without the intervention of other forces, one that can be taken up as a commission by any willing benefactor, and can track the changes in real-time in accordance with the needs and wants of the community throughout the process. </p>
            </div>
        </div>
    </body>
</html>
