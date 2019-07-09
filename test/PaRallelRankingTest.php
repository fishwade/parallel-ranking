<?php

namespace  FishWade\ParallelRanking\Test;

use PHPUnit\Framework\TestCase;
use FishWade\ParallelRanking\ParallelRanking;

class ParallelRankingTest extends TestCase
{
    public function testParallelRanking()
    {
        $data= [];
        for ($i = 1; $i <= 10; $i++) {
            $score = $i;
            if (in_array($i, [6, 7])) {
                $score = 2;
            }
            if (in_array($i, [8, 9])) {
                $score = 3;
            }
            if ($i == 10) {
                $score = 4;
            }
            $data[] = ['user_id' => $i, 'score' => $score];
        }
        $parallel_ranking = new ParallelRanking();
        $new_data = $parallel_ranking->parallelRanking($data);
        $result = [
            ['user_id' => 5, 'score' => 5, 'rank' => 1],
            ['user_id' => 4, 'score' => 4, 'rank' => 2],
            ['user_id' => 10, 'score' => 4, 'rank' => 2],
            ['user_id' => 3, 'score' => 3, 'rank' => 4],
            ['user_id' => 8, 'score' => 3, 'rank' => 4],
            ['user_id' => 9, 'score' => 3, 'rank' => 4],
            ['user_id' => 2, 'score' => 2, 'rank' => 7],
            ['user_id' => 6, 'score' => 2, 'rank' => 7],
            ['user_id' => 7, 'score' => 2, 'rank' => 7],
            ['user_id' => 1, 'score' => 1, 'rank' => 10],
        ];

        $this->assertEquals($result, $new_data);
    }
}