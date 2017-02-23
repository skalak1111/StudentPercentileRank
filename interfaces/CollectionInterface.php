<?php

/**
 * Collection interface file
 *
 * Copyright (c) 2016, Kiril Savchev
 * All rights reserved.
 *
 * @category Libs
 * @package Collection
 *
 * @author Kiril Savchev <k.savchev@gmail.com>
 *
 * @license https://opensource.org/licenses/BSD-3-Clause BSD 3 License
 * @link http://ifthenelse.info
 */

/**
 * The collection interface
 *
 * The main collection interface that bounds the concrete collectin classes into
 * a class family.
 *
 * @package Collection
 *
 * @author Kiril Savchev <k.savchev@gmail.com>
 *
 * @category Libs
 * @license https://opensource.org/licenses/BSD-3-Clause BSD 3 License
 * @version Release: 1
 * @link http://ifthenelse.info
 */
interface CollectionInterface extends
\ArrayAccess,
\Serializable,
\Countable,
\SeekableIterator {

	/**
	 * Gets a value from the collection
	 *
	 * This method will checks whether it contains the key and if yes, it will
	 * return the value on it. Otherwise it will throw a \OutOfBoundsException.
	 * If the key is not an integer it will throw a \OutOfRangeException
	 *
	 * @param int $key
	 * @return mixed The value for specified key
	 * @throws \OutOfBoundsException
	 * @throws \OutOfRangeException
	 */
	public function get($key);

	/**
	 * Sets a value into the collection
	 *
	 * The value will be added to the end of the collection.
	 * If the collection contains the value it will throw \LogicException.
	 * If the key is not an integer it will throw a \OutOfRangeException
	 *
	 * @param mixed $value The value
	 * @throws \LogicException
	 * @throws \OutOfRangeException
	 */
	public function set($value);

	/**
	 * Updates the value for specified key
	 *
	 * Replace the old value with the new one
	 *
	 * @param mixed $oldValue The old value
	 * @param mixed $newValue The new value
	 * @param int $key The key
	 */
	public function replace($oldValue, $newValue);

	/**
	 * Whether the collection contains a value.
	 *
	 * Will check whether the value is in the collection.
	 *
	 * @param mixed $value The searched value
	 * @return bool True if the collection contains the values, otherwise false
	 */
	public function has($value);

	/**
	 * Removes a value from the collection
	 *
	 * This method will search for the value and will remove if it is in the
	 * collection. If the value is not in the collection it will return true,
	 * if the removing fails it will return false, otherwise on success removing
	 * it will return its key.
	 *
	 * @param mixed $value
	 * @return bool|int True if the value is in the collection, false if removing fails, otherwise - the removed value's key
	 */
	public function remove($value);

	/**
	 * Merges a collection into the current collection
	 *
	 * This method will replace the current collection values when the keys
	 * are the same, will add the rest from the new collection and will
	 * leave the old if their keys are not present in the new one.
	 *
	 * @param \Ite\Collection\CollectionInterface $collection The new collection
	 */
	public function merge(CollectionInterface $collection);

	/**
	 * Remove sub collection
	 *
	 * Checks wether the collection contains the values of sub collections
	 * and removes them.
	 *
	 * @param CollectionInterface $collection The sub collection
	 */
	public function removeCollection(CollectionInterface $collection);

	/**
	 * Return the collection copy as an array
	 *
	 * Nevertheless the collection type, this method will convert it into an
	 * array and will return it
	 *
	 * @return array The collection as an array
	 */
	public function toArray();
}
