var acceptButtons = document.querySelectorAll(".accept");
var declineButtons = document.querySelectorAll(".decline");
var reqStatuses = document.querySelectorAll(".status");

for (var i = 0; i < reqStatuses.length; i++) {
    if (reqStatuses[i].value === "declined") {
        declineButtons[i].innerHTML = "DECLINED"; // Change the button's text at the same index
        declineButtons[i].disabled = true; // Disable the button at the same index
        declineButtons[i].style.backgroundColor = "rgb(74, 74, 74)"; // Change the background color at the same index
        
        // acceptButtons[i].style.display = "none";
        acceptButtons[i].style.backgroundColor = "#000080";
        acceptButtons[i].innerHTML = "RESTORE"; // Change the button's text at the same index
    }

}

