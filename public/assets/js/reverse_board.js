function reverseStartingBoardPosition()
{
    const table = document.createElement('table');
    table.setAttribute('class', 'table table-bordered');

    const tbody = document.createElement('tbody');

    tbody.appendChild(createReverseTableRow(getBoardFirstRowElements()));
    tbody.appendChild(createReverseTableRow(getBoardSecondRowElements()));

    const rowsFromThirdToSixElements = getBoardRowsFromThirdToSixthElements();

    for (i in rowsFromThirdToSixElements) 
    {
        let index = rowsFromThirdToSixElements.length - (parseInt(i) + 1);
        tbody.appendChild(createReverseTableRow(rowsFromThirdToSixElements[index]));
    }

    tbody.appendChild(createReverseTableRow(getBoardSeventhRowElements()));
    tbody.appendChild(createReverseTableRow(getBoardEighthRowElements()));

    tbody.appendChild(createReverseTableRow(getColumnNameRowElements()));

    table.appendChild(tbody);

    let oldTable = document.querySelector('.table.table-bordered');

    tableContainer = document.querySelector('.table-responsive');
    tableContainer.removeChild(oldTable);

    tableContainer.appendChild(table);
}

function createReverseTableRow(rowElements)
{
    let tableRow = document.createElement('tr');

    let length = rowElements.length;

    tableRow.appendChild(rowElements[0]);

    for (i in rowElements)
    {
        if (parseInt(i) == length - 1) {
            continue;
        }

        let index = length - (parseInt(i) + 1);

        tableRow.appendChild(rowElements[index]);
    }

    return tableRow;
}