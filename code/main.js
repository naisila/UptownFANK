const email = document.getElementById("txtEmail")
const password = document.getElementById("txtPassword")
const name = document.getElementById("txtName")
const address = document.getElementById("txtAddress")
const phone = document.getElementById("phoneNumber")
const userSelection = document.getElementById("userSelection")
const basicUser = document.getElementById("userType1")
const superUser = document.getElementById("userType2")
const organization = document.getElementById("organization")
const btnAuth = document.getElementById("btnAuth")
const btnAuthAlter = document.getElementById("btnAuthAlter")
const loginPage = document.getElementById("loginPage")
const insidePage = document.getElementById("insidePage")

const registerMsg = "Dont have an account yet, Click here to register!"
const loginMsg = "Already registered, Click here to Login!"

window.onload = function() {
    initialSetup()
};

function initialSetup(){
    name.parentNode.style.display = "none"
    address.parentNode.style.display = "none"
    phone.parentNode.style.display = "none"
    userSelection.style.display = "none"
    organization.parentNode.style.display = "none"
}

btnAuthAlter.addEventListener("click", function (e){
    if(e.target.innerText.includes("account")){
        showRegister()
    }
    else{
        hideRegister()
    }
})

function showRegister(){
    name.parentNode.style.display = "block"
    address.parentNode.style.display = "block"
    phone.parentNode.style.display = "block"
    userSelection.style.display = "block"
    btnAuth.innerText = "Register"
    btnAuthAlter.innerText = loginMsg
}

function hideRegister(){
    name.parentNode.style.display = "none"
    address.parentNode.style.display = "none"
    phone.parentNode.style.display = "none"
    userSelection.style.display = "none"
    btnAuth.innerText = "Login"
    btnAuthAlter.innerText = registerMsg
}

function showOrganization(){
    organization.parentNode.style.display = "block"
}

function hideOrganization(){
    organization.parentNode.style.display = "none"
}

basicUser.addEventListener("click", function(){
    hideOrganization()
})

superUser.addEventListener("click", function(){
    showOrganization()
})

function clearInputs(){
    email.value = ""
    password.value = ""
    name.value = ""
    address.value = ""
    phone.value = ""
    organization.value = ""
}


btnAuth.addEventListener("click", function() {
    if(login()){
        hideLoginPage()
    }
    else{
        alert("There was some error with login")
    }
})

function login(){
    return true
}


function hideLoginPage(){
    loginPage.style.display = "none"
    insidePage.style.display = "block"
}

function showLoginPage(){
    insidePage.style.display = "none"
    loginPage.style.display = "block"
}