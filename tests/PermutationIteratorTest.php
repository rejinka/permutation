<?php

/*
 * This file is part of the Permutation package.
 *
 * (c) Tony Lemke <tlemke@naji-dev.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NajiDev\Permutation\Tests;

use NajiDev\Permutation\PermutationIterator;
use stdClass;


class PermutationIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider arrayProvider
     */
    public function testAllPermutationsWillBeBuilt($original, $numberOfPermutations)
    {
        $iterator = new PermutationIterator($original);

        // this loop makes sure, that sure, that no permutation is duplicated
        $permutations = array();
        foreach ($iterator as $permutation) {
            if (in_array($permutation, $permutations, true)) {
                $this->fail('Generated a permutation a second time');
            }

            $permutations[] = $permutation;
        }

        // 7! = 5040 is the number of expected permutations, all unique!
        $this->assertCount($numberOfPermutations, $permutations);
    }

    public function arrayProvider()
    {
        return array(
            array(
                array(1),
                1 // 1! = 1
            ),
            array(
                array(
                    1, 2, 3, 4
                ),
                24 // 4! = 24
            ),
            array(
                array(
                    1, 12.4, 'a', array('b'), array(array('c')), new stdClass(), new \InvalidArgumentException()
                ),
                5040 // 7! = 5040
            )
        );
    }

    public function testEmptyElements()
    {
        $this->setExpectedException('InvalidArgumentException', 'The set must not be empty');
        new PermutationIterator(array());
    }
}