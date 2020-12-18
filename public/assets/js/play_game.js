let playGameButton = document.getElementById('play-game-button');
let playNextMoveButton = document.getElementById('play-next-move-button');

function playGame()
{
    fetch('/api/game/play')
        .then(response => response.json())
        .then(response => JSON.parse(response))
        .then(response => {
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

        let squaresWithTheCordOne = document.querySelectorAll(`[data-CordOne="${move.previous_cords[0]}"]`);
        let newSquaresWithTheCordOne = document.querySelectorAll(`[data-CordOne="${move.new_cords[0]}"]`);

        let squareWithThePiece = null;
        let newSquareForThePiece = null;

        for (square in squaresWithTheCordOne) {
            if (squaresWithTheCordOne[square].getAttribute('data-CordTwo') == move.previous_cords[1]) {
                squareWithThePiece = squaresWithTheCordOne[square];
                break;
            }
        }

        for (square in newSquaresWithTheCordOne) {
            if (newSquaresWithTheCordOne[square].getAttribute('data-CordTwo') == move.new_cords[1]) {
                newSquareForThePiece = newSquaresWithTheCordOne[square];
                break;
            }
        }

        squareWithThePiece.firstChild.classList.add('opacity-0');
        newSquareForThePiece.firstChild.classList.remove('opacity-0');
        newSquareForThePiece.firstChild.setAttribute('src', `/assets/images/${move.piece.picture}`);


        counter.value = moveNumber + 1;
    });
}

playGameButton.addEventListener('click', playGame);