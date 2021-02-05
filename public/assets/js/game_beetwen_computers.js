let playGameBeetwenComputersButton = document.getElementById('play-game-beetwen-computers-button');
let playNextMoveButton = document.getElementById('play-next-move-button');
let containerForMoves = document.getElementById('container-for-moves');

function playGameBeetwenComputers()
{
    fetch('/api/game/play/beetwen/computers')
        .then(response => response.json())
        .then(response => JSON.parse(response))
        .then(response => {
            resetBoardToStartingPosition(response);
            recreatePlayNextMoveButton();
            resetMovesContainers();
            resetCounters();
            
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

        playMoveOnTheBoard(move, counter, containerForMoves);
    });
}

function resetCounters()
{
    document.getElementById('human-game-move-counter').value = "0";
    document.getElementById('move-counter').value = "0";
}

function resetMovesContainers()
{
    document.getElementById('container-for-moves').textContent = "";
    document.getElementById('container-for-human-game-moves').textContent = "";
}

function recreatePlayNextMoveButton()
{
    playNextMoveButton.remove();

    let container = playGameBeetwenComputersButton.parentElement;

    let newButton = document.createElement('button');
    newButton.setAttribute('class', 'btn btn-primary');
    newButton.setAttribute('id', 'play-next-move-button');
    newButton.textContent = "Play next move";

    container.appendChild(newButton);

    playNextMoveButton = document.getElementById('play-next-move-button');
}

playGameBeetwenComputersButton.addEventListener('click', playGameBeetwenComputers);