<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
<!--    <a class="navbar-brand" href="#">Navbar</a>-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
        </ul>
        <form class="d-flex mx-auto">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <ul class="navbar-nav mx-3">
            <li class="nav-item">
                 <?php if (isset($isRestricted) && $isRestricted):?>
                     <a class="nav-link active" aria-current="page" href="#">Hello, <?php echo $_SESSION['username'] ?></a>
                 <?php else:?>
                     <a class="nav-link active" aria-current="page" href="#">Sign In</a>
                 <?php endif;?>
            </li>
            <div class="vl"></div>
            <li class="nav-item">
                <?php if (isset($isRestricted) && $isRestricted):?>
                    <a class="nav-link active" aria-current="page" href="#">Sign out</a>
                <?php else:?>
                    <a class="nav-link active" aria-current="page" href="#">Sign up</a>
                <?php endif;?>
            </li>
        </ul>
    </div>
</div>
</nav>