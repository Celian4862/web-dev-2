<nav class="sticky-top bg-white p-3 text-center">
    <a href="<?php echo isset($_SESSION['username']) ? './dashboard.php' : './index.php'; ?>" style="margin: 0 5% 0 0;">
        <img src="./assets/images/ICONSOLO.png" alt="logo" width="3%" class="img-fluid" />
    </a>
    <div class="d-inline-flex">
        <ul class="p-0 m-0">
            <?php if (isset($_SESSION["username"])) { ?>
                <li class="d-inline-block mx-4"><a href="./dashboard.php">Dashboard</a></li>
            <?php } else { ?>
                <li class="d-inline-block mx-4"><a href="./index.php">Home</a></li>
                <li class="d-inline-block mx-4"><a href="./about_us.php">About Us</a></li>
                <li class="d-inline-block mx-4"><a href="./support.php">Support</a></li>
            <?php } ?>
        </ul>
        <form id="search" class="px-5">
            <input id="search-bar" name="search-bar" type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
        <ul class="p-0 m-0">
            <?php if (isset($_SESSION["username"])) { ?>
                <li class="d-inline-block mx-4"><a href="./assets/processing_php/logout.php">Log out</a></li>
            <?php } else { ?>
                <li class="d-inline-block mx-4"><a href="./signup.php">Sign up</a></li>
                <li class="d-inline-block mx-4"><a href="./login.php">Log in</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>