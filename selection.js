function toID(num, size) {
    id = num.toString();
    pre = '';
    for (i = 0; i < size-id.length; i++) {
        pre += '0';
    }
    return pre + id;
}

function selectPatron(PID) {
    // add PID of selected patron to div for formatting and
    // add PID as form value
    selection = document.querySelector('.selectedPatron');
    selection.innerText = toID(PID, 5);
    input = document.querySelector('#patronValue');
    input.setAttribute('value', toID(PID, 5));
}
function selectBook(ISBN) {
    // add PID of selected patron to div for formatting and
    // add PID as form value
    selection = document.querySelector('.selectedBooks');
    selection.innerText = toID(ISBN, 13);
    input = document.querySelector('#bookValue');
    input.setAttribute('value', toID(ISBN, 13));
}
