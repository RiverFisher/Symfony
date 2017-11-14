<?php

/**
 * Class ArrayWizard
 */
class ArrayWizard {
    /**
     * Decomposed array
     *
     * @var array
     */
    public $decomposedArray = [];

    /**
     * Composed array
     *
     * @var array
     */
    public $composedArray = [];

    /**
     * ArrayWizard constructor
     */
    public function __construct() {
        print_r('Hi! I\'m array wizard. Now I\'m ready to show you some good tricks.' . PHP_EOL);
    }

    /**
     * Decompose array
     *
     * @param $array
     * @return array
     */
    public function decomposeArray($array) {
        $this->decomposedArray = [];

        foreach ($array as $key => $value) {
            $keys = explode('.', $key);

            $embeddingPoint = & $this->decomposedArray;

            for ($serialNumber = 0;
                 $serialNumber < count($keys);
                 $serialNumber++) {
                if ($serialNumber < count($keys) - 1) {
                    if (!$this->link_key_exists($keys[$serialNumber], $embeddingPoint)) {
                        $embeddingPoint[$keys[$serialNumber]] = [];
                    }

                    $embeddingPoint = &$embeddingPoint[$keys[$serialNumber]];
                } else {
                    $embeddingPoint[$keys[$serialNumber]] = $value;
                }
            }
        }
        unset($embeddingPoint);

        print_r($this->decomposedArray);
        return $this->decomposedArray;
    }

    /**
     * Compose array
     *
     * @param $array
     * @return array
     */
    public function composeArray($array) {
        $this->composedArray = [];

        foreach ($array as $key => $value) {
            if (gettype($value) === 'array') {
                $this->composeRecursion($value, [$key]);
            } else {
                $this->composedArray += [$key => $value];
            }
        }

        print_r($this->composedArray);
        return $this->composedArray;
    }

    /**
     * Implementation of recursive array composing
     *
     * @param $array
     * @param $sequence
     */
    public function composeRecursion($array, $sequence) {
        foreach ($array as $key => $value) {
            array_push($sequence, $key);
            if (gettype($value) === 'array') {
                $this->composeRecursion($value, $sequence);
                array_pop($sequence);
            } else {
                $this->composedArray += [implode('.', $sequence) => $value];
                array_pop($sequence);
            }
        }
    }

    /**
     * Unset the result of calculating
     */
    public function unsetResult() {
        $this->decomposedArray = [];
        $this->composedArray = [];
    }

    /**
     * Custom method for verifying the existence of an array key,
     * but passed through a reference
     *
     * snake_case styled - by analogy with the built-in equivalent
     *
     * @param $key
     * @param $link_to_array
     * @return bool
     */
    public function link_key_exists($key, $link_to_array) {
        $array_keys = array_keys($link_to_array);
        foreach ($array_keys as $array_key) {
            if ($array_key == $key) {
                return true;
            }
        }
        return false;
    }
}

$data = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10
];

$customData = [
    'A' => [
        'B' => 7
    ],
    'C' => [
        'D' => [
            'E' => 4
        ],
        'F' => 56
    ],
    'G' => [
        'H' => [
            'I' => [
                'J' => 17
            ],
            'K' => [
                'L' => 2,
                'M' => [
                    'N' => 3,
                    'O' => 0,
                    'P' => 8
                ]
            ]
        ],
        'R' => 96
    ]
];

$wizard = new ArrayWizard();
$result1 = $wizard->decomposeArray($data);
$result2 = $wizard->composeArray($result1);
$result3 = $wizard->composeArray($customData);
$wizard->unsetResult();
