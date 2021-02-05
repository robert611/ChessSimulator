function playMoveOnTheBoard(move, counter, containerForMoves)
{
    let moveNumber = parseInt(counter.value);

    if (Array.isArray(move.piece)) {
        for (i in move.piece) {
            let newCords = move.new_cords_square[i].square.cords;

            let squareWithThePiece = document.getElementById(`cord-${move.previous_cords[i].previous_cords[0]}${move.previous_cords[i].previous_cords[1]}`);
            let newSquareForThePiece = document.getElementById(`cord-${newCords[0]}${newCords[1]}`);
    
            squareWithThePiece.firstChild.classList.add('opacity-0');
            newSquareForThePiece.firstChild.classList.remove('opacity-0');
            newSquareForThePiece.firstChild.setAttribute('src', `/assets/images/${move.piece[i].picture}`);

            counter.value = moveNumber + 1;
        
            let paragraphWithMove = document.createElement('p');
            paragraphWithMove.textContent = `${moveNumber + 1}. ${move.piece[i].side} ${move.piece[i].name}, from [${move.previous_cords[i].previous_cords} , ${move.previous_cords[i].previous_cords}] to [${newCords[0]}, ${newCords[1]}]
                type: ${move.type}`;
    
            containerForMoves.appendChild(paragraphWithMove);
        }

        document.getElementById('castle-input').value = "";
    }
    else 
    {
        let newCords = move.new_cords_square.cords;

        let squareWithThePiece = document.getElementById(`cord-${move.previous_cords[0]}${move.previous_cords[1]}`);
        let newSquareForThePiece = document.getElementById(`cord-${newCords[0]}${newCords[1]}`);

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
}