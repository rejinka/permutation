# Permutation

## Abstract

Mathematicians define a permutation as follows:

> "[...] the notion of permutation relates to the act of permuting, or rearranging, members of a set into a particular
> sequence or order (unlike combinations, which are selections that disregard order). For example, there are six
> permutations of the set {1,2,3}, namely (1,2,3), (1,3,2), (2,1,3), (2,3,1), (3,1,2), and (3,2,1)." [1]

This package provides tools for managing permutations - for the time it just provides one tool for creating
permutations. It was created to easily build phpunit-testcases with permutations.

## PermutationIterator

The usage of the PermutationIterator is quite simple:

````
$set = [1, 2, 3];

$iterator = new NajiDev\Permutation\PermutationIterator($set);

foreach ($iterator as $permutationOfSet) {
    var_dump($permutationOfSet);
}
````

In each iteration one of the following arrays (just once) will be dumped:

- array(1, 2, 3)
- array(1, 3, 2)
- array(2, 1, 3)
- array(2, 3, 1)
- array(3, 1, 2)
- array(3, 2, 1)


[1] http://en.wikipedia.org/wiki/Permutation