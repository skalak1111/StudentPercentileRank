<?php

/**
 * Collection trait file
 * 
 */

/**
 * The collection trait
 *
 * The trait that provides the minimum base functionalities and collections
 * storage.
 *
 */
trait CollectionTrait {

	/**
	 * The concrete collection storage
	 *
	 * @var mixed
	 */
	protected $collection;

	/**
	 * Returns the concrete collection storage
	 *
	 * In the context of the concrete class this may be an array,
	 * \SplObjectStorage or other data container
	 *
	 * @return mixed The concrete collection storage
	 */
	public function getCollection() {
		return $this->collection;
	}

	/**
	 * Checks whether the key is valid
	 *
	 * Checks the key type and the whether the key is in the collection
	 * bound
	 *
	 * @param int $key
	 * @throws \OutOfRangeExcpetion
	 * @throws \OutOfBoundsException
	 */
	protected function checkKey($key) {
		try {
			$this->seek($key);
			$this->rewind();
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 *
	 * @throws \OutOfRangeException
	 */
	protected function throwOutOfRange() {
		throw new \OutOfRangeException("Invalid key type");
	}

	/**
	 *
	 * @throws \OutOfBoundsException
	 */
	protected function throwOutOfBounds() {
		throw new \OutOfBoundsException("No such key");
	}

	/**
	 * {@inheritdoc}
	 * @return void
	 */
	public function seek($key) {
		if (!is_int($key)) {
			$this->throwOutOfRange();
		}
		if ($key > $this->count()) {
			$this->throwOutOfBounds();
		}
		if ($this->key() != $key) {
			$this->rewind();
			while ($this->key() != $key) {
				$this->next();
			}
		}
		return true;
	}

	/**
	 * {@inheritdoc}
	 * @return bool
	 */
	public function offsetExists($offset) {
		try {
			return $this->seek($offset);
		} catch (\Exception $e) {
			return false;
		}
	}

	/**
	 * {@inheritdoc}
	 * @param int $offset
	 * @return mixed
	 */
	public function offsetGet($offset) {
		return $this->get($offset);
	}

	/**
	 * {@inheritdoc}
	 * @param int $offset
	 * @param mixed $value
	 */
	public function offsetSet($offset, $value) {
		$this->set($value, $offset);
	}

	/**
	 * {@inheritdoc}
	 * @param int $offset
	 */
	public function offsetUnset($offset) {
		$this->seek($offset);
		$current = $this->current();
		$this->remove($current);
	}

}