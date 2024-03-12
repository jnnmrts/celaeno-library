const loginForm = document.getElementById("login-form");
const message = document.getElementById("message");

loginForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const username = loginForm.username.value.trim();
  const password = loginForm.password.value.trim();

  if (username === "" || password === "") {
    message.textContent = "Please fill in all fields";
    message.style.display = "block";
    return;
  }

  // Check if username and password are correct
  if (username === "username" && password === "password") {
    message.textContent = "Login successful!";
    message.style.backgroundColor = "#4caf50";
    message.style.display = "block";
  } else {
    message.textContent = "Invalid username or password";
    message.style.display = "block";
  }
});
