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
const affiliation = document.getElementById("affiliation")
const teamKey = document.getElementById("teamKey")


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
    mName = name.value
    mEmail = email.value
    mPassword = password.value
    mAddress = address.value
    mPhoneNumber = phone.value
    mOrganization = organization.value

    if(e.target.innerText.includes("Register")){

        if(mName == "" || mEmail == "" || mPassword == "" || mAddress == "" || mPhoneNumber == ""){
            window.alert("Please fill out all the fields")
        }
        else{
            $.post("register.php",
            { name: mName, email : mEmail, password: mPassword, address: mAddress, phone: mPhoneNumber, organization: mOrganization},
            function(response){
                pResponse = JSON.parse(response)
                console.log(pResponse.status)
                if(pResponse.status == "success"){
                    hideLoginPage()
                    gUserId = pResponse.userID
                    alert("Successfully registered")
                }
                else{
                    alert("There was some error with Register")
                }
            });

        }
    }
    else{
        if( mEmail == "" || mPassword == ""){
            window.alert("Please fill out all the fields")
        }else{
            $.post("login.php",
            { email: mEmail, password: mPassword},
            function(response){
                pResponse = JSON.parse(response)
                if(pResponse.status == "success"){
                    hideLoginPage()
                    gUserId = pResponse.userID
                    alert("Successfully logged in")
                }
                else{
                    alert("There was some error with Login")
                }
            });   
        }
    }

    clearInputs()
})




function hideLoginPage(){
    loginPage.style.display = "none"
    insidePage.style.display = "block"
}

function showLoginPage(){
    insidePage.style.display = "none"
    loginPage.style.display = "block"
}

newteam.addEventListener("click", function(){

    createTeam(teamName.value, affiliation.value, teamKey.value)

    $("#NTB").trigger("click")
    teamName.value = ""
})


function createTeam(teamName, mAffiliation, mKey){
    $.post("create_team.php",
    { name: teamName, userId : gUserId, affiliation: mAffiliation, key: mKey},
    function(response){
        pResponse = JSON.parse(response)
        if(pResponse.status == "success"){
            createTeamCard(teamName, pResponse)
        }
        else{
            alert("There was some error while creating a New Team")
        }
    });
}

function createTeamCard(teamName, response){
  var name = teamName
  var teamId = response.teamId

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
  inside.className = "collapse show"
  inside.setAttribute("aria-labelledby", cardHeader.id)
  var parent = "#accordionTeams"
  inside.setAttribute("data-parent", parent)
  //inside.setAttribute("style", )

  var body = document.createElement("div")
  body.className = "card-body"
  

  var columns = document.createElement("div")
  columns.className = "card-columns"
  var columnsId = teamId + "I"
  columns.id = columnsId

  body.append(columns)

  inside.append(body)

  card.append(cardHeader, inside)

  var menu = document.getElementById("accordionTeams")
  menu.append(card)

}

document.getElementById("submitBoard").addEventListener("click", function() {

    var teamId = gTeamId
    var name = document.getElementById("inputBName").value
    var description = document.getElementById("inputDesc").value
    var priority = document.getElementById("inputPriority").value
    var color = document.getElementById("inputColor").value
    var requirements = document.getElementById("inputReqs").value
    var ET = document.getElementById("inputET").value


    $.post("create_board.php",
    { userId: gUserId ,teamId: teamId, name: name, description: description, priority: priority, color: color, requirements: requirements, estimatedTime: ET},
    function(response){
        pResponse = JSON.parse(response)
        console.log(pResponse.status)
        if(pResponse.status == "success"){
            createBoardCard(teamId, name, color, description, requirements, pResponse)
        }
        else{
            alert("There was some error with Adding a new Board")
        }
    });

  
    $("#inputBName").value = ""
    $("#inputDesc").value = ""
    $("#inputPriority").value = ""
    $("#inputColor").value = ""
    $("#inputReqs").value = ""
    $("#inputET").value = ""
  
    $(gAddButton).trigger("click")
  
})

function createBoardCard(teamId, name, color, description, requirements, response){
    //alert("Now I am gonna create the board")

    var cardWrapper = document.createElement("div")
    cardWrapper.setAttribute("style", "18rem")
    cardWrapper.className = "card text-white mb-3"
    var backgroundColor = "background-color:" + color
    cardWrapper.setAttribute("style", backgroundColor)

    var cardHeader = document.createElement("div")
    cardHeader.className = "card-header"
    cardHeader.innerText = name
    
    var cardBody = document.createElement("div")
    cardBody.className = "card-body"

    var cardTitle = document.createElement("h5")
    cardTitle.className = "card-title"
    cardTitle.innerText = description

    var cardText = document.createElement("p")
    cardText.innerText = requirements

    //Append Everything
    cardBody.append(cardTitle, cardText)

    cardWrapper.append(cardHeader, cardBody)

    var parentId = teamId + "I"

    var parent = document.getElementById(parentId)

    parent.append(cardWrapper)
    
}
  

function openElement(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }


//fade animation
