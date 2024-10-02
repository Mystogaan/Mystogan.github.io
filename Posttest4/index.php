<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Welcome message -->
    <div id="welcomeMessage" style="display:none;">
        <p id="greetingMessage"></p>
    </div>
    
    <!-- Box Right -->
    <div class="container-login" id="container">
        <!-- Box Left -->
        <div class="box-left">
            <div class="toggle">
                <h1>Welcome Back!</h1>
                <p>Enter your personal details to use all of site features</p>
            </div>
        </div>
        <div class="box-right" id="box-right">
            <div class="content-right">
                <form id="loginForm">
                    <h1>Sign In</h1>
                    <span>Use your email and password</span>
                    <input type="text" id="name" placeholder="Name" required>
                    <input type="email" id="email" placeholder="Email" required>
                    <input type="password" id="password" placeholder="Password" required>
                    <button type="submit">Sign In</button>
                </form>
            </div>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>
</html>