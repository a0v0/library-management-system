<?php
function calculateFinalMarks($totalMarks, $bonusMarks, $penaltyMarks)
{
    return ($totalMarks + $bonusMarks) - $penaltyMarks;
}

$total = (int)readline("Enter Total Marks: ");
$bonus = (int)readline("Enter Bonus Marks: ");
$penalty = (int)readline("Enter Penalty Marks: ");

echo "Final Marks: " . calculateFinalMarks($total, $bonus, $penalty);
