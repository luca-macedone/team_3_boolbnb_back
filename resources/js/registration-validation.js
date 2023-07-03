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
    let today = new Date();
    const dd = String(today.getDate()).padStart(2, '0');
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const yyyy = today.getFullYear();
    today = yyyy + '/' + mm + '/' + dd;

    if(password != passwordConfirmation || date > today) {
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
      
          if(date > today) {
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
            dateStrong.innerText = "Date of birth cannot be a future date";
      
            // aggiungi il messaggio d'errore alla DOM
            dateSpan.appendChild(dateStrong);
            birthdayEl.insertAdjacentElement("afterend", dateSpan);
        }

        /*let age = (Date.now(currentDate) - date);
        
         if(age < 18) {

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
            dateStrong.innerText = "You must be 18 years old to registrate";
      
            // aggiungi il messaggio d'errore alla DOM
            dateSpan.appendChild(dateStrong);
            birthdayEl.insertAdjacentElement("afterend", dateSpan);
        }*/
   }

})