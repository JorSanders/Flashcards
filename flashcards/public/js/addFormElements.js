var cardCount = 0;
var previousElement;
var targetDiv = document.getElementById("cards");

addCard();

function addCard() {
    english = createInput("english");
    pinyin = createInput("pinyin");
    character = createInput("character");
    comment = createInput("comment");

    var li = document.createElement("li");
    li.appendChild(english);
    li.appendChild(comment);
    li.appendChild(pinyin);
    li.appendChild(character);
    targetDiv.appendChild(li);

    if (cardCount > 0) {
        previousElement.removeEventListener("input", addCard);
    }

    $("#english-" + cardCount).on("change", function () {
        translate(event.target);
    });
    cardCount++;

    previousElement = english;
    english.addEventListener("input", addCard);

}

function createInput(name) {
    element = document.createElement("input");
    element.setAttribute('type', "text");
    element.setAttribute('name', name + "-" + cardCount);
    element.setAttribute('id', name + "-" + cardCount);

    return element
}

function translate(triggerElement) {
    id = triggerElement.id.split('-')[1];
    translateString = triggerElement.value;

    characterEle = document.getElementById('character-' + id);
    pinyinEle = document.getElementById('pinyin-' + id);
    var ulr = 'https://translate.google.com/?text=' + translateString + '&hl=en&langpair=auto%7Czh-CN';
    $.ajax({
        url: ulr, success: function (result) {
            character = $(result).find('#res-translit').text();
            pinyin = $(result).find('#gt-res-dir-ctr').text();
            characterEle.value = character;
            pinyinEle.value = pinyin;
        }
    });
}
