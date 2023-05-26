const form = document.getElementById("form");
const username = document.getElementById("username");
const firstSurname = document.getElementById("firstSurname");
const secoundSurname = document.getElementById("secoundSurname");
const email = document.getElementById("email");
const password = document.getElementById("password");
const passwordConfirmation = document.getElementById("password-confirmation");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  checkInputs();
});

//para realizar la validación de las Inputs de éxito y error//
function checkInputs() {
  const usernameValue = username.value;
  const firstSurnameValue = firstSurname.value;
  const secoundSurnameValue = secoundSurname.value;
  const emailValue = email.value;
  const passwordValue = password.value;
  const passwordConfirmationValue = passwordConfirmation.value;

  if (usernameValue === "") {
    console.log(1);
    setErrorFor(username, "Rellene este campo.");
  } else if (checkUsername(usernameValue) == false) {
    console.log(2);
    setErrorFor(username, "Caracteres inválidos.");
  } else {
    console.log(3);
    setSuccessFor(username);
  }

  if (firstSurnameValue === "") {
    console.log(1);
    setErrorFor(firstSurname, "Rellene este campo.");
  } else if (checkUsername(firstSurnameValue) == false) {
    console.log(2);
    setErrorFor(firstSurname, "Caracteres inválidos.");
  } else {
    console.log(3);
    setSuccessFor(firstSurname);
  }

  if (secoundSurname === "") {
    console.log(1);
    setErrorFor(secoundSurname, "Rellene este campo.");
  } else if (checkUsername(secoundSurnameValue) == false) {
    console.log(2);
    setErrorFor(secoundSurname, "Caracteres inválidos.");
  } else {
    console.log(3);
    setSuccessFor(secoundSurname);
  }

  if (emailValue === "") {
    setErrorFor(email, "Rellene este campo.");
  } else if (!checkEmail(emailValue)) {
    setErrorFor(email, "Introduzca un correo electrónico válido.");
  } else {
    setSuccessFor(email);
  }

  if (passwordValue === "") {
    setErrorFor(password, "Se requiere una contraseña.");
  } else if (passwordValue.length < 4 || passwordValue.length > 8) {
    setErrorFor(password, "La contraseña debe tener entre 4 y 8 caracteres.");
  } else {
    setSuccessFor(password);
  }
  
  if (passwordConfirmationValue === "") {
    setErrorFor(passwordConfirmation, "Se requiere confirmar la contraseña.");
  } else if (passwordConfirmationValue !== passwordValue) {
    setErrorFor(passwordConfirmation, "Las contraseñas no coinciden.");
  } else {
    setSuccessFor(passwordConfirmation);
  }
  
  const formControls = form.querySelectorAll(".form-control");
  const formIsValid = [...formControls].every((formControl) => {
    return formControl.className === "form-control success";
  });

  if (formIsValid) {
    alert("La inscripción ha sido correcta!");

    // Redirigir a la página de consulta
    window.location.href = "consulta.html";
  }
}

function setErrorFor(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector("small");

  //Añadir mensaje de error//
  small.innerText = message;

  //Añadir clase de error//
  formControl.className = "form-control error";
}

function setSuccessFor(input) {
  const formControl = input.parentElement;

  //Añadir clase de éxito//
  formControl.className = "form-control success";
}

function checkUsername(username) {
  return /^[a-zA-Z]+$/.test(username);
}

function checkEmail(email) {
  return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
    email
  );
}
