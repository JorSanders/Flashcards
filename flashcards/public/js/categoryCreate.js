var cardCount = 0;
var targetDiv = document.getElementById("cards");
allInputFields = [];

$("#title").change(function () {
    event.target.value = jsUcfirst(event.target.value);
});
$("#description").change(function () {
    event.target.value = jsUcfirst(event.target.value);
});


var addCardHandler = function () {
    // Yes this seems useless. But otherwise an argument will be passed to the addCard() function
    addCard();
};

function addCard(card = null) {
    var inputFields = [];

    // Create the input fields
    inputFields['english'] = createInput("english");
    inputFields['character'] = createInput("character");
    inputFields['pinyin'] = createInput("pinyin");

    idElement = document.createElement("input");
    idElement.setAttribute('type', "hidden");
    idElement.setAttribute('name', "cardId-" + cardCount);

    if (card !== null) {
        inputFields['english'].value = card.english;
        inputFields['character'].value = card.character;
        inputFields['pinyin'].value = card.pinyin;
        idElement.setAttribute('value', card.id);
    }

    // Create the table row
    var tr = document.createElement("TR");
    var index = document.createElement("TH");
    index.setAttribute("scope", "row");
    index.innerHTML = cardCount + 1 + "";
    tr.appendChild(index);

    for (var key in inputFields) {
        td = document.createElement("td");
        td.appendChild(inputFields[key]);
        tr.appendChild(td);
    }

    tr.appendChild(idElement);

    targetDiv.appendChild(tr);

    // Set the previous fields on required and remove the addcard event listener
    if (cardCount > 0) {
        $(allInputFields[cardCount - 1]['english']).off("input", addCardHandler);
        $(allInputFields[cardCount - 1]['character']).off("input", addCardHandler);

        allInputFields[cardCount - 1]['english'].required = true;
        allInputFields[cardCount - 1]['character'].required = true;
        allInputFields[cardCount - 1]['pinyin'].required = true;
    }

    // Add the translate event listeners
    $(inputFields['english']).on("change", function () {
        translateEnCh(event.target);
    });
    $(inputFields['character']).on("change", function () {
        translateChEn(event.target);
    });

    // Add the addcard translate event listeners
    $(inputFields['english']).on("input", addCardHandler);
    $(inputFields['character']).on("input", addCardHandler);

    allInputFields.push(inputFields);
    cardCount++;
}

function createInput(name) {
    element = document.createElement("input");
    element.setAttribute('type', "text");
    element.setAttribute('name', name + "-" + cardCount);
    element.setAttribute('id', name + "-" + cardCount);
    element.setAttribute('class', "form-control");
    element.setAttribute('placeholder', name.replace(/^\w/, c => c.toUpperCase()));

    return element
}

function translateEnCh(triggerElement) {
    id = triggerElement.id.split('-')[1];
    translateString = triggerElement.value;

    translateString = jsUcfirst(translateString);

    var url = 'https://translate.google.com/?text=' + translateString + '&hl=en&langpair=auto%7Czh-CN';
    $.ajax({
        url: url,
        success: function (result) {
            pinyin = $(result).find('#res-translit').text();
            character = $(result).find('#gt-res-dir-ctr').text();
            allInputFields[id]['character'].value = character;
            allInputFields[id]['pinyin'].value = pinyin;
            allInputFields[id]['english'].value = translateString;
        }
    });
}

function translateChEn(triggerElement) {
    id = triggerElement.id.split('-')[1];
    translateString = triggerElement.value;

    englishEle = document.getElementById('english-' + id);
    pinyinEle = document.getElementById('pinyin-' + id);
    var url = 'https://translate.google.com/?text=' + translateString + '&langpair=zh%7Cen#zh-CN/en/';
    $.ajax({
        url: url,
        success: function (result) {
            pinyin = $(result).find('#src-translit').text();
            english = $(result).find('#result_box').text();
            englishEle.value = english;
            pinyinEle.value = pinyin;
        }
    });
}

function jsUcfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

cards.forEach(function (card) {
    addCard(card);
});
addCard();