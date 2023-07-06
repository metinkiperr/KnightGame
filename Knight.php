<?php

declare(strict_types=1);

class Knight
{
    public string $name;
    public int $lifePoints;

    public function __construct(string $name, int $lifePoints)
    {
        $this->name = $name;
        $this->lifePoints = $lifePoints;
    }
}

function playGame(int $numKnights, int $lifePoints): void
{
    if ($numKnights < 0 || $lifePoints < 0) {
        echo "Please add a positive integer.\n";

        return;
    }

    if ($numKnights <= 1) {
        echo "Please add more knights \n";

        return;
    }

    $knights = [];

    for ($i = 1; $i <= $numKnights; $i++) {
        $knight = new Knight("Knight $i", $lifePoints);
        $knights[] = $knight;
    }

    $currentPlayerIndex = 0;

    while (count($knights) > 1) {
        $currentPlayer = $knights[$currentPlayerIndex];
        $nextPlayerIndex = ($currentPlayerIndex + 1) % count($knights);
        $nextPlayer = $knights[$nextPlayerIndex];

        $diceRoll = mt_rand(1, 6);
        $nextPlayer->lifePoints -= $diceRoll;

        echo "$currentPlayer->name rolled: $diceRoll.\n";
        echo "$nextPlayer->name's life points: $nextPlayer->lifePoints\n";

        if ($nextPlayer->lifePoints <= 0) {
            echo "$nextPlayer->name died.\n";
            unset($knights[$nextPlayerIndex]);

            $knights = array_values($knights);
            if ($nextPlayerIndex < $currentPlayerIndex) {
                $currentPlayerIndex--;
            }
        }

        $currentPlayerIndex = ($currentPlayerIndex + 1) % count($knights);
    }

    $winner = $knights[0];

    echo "The winner is: $winner->name\n";
}

playGame(3, 10);
