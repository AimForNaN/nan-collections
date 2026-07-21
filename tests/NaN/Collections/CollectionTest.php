<?php

use NaN\Collections\Collection;

describe('Collection', function () {
	test('Array conversion', function () {
		$collection = new Collection();

		expect($collection->toArray())
			->toBeEmpty()
		;

		$collection = new Collection(1,2,3);

		expect($collection->toArray())
			->toBe([1,2,3])
		;
	});

	test('Count', function () {
		$collection = new Collection();

		expect($collection)->toBeEmpty();

		$collection = new Collection(1,2,3);

		expect($collection)->toHaveCount(3);

		$collection = new class() extends Collection {
			public function __construct(...$items) {
				parent::__construct(...$items);
			}
		};

		expect($collection)
			->toBeEmpty()
			->and($collection->toArray())
				->toBeEmpty()
		;
	});

	test('Map', function () {
		$collection = new Collection();
		$mappings = $collection->map(fn($item) => (string)$item);
		$mappings = [...$mappings];

		expect($mappings)
			->toBeEmpty()
			->and($mappings)
				->toBe([])
		;

		$collection = new Collection(1,2,3);
		$mappings = $collection->map(fn($item) => (string)$item);
		$mappings = [...$mappings];

		expect($mappings)
			->toHaveCount(3)
			->and($mappings)
				->toBe(['1', '2', '3'])
		;
	});

	test('Splat operator', function () {
		$collection = new Collection(1,2,3);

		expect([...$collection])->toBe([1,2,3]);
	});
});
