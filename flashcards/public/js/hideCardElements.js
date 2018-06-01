function toggle(elementId) {
    var cardElement = document.getElementById("card-" + elementId);
    var preferenceElement = document.getElementById("preference-" + elementId);
    var buttonElement = document.getElementById("button-" + elementId);

    if (cardElement === null || preferenceElement === null) {
        return
    }

    var buttonText = buttonElement.innerHTML;
    var split = buttonText.split(" ")[0] + " ";


    if (parseInt(preferenceElement.value) === 1){
        preferenceElement.value = 0;
        cardElement.style.display = "none";
        buttonElement.classList.remove('btn-success');
        buttonElement.classList.add('btn-danger');
        buttonElement.innerHTML = split + "hide";
    }else{
        preferenceElement.value = 1;
        cardElement.style.display = "block";
        buttonElement.classList.remove('btn-danger');
        buttonElement.classList.add('btn-success');
        buttonElement.innerHTML = split + "show";
    }
}