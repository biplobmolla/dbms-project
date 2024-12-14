function toggleMenu() {
  const navLinks = document.querySelector(".nav-links");
  navLinks.classList.toggle("active");
}

// Register Form Validation
// document
//   .getElementById("register-form")
//   .addEventListener("submit", function (e) {
//     e.preventDefault();

//     // Reset error messages
//     document.querySelectorAll(".error-message").forEach((msg) => {
//       msg.textContent = "";
//     });

//     // Grab form values
//     const fullName = document.getElementById("full-name").value;
//     const username = document.getElementById("username").value;
//     const email = document.getElementById("email").value;
//     const password = document.getElementById("password").value;
//     const confirmPassword = document.getElementById("confirm-password").value;

//     let valid = true;

//     // Full Name Validation
//     if (fullName === "") {
//       document.getElementById("full-name-error").textContent =
//         "Full Name is required";
//       valid = false;
//     }

//     // Username Validation
//     if (username === "") {
//       document.getElementById("username-error").textContent =
//         "Username is required";
//       valid = false;
//     }

//     // Email Validation
//     const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
//     if (!emailRegex.test(email)) {
//       document.getElementById("email-error").textContent =
//         "Invalid email address";
//       valid = false;
//     }

//     // Password Validation
//     if (password === "") {
//       document.getElementById("password-error").textContent =
//         "Password is required";
//       valid = false;
//     }

//     // Confirm Password Validation
//     if (password !== confirmPassword) {
//       document.getElementById("confirm-password-error").textContent =
//         "Passwords do not match";
//       valid = false;
//     }

//     if (valid) {
//       // Form is valid
//       alert("Registration successful!");
//     }
//   });

// Login Form Validation
// document.getElementById("login-form").addEventListener("submit", function (e) {
//   e.preventDefault();

//   // Reset error messages
//   document.querySelectorAll(".error-message").forEach((msg) => {
//     msg.textContent = "";
//   });

//   // Grab form values
//   const username = document.getElementById("login-username").value;
//   const password = document.getElementById("login-password").value;

//   let valid = true;

//   // Validate login inputs
//   if (username === "") {
//     document.getElementById("login-username-error").textContent =
//       "Username or email is required";
//     valid = false;
//   }

//   if (password === "") {
//     document.getElementById("login-password-error").textContent =
//       "Password is required";
//     valid = false;
//   }

//   if (valid) {
//     // Form is valid
//     alert("Login successful!");
//   }
// });

// Comment Form Functionality
// document
//   .getElementById("comment-form")
//   .addEventListener("submit", function (e) {
//     e.preventDefault();

//     // Grab comment text
//     const commentText = document.getElementById("comment-text").value;

//     // Get current time
//     const currentTime = new Date();
//     const formattedTime = currentTime.toLocaleString("en-US", {
//       year: "numeric",
//       month: "short",
//       day: "numeric",
//       hour: "numeric",
//       minute: "numeric",
//       hour12: true,
//     });

//     if (commentText.trim() !== "") {
//       const commentList = document.querySelector(".comment-list");

//       const newComment = document.createElement("div");
//       newComment.classList.add("comment");
//       newComment.innerHTML = `<p><strong>You:</strong> ${commentText} <span class="comment-time">${formattedTime}</span></p>`;

//       commentList.prepend(newComment);

//       document.getElementById("comment-text").value = "";
//     }
//   });
