var cardCount = 0;
var targetDiv = document.getElementById("cards");

allInputFields = [];

var idk = function addCard() {
    var inputFields = [];

    // Create the input fields
    inputFields['english'] = createInput("english");
    inputFields['character'] = createInput("character");
    inputFields['pinyin'] = createInput("pinyin");

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
    targetDiv.appendChild(tr);

    // Set the previous fields on required and remove the addcard event listener
    if (cardCount > 0) {
        $(allInputFields[cardCount - 1]['english']).off("input", idk);
        $(allInputFields[cardCount - 1]['character']).off("input", idk);

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
    $(inputFields['english']).on("input", idk);
    $(inputFields['character']).on("input", idk);

    allInputFields.push(inputFields);
    cardCount++;
};

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

    translateString.replace(/^\w/, c => c.toUpperCase());

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

idk.call();
