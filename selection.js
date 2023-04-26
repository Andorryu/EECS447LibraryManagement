function toID(num, size) {
    id = num.toString();
    pre = '';
    for (i = 0; i < size-id.length; i++) {
        pre += '0';
    }
    return pre + id;
}

function selectPatron(PID) {
    selection = document.querySelector('.selectedPatron');
    selection.innerText = 'Selected Patron ID: ' + toID(PID, 5);
    input = window.parent.document.querySelector('#patronValue');
    input.setAttribute('value', toID(PID, 5));
}
function selectBook(ISBN) {
    selection = document.querySelector('.selectedBook');
    selection.innerText = 'Selected Book ISBN: ' + toID(ISBN, 13);
    input = window.parent.document.querySelector('#bookValue');
    input.setAttribute('value', toID(ISBN, 13));
}
