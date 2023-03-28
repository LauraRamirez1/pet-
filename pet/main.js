function setFormMessage(formElement, type, message) {
    const messageElement = formElement.querySelector(".form__message");

    messageElement.textContent = message;
    messageElement.classList.remove("form__message--success", "form__message--error");
    messageElement.classList.add(`form__message--${type}`);
}

function setInputError(inputElement, message) {
    inputElement.classList.add("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = message;
}

function clearInputError(inputElement) {
    inputElement.classList.remove("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = "";
}




document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");
    const createAccountForm = document.querySelector("#createAccount");

    document.querySelector("#linkCreateAccount").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.remove("form--hidden");
    });

    document.querySelector("#linkLogin").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        createAccountForm.classList.add("form--hidden");
    });

    loginForm.addEventListener("submit", e => {
        e.preventDefault();
        
        // Perform your AJAX/Fetch login

        setFormMessage(loginForm, "error", "Combinación inválida de Usuario/Contraseña");
           
    
    });

    document.querySelectorAll(".form__input").forEach(inputElement => {
        inputElement.addEventListener("blur", e => {
            if (e.target.id === "signupUsername" && e.target.value.length > 0 && e.target.value.length < 5) {
                setInputError(inputElement, "Nombre de usario debe tener al menos 5 caracteres");
            }

            /* Validaciones contraseña en creación de cuenta */

            if (e.target.id === "signupPassword" && e.target.value.length > 0 && e.target.value.length < 10) {
                setInputError(inputElement, "Contraseña debe tener al menos 10 caracteres");
            }

            re = /[0-9]/;
            if (e.target.id === "signupPassword" && !re.test(e.target.value)) {
                setInputError(inputElement, "Contraseña debe tener al menos un número");
            }

            re = /[a-z]/;
            if (e.target.id === "signupPassword" && !re.test(e.target.value)) {
                setInputError(inputElement, "Contraseña debe contener al menos una letra minúscula");
            }

            re = /[A-Z]/;
            if (e.target.id === "signupPassword" && !re.test(e.target.value)) {
                setInputError(inputElement, "Contraseña debe contener al menos una letra mayúscula");
            }

            re = /[_?!<>]/;
            if (e.target.id === "signupPassword" && !re.test(e.target.value)) {
                setInputError(inputElement, "Contraseña debe contener al menos un caracter especial (_?!<>)");
            }
            
            /* Validaciones email en creación de cuenta */


            mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (e.target.id === "signupEmail" && !mailformat.test(e.target.value)) {
                setInputError(inputElement, "asdasdas");
            }
           
            



        });


        inputElement.addEventListener("input", e => {
            clearInputError(inputElement);
        });


    });


});