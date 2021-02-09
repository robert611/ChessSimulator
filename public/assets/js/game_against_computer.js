const playGameWithComputerButton = document.getElementById('play-game-with-computer-button');
const playNextMoveAgainstComputerForm = document.getElementById('play-next-move-against-computer-form');
const containerForHumanGameMoves = document.getElementById('container-for-human-game-moves');
let playHumanMoveButton = document.getElementById('play-human-move-button');
let humanGameMoveCounter = document.getElementById('human-game-move-counter');
const colorButtonsDiv = document.getElementById('pick-color-buttons-div');
const colorButtons = document.getElementsByClassName('pick-color-button');

function playGameBeetwenHumandAndComputer(piecesColor)
{
    fetch(`/api/game/play/with/computer/${piecesColor}`)
        .then(response => response.json())
        .then(response => JSON.parse(response))
        .then(response => {
            recreatePlayHumanMoveButton();
            if (piecesColor == "black") reverseStartingBoardPosition(); 
            else resetBoardToStartingPosition();
            resetMovesContainers();
            resetCounters();

            enableHumanToPlayMove(response.game_file_name)

            if (response.moves.length > 0) {
                playMoveOnTheBoard(response.moves[0], humanGameMoveCounter, containerForHumanGameMoves);
            }
        });
}

function showPickColorButtons()
{
    colorButtonsDiv.classList.remove('hidden');
}

function enableHumanToPlayMove(gameFileName)
{
    playHumanMoveButton.removeAttribute("disabled");

    playHumanMoveButton.addEventListener('click', (e) => {
        e.preventDefault();

        let castle = document.getElementById('castle-input').value;

        let currentXCoordinate = document.getElementById('piece-current-coordinate-x-input').value;
        let currentYCoordinate = document.getElementById('piece-current-coordinate-y-input').value;

        let newXCoordinate = document.getElementById('piece-new-coordinate-x-input').value;
        let newYCoordinate = document.getElementById('piece-new-coordinate-y-input').value;

        let moveFrom = [currentXCoordinate, currentYCoordinate];
        let moveTo = [newXCoordinate, newYCoordinate];

        let data = new FormData();

        data.append('from_x', moveFrom[0]);
        data.append('from_y', moveFrom[1]);
        data.append('to_x', moveTo[0]);
        data.append('to_y', moveTo[1]);
        data.append('castle', castle);
        data.append('game_file_name', gameFileName);

        fetch('/api/game/play/move/against/computer', {method: 'POST', body: data})
            .then(response => response.json())
            .then(response => JSON.parse(response))
            .then(response => {

                if (response.error) {
                    alert(response.error);
                } else if (response.result.result == "") {
                    playMoveOnTheBoard(response.moves[response.moves.length - 2], humanGameMoveCounter, containerForHumanGameMoves);

                    setTimeout(() => {
                        playMoveOnTheBoard(response.moves[response.moves.length - 1], humanGameMoveCounter, containerForHumanGameMoves);
                    }, 2000);
                } else {
                    playMoveOnTheBoard(response.moves[response.moves.length - 1], humanGameMoveCounter, containerForHumanGameMoves);

                    setTimeout(() => {
                        endGameBeetwenHumandAndComputer(response.result);
                    }, 1000);
                }
            });
    });
}

function recreatePlayHumanMoveButton()
{
    playHumanMoveButton.remove();

    let newButton = document.createElement('button');
    newButton.setAttribute('class', 'btn btn-outline-primary');
    newButton.setAttribute('type', 'submit');
    newButton.setAttribute('id', 'play-human-move-button');
    newButton.textContent = "Play your move";

    playNextMoveAgainstComputerForm.appendChild(newButton);

    playHumanMoveButton = document.getElementById('play-human-move-button');
}

function endGameBeetwenHumandAndComputer(result)
{
    alert(`Gra została skończona wynikiem: ${result.result}, powód: ${result.type}`);

    playHumanMoveButton.setAttribute('disabled', true);
}

playGameWithComputerButton.addEventListener('click', showPickColorButtons);

Array.from(colorButtons).forEach((button) => {
    let piecesColor = button.getAttribute('data-color');
    button.addEventListener('click', () => {playGameBeetwenHumandAndComputer(piecesColor)});
});
