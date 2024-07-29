const pwdField = document.querySelector('.password-field')
const pwdInput = document.querySelector('.password-field input')
const pwdToggleSwitch = document.querySelector('.password-field i')

pwdToggleSwitch.addEventListener('click', () => {
    if (pwdInput.type == 'password') {
        pwdInput.type = 'text'
    } else {
        pwdInput.type = 'password'
    }
    pwdField.classList.toggle('active')

})

const signUpForm = document.querySelector('.signup form')
const logInForm = document.querySelector('.login form')
const errorBar = document.querySelector('.error')

const authenticate = (form, targetFile) => {
    let xhr = new XMLHttpRequest()
    xhr.open("POST", `../auth/${targetFile}`, true)
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText == 'success') {
                location.href = "users.php"
            } else {
                errorBar.style.display = "block"
                errorBar.textContent = this.responseText
            }
        } else {
            console.log('error: ' + this.status);
        }
    }

    let formData = new FormData(form)
    xhr.send(formData)
}

try {
    signUpForm.onsubmit = (e) => {
        e.preventDefault()
        authenticate(signUpForm, 'signup.php')
    }
} catch {

}

try {
    logInForm.onsubmit = (e) => {
        e.preventDefault()
        authenticate(logInForm, 'login.php')
    }
} catch {
}
