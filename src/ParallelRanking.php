<?php

namespace  FishWade\ParallelRanking;

class ParallelRanking
{
    public function parallelRanking(Array $data)
    {
        array_multisort(array_column($data, 'score'), SORT_DESC, $data);
        $new_data = [];
        $rank = 1;
        $position = 1;
        $last_ranking_score = 0;
        foreach ($data as $datum) {
            if ($datum['score'] != $last_ranking_score) {
                $rank = $position;
            }
            $datum['rank'] = $rank;
            $new_data[] = $datum;
            $last_ranking_score = $datum['score'];
            $position++;
        }

        return $new_data;
    }
}
