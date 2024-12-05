const board = document.getElementById('board');
const cells = document.querySelectorAll('.cell');
const statusDiv = document.getElementById('status');
const resetButton = document.getElementById('reset');

let currentPlayer = 'X';
let gameBoard = ['', '', '', '', '', '', '', '', ''];
let gameActive = true;

// Check for a winner
const checkWinner = () => {
    const winPatterns = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6],
    ];

    for (let pattern of winPatterns) {
        const [a, b, c] = pattern;
        if (gameBoard[a] && gameBoard[a] === gameBoard[b] && gameBoard[a] === gameBoard[c]) {
            gameActive = false;
            return gameBoard[a]; // Return the winner ('X' or 'O')
        }
    }

    // Check for a draw (no empty spaces left)
    if (!gameBoard.includes('')) {
        gameActive = false;
        return 'Draw';
    }

    return null;
};

// Handle the player's click on the board
const handleClick = (index) => {
    if (gameBoard[index] || !gameActive) return; // Ignore if already clicked or game is over

    // Mark the board with the current player's symbol
    gameBoard[index] = currentPlayer;
    cells[index].textContent = currentPlayer;

    // Check if the game is won or drawn
    const winner = checkWinner();
    if (winner) {
        if (winner === 'Draw') {
            statusDiv.textContent = "It's a draw!";
        } else {
            statusDiv.textContent = `${winner} wins!`;
        }
    } else {
        currentPlayer = currentPlayer === 'X' ? 'O' : 'X'; // Switch player
        statusDiv.textContent = `${currentPlayer}'s turn`;
    }
};

// Reset the game
const resetGame = () => {
    gameBoard = ['', '', '', '', '', '', '', '', ''];
    gameActive = true;
    currentPlayer = 'X';
    statusDiv.textContent = `${currentPlayer}'s turn`;

    // Clear the cells
    cells.forEach(cell => cell.textContent = '');
};

// Add event listeners to each cell
cells.forEach(cell => {
    cell.addEventListener('click', () => handleClick(cell.dataset.index));
});

// Add event listener to reset button
resetButton.addEventListener('click', resetGame);
