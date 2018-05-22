var cardCount = 0;
var previousElement;
var targetDiv = document.getElementById("cards");

addCard();

function addCard() {
    var english = document.createElement("input");
    english.setAttribute('type', "text");
    english.setAttribute('name', "english-" + cardCount);

    var pinyin = document.createElement("input");
    pinyin.setAttribute('type', "text");
    pinyin.setAttribute('name', "pinyin-" + cardCount);

    var character = document.createElement("input");
    character.setAttribute('type', "text");
    character.setAttribute('name', "character-" + cardCount);

    var comment = document.createElement("input");
    comment.setAttribute('type', "text");
    comment.setAttribute('name', "comment-" + cardCount);

    var li = document.createElement("li");
    li.appendChild(english);
    li.appendChild(pinyin);
    li.appendChild(character);
    li.appendChild(comment);
    targetDiv.appendChild(li);

    if (cardCount > 0) {
        previousElement.removeEventListener("input", addCard);
    }

    cardCount++;

    previousElement = english;
    english.addEventListener("input", addCard);
}
