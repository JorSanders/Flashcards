var cardCount = 0;
var previousInput;
var cardsDiv = document.getElementById("cards-1111");

addCard();

function addCard() {
    var inputBox = document.createElement("input");
    inputBox.setAttribute('type', "text");
    inputBox.setAttribute('name', "heading-" + cardCount);
    inputBox.setAttribute('id', "input-" + cardCount);

    cardsDiv.appendChild(inputBox);

    if (cardCount > 0) {
        previousInput.removeEventListener("input", addCard);
    }

    cardCount++;

    previousInput = inputBox;
    inputBox.addEventListener("input", addCard);
}
