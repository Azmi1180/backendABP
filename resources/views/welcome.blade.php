<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instannews - Daily Digest News at Your Fingertips</title>     
</head>
<body>
    <div class="container">
        <header>
            <div class="top-nav">
                <div class="empty-space"></div>
                <a href="{{ url('login') }}" class="login-btn">Log In Now →</a>
            </div>
            
            <div class="hero-section">
                <div class="logo">
                    <img src="{{ asset('instannews.png') }}" alt="Instannews Logo">
                </div>
                <div class="hero-content">
                    <h1>Instannews</h1>
                    <h2>Daily Digest News at Your Fingertips</h2>
                    <p>In this digital age, information spreads rapidly. Instannews is the solution to access news efficiently through daily digests and effective news management.</p>
                </div>
            </div>
        </header>

        <section class="features-section">
            <h2>Key Features</h2>
            
            <div class="feature">
                <div class="feature-icon">
                    <img src="{{ asset('dailydigest.png') }}" alt="Daily Digest Icon" class="feature-img">
                </div>
                <div class="feature-content">
                    <h3>Daily Digest</h3>
                    <p>Receive a daily summary of important news automatically curated by AI</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <img src="{{ asset('news.png') }}" alt="Icon" class="feature-img">
                </div>
                <div class="feature-content">
                    <h3>Automated News Collection</h3>
                    <p>Automatically gathered every day via Newsdata.io API</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <img src="{{ asset('filters.png') }}" alt="filter icon" class="feature-img">
                </div>
                <div class="feature-content">
                    <h3>News Category Filters</h3>
                    <p>Instannews filters the news to deliver only relevant information to you.</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <img src="{{ asset('news.png') }}" alt="search icon" class="feature-img">
                </div>
                <div class="feature-content">
                    <h3>Smart News Search</h3>
                    <p>The search feature makes it easy to find news based on keywords</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <img src="{{ asset('bookmark .png') }}" alt="bookmark Icon" class="feature-img">
                </div>
                <div class="feature-content">
                    <h3>CRUD Bookmarking</h3>
                    <p>Manage and access your favorite news anytime</p>
                </div>
            </div>
        </section>

        <section class="why-section">
            <h2>Why Instannews?</h2>
            
            <div class="why-content">
                <div class="why-image">
                    <img src="{{ asset('foto.png') }}" alt="Person using phone">
                </div>
                <div class="why-points">
                    <ul>
                        <li><strong>Flexible Access:</strong> Enjoy news via both web and mobile apps, anytime, anywhere.</li>
                        <li><strong>AI-Powered:</strong> Leverage Gemini API technology to deliver summarized news efficiently.</li>
                        <li><strong>Easy News Management:</strong> Save and organize news you consider important with ease.</li>
                        <li><strong>User-Centric:</strong> Customize your experience with category filters and smart search.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <p>Instannews is available on both web and mobile platforms.<br>
               Sign up today to start accessing news in a more efficient and enjoyable way!</p>
            
            <div class="cta-buttons">
                <a href="{{ url('login') }}" class="cta-btn sign-in">Sign In</a>
                <a href="{{ url('signup') }}" class="cta-btn sign-up">Sign Up</a>
            </div>
        </section>
        
        <footer>
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('instannews.png') }}" alt="Instannews Logo">
                    <div class="social-icons">
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="footer-links">
                    <div class="footer-column">
                        <h3>Navigation</h3>
                        <ul>
                            <li><a href="{{ url('/') }}">Home / Landing</a></li>
                            <li><a href="#">About Instannews</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-column">
                        <h3>Instannews</h3>
                        <ul>
                            <li><a href="{{ url('login') }}">Log In</a></li>
                            <li><a href="{{ url('signup') }}">Sign Up</a></li>
                            <li><a href="#">Key Features</a></li>
                            <li><a href="#">Why Instannews</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>