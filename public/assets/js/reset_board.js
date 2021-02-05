function resetBoardToStartingPosition()
{
    const table = document.createElement('table');
    table.setAttribute('class', 'table table-bordered');

    const tbody = document.createElement('tbody');

    tbody.appendChild(createTableRow(getBoardEighthRowElements()));
    tbody.appendChild(createTableRow(getBoardSeventhRowElements()));

    const rowsFromThirdToSixElements = getBoardRowsFromThirdToSixthElements();

    for (rowElements in rowsFromThirdToSixElements) 
    {
        tbody.appendChild(createTableRow(rowsFromThirdToSixElements[rowElements]));
    }

    tbody.appendChild(createTableRow(getBoardSecondRowElements()));
    tbody.appendChild(createTableRow(getBoardFirstRowElements()));
    tbody.appendChild(createTableRow(getColumnNameRowElements()));

    table.appendChild(tbody);

    let oldTable = document.querySelector('.table.table-bordered');

    tableContainer = document.querySelector('.table-responsive');
    tableContainer.removeChild(oldTable);

    tableContainer.appendChild(table);
}

function createTableRow(rowElements)
{
    let tableRow = document.createElement('tr');

    for (row in rowElements)
    {
        let td = rowElements[row];

        tableRow.appendChild(td);
    }

    return tableRow;
}

function getBoardEighthRowElements()
{
    const eightRowNumber = document.createElement('td');
    eightRowNumber.textContent = "8";
   
    /* Black rook on  [8, 1] */
    const eightRowFirstRook = document.createElement('td');
    eightRowFirstRook.setAttribute('class', 'bg-white');
    eightRowFirstRook.setAttribute('id', 'cord-81');

    const blackRookImg = document.createElement('img');
    blackRookImg.setAttribute('class', 'piece-board-img');
    blackRookImg.setAttribute('src', '/assets/images/black-rook.png');

    eightRowFirstRook.appendChild(blackRookImg);

    /* Black knight on [8, 2] */
    const eightRowFirstKnight = document.createElement('td');
    eightRowFirstKnight.setAttribute('class', 'bg-green-board-square');
    eightRowFirstKnight.setAttribute('id', 'cord-82');

    const blackKnightImg = document.createElement('img');
    blackKnightImg.setAttribute('class', 'piece-board-img');
    blackKnightImg.setAttribute('src', '/assets/images/black-knight.png');

    eightRowFirstKnight.appendChild(blackKnightImg);

    /* Black Bishop on [8, 3] */
    const eightRowFirstBishop = document.createElement('td');
    eightRowFirstBishop.setAttribute('class', 'bg-white');
    eightRowFirstBishop.setAttribute('id', 'cord-83');

    const blackBishopImg = document.createElement('img');
    blackBishopImg.setAttribute('class', 'piece-board-img');
    blackBishopImg.setAttribute('src', '/assets/images/black-bishop.png');

    eightRowFirstBishop.appendChild(blackBishopImg);

    /* Black Quenn on [8, 4] */
    const blackQuenn = document.createElement('td');
    blackQuenn.setAttribute('class', 'bg-green-board-square');
    blackQuenn.setAttribute('id', 'cord-84');

    const blackQuennImg = document.createElement('img');
    blackQuennImg.setAttribute('class', 'piece-board-img');
    blackQuennImg.setAttribute('src', '/assets/images/black-quenn.png');

    blackQuenn.appendChild(blackQuennImg);

    /* Black King on [8, 5] */
    const blackKing = document.createElement('td');
    blackKing.setAttribute('class', 'bg-white');
    blackKing.setAttribute('id', 'cord-85');

    const blackKingImg = document.createElement('img');
    blackKingImg.setAttribute('class', 'piece-board-img');
    blackKingImg.setAttribute('src', '/assets/images/black-king.png');

    blackKing.appendChild(blackKingImg);

    /* Black Bishop on [8, 6] */
    const blackSecondBishop = document.createElement('td');
    blackSecondBishop.setAttribute('class', 'bg-green-board-square');
    blackSecondBishop.setAttribute('id', 'cord-86');

    blackSecondBishop.appendChild(blackBishopImg.cloneNode());

    /* Black Knight on [8, 7] */
    const blackSecondKnight = document.createElement('td');
    blackSecondKnight.setAttribute('class', 'bg-white');
    blackSecondKnight.setAttribute('id', 'cord-87');

    blackSecondKnight.appendChild(blackKnightImg.cloneNode());

    /* Black Rook on [8, 8] */
    const blackSecondRook = document.createElement('td');
    blackSecondRook.setAttribute('class', 'bg-green-board-square');
    blackSecondRook.setAttribute('id', 'cord-88');

    blackSecondRook.appendChild(blackRookImg.cloneNode());

    return [eightRowNumber, eightRowFirstRook, eightRowFirstKnight, eightRowFirstBishop, blackQuenn, blackKing, blackSecondBishop, blackSecondKnight, blackSecondRook];
}

function getBoardSeventhRowElements()
{
    const seventhRowNumber = document.createElement('td');
    seventhRowNumber.textContent = "7";

    const blackPawnImg = document.createElement('img');
    blackPawnImg.setAttribute('class', 'piece-board-img');
    blackPawnImg.setAttribute('src', '/assets/images/black-pawn.png');

    let colorClass = null;

    seventhRowArray = [];
    seventhRowArray.push(seventhRowNumber);

    for (let i = 1; i <= 8; i++)
    {
        if (i % 2 == 0) 
            colorClass = 'bg-white';
        else 
            colorClass = 'bg-green-board-square';

        let blackPawn = document.createElement('td');
        blackPawn.setAttribute('class', `${colorClass}`);
        blackPawn.setAttribute('id', `cord-7${i}`);

        blackPawn.appendChild(blackPawnImg.cloneNode());

        seventhRowArray.push(blackPawn);
    }

    return seventhRowArray;
}

function getBoardRowsFromThirdToSixthElements()
{
    const rows = [];

    for (let i = 6; i >= 3; i--)
    {
        let rowArray = [];

        const rowNumber = document.createElement('td');
        rowNumber.textContent = i;

        rowArray.push(rowNumber);

        const blackPawnImg = document.createElement('img');
        blackPawnImg.setAttribute('class', 'piece-board-img opacity-0');
        blackPawnImg.setAttribute('src', '/assets/images/black-pawn.png');

        let colorClass = null;

        for (let j = 1; j <= 8; j++)
        {
            if (i % 2 == 0 && j % 2 !== 0)
                colorClass = 'bg-white';

            else if(i % 2 !== 0 && j % 2 == 0)
                colorClass = 'bg-white';

            else
                colorClass = 'bg-green-board-square';
    
            let invisibleBlackPawn = document.createElement('td');
            invisibleBlackPawn.setAttribute('class', `${colorClass}`);
            invisibleBlackPawn.setAttribute('id', `cord-${i}${j}`);

            invisibleBlackPawn.appendChild(blackPawnImg.cloneNode());
    
            rowArray.push(invisibleBlackPawn);
        }

        rows.push(rowArray);
    }
    
    return rows;
}

function getBoardSecondRowElements()
{
    const secondRowElements = [];

    const secondRowNumber = document.createElement('td');
    secondRowNumber.textContent = "2";

    secondRowElements.push(secondRowNumber);

    const whitePawnImg = document.createElement('img');
    whitePawnImg.setAttribute('class', 'piece-board-img');
    whitePawnImg.setAttribute('src', '/assets/images/white-pawn.png');
    
    let colorClass = null;

    for (let i = 1; i <= 8; i++)
    {
        if (i % 2 !== 0) 
            colorClass = 'bg-white';
        else 
            colorClass = 'bg-green-board-square';

        let whitePawn = document.createElement('td');
        whitePawn.setAttribute('class', `${colorClass}`);
        whitePawn.setAttribute('id', `cord-2${i}`);

        whitePawn.appendChild(whitePawnImg.cloneNode());

        secondRowElements.push(whitePawn);
    }

    return secondRowElements;
}

function getBoardFirstRowElements()
{
    const firstRowNumber = document.createElement('td');
    firstRowNumber.textContent = "1";
   
    /* White rook on  [1, 1] */
    const firstRowFirstRook = document.createElement('td');
    firstRowFirstRook.setAttribute('class', 'bg-green-board-square');
    firstRowFirstRook.setAttribute('id', 'cord-11');

    const whiteRookImg = document.createElement('img');
    whiteRookImg.setAttribute('class', 'piece-board-img');
    whiteRookImg.setAttribute('src', '/assets/images/white-rook.png');

    firstRowFirstRook.appendChild(whiteRookImg);

    /* White knight on [1, 2] */
    const firstRowFirstKnight = document.createElement('td');
    firstRowFirstKnight.setAttribute('class', 'bg-white');
    firstRowFirstKnight.setAttribute('id', 'cord-12');

    const whiteKnightImg = document.createElement('img');
    whiteKnightImg.setAttribute('class', 'piece-board-img');
    whiteKnightImg.setAttribute('src', '/assets/images/white-knight.png');

    firstRowFirstKnight.appendChild(whiteKnightImg);

    /* White Bishop on [1, 3] */
    const firstRowFirstBishop = document.createElement('td');
    firstRowFirstBishop.setAttribute('class', 'bg-green-board-square');
    firstRowFirstBishop.setAttribute('id', 'cord-13');

    const whiteBishopImg = document.createElement('img');
    whiteBishopImg.setAttribute('class', 'piece-board-img');
    whiteBishopImg.setAttribute('src', '/assets/images/white-bishop.png');

    firstRowFirstBishop.appendChild(whiteBishopImg);

    /* White Quenn on [1, 4] */
    const whiteQuenn = document.createElement('td');
    whiteQuenn.setAttribute('class', 'bg-white');
    whiteQuenn.setAttribute('id', 'cord-14');

    const whiteQuennImg = document.createElement('img');
    whiteQuennImg.setAttribute('class', 'piece-board-img');
    whiteQuennImg.setAttribute('src', '/assets/images/white-quenn.png');

    whiteQuenn.appendChild(whiteQuennImg);

    /* White King on [1, 5] */
    const whiteKing = document.createElement('td');
    whiteKing.setAttribute('class', 'bg-green-board-square');
    whiteKing.setAttribute('id', 'cord-15');

    const whiteKingImg = document.createElement('img');
    whiteKingImg.setAttribute('class', 'piece-board-img');
    whiteKingImg.setAttribute('src', '/assets/images/white-king.png');

    whiteKing.appendChild(whiteKingImg);

    /* White Bishop on [1, 6] */
    const whiteSecondBishop = document.createElement('td');
    whiteSecondBishop.setAttribute('class', 'bg-white');
    whiteSecondBishop.setAttribute('id', 'cord-16');

    whiteSecondBishop.appendChild(whiteBishopImg.cloneNode());

    /* White Knight on [1, 7] */
    const whiteSecondKnight = document.createElement('td');
    whiteSecondKnight.setAttribute('class', 'bg-green-board-square');
    whiteSecondKnight.setAttribute('id', 'cord-17');

    whiteSecondKnight.appendChild(whiteKnightImg.cloneNode());

    /* Black Rook on [1, 8] */
    const whiteSecondRook = document.createElement('td');
    whiteSecondRook.setAttribute('class', 'bg-white');
    whiteSecondRook.setAttribute('id', 'cord-18');

    whiteSecondRook.appendChild(whiteRookImg.cloneNode());

    return [firstRowNumber, firstRowFirstRook, firstRowFirstKnight, firstRowFirstBishop, whiteQuenn, whiteKing, whiteSecondBishop, whiteSecondKnight, whiteSecondRook];
}

function getColumnNameRowElements() {
    const emptySquare = document.createElement('td');

    const columnA = document.createElement('td');
    columnA.textContent = "a";

    const columnB = document.createElement('td');
    columnB.textContent = "b";

    const columnC = document.createElement('td');
    columnC.textContent = "c";

    const columnD = document.createElement('td');
    columnD.textContent = "d";

    const columnE = document.createElement('td');
    columnE.textContent = "e";

    const columnF = document.createElement('td');
    columnF.textContent = "f";

    const columnG = document.createElement('td');
    columnG.textContent = "g";

    const columnH = document.createElement('td');
    columnH.textContent = "h";

    return [emptySquare, columnA, columnB, columnC, columnD, columnE, columnF, columnG, columnH];
}