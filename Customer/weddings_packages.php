<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weddings Packages</title>
    <link rel="stylesheet" href="../Common/CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
</head>
<body>
    <header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">Malcolm Lismore Photography</a>
                <a class="navbar-title position-absolute top-50 start-50 translate-middle" href="weddings_packages.php">Weddings Packages</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.html">Home</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gallery</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="portraits.html">Portraits Gallery</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="weddings.html">Weddings Gallery</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="events.html">Events Gallery</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Packages</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="portraits_packages.php">Portraits Packages</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="weddings_packages.php">Weddings Packages</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="events_packages.php">Events Packages</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                            <li class="nav-item"><a class="nav-link" href="admin_login.php">Admin Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="p-cont">
                <div class="main-text">Specially crafted packages are available to match <br>the specific requirements of each party.</div>
            </div>
            <table>
                <tr>
                    <th>Package</th>
                    <th>Details</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td>Basic Wedding Package</td>
                    <td>
                        <ul>
                            <li>4 hours of coverage</li>
                            <li>Ceremony and formal portraits</li>
                            <li>100 edited high-resolution digital images</li>
                            <li>Online gallery for viewing and downloading</li>
                        </ul>
                    </td>
                    <td>$1,000</td>
                </tr>
                <tr>
                    <td>Standard Wedding Package</td>
                    <td>
                        <ul>
                            <li>8 hours of coverage</li>
                            <li>Full-day coverage from preparation to reception</li>
                            <li>300 edited high-resolution digital images</li>
                            <li>Online gallery for viewing and downloading</li>
                            <li>10x10 wedding album with 20 pages</li>
                        </ul>
                    </td>
                    <td>$2,000</td>
                </tr>
                <tr>
                    <td>Premium Wedding Package</td>
                    <td>
                        <ul>
                            <li>12 hours of coverage</li>
                            <li>Full-day coverage including pre-wedding events</li>
                            <li>500 edited high-resolution digital images</li>
                            <li>Online gallery for viewing and downloading</li>
                            <li>12x12 wedding album with 30 pages</li>
                            <li>Engagement session</li>
                            <li>Two parent albums</li>
                        </ul>
                    </td>
                    <td>$3,500</td>
                </tr>
            </table>
            <div>
                <p class="add-ser">Additional services</p>
                <ul class="add-ser-li">
                    <li>Extra hours: $150 per hour</li>
                    <li>Additional edited images: $20 per image</li>
                    <li>Custom photo albums: Starting at $150</li>
                    <li>Prints and canvases: Prices vary by size</li>
                    <li>Travel fees: Applicable for locations outside a 30-mile radius</li>
                </ul>
                <p><strong>Note:</strong> To get a quote or customize your package please leave us an enquiry.</p>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <section class="contact">
                <div class="contact-det pt-5 my-5">
                    <p>Facebook: <a href="https://www.facebook.com/">facebook.com</a></p>
                    <p>Email: malcolm@photography.com</p>
                </div>
            </section>
            <p>&copy; Malcom Lismore Photography. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
