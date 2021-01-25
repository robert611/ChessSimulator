let playGameButton = document.getElementById('play-game-button');
let playNextMoveButton = document.getElementById('play-next-move-button');
let containerForMoves = document.getElementById('container-for-moves');

function playGame()
{
    fetch('/api/game/play')
        .then(response => response.json())
        .then(response => JSON.parse(response))
        .then(response => {
            resetBoardToGameStartingPosition(response);

            playNextMove(response);
        });
}

function playNextMove(game)
{
    playNextMoveButton.addEventListener('click', () => {
        /* Get move cords, get squares on the board to which those cords belong and change images of pieces */
        let counter = document.getElementById('move-counter');
        let moveNumber = parseInt(counter.value);

        if (game.moves.length - 1 < moveNumber) {
            alert("That's all moves");
            return;
        }

        let move = game.moves[moveNumber];

        if (Array.isArray(move.piece)) {
            for (i in move.piece) {                
                let newCords = move.new_cords_square[i].square.cords;

                let squareWithThePiece = document.getElementsByClassName(`cord-${move.previous_cords[i].previous_cords[0]}${move.previous_cords[i].previous_cords[1]}`)[0];
                let newSquareForThePiece = document.getElementsByClassName(`cord-${newCords[0]}${newCords[1]}`)[0];
        
                squareWithThePiece.firstChild.classList.add('opacity-0');
                newSquareForThePiece.firstChild.classList.remove('opacity-0');
                newSquareForThePiece.firstChild.setAttribute('src', `/assets/images/${move.piece[i].picture}`);
        
                counter.value = moveNumber + 1;
        
                let paragraphWithMove = document.createElement('p');
                paragraphWithMove.textContent = `${moveNumber + 1}. ${move.piece[i].side} ${move.piece[i].name}, from [${move.previous_cords[i].previous_cords} , ${move.previous_cords[i].previous_cords}] to [${newCords[0]}, ${newCords[1]}]
                    type: ${move.type}`;
        
                containerForMoves.appendChild(paragraphWithMove);
            }
        }
        else 
        {
            let newCords = move.new_cords_square.cords;

            let squareWithThePiece = document.getElementsByClassName(`cord-${move.previous_cords[0]}${move.previous_cords[1]}`)[0];
            let newSquareForThePiece = document.getElementsByClassName(`cord-${newCords[0]}${newCords[1]}`)[0];
    
            if (move.piece.name == 'pawn' && ((move.piece.side == 'white' && newCords[0] == 8) || (move.piece.side == 'black' && newCords[0] == 1))) 
            {
                move.piece.picture = move.piece.side + '-quenn.png';
            }
    
            squareWithThePiece.firstChild.classList.add('opacity-0');
            newSquareForThePiece.firstChild.classList.remove('opacity-0');
            newSquareForThePiece.firstChild.setAttribute('src', `/assets/images/${move.piece.picture}`);
    
            counter.value = moveNumber + 1;
    
            let paragraphWithMove = document.createElement('p');
            paragraphWithMove.textContent = `${moveNumber + 1}. ${move.piece.side} ${move.piece.name}, from [${move.previous_cords[0]} , ${move.previous_cords[1]}] to [${newCords[0]}, ${newCords[1]}]
                type: ${move.type}`;
    
            containerForMoves.appendChild(paragraphWithMove);
        }
    });
}

function resetBoardToGameStartingPosition(game)
{
    document.getElementById('move-counter').value = "0";

    recreatePlayNextMoveButton();

    /* First recreate board to last move position and then go from last move to first so it will be starting position */
    for (let i = 1; i <= 8; i++) {
        for (let j = 1; j <= 8; j++) {
            let piece = game.board[i][j].piece;

            let squaresWithThisPiece = document.getElementsByClassName(`cord-${i}${j}`)[0];

            if (piece != null)
            {
                squaresWithThisPiece.firstChild.classList.remove('opacity-0');
                squaresWithThisPiece.firstChild.setAttribute('src', `/assets/images/${piece.picture}`)
            }
            else 
            {
                squaresWithThisPiece.firstChild.classList.add('opacity-0');
                squaresWithThisPiece.firstChild.setAttribute('src', `/assets/images/black-pawn.png`)
            }
        }
    }

    let movesLength = game.moves.length;

    for (i in game.moves)
    {
        let move = game.moves[movesLength - (parseInt(i) + 1)];

        /* If move is of type castle it will be array */
        if (Array.isArray(move.piece)) 
        {
            for (i in move.piece) {
                makeMove(move.new_cords_square[i].square.cords, move.piece[i], move.previous_cords[i].previous_cords, move.new_cords_square[i].square.piece);
            }
        }
        else 
        {
            makeMove(move.new_cords_square.cords, move.piece, move.previous_cords, move.new_cords_square.piece);
        }
       
    }
}

function makeMove(newCords, piece, previousCords, newCordsSquarePiece) 
{
    const squareWithThePiece = document.getElementsByClassName(`cord-${newCords[0]}${newCords[1]}`)[0];
    const newSquareForThePiece = document.getElementsByClassName(`cord-${previousCords[0]}${previousCords[1]}`)[0];

    if (newCordsSquarePiece != null) {
        squareWithThePiece.firstChild.setAttribute('src', `/assets/images/${newCordsSquarePiece.picture}`);
    } else {
        squareWithThePiece.firstChild.classList.add('opacity-0');
    }

    newSquareForThePiece.firstChild.classList.remove('opacity-0');
    newSquareForThePiece.firstChild.setAttribute('src', `/assets/images/${piece.picture}`);
}

function recreatePlayNextMoveButton()
{
    playNextMoveButton.remove();

    let container = playGameButton.parentElement;

    let newButton = document.createElement('button');
    newButton.setAttribute('class', 'btn btn-primary');
    newButton.setAttribute('id', 'play-next-move-button');
    newButton.textContent = "Play next move";

    container.appendChild(newButton);

    playNextMoveButton = document.getElementById('play-next-move-button');
}

playGameButton.addEventListener('click', playGame);