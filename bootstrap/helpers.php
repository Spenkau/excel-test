<?php

if (! function_exists("xrange")) {
    /**
     * @param int $start
     * @param int $limit
     * @param int $step
     * @return Generator
     */
    function xrange(int $start, int $limit, int $step = 1): Iterator
    {
        if ($start <= $limit) {
            if ($step <= 0) {
                throw new LogicException('Шаг должен быть положительным');
            }

            for ($i = $start; $i <= $limit; $i += $step) {
                yield $i;
            }
        } else {
            if ($step >= 0) {
                throw new LogicException('Шаг должен быть отрицательным');
            }

            for ($i = $start; $i >= $limit; $i += $step) {
                yield $i;
            }
        }
    }
}
