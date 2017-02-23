<?php
/**
 * ArrayCollection file
 *
 */

require_once 'interfaces/CollectionInterface.php';
require_once 'CollectionTrait.php';

/**
 * ArrayCollection class
 *
 * The Collection class that store the values in array
 *
 */
class ArrayCollection implements CollectionInterface {

    use CollectionTrait;

    /**
     * The collection pointer position
     *
     * @var int
     */
    protected $position;

    /**
     * ArrayCollection class
     *
     * The Collection class that store the values in array
     *
     * @param array $collection
     */
    public function __construct(array $collection = []) {
        $this->collection = $collection;
        $this->rewind();
    }

    /**
     * {@inheritdoc}
     * @return int
     */
    public function count() {
        return count($this->collection);
    }

    /**
     * {@inheritdoc}
     * @return mixed
     */
    public function current() {
        return current($this->collection);
    }

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
    public function get($key) {
        $this->seek($key);
        return $this->current();
    }

    /**
     * Whether the collection contains a value.
     *
     * Will check whether the value is in the collection.
     *
     * @param mixed $value The searched value
     * @return bool True if the collection contains the values, otherwise false
     */
    public function has($value) {
        return in_array($value, $this->collection);
    }

    /**
     * {@inheritdoc}
     * @return int
     */
    public function key() {
        $this->position = key($this->collection);
        return $this->position;
    }

    /**
     * Merges a collection into the current collection
     *
     * This method will replace the current collection values when the keys
     * are the same, will add the rest from the new collection and will
     * leave the old if their keys are not present in the new one.
     *
     * @param \Ite\Collection\CollectionInterface $collection The new collection
     */
    public function merge(CollectionInterface $collection) {
        $this->collection = array_values(array_replace($this->toArray(), $collection->toArray()));
        $this->rewind();
    }

    /**
     * {@inheritdoc}
     * @return void
     */
    public function next() {
        $this->position++;
        next($this->collection);
    }

    /**
     * Removes a value from the collection
     *
     * This method will search for the value and will remove if it is in the
     * collection. If the value is not in the collection it will return true,
     * if the removing fails it will return false, otherwise on success removing
     * it will return its key.
     *
     * @param mixed $value
     * @return bool|int True if the value is in not the collection, false if removing fails, otherwise - the removed value's key
     */
    public function remove($value) {
        if ($this->has($value)) {
            $key = array_search($value, $this->collection);
            unset($this->collection[$key]);
            $this->collection = array_values($this->collection);
        } else {
            return true;
        }
    }

    /**
     * Updates the value for specified key
     *
     * Replace the old value with the new one
     *
     * @param mixed $oldValue The old value
     * @param mixed $newValue The new value
     */
    public function replace($oldValue, $newValue) {
        $key = array_search($oldValue, $this->collection);
        if ($key !== false) {
            $this->collection[$key] = $newValue;
        } else {
            $this->collection[] = $newValue;
        }
    }

    /**
     * {@inheritdoc}
     * @return void
     */
    public function rewind() {
        reset($this->collection);
        $this->position = 0;
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function serialize() {
        return serialize($this->collection);
    }

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
    public function set($value) {
        if (!$this->has($value)) {
            $this->collection[] = $value;
        } else {
            throw new \LogicException("Already in the collection");
        }
    }

    /**
     * Return the collection copy as an array
     *
     * Nevertheless the collection type, this method will convert it into an
     * array and will return it
     *
     * @return array The collection as an array
     */
    public function toArray() {
        return $this->getCollection();
    }

    /**
     * {@inheritdoc}
     * @return void
     */
    public function unserialize($serialized) {
        $this->collection = unserialize($serialized);
        $this->rewind();
    }

    /**
     * {@inheritdoc}
     * @return bool
     */
    public function valid() {
        return $this->position < $this->count();
    }

    /**
     * Remove sub collection
     * 
     * Checks wether the collection contains the values of sub collections
     * and removes them.
     * 
     * @param CollectionInterface $collection The sub collection
     */
    public function removeCollection(CollectionInterface $collection) {
        $diff = array_diff($this->collection, $collection->toArray());
        $this->collection = array_values($diff);
    }

}