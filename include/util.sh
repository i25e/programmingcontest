#!/bin/bash

random_n_digits() { # n, seed, tail
    RANDOM=$2
    r=$RANDOM

    tail="${3}${r}"

    [ ${#tail} -lt $1 ] && random_n_digits $1 $r $tail || echo $tail
}

random_n_numbers() { # n, seed
    RANDOM=$2
    r=$RANDOM

    [ $1 -gt 0 ] && echo $r && random_n_numbers $(($1 - 1)) $r
}
