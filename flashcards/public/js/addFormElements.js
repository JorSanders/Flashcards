var cardCount = 0;
var previousElement;
var targetDiv = document.getElementById("cards");

addCard();

function addCard() {
    var inputFields = [];

    inputFields.push(createInput("english"));
    inputFields.push(createInput("comment"));
    inputFields.push(createInput("pinyin"));
    inputFields.push(createInput("character"));

    var tr = document.createElement("TR");
    var index = document.createElement("TH");
    index.setAttribute("scope", "row");
    index.innerHTML = cardCount + 1;

    tr.appendChild(index);


    inputFields.forEach(element => {
        tr.appendChild(element);
    });

    targetDiv.appendChild(tr);

    if (cardCount > 0) {
        previousElement.removeEventListener("input", addCard);
    }

    $("#english-" + cardCount).on("change", function () {
        translate(event.target);
    });
    cardCount++;

    previousElement = inputFields[0];
    previousElement.required = true;
    previousElement.addEventListener("input", addCard);

}

function createInput(name) {
    element = document.createElement("input");
    element.setAttribute('type', "text");
    element.setAttribute('name', name + "-" + cardCount);
    element.setAttribute('id', name + "-" + cardCount);
    element.setAttribute('class', "form-control");
    element.setAttribute('placeholder', name);

    td = document.createElement("td");
    td.appendChild(element);

    return td
}

function translate(triggerElement) {
    id = triggerElement.id.split('-')[1];
    translateString = triggerElement.value;

    characterEle = document.getElementById('character-' + id);
    pinyinEle = document.getElementById('pinyin-' + id);
    var ulr = 'https://translate.google.com/?text=' + translateString + '&hl=en&langpair=auto%7Czh-CN';
    $.ajax({
        url: ulr, success: function (result) {
            pinyin = $(result).find('#res-translit').text();
            character = $(result).find('#gt-res-dir-ctr').text();
            characterEle.value = character;
            pinyinEle.value = pinyin;
        }
    });
}
