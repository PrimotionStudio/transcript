<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Transcript Tracker - Secure and Decentralized</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary text-lg" href="#">

                <img src="assets/img/logo-ct-dark.png" class="navbar-brand-img me-2" style='height: 40px; width: 40px;' alt="main_logo"> University Transcript Tracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-2" href="login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-primary text-white py-5 mt-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-white fw-bold mb-4">Secure and Decentralized University Transcript Tracking</h1>
                    <p class="lead mb-4">Our system utilizes blockchain technology and cloud storage to provide a secure and transparent way to track university transcripts.</p>
                    <div class="d-flex gap-3">
                        <a href="register" class="btn btn-light btn-lg">Get Started</a>
                        <a href="#learn-more" class="btn btn-outline-light btn-lg">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="assets/img/banner.jpeg" alt="Secure Transcript Tracking" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose University Transcript Tracker?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-lock text-primary fa-3x mb-3"></i>
                            <h5 class="card-title">Secure Storage</h5>
                            <p class="card-text">Your transcripts are stored securely on our cloud storage system, protected by blockchain technology.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-bolt text-primary fa-3x mb-3"></i>
                            <h5 class="card-title">Fast and Efficient</h5>
                            <p class="card-text">Our system allows for fast and efficient tracking and retrieval of university transcripts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-headset text-primary fa-3x mb-3"></i>
                            <h5 class="card-title">24/7 Support</h5>
                            <p class="card-text">Our dedicated team is always available to assist you with any questions or concerns.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">How It Works</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="timeline">
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-1 text-primary me-2"></i> Upload Transcript</h5>
                                <p class="card-text">Upload your university transcript to our secure cloud storage system.</p>
                            </div>
                        </div>
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-2 text-primary me-2"></i> Blockchain Verification</h5>
                                <p class="card-text">Our system utilizes blockchain technology to verify the authenticity of your transcript.</p>
                            </div>
                        </div>
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-3 text-primary me-2"></i> Secure Storage</h5>
                                <p class="card-text">Your transcript is stored securely on our cloud storage system, protected by blockchain technology.</p>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-4 text-primary me-2"></i> Access and Share</h5>
                                <p class="card-text">You can access and share your transcript securely with others, using our system.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="get-started" class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="mb-4">Ready to Get Started?</h2>
            <p class="lead mb-4">Join thousands of satisfied users who trust University Transcript Tracker for their transcript tracking needs.</p>
            <a href="#signup" class="btn btn-light btn-lg">Create Free Account</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="mb-3">University Transcript Tracker</h5>
                    <p class="mb-0">Secure and decentralized university transcript tracking system.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">About Us</a></li>
                        <li><a href="#" class="text-white-50">Contact</a></li>
                        <li><a href="#" class="text-white-50">Terms of Service</a></li>
                        <li><a href="#" class="text-white-50">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Connect With Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white-50"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-linkedin fa-lg"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php
    require_once "included/scripts.php";
    ?>
</body>

</html>