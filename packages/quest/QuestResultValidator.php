<?php

namespace Packages\quest;

use App\QuestResult;

class QuestResultValidator
{
    public function validateProperClearOrder($questResultId, $authUserId)
    {
        $latestQuestResult = QuestResult::query()->where('user_id', '=', $authUserId)->where('isCleared', '=', true)->orderByDesc('id')->first();
        if ($latestQuestResult == []) {
            return $questResultId == 1;
        } else {
            return $questResultId == QuestResult::query()->where('user_id', '=', $authUserId)->orderByDesc('id');
        }
    }
}
