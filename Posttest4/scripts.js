document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    var name = document.getElementById("name").value;

    console.log("Form Submitted");
    console.log("Name:", name);
    
    let greeting = `Hi, ${name}! Welcome back!`;
    console.log("Greeting Message:", greeting);
    
    // Sembunyikan container login
    document.getElementById("container").style.display = "none";
    
    // Tampilkan dan atur pesan greeting
    const welcomeMessage = document.getElementById("welcomeMessage");
    const greetingMessage = document.getElementById("greetingMessage");
    
    greetingMessage.innerText = greeting;
    welcomeMessage.style.display = "flex";

    setTimeout(function() {
        window.location.href = "home.php";
    }, 3000);
});