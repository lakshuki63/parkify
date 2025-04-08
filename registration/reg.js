
// const userName=document.getElementById("userName");
// const Email=document.getElementById("email");
// const Password=document.getElementById("password");
// const submit=document.getElementById("submit");

// submit.addEventListener("click", (event) => {
//     event.preventDefault();


//     // Username validation
//     if (userName.value.trim().length < 6) {
//         alert("Username must be at least 6 characters long.");
//         return;
//     }

//     const isValidUserName = [userName.value.trim()].every(char =>
//         (char >= 'A' && char <= 'Z') || 
//         (char >= 'a' && char <= 'z') || 
//         (char >= '0' && char <= '9')
//     );

//     if (!isValidUserName) {
//         alert("Username can only be alphanumeric.");
//         return;
//     }

//     // Password validation
//     const passwordValue = Password.value.trim();

//     if (passwordValue.length < 8) {
//         alert("Password must be at least 8 characters long.");
//         return;
//     }

//     let hasUpperCase = false;
//     let hasLowerCase = false;
//     let hasDigit = false;

//     for (let char of passwordValue) {
//         if (char >= 'A' && char <= 'Z') hasUpperCase = true;
//         else if (char >= 'a' && char <= 'z') hasLowerCase = true;
//         else if (char >= '0' && char <= '9') hasDigit = true;
//     }

//     if (!hasUpperCase) {
//         alert("Password must contain at least one uppercase letter.");
//         return;
//     }

//     if (!hasLowerCase) {
//         alert("Password must contain at least one lowercase letter.");
//         return;
//     }

//     if (!hasDigit) {
//         alert("Password must contain at least one digit.");
//         return;
//     }

//     // Email validation
//     const emailValue = Email.value.trim();
//     const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

//     if (!emailPattern.test(emailValue)) {
//         alert("Not a valid e-mail address");
//         return;
//     }

   


//     // for age
//     const ageValue = parseInt(Age.value, 10);
//         if (isNaN(ageValue) || ageValue < 18 || ageValue > 60) {
//             alert("Not valid, enter age between 18 and 60");
//         }

//     alert("Form submitted successfully!");
// });