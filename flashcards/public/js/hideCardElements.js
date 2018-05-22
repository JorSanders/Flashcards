function toggle(elementId) {
    var cardElement = document.getElementById("card-" + elementId);
    var preferenceElement = document.getElementById("preference-" + elementId);

    if (cardElement === null || preferenceElement === null) {
        return
    }

    if (preferenceElement.value === 1){
        preferenceElement.value = 0;
        cardElement.style.display = "block";
    }else{
        preferenceElement.value = 1;
        cardElement.style.display = "none";
    }
}