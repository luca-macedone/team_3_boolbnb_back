//recupero dei dom elements
const form = document.querySelector("form");
const defaultNameEl = document.getElementById("name");
const passwordEl = document.getElementById("password");
const passwordConfirmEl = document.getElementById("password-confirm");
const birthdayEl = document.getElementById("birthday");

form.addEventListener("submit", (e) => {
    //seleziona lo span con il messaggio d'errore e cancellali se già esistono
    const existingPasswordSpan = document.getElementById('passwordConfirmationError');
    const existingDateSpan = document.getElementById('dateError');

    if(existingPasswordSpan) {
        existingPasswordSpan.remove();
    }
    if(existingDateSpan) {
        existingDateSpan.remove();
    }

    
    
    //rimuovi la classe chiamata is-invalid dal submit precedente
    passwordEl.classList.remove('is-invalid');
    passwordConfirmEl.classList.remove("is-invalid");
    birthdayEl.classList.remove("is-invalid");
    
    // dom elements
    let password = passwordEl.value;
    let passwordConfirmation = passwordConfirmEl.value;
    let date = birthdayEl.value;

    //Format della data
    let over18 = new Date();
    const dd = String(over18.getDate()).padStart(2, '0');
    const mm = String(over18.getMonth() + 1).padStart(2, '0');
    const yyyy = over18.getFullYear() - 18;
    over18 = yyyy + '-' + mm + '-' + dd;

    if(password != passwordConfirmation || date > over18 || date < "1900-01-01") {
        // evita il submit del form se ci sono errori
        e.preventDefault(); 

        if(password != passwordConfirmation) {
            // svuota gli input delle password
            passwordEl.value = "";
            passwordConfirmEl.value = "";
      
            // aggiungi la classe "is-invalid"
            passwordEl.classList.add("is-invalid");
            passwordConfirmEl.classList.add("is-invalid");
      
            // crea lo span per l'errore del messaggio
            const passwordConfirmationSpan = document.createElement("span");
            passwordConfirmationSpan.classList.add("mt-1");
            passwordConfirmationSpan.setAttribute("id", "passwordConfirmationError");
            passwordConfirmationSpan.setAttribute("role", "alert");
      
            // aggiungere lo strong per l'errore del messaggio
            const passwordConfirmationStrong = document.createElement("strong");
            passwordConfirmationStrong.classList.add("text-danger");
            passwordConfirmationStrong.innerText = "The passwords don't match";
      
            // aggiungi il messaggio d'errore alla DOM
            passwordConfirmationSpan.appendChild(passwordConfirmationStrong);
            passwordConfirmEl.insertAdjacentElement("afterend", passwordConfirmationSpan);
          }
      

          if(date < "1900-01-01") {

            // aggiungi la classe "is-invalid"
            birthdayEl.classList.add("is-invalid");
      
            // crea lo span per l'errore del messaggio
            const dateSpan = document.createElement("span");
            dateSpan.classList.add("mt-1");
            dateSpan.setAttribute("id", "dateError");
            dateSpan.setAttribute("role", "alert");
      
            // aggiungi lo strong al messaggio
            const dateStrong = document.createElement("strong");
            dateStrong.classList.add("text-danger");

            dateStrong.innerText = "You must insert a date after 01/01/1900";

      
            // aggiungi il messaggio d'errore alla DOM
            dateSpan.appendChild(dateStrong);
            birthdayEl.insertAdjacentElement("afterend", dateSpan);
        }
        if(date > over18) {
            // aggiungi la classe "is-invalid"
            birthdayEl.classList.add("is-invalid");
      
            // crea lo span per l'errore del messaggio
            const dateSpan = document.createElement("span");
            dateSpan.classList.add("mt-1");
            dateSpan.setAttribute("id", "dateError");
            dateSpan.setAttribute("role", "alert");
      
            // aggiungi lo strong al messaggio
            const dateStrong = document.createElement("strong");
            dateStrong.classList.add("text-danger");
            dateStrong.innerText = "You must be +18 years old";
      
            // aggiungi il messaggio d'errore alla DOM
            dateSpan.appendChild(dateStrong);
            birthdayEl.insertAdjacentElement("afterend", dateSpan);
        }
   }

})