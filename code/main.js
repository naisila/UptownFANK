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
const newteam = document.getElementById("submitTeam")
const teamName = document.getElementById("teamName")

const registerMsg = "Dont have an account yet, Click here to register!"
const loginMsg = "Already registered, Click here to Login!"


//Persistent variables
var gUserId;
var gAddButton;
var gTeamId;

window.onload = function() {
    initialSetup()
};

function initialSetup(){
    name.parentNode.style.display = "none"
    address.parentNode.style.display = "none"
    phone.parentNode.style.display = "none"
    userSelection.style.display = "none"
    organization.parentNode.style.display = "none"
    insidePage.style.display = "none"
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


btnAuth.addEventListener("click", function(e) {
    if(e.target.innerText.includes("Register")){
        console.log("Register clicked")
        const response = register()
        if(response.status == "success"){
            hideLoginPage()
            gUserId = userId
            alert("Successfully registered")
        }
        else{
            alert("There was some error with register")
        }
        
    }
    else{
        const response = login()
        if(response.status == "success"){
            gUserId = response.userId
            console.log("User Id is", gUserId)
            hideLoginPage()
        }
        else{
            alert("There was some error with login")
        }   
    }

    clearInputs()
})

function login(){
    returnInfo = {
        status: "success",
        userId:  "1245" 
    }

    return returnInfo
}

function register(){

    mName = name.value
    mEmail = email.value
    mPassword = password.value
    mAddress = address.value
    mPhoneNumber = phone.value
    mOrganization = organization.value


    $.post("register.php",
    { name: mName, email : mEmail, password: mPassword, address: mAddress, phone: mPhoneNumber, organization: mOrganization},
    function(response){
        return response
    });
    
}


function hideLoginPage(){
    loginPage.style.display = "none"
    insidePage.style.display = "block"
}

function showLoginPage(){
    insidePage.style.display = "none"
    loginPage.style.display = "block"
}

newteam.addEventListener("click", function(){

    createTeam(teamName.value)

    $("#NTB").trigger("click")
    teamName.value = ""
})


function createTeam(teamName){
    $.post("create_table.php",
    { name: teamName, userId : gUserId},
    function(response){
        if(response.status == "success"){
            createTeamCard(response.teamId)
        }
        else{
            alert("There was some error while creating a New Team")
        }
    });
}

function createTeamCard(teamName, response){
  name = teamName
  teamId = response.teamId

  var card = document.createElement("div")
  card.className = "card"
  card.id = teamId

  var cardHeader = document.createElement("div")
  cardHeader.className = "card-header"
  cardHeader.id = name + "H"

  var h5 = document.createElement("h5")
  h5.className = "mb-0"

  var hButton = document.createElement("button")
  var area = name + "B"
  hButton.className = "btn btn-link"
  hButton.setAttribute("type", "button")
  hButton.setAttribute("data-toggle", "collapse")
  hButton.setAttribute("data-target", ("#" + area))
  hButton.setAttribute("aria-expanded", "false")
  hButton.setAttribute("aria-controls", area)
  hButton.innerText = name

  h5.append(hButton)

  addButton = document.createElement("a")
  addButton.className = "btn btn-info"
  addButton.innerText = "New Board"
  addButton.setAttribute("href", "#")
  addButton.setAttribute("data-toggle", "modal")
  addButton.setAttribute("data-target","#addModal")
  addButton.addEventListener("click", function(){
    gTeamId = teamId
    gAddButton = addButton
  })

  h5.append(addButton)

  cardHeader.append(h5)

  var inside = document.createElement("div")
  inside.id = area
  inside.className = "collapse"
  inside.setAttribute("aria-labelledby", cardHeader.id)
  var parent = "#accordionTeams"
  inside.setAttribute("data-parent", parent)
  //inside.setAttribute("style", )

  var body = document.createElement("div")
  body.className = "card-body"
  var bodyId = name + "I"
  body.id = bodyId
  inside.append(body)

  card.append(cardHeader, inside)

  var menu = document.getElementById("accordionTeams")
  menu.append(card)

}
