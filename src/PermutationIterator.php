<?php

/*
 * This file is part of the Permutation package.
 *
 * (c) Tony Lemke <tlemke@naji-dev.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NajiDev\Permutation;

use Iterator;


/**
 * This Iterator generates permutation of the given elements. It uses the iterative algorithm "The Counting QuickPerm
 * Algorithm".
 *
 * @link http://www.quickperm.org/quickperm.php
 */
class PermutationIterator implements Iterator
{
    protected $elements;
    protected $elementCount;

    protected $p, $i, $j, $k;
    protected $hasNext;

    public function __construct(array $elements)
    {
        if (empty($elements)) {
            throw new \InvalidArgumentException('The set must not be empty');
        }

        $this->elements     = array_values($elements);
        $this->elementCount = count($this->elements);
    }

    public function current()
    {
        return $this->elements;
    }

    public function next()
    {
        $this->k++;

        while ($this->i < $this->elementCount) {
            if ($this->p[$this->i] < $this->i) {
                $this->j = ($this->i % 2) * $this->p[$this->i];

                // swap the elements
                $tmp = $this->elements[$this->j];
                $this->elements[$this->j] = $this->elements[$this->i];
                $this->elements[$this->i] = $tmp;

                $this->p[$this->i]++;
                $this->i = 1;

                return;
            }

            $this->p[$this->i++] = 0;
        }

        $this->hasNext = false;
    }

    public function key()
    {
        return $this->k;
    }

    public function valid()
    {
        return $this->hasNext;
    }

    public function rewind()
    {
        if ($this->elementCount) {
            $this->p = array_fill(0, $this->elementCount, 0);
        }

        $this->hasNext = true;
        $this->i = 1;
        $this->j = 0;
        $this->k = 0;
    }

}