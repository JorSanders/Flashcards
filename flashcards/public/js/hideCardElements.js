function toggle(elementId) {
    var cardElement = document.getElementById("card-" + elementId);
    var preferenceElement = document.getElementById("preference-" + elementId);

    if (cardElement === null || preferenceElement === null) {
        return
    }

    if (parseInt(preferenceElement.value) === 1){
        preferenceElement.value = 0;
        cardElement.style.display = "none";
    }else{
        preferenceElement.value = 1;
        cardElement.style.display = "block";
    }
}